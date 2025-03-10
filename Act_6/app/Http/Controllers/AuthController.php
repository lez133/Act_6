<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return response()->json(['success' => true, 'redirect' => '/dashboard']);
        }

        return response()->json(['success' => false, 'message' => 'Invalid credentials']);
    }

    public function register(Request $request)
    {
        $user = User::create([
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);
        return response()->json(['success' => true, 'redirect' => '/dashboard']);
    }

    public function dashboard()
    {
        return view('dashboard');
    }

    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {
        $socialUser = Socialite::driver($provider)->user();
        $user = User::updateOrCreate([
            'email' => $socialUser->getEmail()
        ], [
            'first_name' => $socialUser->getName(),
            'email' => $socialUser->getEmail(),
            'password' => Hash::make('password'),
        ]);

        Auth::login($user);
        return redirect('/dashboard');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
