<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Models\Settings\UniversityList;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UniversityListController extends Controller
{
    public function index()
    {

        $university_lists = UniversityList::query()->orderByDesc('created_at')->paginate(10);
        return view('settings.university_lists.index', compact('university_lists'));

    }

    /**
     * Show the form for creating a new resource.
     */

    public function create()
    {

        return view('settings.university_lists.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required|max:255',
        ], [
            'title.required' => 'Universitet doldurulmalıdır.',
            'title.max' => 'Universitet maksimum 255 simvol ola bilər.',
        ]);

        if ($request->image){
            $file = $request->image;
            $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();

            $file->move(public_path('logos'), $filename);
        }

        UniversityList::create([
            'title' => $request->title,
            'image' => $filename ?? null,
        ]);

        return redirect()->route('university_lists.index')->with('message', 'Universitet əlavə olundu.');

    }

    /**
     * Display the specified resource.
     */
    public function show(UniversityList $university_list)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UniversityList $university_list)
    {
        return view('settings.university_lists.edit', compact('university_list'));
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, UniversityList $university_list)
    {
        $request->validate([
            'title' => 'required|max:255',
        ], [
            'title.required' => 'Universitet doldurulmalıdır.',
            'title.max' => 'Universitet maksimum 255 simvol ola bilər.',
        ]);

        if ($request->image){

            $filePath = public_path('logos/' . $university_list->image);
            if (file_exists($filePath) && is_file($filePath)) {
                unlink($filePath);
            }

            $file = $request->image;
            $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('logos'), $filename);
            $university_list->image = $filename;
        }

        $university_list->update([
            'title' => $request->title,
        ]);

        return redirect()->route('university_lists.index')->with('message', 'Universitet dəyişdirildi.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UniversityList $university_list)
    {

        $university_list->delete();
        return redirect()->route('university_lists.index')->with('message', 'Universitet silindi.');

    }
}
