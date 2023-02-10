<?php

namespace App\Http\Controllers\client;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    //

    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        try {
            $user = Socialite::driver('google')->user();
            $userCol = User::where('id_gg', $user->id)->first();
            if ($userCol) {
                Auth::guard('web')->login($userCol);
                return redirect()->route('home');
            } else {
                if (User::where('email', $user->email)->first()) {
                    $userCol = User::where('email', $user->email)->first();
                    $userCol->id_gg = $user->id;
                    $userCol->save();
                    Auth::guard('web')->login($userCol);
                    return redirect()->route('home');
                }
                $addUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'id_gg' => $user->id,
                    'image' => $user->avatar,
                    'email_verified_at' => now(),
                    'password' => encrypt($user->id)
                ]);
                Auth::guard('web')->login($addUser);
                $addUser->assignRole('User');
                return redirect('/');
            }
        } catch (\Exception $exception) {
            dd($exception->getMessage());
        }
    }
}
