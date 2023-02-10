<?php

namespace App\Http\Controllers\client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    //
    public function logout()
    {
        Auth::guard('web')->logout();
        return redirect()->route('home');
    }
}
