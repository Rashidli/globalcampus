<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Models\Settings\EducationLanguage;
use Illuminate\Http\Request;

class EducationLanguageController extends Controller
{
    public function index()
    {

        $education_languages = EducationLanguage::query()->orderByDesc('created_at')->paginate(10);
        return view('settings.education_languages.index', compact('education_languages'));

    }

    /**
     * Show the form for creating a new resource.
     */

    public function create()
    {

        return view('settings.education_languages.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required|max:255',
        ], [
            'title.required' => 'Təhsil dili sahəsi doldurulmalıdır.',
            'title.max' => 'Təhsil dili sahəsi maksimum 255 simvol ola bilər.',
        ]);

        EducationLanguage::create([
            'title' => $request->title,
        ]);

        return redirect()->back()->with('message', 'Təhsil dili əlavə olundu.');

    }

    /**
     * Display the specified resource.
     */
    public function show(EducationLanguage $education_language)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EducationLanguage $education_language)
    {
        return view('settings.education_languages.edit', compact('education_language'));
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, EducationLanguage $education_language)
    {
        $request->validate([
            'title' => 'required|max:255',
        ], [
            'title.required' => 'Təhsil dili sahəsi doldurulmalıdır.',
            'title.max' => 'Təhsil dili sahəsi maksimum 255 simvol ola bilər.',
        ]);

        $education_language->update([
            'title' => $request->title,
        ]);

        return redirect()->back()->with('message', 'Təhsil dili dəyişdirildi.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EducationLanguage $education_language)
    {

        $education_language->delete();
        return redirect()->route('education_languages.index')->with('message', 'Təhsil dili silindi.');

    }
}
