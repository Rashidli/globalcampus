<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Models\Settings\ProgramStatus;
use Illuminate\Http\Request;

class ProgramStatusController extends Controller
{
    public function index()
    {

        $program_statuses = ProgramStatus::query()->orderByDesc('created_at')->paginate(10);
        return view('settings.program_statuses.index', compact('program_statuses'));

    }

    /**
     * Show the form for creating a new resource.
     */

    public function create()
    {

        return view('settings.program_statuses.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required|max:255',
            'color' => 'required|max:20',
        ], [
            'title.required' => 'Program Satatusu sahəsi doldurulmalıdır.',
            'title.max' => 'Program Satatusu sahəsi maksimum 255 simvol ola bilər.',
            'color.required' => 'Rəng sahəsi doldurulmalıdır.',
            'color.max' => 'Rəng sahəsi maksimum 20 simvol ola bilər.',
        ]);

        ProgramStatus::create([
            'title' => $request->title,
            'color' => $request->color,
        ]);

        return redirect()->back()->with('message', 'Program Satatusu əlavə olundu.');

    }

    /**
     * Display the specified resource.
     */
    public function show(ProgramStatus $program_status)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProgramStatus $program_status)
    {
        return view('settings.program_statuses.edit', compact('program_status'));
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, ProgramStatus $program_status)
    {

        $request->validate([
            'title' => 'required|max:255',
            'color' => 'required|max:20',
        ], [
            'title.required' => 'Program Satatusu sahəsi doldurulmalıdır.',
            'title.max' => 'Program Satatusu sahəsi maksimum 255 simvol ola bilər.',
            'color.required' => 'Rəng sahəsi doldurulmalıdır.',
            'color.max' => 'Rəng sahəsi maksimum 255 simvol ola bilər.',
        ]);

        $program_status->update([
            'title' => $request->title,
            'color' => $request->color,
        ]);

        return redirect()->back()->with('message', 'Program Satatusu dəyişdirildi.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProgramStatus $program_status)
    {

        $program_status->delete();
        return redirect()->route('program_statuses.index')->with('message', 'Program Satatusu silindi.');

    }
}
