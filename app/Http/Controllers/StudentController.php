<?php

namespace App\Http\Controllers;

use App\Enums\UserType;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Services\UserService;
use App\Models\Document;
use App\Models\Education;
use App\Models\Program;
use App\Models\Service;
use App\Models\Settings\Citizenship;
use App\Models\Settings\EducationLevel;
use App\Models\Settings\Period;
use App\Models\Settings\Profession;
use App\Models\Settings\UniversityList;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use PhpParser\Comment\Doc;
use Spatie\Permission\Models\Role;

class StudentController extends Controller
{

    public function __construct(protected UserService $userService)
    {
        $this->middleware('permission:list-students|create-students|edit-students|delete-students', ['only' => ['index','show']]);
        $this->middleware('permission:create-students', ['only' => ['create','store']]);
        $this->middleware('permission:edit-students', ['only' => ['edit']]);
        $this->middleware('permission:delete-students', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
    {
        $user = auth()->user();
//        dd(User::query()->where('agent_id', $user->id)->get());

        // For agents, only show their own students
        if ($user->type === UserType::AGENT->value) {
            $query = User::with(['agent', 'agent.agent_info', 'programs'])
                ->where('type', UserType::STUDENT)
                ->where('agent_id', $user->id);
        }
        // For admin, check if we're viewing a specific agent's students
        else if ($request->has('agent_id')) {
            $query = User::with(['agent', 'agent.agent_info', 'programs'])
                ->where('type', UserType::STUDENT)
                ->where('agent_id', $request->agent_id);
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

        $agents = User::with('agent_info')->where('type', UserType::AGENT)->get();
        $periods = Period::all();
        $education_levels = EducationLevel::with('school_types')->get();
        $professions = Profession::all();
        $university_lists = UniversityList::all();

        return view('students.index', compact(
            'users', 'agents', 'periods', 'education_levels', 'professions', 'university_lists', 'count'
        ));
    }

    private function applyUserFilters(Request $request, $query, User $user)
    {
        return $query
            ->when($request->filled('name'), fn($q) => $q->where('name', 'like', '%' . $request->name . '%'))
            ->when($request->filled('surname'), fn($q) => $q->where('surname', 'like', '%' . $request->surname . '%'))
            ->when($request->filled('agent_id') && $user->type !== UserType::AGENT,
                fn($q) => $q->whereIn('agent_id', $request->agent_id))
            ->when($request->filled('university_list_id'), fn($q) => $q->whereHas('programs',
                fn($q) => $q->whereIn('university_list_id', $request->university_list_id)))
            ->when($request->filled('period_id'), fn($q) => $q->whereHas('programs',
                fn($q) => $q->whereIn('period_id', $request->period_id)))
            ->when($request->filled('education_level_id'), fn($q) => $q->whereHas('programs',
                fn($q) => $q->where('education_level_id', $request->education_level_id)))
//            ->when($request->filled('school_type_id'), fn($q) => $q->whereHas('programs',
//                fn($q) => $q->where('school_type_id', $request->school_type_id)))
//            ->when($request->filled('country_id'), fn($q) => $q->whereHas('programs',
//                fn($q) => $q->where('country_id', $request->country_id)))
            ->when($request->filled('profession_id'), fn($q) => $q->whereHas('programs.tariff',
                fn($q) => $q->whereIn('profession_id', $request->profession_id)));
    }



    /**
     * Show the form for creating a new resource.
     */

    public function create()
    {
        $citizenships = Citizenship::all();
        $agents = User::query()->with('agent_info')->where('type', UserType::AGENT)->get();
        return view('students.create', compact('agents','citizenships'));

    }

    public function show(string $id)
    {

        $user = User::query()->with(
            'educations',
            'experiences',
            'languages',
            'programs',
            'documents','services','costs')
            ->findOrFail($id);

        $services = Service::all();
        $isStudent = $user->hasRole('Student');

        $education_levels = EducationLevel::query()->with('setting_documents')->get();

        return view('students.show', compact('user', 'services','isStudent','education_levels'));

    }

    public function single_student()
    {

        $id = auth()->user()->id;
        $user = User::query()->with(
            'educations',
            'experiences',
            'languages',
            'programs',
            'documents','services','costs')
            ->findOrFail($id);
        $services = Service::all();
        $isStudent = $user->hasRole('Student');
        return view('students.single_student', compact('user', 'services','isStudent'));

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
            'documents')
            ->findOrFail($id);
        $citizenships = Citizenship::all();
        $agents = User::query()->where('type', UserType::AGENT)->get();
        return view('students.edit', compact('user', 'agents','citizenships'));

    }

    public function destroy($id)
    {
        $user = User::query()->findOrFail($id);
        $user->delete();
        return redirect()->route('students.index')->with('message', 'Tələbə silindi');
    }

    public function toggleStatus($id)
    {
        $user = User::query()->with('student_info')->findOrFail($id);

        $studentInfo = $user->student_info;
        $studentInfo->is_active = !$studentInfo->is_active;
        $studentInfo->save();

        return response()->json([
            'status' => $studentInfo->is_active ? 'active' : 'deactivated'
        ]);
    }

    public function store(StoreStudentRequest $request)
    {
//        dd($request->all());
        try {

            $validatedData = $request->validated();

            $user = $this->userService->createUser($validatedData);

            $user->assignRole(2);
            return redirect()->route(auth()->user()->hasRole('Agent') ? 'agent_students' : 'students.index')
                ->with('message', 'Student əlavə edildi');


        } catch (\Exception $exception) {

            return $exception->getMessage();

        }

    }

    public function update(Request $request, $id)
    {
//        dd($request->all());
        try {
            $user = User::query()->findOrFail($id);

            $request->validate([
                'name' => 'nullable|string|max:255',
                'surname' => 'nullable|string|max:255',
                'phone' => 'nullable|string|max:255',
                'father_name' => 'nullable|string|max:255',
                'mother_name' => 'nullable|string|max:255',
                'birthday' => 'nullable|date',
                'contact_email' => 'nullable|email|max:255',
                'address' => 'nullable|string|max:255',
                'marital_status' => 'nullable',
                'gender' => 'nullable|string',
                'password' => 'nullable', // Şifrə təsdiqləmə
            ]);

            // Şəkili yenilə
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('files'), $filename);
                $user->image = $filename;
            }

            // Update üçün olan məlumatlar
            $updateData = [
                'name' => $request->name,
                'surname' => $request->surname,
                'phone' => $request->phone,
                'agent_id' => $request->agent_id,
            ];

            // Əgər şifrə boş deyil və request-də varsa, hash edib əlavə edirik
            if (!empty($request->password)) {
                $updateData['password'] = bcrypt($request->password);
            }

            $user->update($updateData);

            // Tələbə məlumatlarını yenilə və ya yarat
            if ($user->student_info) {
                $user->student_info->update([
                    'father_name' => $request->father_name,
                    'mother_name' => $request->mother_name,
                    'birthday' => $request->birthday,
                    'contact_email' => $request->contact_email,
                    'address' => $request->address,
                    'marital_status' => $request->marital_status,
                    'gender' => $request->gender,
                    'passport_number' => $request->passport_number,
                    'identity_number' => $request->identity_number,
                    'citizenship' => $request->citizenship,
                ]);
            } else {
                $user->student_info()->create([
                    'father_name' => $request->father_name,
                    'mother_name' => $request->mother_name,
                    'birthday' => $request->birthday,
                    'contact_email' => $request->contact_email,
                    'address' => $request->address,
                    'marital_status' => $request->marital_status,
                    'gender' => $request->gender,
                    'passport_number' => $request->passport_number,
                    'identity_number' => $request->identity_number,
                    'citizenship' => $request->citizenship,
                ]);
            }

            return redirect()->back()->with('message', 'Successfully updated');
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }


    public function getUserInfo(Request $request)
    {
        $user = User::with('student_info')->find($request->user_id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        return response()->json($user);
    }

    public function updateUserInfo(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'father_name' => 'nullable|string|max:255',
            'mother_name' => 'nullable|string|max:255',
            'birthday' => 'nullable|date',
            'passport_number' => 'nullable|string|max:50',
            'identity_number' => 'nullable|string|max:50',
            'citizenship' => 'nullable|string|max:100',
            'contact_email' => 'nullable|email|max:255',
            'relative_number' => 'nullable|string|max:20',
            'whatsapp_number' => 'nullable|string|max:20',
            'company_email' => 'nullable|email|max:255',
            'client' => 'nullable|string|max:255',
            'emal_password' => 'nullable|string|max:255',
            'emal_confirmation_code' => 'nullable|string|max:255',
        ]);

        $user = User::findOrFail($validated['user_id']);

        $user->update([
            'name' => $validated['name'],
            'surname' => $validated['surname'],
            'phone' => $validated['phone'],
        ]);

        if ($user->student_info) {
            $user->student_info->update([
                'father_name' => $validated['father_name'],
                'mother_name' => $validated['mother_name'],
                'birthday' => $validated['birthday'],
                'passport_number' => $validated['passport_number'],
                'identity_number' => $validated['identity_number'],
                'citizenship' => $validated['citizenship'],
                'contact_email' => $validated['contact_email'],
                'relative_number' => $validated['relative_number'],
                'whatsapp_number' => $validated['whatsapp_number'],
                'company_email' => $validated['company_email'],
                'client' => $validated['client'],
                'emal_password' => $validated['emal_password'],
                'emal_confirmation_code' => $validated['emal_confirmation_code'],
            ]);
        }

        return response()->json(['message' => 'Məlumatlar uğurla yeniləndi!']);
    }


    public function getDocuments($educationLevel)
    {
        $education = EducationLevel::where('title', $educationLevel)->with('setting_documents')->first();

        if (!$education) {
            return response()->json(['documents' => []]);
        }

        return response()->json([
            'documents' => $education->setting_documents->pluck('title')
        ]);
    }




}
