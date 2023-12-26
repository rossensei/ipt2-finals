<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Jobs\RegisterJob;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {

        // dd($request->all());
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        $user = User::where('email', $request->email)->first();
        // dd($user);

        if(!$user){
            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ])->onlyInput('email');
        }
        elseif ($user->email_verified_at == null) {
            return redirect('/')->with('error', 'Your account is not verified, please check your email for email verification.');
        }

        $login = auth()->attempt($credentials);
        // dd($login);

        if(!$login) {
            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ])->onlyInput('email');
        }

        $request->session()->regenerate();

        return redirect('/dashboard');
    }

    public function create()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $credentials = $request->validate([
            'name' => ['required', 'string'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'confirmed']
        ]);

        $credentials['remember_token'] = Str::random(24);
        $user = User::create($credentials);

        RegisterJob::dispatch($user);

        return redirect('/')->with('message', 'Your account has been created. Please check your email for verification.');
    }

    public function verification(User $user, $token)
    {
        // dd($user, $token);

        if($user->remember_token !== $token) {
            return redirect('/')->with('error', 'Invalid token.');
        }

        $user->email_verified_at = now();
        $user->save();

        return redirect('/')->with('message', 'Your account has been verified.');
    }

    public function logout(Request $request)
    {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('message', 'You have been logged out.');
    }
}
