<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Models\Settings\Period;
use Illuminate\Http\Request;

class PeriodController extends Controller
{
    public function index()
    {

        $periods = Period::query()->orderByDesc('created_at')->paginate(10);
        return view('settings.periods.index', compact('periods'));

    }

    /**
     * Show the form for creating a new resource.
     */

    public function create()
    {

        return view('settings.periods.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required|max:255',
        ], [
            'title.required' => 'Dönəm doldurulmalıdır.',
            'title.max' => 'Dönəm maksimum 255 simvol ola bilər.',
        ]);

        Period::create([
            'title' => $request->title,
        ]);

        return redirect()->route('periods.index')->with('message', 'Dönəm əlavə olundu.');

    }

    /**
     * Display the specified resource.
     */
    public function show(Period $period)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Period $period)
    {
        return view('settings.periods.edit', compact('period'));
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, Period $period)
    {
        $request->validate([
            'title' => 'required|max:255',
        ], [
            'title.required' => 'Dönəm doldurulmalıdır.',
            'title.max' => 'Dönəm maksimum 255 simvol ola bilər.',
        ]);

        $period->update([
            'title' => $request->title,
        ]);

        return redirect()->route('periods.index')->with('message', 'Dönəm dəyişdirildi.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Period $period)
    {

        $period->delete();
        return redirect()->route('periods.index')->with('message', 'Dönəm silindi.');

    }

    public function togglePeriodStatus($id)
    {
        $period = Period::query()->findOrFail($id);
        $period->is_active = !$period->is_active;
        $period->save();

        return redirect()->route('periods.index')->with('message', "$period->title statusu dəyişdirildi.");
    }
}
