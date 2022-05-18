<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminLoginRequest;
use App\Http\Requests\UserLoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Show admin login page
     */
    public function adminLogin()
    {
        return view('admin-login');
    }

    /**
     * Process login
     */
    public function login(AdminLoginRequest $request)
    {
        $credentials = $request->only(['email', 'password']);
        $isRememberMe = $request->post('remember_me', false) ? true : false;

        if (!Auth::attempt($credentials, $isRememberMe)) {
            // redirect to login page with error message
            return redirect()->route('login')->with('error', 'Email or password is incorrect');
        }
        return redirect()->route('admin-dashboard');
        // redirect to dashboard
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
