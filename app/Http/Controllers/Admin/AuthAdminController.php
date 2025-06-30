<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class AuthAdminController extends Controller
{
    public function login()
    {
        if (Auth::check()) {
            return redirect(route('admin.dashboard'));
        }
        return view('admin.login');
    }

    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
 
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
 
            return redirect()->intended(route('admin.dashboard'));
        }
        Alert::toast('Login Failed', 'error');
 
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function register()
    {
        return view('admin.register');
    }

    public function changePassword()
    {
        $user = Auth::user();
        return view('admin.change-password', compact('user'));
    }

    public function changePasswordStore(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|confirmed',
        ]);

        $user = User::find(Auth::user()->id);
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        Auth::logout();
        return redirect()->route('admin.login');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
    
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect('/');
    }
}
