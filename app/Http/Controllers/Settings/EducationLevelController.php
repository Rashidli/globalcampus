<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Models\Settings\EducationLevel;
use Illuminate\Http\Request;

class EducationLevelController extends Controller
{
    public function index()
    {
        $education_levels = EducationLevel::query()->orderByDesc('created_at')->paginate(10);

        return view('settings.education_levels.index', compact('education_levels'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('settings.education_levels.create');
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

        EducationLevel::create([
            'title'       => $request->title,
            'description' => $request->description,
        ]);

        return redirect()->back()->with('message', 'Təhsil pilləsi əlavə olundu.');
    }

    /**
     * Display the specified resource.
     */
    public function show(EducationLevel $education_level): void {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EducationLevel $education_level)
    {
        return view('settings.education_levels.edit', compact('education_level'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EducationLevel $education_level)
    {
        $request->validate([
            'title' => 'required|max:255',
        ], [
            'title.required' => 'Təhsil pilləsi sahəsi doldurulmalıdır.',
            'title.max'      => 'Təhsil pilləsi sahəsi maksimum 255 simvol ola bilər.',
        ]);

        $education_level->update([
            'title'       => $request->title,
            'description' => $request->description,
        ]);

        return redirect()->back()->with('message', 'Təhsil pilləsi dəyişdirildi.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EducationLevel $education_level)
    {
        $education_level->delete();

        return redirect()->route('education_levels.index')->with('message', 'Təhsil pilləsi silindi.');
    }
}
