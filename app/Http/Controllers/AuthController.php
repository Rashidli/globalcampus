<?php

namespace App\Http\Controllers;

use App\Enums\UserType;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register_submit(RegisterRequest $request)
    {

        $user = new User([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        $user->save();

        Auth::login($user);

        return redirect()->route('home');

    }

    public function login_submit(LoginRequest $request)
    {

        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
//            if(\auth()->user()->hasRole('Student')){
//                return redirect()->route('single_student');
//            }elseif (\auth()->user()->hasRole('Agent')){
//                return redirect()->route('agent_students');
//            }

            return redirect()->route('home');
        }else{
            $error = \Illuminate\Validation\ValidationException::withMessages([
                'password' => ['Şifrə yanlışdır'],
            ]);
            throw $error;
        }

    }

    public function logout()
    {

        Auth::logout();
        return redirect()->route('login');

    }

    public function home()
    {
        $userCount = User::query()
            ->where('type', UserType::STUDENT)->count();
        $agentCount = User::query()
            ->where('type', UserType::AGENT)->count();
        return view('welcome', compact('userCount','agentCount'));
    }

    public function login()
    {
        return view('login');
    }
}
