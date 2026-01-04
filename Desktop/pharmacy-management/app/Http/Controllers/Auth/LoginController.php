<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        $remember = $request->has('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            
            $user = Auth::user();
            
            return redirect()->intended($this->redirectTo($user->role));
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->withInput($request->only('email'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->flush();

        return redirect('/login');
    }

    protected function redirectTo($role)
    {
        switch ($role) {
            case 'ceo':
                return '/dashboard/ceo';
            case 'director':
                return '/dashboard/director';
            case 'accounts':
                return '/dashboard/accounts';
            case 'department':
                return '/dashboard/department';
            default:
                return '/dashboard';
        }
    }
}

