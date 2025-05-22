<?php

namespace App\Http\Controllers;

use App\Enums\UserType;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:list-users|create-users|edit-users|delete-users', ['only' => ['index', 'show']]);
        $this->middleware('permission:create-users', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit-users', ['only' => ['edit']]);
        $this->middleware('permission:delete-users', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::query()->with('roles')->where('type', UserType::USER)->get();

        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();

        return view('users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RegisterRequest $request)
    {
        $user = new User([
            'name'     => $request->input('name'),
            'surname'     => $request->input('surname'),
            'email'    => $request->input('email'),
            'type'     => UserType::USER,
            'password' => Hash::make($request->input('password')),
        ]);

        $user->assignRole($request->role);

        $user->save();
        session()->flash('success', "{$user->name} əlavə olundu.");
        return redirect()->route('users.index')->with('message', 'İstifadəçi əlavə edildi');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): void {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $roles = Role::all();

        return view('users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'surname'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8',
        ]);

        $user->name  = $request->input('name');
        $user->email = $request->input('email');
        $user->surname = $request->input('surname');

        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        $user->syncRoles();
        $user->assignRole($request->role);

        $user->save();
        session()->flash('success', "{$user->name} dəyişdirildi.");

        return redirect()->back()->with('message', 'İstifadəçi update edildi');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')->with('message', 'İstifadəçi silindi');
    }

    public function login()
    {
        return view('login');
    }

    public function uploadImage(Request $request)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);

        $user = auth()->user();

        if ($request->hasFile('image')) {
            $file     = $request->file('image');
            $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();

            $file->move(public_path('files'), $filename);

            if ($user->image) {
                unlink(public_path('files/' . $user->image));
            }

            $user->image = $filename;
            $user->save();
        }

        return redirect()->back()->with('message', 'Şəkil uğurla yükləndi!');
    }
}
