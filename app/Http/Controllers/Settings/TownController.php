<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Models\Settings\Town;
use Illuminate\Http\Request;

class TownController extends Controller
{
    public function index()
    {

        $towns = Town::query()->orderByDesc('created_at')->paginate(10);
        return view('settings.towns.index', compact('towns'));

    }

    /**
     * Show the form for creating a new resource.
     */

    public function create()
    {

        return view('settings.towns.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required|max:255',
        ], [
            'title.required' => 'Şəhər doldurulmalıdır.',
            'title.max' => 'Şəhər maksimum 255 simvol ola bilər.',
        ]);

        Town::create([
            'title' => $request->title,
        ]);

        return redirect()->route('towns.index')->with('message', 'Şəhər əlavə olundu.');

    }

    /**
     * Display the specified resource.
     */
    public function show(Town $town)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Town $town)
    {
        return view('settings.towns.edit', compact('town'));
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, Town $town)
    {
        $request->validate([
            'title' => 'required|max:255',
        ], [
            'title.required' => 'Şəhər doldurulmalıdır.',
            'title.max' => 'Şəhər maksimum 255 simvol ola bilər.',
        ]);

        $town->update([
            'title' => $request->title,
        ]);

        return redirect()->route('towns.index')->with('message', 'Şəhər dəyişdirildi.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Town $town)
    {

        $town->delete();
        return redirect()->route('towns.index')->with('message', 'Şəhər silindi.');

    }
}
