<?php

namespace App\Http\Controllers;

use App\Enums\UserType;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class AgentController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:list-agents|create-agents|edit-agents|delete-agents', ['only' => ['index', 'show']]);
        $this->middleware('permission:create-agents', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit-agents', ['only' => ['edit']]);
        $this->middleware('permission:delete-agents', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = User::query()->with('agent_info');

        $query->when($request->name, function ($q, $name): void {
            $q->whereRaw("CONCAT(name, ' ', surname) LIKE ?", ["%{$name}%"])
                ->orWhere('name', 'like', "%{$name}%")
                ->orWhere('surname', 'like', "%{$name}%");
        });

        $query->when($request->email, function ($q, $email): void {
            $q->where('email', 'like', '%' . $email . '%');
        });

        $query->when($request->phone, function ($q, $phone): void {
            $q->where('phone', 'like', '%' . $phone . '%');
        });

        $query->when($request->company_name, function ($q, $company_name): void {
            $q->whereHas('agent_info', function ($subQuery) use ($company_name): void {
                $subQuery->where('company_name', 'like', '%' . $company_name . '%');
            });
        });

        $users = $query->orderByDesc('pinned_at')
            ->orderByDesc('id')
            ->where('type', UserType::AGENT)
            ->withCount('students')
            ->paginate(10);

        if ($request->ajax()) {
            return response()->json([
                'html'       => view('agents.partials.table', compact('users'))->render(),
                'total'      => $users->total(),
                'pagination' => view('components.pagination', ['paginator' => $users])->render(),
            ]);
        }

        return view('agents.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();

        return view('agents.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'      => 'nullable|string|max:255',
            'surname'   => 'nullable|string|max:255',
            'phone'     => 'nullable|string|max:255',
            'insta_url' => 'nullable|string|url|max:255',
            'email'     => 'required|email|max:255|unique:users,email',
            'password'  => 'required|min:6',
        ]);

        if ($request->hasFile('image')) {
            $file = $request->image;

            $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();

            $file->move(public_path('files'), $filename);
        }

        $user = new User([
            'name'     => $request->input('name'),
            'surname'  => $request->input('surname'),
            'phone'    => $request->input('phone'),
            'email'    => $request->input('email'),
            'image'    => $filename ?? null,
            'type'     => UserType::AGENT,
            'password' => Hash::make($request->input('password')),
        ]);

        $user->save();

        $user->agent_info()->create([
            'address'      => $request->address,
            'company_name' => $request->company_name,
            'insta_url'    => $request->input('insta_url'),
        ]);

        $user->assignRole(1);

        session()->flash('success', "{$user->name} əlavə edildi.");

        return redirect()->route('agents.index');
    }

    public function edit($id)
    {
        $agent = User::query()->with('agent_info')->findOrFail($id);

        return view('agents.edit', compact('agent'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $user = User::findOrFail($id);

            $validatedData = $request->validate([
                'name'         => 'nullable|string|max:255',
                'surname'      => 'nullable|string|max:255',
                'phone'        => 'nullable|string|max:255',
                'insta_url'    => 'nullable|string|url|max:255',
                'email'        => 'required|email|unique:users,email,' . $user->id . '|max:255',
                'password'     => 'nullable',
                'company_name' => 'nullable',
                'address'      => 'nullable',
                //                'password' => 'nullable|string|min:6|confirmed',
            ]);

            if ($request->hasFile('image')) {
                $file = $request->file('image');

                $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();

                $file->move(public_path('files'), $filename);

                $user->image = $filename;
            }

            $user->name    = $validatedData['name'];
            $user->surname = $validatedData['surname'];
            $user->phone   = $validatedData['phone'];
            $user->email   = $validatedData['email'];

            $user->agent_info()->update([
                'company_name' => $validatedData['company_name'],
                'address'      => $validatedData['address'],
                'insta_url'    => $validatedData['insta_url'],
            ]);

            if ( ! empty($validatedData['password'])) {
                $user->password = Hash::make($validatedData['password']);
            }

            $user->save();

            session()->flash('success', "{$user->name} məlumatları dəyişdirildi.");

            return redirect()->route('agents.index');
        } catch (Exception $exception) {
            Log::error('Error updating user: ' . $exception->getMessage());

            return response()->json(['error' => 'Failed to update user. Please try again later.'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::query()->findOrFail($id);
        $user->delete();
        session()->flash('success', "{$user->name} silindi.");

        return redirect()->route('agents.index');
    }

    public function pinAgent($id)
    {
        $agent = User::query()->findOrFail($id);

        if ($agent->pinned_at) {
            $agent->pinned_at = null;
        } else {
            $agent->pinned_at = now();
        }

        $agent->save();

        return redirect()->back()->with('success', 'Agent sancağı dəyişdirildi!');
    }
}
