<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Models\Settings\ExamLanguage;
use Illuminate\Http\Request;

class ExamLanguageController extends Controller
{
    public function index()
    {

        $exam_languages = ExamLanguage::query()->orderByDesc('created_at')->paginate(10);
        return view('settings.exam_languages.index', compact('exam_languages'));

    }

    /**
     * Show the form for creating a new resource.
     */

    public function create()
    {

        return view('settings.exam_languages.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required|max:255',
        ], [
            'title.required' => 'İmtahan dili sahəsi doldurulmalıdır.',
            'title.max' => 'İmtahan dili sahəsi maksimum 255 simvol ola bilər.',
        ]);

        ExamLanguage::create([
            'title' => $request->title,
        ]);

        return redirect()->back()->with('message', 'İmtahan dili əlavə olundu.');

    }

    /**
     * Display the specified resource.
     */
    public function show(ExamLanguage $exam_language)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ExamLanguage $exam_language)
    {
        return view('settings.exam_languages.edit', compact('exam_language'));
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, ExamLanguage $exam_language)
    {
        $request->validate([
            'title' => 'required|max:255',
        ], [
            'title.required' => 'İmtahan dili sahəsi doldurulmalıdır.',
            'title.max' => 'İmtahan dili sahəsi maksimum 255 simvol ola bilər.',
        ]);

        $exam_language->update([
            'title' => $request->title,
        ]);

        return redirect()->back()->with('message', 'İmtahan dili dəyişdirildi.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ExamLanguage $exam_language)
    {

        $exam_language->delete();
        return redirect()->route('exam_languages.index')->with('message', 'İmtahan dili silindi.');


    }
}
