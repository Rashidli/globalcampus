<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index()
    {

        $permissions = Permission::all();
        return view('permissions.index', compact('permissions'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validated = $request->validate(['name'=>'required|unique:permissions,name', 'group_name'=>'required']);
        Permission::create($validated);

        return redirect()->route('permissions.index')->with('message','Permission əlavə olundu');
    }

    /**
     * Display the specified resource.
     */
    public function show(Permission $permission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Permission $permission)
    {
        return view('permissions.edit', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Permission $permission)
    {

        $validated = $request->validate([
            'name'=>'required|unique:permissions,name,' . $permission->id,
            'group_name'=>'required'
        ]);
        $permission->update($validated);
        return redirect()->back()->with('message','Permission update olundu');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Permission $permission)
    {
        $permission->delete();
        return redirect()->back()->with('success','Permission silindi');
    }
}
