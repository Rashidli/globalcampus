<?php

namespace App\Http\Controllers;

use App\Enums\UserType;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Services\ActivityLogger;
use App\Http\Services\UserService;
use App\Models\Service;
use App\Models\Settings\Citizenship;
use App\Models\Settings\EducationLevel;
use App\Models\Settings\Period;
use App\Models\Settings\Profession;
use App\Models\Settings\UniversityList;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class StudentController extends Controller
{
    public function __construct(protected UserService $userService)
    {
        $this->middleware('permission:list-students|create-students|edit-students|delete-students', ['only' => ['index', 'show']]);
        $this->middleware('permission:create-students', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit-students', ['only' => ['edit']]);
        $this->middleware('permission:delete-students', ['only' => ['destroy']]);
    }

    private function applyUserFilters(Request $request, $query, User $user)
    {
        //        dd($request->all());
        return $query
            ->when($request->filled('user_id'), fn ($q) => $q->whereIn('id', $request->user_id))
            ->when(
                $request->filled('agent_id'),
                fn ($q) => $q->whereIn('agent_id', $request->agent_id)
            )
            ->when($request->filled('university_list_id'), fn ($q) => $q->whereHas(
                'programs',
                fn ($q) => $q->whereIn('university_list_id', $request->university_list_id)
            ))
            ->when($request->filled('period_id'), fn ($q) => $q->whereHas(
                'programs',
                fn ($q) => $q->whereIn('period_id', $request->period_id)
            ))
            ->when($request->filled('education_level_id'), fn ($q) => $q->whereHas(
                'programs',
                fn ($q) => $q->where('education_level_id', $request->education_level_id)
            ))
            ->when($request->filled('profession_id'), fn ($q) => $q->whereHas(
                'programs.tariff',
                fn ($q) => $q->whereIn('profession_id', $request->profession_id)
            ));
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //        dd($request->all());
        $user = auth()->user();

        //        dd(User::query()->where('agent_id', $user->id)->get());

        // For agents, only show their own students
        if ($user->type === UserType::AGENT->value) {
            $query = User::with(['agent', 'agent.agent_info', 'programs'])
                ->where('type', UserType::STUDENT)
                ->where('agent_id', $user->id);
        }
        // For admin, check if we're viewing a specific agent's students
        elseif ($request->has('agent_id')) {
            $query = User::with(['agent', 'agent.agent_info', 'programs'])
                ->where('type', UserType::STUDENT)
                ->whereIn('agent_id', $request->agent_id);
        }
        // For admin viewing all students
        else {
            $query = User::with(['agent', 'agent.agent_info', 'programs'])
                ->where('type', UserType::STUDENT);
        }

        // Apply filters directly to the User query
        $query = $this->applyUserFilters($request, $query, $user);

        $users = $query->orderByDesc('created_at')->paginate(10)->withQueryString();
        $count = $users->total();

        $agents           = User::with('agent_info')->where('type', UserType::AGENT)->get();
        $periods          = Period::all();
        $education_levels = EducationLevel::with('school_types')->get();
        $professions      = Profession::all();
        $university_lists = UniversityList::all();
        $students         = User::query()->where('type', UserType::STUDENT)->orderByDesc('id')->get();

        return view('students.index', compact(
            'users',
            'agents',
            'periods',
            'education_levels',
            'professions',
            'university_lists',
            'count',
            'students'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $citizenships = Citizenship::all();
        $agents       = User::query()->with('agent_info')->where('type', UserType::AGENT)->get();

        return view('students.create', compact('agents', 'citizenships'));
    }

    public function show(string $id)
    {
        $user = User::query()->with(
            'educations',
            'experiences',
            'languages',
            'programs',
            'documents',
            'services',
            'costs'
        )
            ->findOrFail($id);

        $services = Service::all();

        $education_levels = EducationLevel::query()->with('settingDocuments')->get();

        return view('students.show', compact('user', 'services', 'education_levels'));
    }

    public function single_student()
    {
        $id   = auth()->user()->id;
        $user = User::query()->with(
            'educations',
            'experiences',
            'languages',
            'programs',
            'documents',
            'services',
            'costs'
        )
            ->findOrFail($id);
        $services  = Service::all();
        $isStudent = $user->hasRole('Student');

        return view('students.single_student', compact('user', 'services', 'isStudent'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = User::query()->with(
            'educations',
            'experiences',
            'languages',
            'programs',
            'documents'
        )
            ->findOrFail($id);
        $citizenships = Citizenship::all();
        $agents       = User::query()->where('type', UserType::AGENT)->get();

        return view('students.edit', compact('user', 'agents', 'citizenships'));
    }

    public function destroy($id)
    {
        $user = User::query()->findOrFail($id);
        $user->delete();
        session()->flash('success', 'Tələbə silindi.');

        ActivityLogger::log(
            eventType: 'destroy',
            loggable: $user,
            student_id: $user->id,
            customDescription: 'tələbə silindi.'
        );

        return redirect()->route('students.index');
    }

    public function toggleStatus($id)
    {
        $user = User::query()->with('student_info')->findOrFail($id);

        $studentInfo            = $user->student_info;
        $studentInfo->is_active = ! $studentInfo->is_active;
        $studentInfo->save();

        return response()->json([
            'status' => $studentInfo->is_active ? 'active' : 'deactivated',
        ]);
    }

    public function store(StoreStudentRequest $request)
    {
        try {
            $validatedData = $request->validated();

            $user = $this->userService->createUser($validatedData);

            $user->assignRole(2);

            ActivityLogger::log(
                eventType: 'store',
                loggable: $user,
                student_id: $user->id,
                customDescription: 'Şəxsi kabinet yaradıldı.'
            );

            session()->flash('success', 'Tələbə əlavə edildi.!');

            return redirect()->route(auth()->user()->hasRole('Agent') ? 'agent_students' : 'students.index');
        } catch (Exception $exception) {
            return $exception->getMessage();
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $user = User::query()->findOrFail($id);

            $request->validate([
                'name'           => 'nullable|string|max:255',
                'surname'        => 'nullable|string|max:255',
                'phone'          => 'nullable|string|max:255',
                'father_name'    => 'nullable|string|max:255',
                'mother_name'    => 'nullable|string|max:255',
                'birthday'       => 'nullable|date',
                'contact_email'  => 'nullable|email|max:255',
                'address'        => 'nullable|string|max:255',
                'marital_status' => 'nullable',
                'gender'         => 'nullable|string',
                'password'       => 'nullable',
            ]);

            if ($request->hasFile('image')) {
                $file     = $request->file('image');
                $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('files'), $filename);
                $user->image = $filename;
            }

            $updateData = [
                'name'     => $request->name,
                'surname'  => $request->surname,
                'phone'    => $request->phone,
                'agent_id' => $request->agent_id,
            ];

            if ( ! empty($request->password)) {
                $updateData['password'] = bcrypt($request->password);
            }
            $oldData = $user->toArray();
            $user->update($updateData);
            $newData     = $user->fresh()->toArray();
            $changedData = array_diff_assoc($newData, $oldData);
            unset($changedData['updated_at']);
            ActivityLogger::log(
                eventType: 'update',
                loggable: $user,
                student_id: $user->id,
                oldData: $oldData,
                newData: $newData,
                changedData: $changedData,
                customDescription: 'şəxsi məlumatlarda dəyişiklik olundu.'
            );

            if ($user->student_info) {
                $oldStudentInfoData = $user->student_info->toArray();

                $user->student_info->update([
                    'father_name'     => $request->father_name,
                    'mother_name'     => $request->mother_name,
                    'birthday'        => $request->birthday,
                    'contact_email'   => $request->contact_email,
                    'address'         => $request->address,
                    'marital_status'  => $request->marital_status,
                    'gender'          => $request->gender,
                    'passport_number' => $request->passport_number,
                    'identity_number' => $request->identity_number,
                    'citizenship'     => $request->citizenship,
                ]);

                $newStudentInfoData = $user->student_info->fresh()->toArray();
                $changedStudentInfo = array_diff_assoc($newStudentInfoData, $oldStudentInfoData);
                unset($changedStudentInfo['updated_at']);

                if ( ! empty($changedStudentInfo)) {
                    ActivityLogger::log(
                        eventType: 'update',
                        loggable: $user->student_info,
                        student_id: $user->id,
                        oldData: $oldStudentInfoData,
                        newData: $newStudentInfoData,
                        changedData: $changedStudentInfo,
                        customDescription: 'şəxsi məlumatlarda dəyişiklik olundu.'
                    );
                }
            } else {
                $createdStudentInfo = $user->student_info()->create([
                    'father_name'     => $request->father_name,
                    'mother_name'     => $request->mother_name,
                    'birthday'        => $request->birthday,
                    'contact_email'   => $request->contact_email,
                    'address'         => $request->address,
                    'marital_status'  => $request->marital_status,
                    'gender'          => $request->gender,
                    'passport_number' => $request->passport_number,
                    'identity_number' => $request->identity_number,
                    'citizenship'     => $request->citizenship,
                ]);

                ActivityLogger::log(
                    eventType: 'create',
                    loggable: $createdStudentInfo,
                    student_id: $user->id,
                    oldData: [],
                    newData: $createdStudentInfo->toArray(),
                    changedData: $createdStudentInfo->toArray(),
                    customDescription: 'şəxsi məlumatlarda dəyişiklik olundu.'
                );
            }
            session()->flash('success', 'Şəxsi məlumatlar uğurla yeniləndi.');

            return redirect()->back();
        } catch (Exception $exception) {
            return $exception->getMessage();
        }
    }

    public function getUserInfo(Request $request)
    {
        $user = User::with('student_info')->find($request->user_id);

        if ( ! $user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        return response()->json($user);
    }

    public function updateUserInfo(Request $request)
    {
        $validated = $request->validate([
            'user_id'                => 'required|exists:users,id',
            'name'                   => 'required|string|max:255',
            'surname'                => 'required|string|max:255',
            'phone'                  => 'nullable|string|max:20',
            'father_name'            => 'nullable|string|max:255',
            'mother_name'            => 'nullable|string|max:255',
            'birthday'               => 'nullable|date',
            'passport_number'        => 'nullable|string|max:50',
            'identity_number'        => 'nullable|string|max:50',
            'citizenship'            => 'nullable|string|max:100',
            'contact_email'          => 'nullable|email|max:255',
            'relative_number'        => 'nullable|string|max:20',
            'whatsapp_number'        => 'nullable|string|max:20',
            'company_email'          => 'nullable|email|max:255',
            'client'                 => 'nullable|string|max:255',
            'emal_password'          => 'nullable|string|max:255',
            'emal_confirmation_code' => 'nullable|string|max:255',
        ]);

        $user = User::findOrFail($validated['user_id']);

        $user->update([
            'name'    => $validated['name'],
            'surname' => $validated['surname'],
            'phone'   => $validated['phone'],
        ]);

        if ($user->student_info) {
            $oldStudentInfoData = $user->student_info->toArray();
            $user->student_info->update([
                'father_name'            => $validated['father_name'],
                'mother_name'            => $validated['mother_name'],
                'birthday'               => $validated['birthday'],
                'passport_number'        => $validated['passport_number'],
                'identity_number'        => $validated['identity_number'],
                'citizenship'            => $validated['citizenship'],
                'contact_email'          => $validated['contact_email'],
                'relative_number'        => $validated['relative_number'],
                'whatsapp_number'        => $validated['whatsapp_number'],
                'company_email'          => $validated['company_email'],
                'client'                 => $validated['client'],
                'emal_password'          => $validated['emal_password'],
                'emal_confirmation_code' => $validated['emal_confirmation_code'],
            ]);
            $newStudentInfoData = $user->student_info->fresh()->toArray();
            $changedStudentInfo = array_diff_assoc($newStudentInfoData, $oldStudentInfoData);
            unset($changedStudentInfo['updated_at']);

            if ( ! empty($changedStudentInfo)) {
                ActivityLogger::log(
                    eventType: 'update',
                    loggable: $user->student_info,
                    student_id: $user->id,
                    oldData: $oldStudentInfoData,
                    newData: $newStudentInfoData,
                    changedData: $changedStudentInfo,
                    customDescription: 'şəxsi məlumatlarda dəyişiklik olundu.'
                );
            }
        }

        return response()->json(['message' => 'Məlumatlar uğurla yeniləndi!']);
    }

    public function getDocuments($educationLevel)
    {
        $education = EducationLevel::where('title', $educationLevel)->with('settingDocuments')->first();

        if ( ! $education) {
            return response()->json(['documents' => []]);
        }

        return response()->json([
            'documents' => $education->settingDocuments->pluck('title'),
        ]);
    }
}
