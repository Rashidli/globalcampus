<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Services\ActivityLogger;
use App\Models\Language;
use App\Models\Settings\Exam;
use App\Models\Settings\ExamLanguage;
use App\Models\User;
use Illuminate\Http\Request;

class StudentLanguageController extends Controller
{
    public function index($student_id)
    {
        $user = User::query()->with('languages')->findOrFail($student_id);

        return view('students.languages.index', compact('user'));
    }

    public function create($student_id)
    {
        $exam_languages = ExamLanguage::query()->with('exams')->get();

        $user = User::query()->with('languages')->findOrFail($student_id);

        return view('students.languages.create', compact('user', 'exam_languages'));
    }

    public function edit($id)
    {
        $education      = Language::query()->findOrFail($id);
        $exam_language  = ExamLanguage::query()->where('title', $education->language)->first();
        $exam_languages = ExamLanguage::query()->with('exams')->get();
        $exams          = Exam::query()->where('exam_language_id', $exam_language->id)->get();

        $user = User::query()->with('languages')->findOrFail($education->user_id);

        return view('students.languages.edit', compact(
            'education',
            'user',
            'exam_languages',
            'exams'
        ));
    }

    public function storeLang(Request $request)
    {
        $request->validate([
            'user_id'  => 'required|string',
            'language' => 'nullable|string',
            'exam'     => 'nullable|string',
            'level'    => 'nullable|string',
            'point'    => 'nullable|string',
            'date'     => 'nullable',
        ]);

        $user     = User::query()->findOrFail($request->user_id);
        $language = $user->languages()->create($request->all());

        ActivityLogger::log(
            eventType: 'store',
            loggable: $language,
            student_id: $user->id,
            customDescription: 'yeni dil məlumatı əlavə olundu.'
        );

        session()->flash('success', 'Dil biliyi uğurla əlavə edildi.!');

        return redirect()->route('lang.index', $user->id);
    }

    public function updateLang(Request $request, $id)
    {
        $request->validate([
            'language' => 'nullable|string|max:255',
            'exam'     => 'nullable|string|max:255',
            'level'    => 'nullable|string|max:255',
            'point'    => 'nullable|string|max:255',
            'date'     => 'nullable|string|max:255',
        ]);

        $education = Language::query()->findOrFail($id);
        $oldData   = $education->toArray();
        $education->update($request->all());
        $user = User::query()->findOrFail($education->user_id);

        $newData = $education->fresh()->toArray();

        $changedData = array_diff_assoc($newData, $oldData);
        unset($changedData['updated_at']);

        ActivityLogger::log(
            eventType: 'update',
            loggable: $education,
            student_id: $user->id,
            oldData: $oldData,
            newData: $newData,
            changedData: $changedData,
            customDescription: 'dil məlumatlarında dəyişiklik olundu.'
        );

        session()->flash('success', 'Dil biliyi uğurla yeniləndi.');

        return redirect()->route('lang.index', $education->user_id);
    }

    public function destroy($id)
    {
        $language = Language::query()->findOrFail($id);
        $language->delete();

        session()->flash('success', 'Dil biliyi silindi.');

        ActivityLogger::log(
            eventType: 'destroy',
            loggable: $language,
            student_id: $language->user_id,
            customDescription: 'dil məlumatı silindi.'
        );

        return redirect()->route('lang.index', $language->user_id);
    }
}
