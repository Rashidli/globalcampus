<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Models\Settings\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function index()
    {

        $countries = Country::query()->orderByDesc('created_at')->paginate(10);
        return view('settings.countries.index', compact('countries'));

    }

    /**
     * Show the form for creating a new resource.
     */

    public function create()
    {

        return view('settings.countries.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required|max:255',
        ], [
            'title.required' => 'Ölkə doldurulmalıdır.',
            'title.max' => 'Ölkə maksimum 255 simvol ola bilər.',
        ]);

        Country::create([
            'title' => $request->title,
        ]);

        return redirect()->route('countries.index')->with('message', 'Ölkə əlavə olundu.');

    }

    /**
     * Display the specified resource.
     */
    public function show(Country $country)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Country $country)
    {
        return view('settings.countries.edit', compact('country'));
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, Country $country)
    {
        $request->validate([
            'title' => 'required|max:255',
        ], [
            'title.required' => 'Ölkə doldurulmalıdır.',
            'title.max' => 'Ölkə maksimum 255 simvol ola bilər.',
        ]);

        $country->update([
            'title' => $request->title,
        ]);

        return redirect()->route('countries.index')->with('message', 'Ölkə dəyişdirildi.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Country $country)
    {

        $country->delete();
        return redirect()->route('countries.index')->with('message', 'Ölkə silindi.');

    }
}
