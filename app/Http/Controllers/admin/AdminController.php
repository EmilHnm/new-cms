<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    //
    public function Logout()
    {
        Auth::guard('admin')->logout();
        return Redirect()->route('admin.login');
    }

    public function Login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);
        $remember = $request->has('remember_me');
        $credentials = $request->only('email', 'password');
        if (Auth::guard('admin')->attempt($credentials, $remember)) {
            return redirect()->intended('admin/dashboard');
        }
        return Redirect()->back()->withInput($request->only('email', 'remember_me'));
    }
}
