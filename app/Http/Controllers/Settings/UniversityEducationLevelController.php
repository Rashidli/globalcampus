<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Models\Settings\UniversityEducationLevel;
use Illuminate\Http\Request;

class UniversityEducationLevelController extends Controller
{
    public function index()
    {
        $university_education_levels = UniversityEducationLevel::query()->orderByDesc('created_at')->paginate(10);

        return view('settings.university_education_levels.index', compact('university_education_levels'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('settings.university_education_levels.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
        ], [
            'title.required' => 'Təhsil pilləsi sahəsi doldurulmalıdır.',
            'title.max'      => 'Təhsil pilləsi sahəsi maksimum 255 simvol ola bilər.',
        ]);

        UniversityEducationLevel::create([
            'title' => $request->title,
        ]);
        session()->flash('success', 'Təhsil pilləsi əlavə olundu.');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(UniversityEducationLevel $university_education_level): void {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UniversityEducationLevel $university_education_level)
    {
        return view('settings.university_education_levels.edit', compact('university_education_level'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UniversityEducationLevel $university_education_level)
    {
        $request->validate([
            'title' => 'required|max:255',
        ], [
            'title.required' => 'Təhsil pilləsi sahəsi doldurulmalıdır.',
            'title.max'      => 'Təhsil pilləsi sahəsi maksimum 255 simvol ola bilər.',
        ]);

        $university_education_level->update([
            'title' => $request->title,
        ]);
        session()->flash('success', 'Təhsil pilləsi dəyişdirildi.');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UniversityEducationLevel $university_education_level)
    {
        $university_education_level->delete();
        session()->flash('success', 'Təhsil pilləsi silindi.');
        return redirect()->route('university_education_levels.index');
    }
}
