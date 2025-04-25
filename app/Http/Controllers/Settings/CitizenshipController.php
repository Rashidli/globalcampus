<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Imports\CitizenshipsImport;
use App\Models\Settings\Citizenship;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
class CitizenshipController extends Controller
{


    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv',
        ]);

        Excel::import(new CitizenshipsImport(), $request->file('file'));

        return back()->with('message', 'Vətəndaşlıqlar uğurla yükləndi!');
    }

    public function index()
    {

        $citizenships = Citizenship::query()->orderByDesc('created_at')->paginate(10);
        return view('settings.citizenships.index', compact('citizenships'));

    }

    /**
     * Show the form for creating a new resource.
     */

    public function create()
    {

        return view('settings.citizenships.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required|max:255',
        ], [
            'title.required' => 'Təhsil dili sahəsi doldurulmalıdır.',
            'title.max' => 'Təhsil dili sahəsi maksimum 255 simvol ola bilər.',
        ]);

        Citizenship::create([
            'title' => $request->title,
        ]);

        return redirect()->back()->with('message', 'Təhsil dili əlavə olundu.');

    }

    /**
     * Display the specified resource.
     */
    public function show(Citizenship $citizenship)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Citizenship $citizenship)
    {
        return view('settings.citizenships.edit', compact('citizenship'));
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, Citizenship $citizenship)
    {
        $request->validate([
            'title' => 'required|max:255',
        ], [
            'title.required' => 'Təhsil dili sahəsi doldurulmalıdır.',
            'title.max' => 'Təhsil dili sahəsi maksimum 255 simvol ola bilər.',
        ]);

        $citizenship->update([
            'title' => $request->title,
        ]);

        return redirect()->back()->with('message', 'Təhsil dili dəyişdirildi.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Citizenship $citizenship)
    {

        $citizenship->delete();
        return redirect()->route('citizenships.index')->with('message', 'Təhsil dili silindi.');

    }
}
