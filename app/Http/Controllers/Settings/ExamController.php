<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Models\Settings\ExamLanguage;
use App\Models\Settings\Exam;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    public function index()
    {
        $exam_languages = ExamLanguage::all();
        $exams = Exam::query()->orderByDesc('created_at')->paginate(10);
        return view('settings.exams.index', compact('exams','exam_languages'));
    }

    /**
     * Show the form for creating a new resource.
     */

    public function create()
    {

        return view('settings.exams.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required|max:255',
            'exam_language_id' => 'required',
        ], [
            'title.required' => 'Məktəb növü doldurulmalıdır.',
            'exam_language_id.required' => 'Təhsil pilləsi seçilməlidir.',
            'title.max' => 'Məktəb növü maksimum 255 simvol ola bilər.',
        ]);

        Exam::create([
            'title' => $request->title,
            'exam_language_id' => $request->exam_language_id,
        ]);

        return redirect()->back()->with('message', 'Məktəb növü əlavə olundu.');

    }

    /**
     * Display the specified resource.
     */
    public function show(Exam $exam)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Exam $exam)
    {
        $exam_languages = ExamLanguage::all();
        return view('settings.exams.edit', compact('exam','exam_languages'));
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, Exam $exam)
    {
        $request->validate([
            'title' => 'required|max:255',
            'exam_language_id' => 'required',
        ], [
            'title.required' => 'Məktəb növü doldurulmalıdır.',
            'exam_language_id.required' => 'Təhsil pilləsi seçilməlidir.',
            'title.max' => 'Məktəb növü maksimum 255 simvol ola bilər.',
        ]);

        $exam->update([
            'title' => $request->title,
            'exam_language_id' => $request->exam_language_id,
        ]);

        return redirect()->back()->with('message', 'Məktəb növü dəyişdirildi.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Exam $exam)
    {

        $exam->delete();
        return redirect()->route('exams.index')->with('message', 'Məktəb növü silindi.');

    }
}
