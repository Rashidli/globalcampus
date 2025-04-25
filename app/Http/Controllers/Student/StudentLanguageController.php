<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Models\Settings\EducationLanguage;
use App\Models\Settings\Exam;
use App\Models\Settings\ExamLanguage;
use App\Models\User;
use Illuminate\Http\Request;

class StudentLanguageController extends Controller
{

    public function index($student_id)
    {

        $user = User::query()->with('languages')->findOrFail($student_id);
        return view('students.languages.index', compact( 'user'));

    }

    public function create($student_id)
    {
        $exam_languages = ExamLanguage::query()->with('exams')->get();

        $user = User::query()->with('languages')->findOrFail($student_id);
        return view('students.languages.create', compact( 'user','exam_languages'));
    }

    public function edit($id)
    {
        $education = Language::query()->findOrFail($id);
//        dd($education->language);
        $exam_language = ExamLanguage::query()->where('title', $education->language)->first();
//        dd($exam_language);
        $exam_languages = ExamLanguage::query()->with('exams')->get();
        $exams = Exam::query()->where('exam_language_id',$exam_language->id)->get();

        $user = User::query()->with('languages')->findOrFail($education->user_id);
        return view('students.languages.edit', compact('education',
            'user','exam_languages','exams'));
    }

    public function storeLang(Request $request)
    {
        $request->validate([
            'user_id' => 'required|string',
            'language' => 'nullable|string',
            'exam' => 'nullable|string',
            'level' => 'nullable|string',
            'point' => 'nullable|string',
            'date' => 'nullable',
        ]);

        $user = User::query()->findOrFail($request->user_id);
        $language = $user->languages()->create($request->all());

        return redirect()->route('lang.index',$user->id)->with('message', 'Dil biliyi uğurla əlavə edildi.!');
    }

    public function updateLang(Request $request, $id)
    {
        $request->validate([
            'language' => 'nullable|string',
            'exam' => 'nullable|string',
            'level' => 'nullable|string',
            'point' => 'nullable|string',
            'date' => 'nullable|string',
        ]);

        $education = Language::query()->findOrFail($id);
        $education->update($request->all());

        return redirect()->route('lang.index',$education->user_id)->with('message', 'Dil biliyi uğurla yeniləndi.');
    }

    public function destroy($id)
    {

        $language = Language::query()->findOrFail($id);
        $language->delete();
        return redirect()->route('lang.index', $language->user_id)->with('message', 'Dil biliyi silindi.');

    }

}
