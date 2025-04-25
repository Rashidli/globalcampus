<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Models\Settings\Currency;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    public function index()
    {

        $currencies = Currency::query()->orderByDesc('created_at')->paginate(10);
        return view('settings.currencies.index', compact('currencies'));

    }

    /**
     * Show the form for creating a new resource.
     */

    public function create()
    {

        return view('settings.currencies.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required|max:255',
        ], [
            'title.required' => 'Valyuta doldurulmalıdır.',
            'title.max' => 'Valyuta maksimum 255 simvol ola bilər.',
        ]);

        Currency::create([
            'title' => $request->title,
        ]);

        return redirect()->route('currencies.index')->with('message', 'Valyuta əlavə olundu.');

    }

    /**
     * Display the specified resource.
     */
    public function show(Currency $currency)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Currency $currency)
    {
        return view('settings.currencies.edit', compact('currency'));
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, Currency $currency)
    {
        $request->validate([
            'title' => 'required|max:255',
        ], [
            'title.required' => 'Valyuta doldurulmalıdır.',
            'title.max' => 'Valyuta maksimum 255 simvol ola bilər.',
        ]);

        $currency->update([
            'title' => $request->title,
        ]);

        return redirect()->route('currencies.index')->with('message', 'Valyuta dəyişdirildi.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Currency $currency)
    {

        $currency->delete();
        return redirect()->route('currencies.index')->with('message', 'Valyuta silindi.');

    }
}
