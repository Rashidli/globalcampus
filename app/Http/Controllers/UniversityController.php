<?php

namespace App\Http\Controllers;

use App\Models\Settings\EducationLanguage;
use App\Models\Settings\EducationLevel;
use App\Models\Settings\Profession;
use App\Models\Settings\SchoolType;
use App\Models\Settings\Town;
use App\Models\University;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UniversityController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:list-universities|create-universities|edit-universities|delete-universities', ['only' => ['index','show']]);
        $this->middleware('permission:create-universities', ['only' => ['create','store']]);
        $this->middleware('permission:edit-universities', ['only' => ['edit']]);
        $this->middleware('permission:delete-universities', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {

        $universities = University::all();

        $education_levels = EducationLevel::with('school_types')->get();
        $school_types = SchoolType::all();

        return view('universities.index', compact(
            'universities', 'education_levels','school_types'
        ));

    }


    /**
     * Show the form for creating a new resource.
     */

    public function create()
    {

        $education_levels = EducationLevel::query()->with('school_types.universities')->get();
        return view('universities.create', compact(
            'education_levels'
        ));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'education_level_id' => 'nullable',
            'school_type_id' => 'nullable',
            'file' => 'nullable',
        ],[
            'title.required' => 'Universitet adını daxil edin.',
        ]);

        if($request->hasFile('file')){
            $file = $request->file;

            $filename = Str::uuid() .  '.' . $file->getClientOriginalExtension();

            $file->move(public_path('files'), $filename);
        }

        University::create([
            'title' => $request->title,
            'education_level_id' => $request->education_level_id,
            'school_type_id' => $request->school_type_id,
            'file' => $filename ?? null,
        ]);

        return redirect()->route('universities.index',['tab_type' => $request->tab_type])->with('message', 'Yeni umiversitet əlavə olundu.');

    }

    /**
     * Display the specified resource.
     */
    public function show(University $university)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(University $university)
    {
        $education_levels = EducationLevel::query()->with('school_types.universities')->get();
        return view('universities.edit', compact(
            'university','education_levels'
        ));
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, University $university)
    {
        $request->validate([
            'title' => 'required',
            'education_level_id' => 'nullable',
            'school_type_id' => 'nullable',
            'file' => 'nullable',
        ],[
            'title.required' => 'Universitet adını daxil edin.',
            'price.numeric' => 'Yalnız rəqəm daxil edin.',
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');

            $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();

            $file->move(public_path('files'), $filename);

            $university->file =  $filename;
            $university->save();
        }

        $university->update([
            'title' => $request->title,
            'education_level_id' => $request->education_level_id,
            'school_type_id' => $request->school_type_id,
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
