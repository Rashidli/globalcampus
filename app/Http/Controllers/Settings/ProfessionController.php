<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Models\Settings\EducationLevel;
use App\Models\Settings\Profession;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ProfessionImport;
class ProfessionController extends Controller
{

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv',
            'education_level_id' => 'required|exists:education_levels,id',
        ]);

        Excel::import(new ProfessionImport($request->education_level_id), $request->file('file'));

        return back()->with('message', 'İxtisaslar uğurla yükləndi!');
    }


    public function index()
    {

        $professions = Profession::query()->orderByDesc('created_at')->paginate(10);
        $education_levels = EducationLevel::all();
        return view('settings.professions.index', compact('professions','education_levels'));

    }

    /**
     * Show the form for creating a new resource.
     */

    public function create()
    {
        return view('settings.professions.create');
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
            'title.required' => 'İxtisas sahəsi doldurulmalıdır.',
            'title.max' => 'İxtisas sahəsi maksimum 255 simvol ola bilər.',
            'education_level_id.required' => 'Təhsil pilləsi seçilməlidir.'
        ]);

        Profession::create([
            'title' => $request->title,
            'education_level_id' => $request->education_level_id,
        ]);

        return redirect()->back()->with('message', 'İxtisas əlavə olundu');

    }

    /**
     * Display the specified resource.
     */
    public function show(Profession $profession)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Profession $profession)
    {

        return view('settings.professions.edit', compact('profession'));
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, Profession $profession)
    {
        $request->validate([
            'title' => 'required|max:255',
            'education_level_id' => 'required',
        ], [
            'title.required' => 'İxtisas sahəsi doldurulmalıdır.',
            'title.max' => 'İxtisas sahəsi maksimum 255 simvol ola bilər.',
            'education_level_id.required' => 'Təhsil pilləsi seçilməlidir.'
        ]);

        $profession->update([
            'title' => $request->title,
            'education_level_id' => $request->education_level_id,
        ]);

        return redirect()->back()->with('message', 'İxtisas əlavə dəyişdirildi.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Profession $profession)
    {

        $profession->delete();
        return redirect()->route('professions.index')->with('message', 'İxtisas silindi.');

    }
}
