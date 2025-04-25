<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Models\Settings\EducationLevel;
use App\Models\Settings\SchoolType;
use Illuminate\Http\Request;

class SchoolTypeController extends Controller
{
    public function index()
    {
        $education_levels = EducationLevel::all();
        $school_types = SchoolType::query()->orderByDesc('created_at')->paginate(10);
        return view('settings.school_types.index', compact('school_types','education_levels'));

    }

    /**
     * Show the form for creating a new resource.
     */

    public function create()
    {

        return view('settings.school_types.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required|max:255',
            'education_level_id' => 'required',
        ], [
            'title.required' => 'Məktəb növü doldurulmalıdır.',
            'education_level_id.required' => 'Təhsil pilləsi seçilməlidir.',
            'title.max' => 'Məktəb növü maksimum 255 simvol ola bilər.',
        ]);

        SchoolType::create([
            'title' => $request->title,
            'education_level_id' => $request->education_level_id,
        ]);

        return redirect()->back()->with('message', 'Məktəb növü əlavə olundu.');

    }

    /**
     * Display the specified resource.
     */
    public function show(SchoolType $school_type)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SchoolType $school_type)
    {
        $education_levels = EducationLevel::all();
        return view('settings.school_types.edit', compact('school_type','education_levels'));

    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, SchoolType $school_type)
    {
        $request->validate([
            'title' => 'required|max:255',
            'education_level_id' => 'required',
        ], [
            'title.required' => 'Məktəb növü doldurulmalıdır.',
            'education_level_id.required' => 'Təhsil pilləsi seçilməlidir.',
            'title.max' => 'Məktəb növü maksimum 255 simvol ola bilər.',
        ]);

        $school_type->update([
            'title' => $request->title,
            'education_level_id' => $request->education_level_id,
        ]);

        return redirect()->back()->with('message', 'Məktəb növü dəyişdirildi.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SchoolType $school_type)
    {

        $school_type->delete();
        return redirect()->route('school_types.index')->with('message', 'Məktəb növü silindi.');

    }

}
