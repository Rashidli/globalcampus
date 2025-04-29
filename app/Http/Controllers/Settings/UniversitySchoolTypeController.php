<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Models\Settings\UniversityEducationLevel;
use App\Models\Settings\UniversitySchoolType;
use Illuminate\Http\Request;

class UniversitySchoolTypeController extends Controller
{
    public function index()
    {
        $university_education_levels = UniversityEducationLevel::all();
        $university_school_types     = UniversitySchoolType::query()->orderByDesc('created_at')->paginate(10);

        return view('settings.university_school_types.index', compact('university_school_types', 'university_education_levels'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('settings.university_school_types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'                         => 'required|max:255',
            'university_education_level_id' => 'required',
        ], [
            'title.required'                         => 'Məktəb növü doldurulmalıdır.',
            'university_education_level_id.required' => 'Təhsil pilləsi seçilməlidir.',
            'title.max'                              => 'Məktəb növü maksimum 255 simvol ola bilər.',
        ]);

        UniversitySchoolType::create([
            'title'                         => $request->title,
            'university_education_level_id' => $request->university_education_level_id,
        ]);
        session()->flash('success', 'Məktəb növü əlavə olundu.');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(UniversitySchoolType $university_school_type): void {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UniversitySchoolType $university_school_type)
    {
        $university_education_levels = UniversityEducationLevel::all();

        return view('settings.university_school_types.edit', compact('university_school_type', 'university_education_levels'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UniversitySchoolType $university_school_type)
    {
        $request->validate([
            'title'                         => 'required|max:255',
            'university_education_level_id' => 'required',
        ], [
            'title.required'                         => 'Məktəb növü doldurulmalıdır.',
            'university_education_level_id.required' => 'Təhsil pilləsi seçilməlidir.',
            'title.max'                              => 'Məktəb növü maksimum 255 simvol ola bilər.',
        ]);

        $university_school_type->update([
            'title'                         => $request->title,
            'university_education_level_id' => $request->university_education_level_id,
        ]);
        session()->flash('success', 'Məktəb növü dəyişdirildi.');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UniversitySchoolType $university_school_type)
    {
        $university_school_type->delete();
        session()->flash('success', 'Məktəb növü silindi.');
        return redirect()->route('university_school_types.index');
    }
}
