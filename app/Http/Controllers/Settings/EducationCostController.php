<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Models\Settings\EducationCost;
use Illuminate\Http\Request;

class EducationCostController extends Controller
{
    public function index()
    {

        $education_costs = EducationCost::query()->orderBy('title')->paginate(10);
        return view('settings.education_costs.index', compact('education_costs'));

    }

    /**
     * Show the form for creating a new resource.
     */

    public function create()
    {

        return view('settings.education_costs.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required|max:255|unique:education_costs',
        ], [
            'title.required' => 'Təhsil haqqı sahəsi doldurulmalıdır.',
            'title.unique' => 'Bu təhsil haqqı artıq əlavə olunub.',
        ]);

        EducationCost::create([
            'title' => $request->title,
        ]);

        return redirect()->back()->with('message', 'Təhsil haqqı əlavə edildi.');

    }

    /**
     * Display the specified resource.
     */
    public function show(EducationCost $education_cost)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EducationCost $education_cost)
    {
        return view('settings.education_costs.edit', compact('education_cost'));
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, EducationCost $education_cost)
    {
        $request->validate([
            'title' => 'required|max:255|unique:education_costs',
        ], [
            'title.required' => 'Təhsil haqqı sahəsi doldurulmalıdır.',
            'title.unique' => 'Bu təhsil haqqı artıq əlavə olunub.',
        ]);

        $education_cost->update([
            'title' => $request->title,
        ]);

        return redirect()->back()->with('message', 'Təhsil haqqı dəyişdirildi.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EducationCost $education_cost)
    {

        $education_cost->delete();
        return redirect()->route('education_costs.index')->with('message', 'Təhsil haqqı silindi.');

    }
}
