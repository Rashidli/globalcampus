<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Services\ActivityLogger;
use App\Models\Education;
use App\Models\Settings\Exam;
use App\Models\University;
use App\Models\User;
use Illuminate\Http\Request;

class EducationController extends Controller
{
    public function index($userId)
    {
        $user         = User::findOrFail($userId);
        $educations   = Education::where('user_id', $userId)->get();
        $universities = University::all();
        $exams        = Exam::all();

        return view('students.educations.index', compact('user', 'educations', 'universities', 'exams'));
    }

    public function create($userId)
    {
        $user         = User::findOrFail($userId);
        $universities = University::all();
        $exams        = Exam::all();

        return view('students.educations.create', compact('user', 'universities', 'exams'));
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $education = Education::create($data);

        ActivityLogger::log(
            eventType: 'store',
            loggable: $education,
            student_id: $education->id,
            customDescription: 'təhsil məlumatı əlavə olundu.'
        );

        session()->flash('success', 'Təhsil məlumatı uğurla əlavə edildi.!');

        return redirect()->route('educations.index', $request->user_id);
    }

    public function edit($id)
    {
        $education    = Education::findOrFail($id);
        $user         = $education->user;
        $universities = University::all();
        $exams        = Exam::all();

        return view('students.educations.edit', compact('education', 'user', 'universities', 'exams'));
    }

    public function update(Request $request, $id)
    {
        $education = Education::findOrFail($id);
        $oldData   = $education->toArray();
        $data      = $request->all();

        $education->update($data);
        $newData     = $education->fresh()->toArray();
        $changedData = array_diff_assoc($newData, $oldData);
        unset($changedData['updated_at']);

        ActivityLogger::log(
            eventType: 'update',
            loggable: $education,
            student_id: $education->user_id,
            oldData: $oldData,
            newData: $newData,
            changedData: $changedData,
            customDescription: 'təhsil məlumatlarında dəyişiklik olundu.'
        );

        session()->flash('success', 'Təhsil məlumatı uğurla yeniləndi.');

        return redirect()->route('educations.index', $education->user_id)
            ->with('success', 'Təhsil məlumatı uğurla yeniləndi');
    }

    public function destroy($id)
    {
        $education = Education::findOrFail($id);
        $userId    = $education->user_id;
        $education->delete();
        session()->flash('success', 'Təhsil məlumatı silindi.');

        ActivityLogger::log(
            eventType: 'destroy',
            loggable: $education,
            student_id: $education->user_id,
            customDescription: 'təhsil məlumatı silindi.'
        );

        return redirect()->route('educations.index', $userId);
    }

    public function getFields($degree)
    {
        $universities = University::all();
        $exams        = Exam::all();
        $html         = '';

        if ('Məktəb' === $degree) {
            $html = view('students.educations.partials.school_fields', compact('exams'))->render();
        } elseif ('Kollec' === $degree) {
            $html = view('students.educations.partials.college_fields', compact('exams'))->render();
        } elseif ('Bakalavr' === $degree || 'Magistr' === $degree) {
            $html = view('students.educations.partials.university_fields', compact('universities', 'exams'))->render();
        } elseif ('Denklik' === $degree) {
            $html = view('students.educations.partials.equivalence_fields')->render();
        }

        return response()->json(['html' => $html]);
    }
}
