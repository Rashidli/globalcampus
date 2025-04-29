<?php

namespace App\Http\Controllers;

use App\Models\Settings\UniversityEducationLevel;
use App\Models\Settings\UniversitySchoolType;
use App\Models\University;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UniversityController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:list-universities|create-universities|edit-universities|delete-universities', ['only' => ['index', 'show']]);
        $this->middleware('permission:create-universities', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit-universities', ['only' => ['edit']]);
        $this->middleware('permission:delete-universities', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $universities = University::query()->where('university_education_level_id', $request->education_id)->get();

        $university_school_types     = UniversitySchoolType::all();
        $university_education_levels = UniversityEducationLevel::with('university_school_types')->get();

        return view('universities.index', compact(
            'universities',
            'university_school_types',
            'university_education_levels',
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $university_education_levels = UniversityEducationLevel::query()->with('university_school_types.universities')->get();

        return view('universities.create', compact(
            'university_education_levels'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'                         => 'required',
            'university_education_level_id' => 'nullable',
            'university_school_type_id'     => 'nullable',
            'file'                          => 'nullable',
        ], [
            'title.required' => 'Universitet adını daxil edin.',
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file;

            $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();

            $file->move(public_path('files'), $filename);
        }

        University::create([
            'title'                         => $request->title,
            'university_education_level_id' => $request->university_education_level_id,
            'university_school_type_id'     => $request->university_school_type_id,
            'file'                          => $filename ?? null,
        ]);

        return redirect()->route('universities.index', ['tab_type' => $request->tab_type])->with('message', 'Yeni umiversitet əlavə olundu.');
    }

    /**
     * Display the specified resource.
     */
    public function show(University $university): void {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(University $university)
    {
        $university_education_levels = UniversityEducationLevel::query()->with('university_school_types.universities')->get();

        return view('universities.edit', compact(
            'university',
            'university_education_levels'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, University $university)
    {
        $request->validate([
            'title'                         => 'required',
            'university_education_level_id' => 'nullable',
            'university_school_type_id'     => 'nullable',
            'file'                          => 'nullable',
        ], [
            'title.required' => 'Universitet adını daxil edin.',
            'price.numeric'  => 'Yalnız rəqəm daxil edin.',
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');

            $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();

            $file->move(public_path('files'), $filename);

            $university->file = $filename;
            $university->save();
        }

        $university->update([
            'title'                         => $request->title,
            'university_education_level_id' => $request->university_education_level_id,
            'university_school_type_id'     => $request->university_school_type_id,
        ]);

        return redirect()->route('universities.index')->with('message', 'Mövcud universitet dəyişdirildi.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(University $university)
    {
        $university->delete();

        return redirect()->route('universities.index')->with('message', 'Universitet silindi.');
    }

    public function university()
    {
        return view('university.index');
    }
}
