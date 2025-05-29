<?php

namespace App\Http\Controllers;

use App\Models\Academic;
use Illuminate\Http\Request;

class AcademicController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:list-academics|create-academics|edit-academics|delete-academics', ['only' => ['index', 'show']]);
        $this->middleware('permission:create-academics', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit-academics', ['only' => ['edit']]);
        $this->middleware('permission:delete-academics', ['only' => ['destroy']]);
    }

    public function index()
    {
        $academics = Academic::query()->orderByDesc('created_at')->paginate(10);

        return view('academics.index', compact('academics'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('academics.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
        ]);

        Academic::create([
            'title' => $request->title,
        ]);

        return redirect()->route('academics.index')->with('message', 'Academic added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Academic $academic): void {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Academic $academic)
    {
        return view('academics.edit', compact('academic'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Academic $academic)
    {
        $request->validate([
            'title' => 'required',
        ]);

        $academic->update([
            'title' => $request->title,
        ]);

        return response()->json(['message' => 'Academic updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Academic $academic)
    {
        $academic->delete();

        return redirect()->route('academics.index')->with('message', 'Academic deleted successfully');
    }
}
