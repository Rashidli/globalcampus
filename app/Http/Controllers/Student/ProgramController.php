<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Services\ActivityLogger;
use App\Models\Program;
use App\Models\Settings\Country;
use App\Models\Settings\EducationLevel;
use App\Models\Settings\Period;
use App\Models\Settings\Profession;
use App\Models\Settings\ProgramStatus;
use App\Models\Settings\UniversityList;
use App\Models\Tariff;
use App\Models\User;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    public function index($student_id)
    {
        $user     = User::query()->with('programs')->findOrFail($student_id);
        $programs = $user->programs()->orderByDesc('id')->get();

        return view('students.programs.index', compact('programs', 'user'));
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
        $user = User::query()->with('programs')->findOrFail($student_id);

        $program = $user->programs()->create($request->all());

        ActivityLogger::log(
            eventType: 'store',
            loggable: $program,
            student_id: $user->id,
            customDescription: 'yeni proqram əlavə olundu.'
        );

        session()->flash('success', 'Program uğurla əlavə olundu.!');

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
        $program = Program::findOrFail($id);
        $oldData = $program->toArray();
        $program->update($request->all());
        $newData     = $program->fresh()->toArray();
        $changedData = array_diff_assoc($newData, $oldData);
        unset($changedData['updated_at']);

        ActivityLogger::log(
            eventType: 'update',
            loggable: $program,
            student_id: $program->user_id,
            oldData: $oldData,
            newData: $newData,
            changedData: $changedData,
            customDescription: 'proqram məlumatlarında dəyişiklik olundu.'
        );

        session()->flash('success', 'Program uğurla yeniləndi.');

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

        ActivityLogger::log(
            eventType: 'destroy',
            loggable: $program,
            student_id: $program->user_id,
            customDescription: 'program silindi.'
        );

        return redirect()->route('programs.index', $program->user_id)->with('message', 'Program silindi');
    }
}
