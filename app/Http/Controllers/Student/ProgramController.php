<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\Program;
use App\Models\Settings\Country;
use App\Models\Settings\EducationLevel;
use App\Models\Settings\Period;
use App\Models\Settings\Profession;
use App\Models\Settings\ProgramStatus;
use App\Models\Settings\UniversityList;
use App\Models\Tariff;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProgramController extends Controller
{
    public function index($student_id)
    {
        $user     = User::query()->with('programs')->findOrFail($student_id);
        $programs = $user->programs()->where('is_accept', true)->orderByDesc('id')->get();
        $statuses = ProgramStatus::all();

        return view('students.programs.index', compact('programs', 'user', 'statuses'));
    }

    public function create($student_id)
    {
        $countries        = Country::all();
        $periods          = Period::query()->where('is_active', true)->get();
        $education_levels = EducationLevel::all();
        $university_lists = UniversityList::all();
        $tariffs          = Tariff::all();
        $program_statuses = ProgramStatus::all();
        $user             = User::query()->with('programs')->findOrFail($student_id);

        return view('students.programs.create', compact(
            'countries',
            'periods',
            'education_levels',
            'university_lists',
            'tariffs',
            'program_statuses',
            'user'
        ));
    }

    public function store(Request $request, $student_id)
    {
        $validatedData = $request->validate([
            'country_id'         => 'nullable',
            'period_id'          => 'nullable',
            'education_level_id' => 'nullable',
            'university_list_id' => 'nullable',
            'tariff_id'          => 'nullable',
            'price'              => 'nullable|numeric|min:0',
            'application_date'   => 'nullable|date',
            'result_date'        => 'nullable|date',
            'app_no'             => 'nullable|string|max:255',
            'note'               => 'nullable|string|max:1000',
        ]);

        $user = User::query()->with('programs')->findOrFail($student_id);

        $new_program = $user->programs()->create($validatedData);

        $superAdmins = User::role('Super Admin')->get();

        foreach ($superAdmins as $admin) {
            Notification::create([
                'user_id'     => $admin->id,
                'title'       => 'Yeni Proqram Əlavə Edildi',
                'description' => auth()->user()->name . ' yeni proqram əlavə etdi.',
                'link'        => route('programs.show', $new_program->id),
            ]);
        }

        session()->flash('success', 'Proqram admin tərəfindən yoxlanıldıqdan sonra təsdiqlənəcək!');

        return redirect()->route('programs.index', $user->id);
    }

    public function edit($program_id)
    {
        $program          = Program::query()->findOrFail($program_id);
        $countries        = Country::all();
        $periods          = Period::query()->where('is_active', true)->get();
        $education_levels = EducationLevel::all();
        $university_lists = UniversityList::all();
        $tariffs          = Tariff::all();
        $program_statuses = ProgramStatus::all();
        $user             = User::query()->where('id', $program->user_id)->first();

        return view('students.programs.edit', compact('program', 'user', 'countries', 'periods', 'education_levels', 'university_lists', 'tariffs', 'program_statuses'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'country_id'         => 'nullable',
            'period_id'          => 'nullable',
            'education_level_id' => 'nullable',
            'university_list_id' => 'nullable',
            'tariff_id'          => 'nullable',
            'price'              => 'nullable|numeric|min:0',
            'application_date'   => 'nullable|date',
            'result_date'        => 'nullable|date',
            'app_no'             => 'nullable|string|max:255',
            'note'               => 'nullable|string|max:1000',
        ]);

        $program = Program::findOrFail($id);
        $program->update($validatedData);

        session()->flash('success', 'Proqram uğurla yeniləndi!');

        return redirect()->back();
    }

    public function getProfessions($education_level_id)
    {
        $professions = Profession::query()->where('education_level_id', $education_level_id)->get();

        return response()->json($professions);
    }

    public function getTariffs($university_id, $education_level_id)
    {
        $tariffs = Tariff::query()->with('profession', 'currency')
            ->where('university_list_id', $university_id)
            ->where('education_level_id', $education_level_id)
            ->get();

        return response()->json($tariffs);
    }

    public function destroy($id)
    {
        $program = Program::query()->findOrFail($id);
        $program->delete();
        session()->flash('success', 'Proqram silindi.');

        return redirect()->route('programs.index', $program->user_id);
    }

    public function storeStatus(Request $request)
    {
        $request->validate([
            'program_status_id' => 'required|exists:program_statuses,id',
            'file'              => 'nullable|file|mimes:pdf,doc,docx,jpg,png',
            'note'              => 'nullable|string',
        ]);

        $program                    = Program::query()->findOrFail($request->program_id);
        $program->program_status_id = $request->program_status_id;
        $program->save();
        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('program_status_files', 'public');
        }

        $program->statuses()->attach($request->program_status_id, [
            'program_id' => $request->program_id,
            'file_path'  => $filePath,
            'note'       => $request->note,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return back()->with('success', 'Status uğurla əlavə olundu');
    }

    public function updateStatus(Request $request, $programId, $statusId)
    {
        $program = Program::findOrFail($programId);

        $validated = $request->validate([
            'program_status_id' => 'required|exists:program_statuses,id',
            'created_at'        => 'required|date',
            'note'              => 'nullable|string',
            'file'              => 'nullable|file|max:2048',
        ]);

        $pivotData = [
            'program_status_id' => $validated['program_status_id'],
            'created_at'        => $validated['created_at'],
            'note'              => $validated['note'],
        ];

        if ($request->hasFile('file')) {
            $oldFile = $program->statuses()->where('program_status_id', $statusId)->first()->pivot->file_path;
            if ($oldFile) {
                Storage::delete($oldFile);
            }

            $filePath               = $request->file('file')->store('program_status_files');
            $pivotData['file_path'] = $filePath;
        }

        $program->statuses()->updateExistingPivot($statusId, $pivotData);

        return redirect()->back()
            ->with('success', 'Status tarixçəsi uğurla yeniləndi');
    }

    public function destroyStatus($programId, $statusId)
    {
        $program = Program::findOrFail($programId);

        $filePath = $program->statuses()
            ->where('program_status_id', $statusId)
            ->first()
            ->pivot
            ->file_path;

        if ($filePath) {
            Storage::delete($filePath);
        }

        $program->statuses()->detach($statusId);

        return redirect()->back()
            ->with('success', 'Status tarixçəsi uğurla silindi');
    }

    public function show($id)
    {
        $program = Program::query()->findOrFail($id);
        $user    = User::query()->findOrFail($program->user_id);

        return view('students.programs.show', compact('program', 'user'));
    }

    public function accept($id)
    {
        try {
            $program = Program::query()->findOrFail($id);
            $program->update(['is_accept' => true]);
            $user = User::query()->findOrFail($program->user_id);
            Notification::create([
                'user_id'     => $user->agent_id,
                'title'       => 'Proqramınız təsdiq edildi',
                'description' => 'Admin yeni proqramınızı təsdiq etdi.',
                'link'        => route('programs.index', $program->user_id),
            ]);

            session()->flash('success', 'Proqram qəbul edildi.');

            return redirect()->back();
        } catch (Exception $exception) {
            return $exception->getMessage();
        }
    }
}
