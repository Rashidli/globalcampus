<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:list-services|create-services|edit-services|delete-services', ['only' => ['index','show']]);
        $this->middleware('permission:create-services', ['only' => ['create','store']]);
        $this->middleware('permission:edit-services', ['only' => ['edit']]);
        $this->middleware('permission:delete-services', ['only' => ['destroy']]);
    }

    public function index()
    {

        $services = Service::query()->orderByDesc('created_at')->paginate(10);
        return view('services.index', compact('services'));

    }

    /**
     * Show the form for creating a new resource.
     */

    public function create()
    {

        return view('services.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required',
        ]);

        Service::create([
            'title' => $request->title,
        ]);

        return redirect()->route('services.index')->with('message', 'Service added successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(Service $service)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service)
    {
        return view('services.edit', compact('service'));

    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, Service $service)
    {
        $request->validate([
            'title' => 'required',
        ]);

        $service->update([
            'title' => $request->title,
        ]);

        return response()->json(['message' => 'Service updated successfully']);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {

        $service->delete();
        return redirect()->route('services.index')->with('message', 'Service deleted successfully');

    }
}
