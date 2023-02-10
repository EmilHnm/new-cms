<?php

namespace App\Http\Controllers\client;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    //

    public function ClientProfileView($id)
    {
        $user = User::with(['post'])->find($id);
        return view('backend.client.profile.view_profile', compact('user'));
    }

    public function ClientProfileEdit($id)
    {
        if (Auth::guard('web')->user() && Auth::guard('web')->user()->id == $id) {
            $user = User::with(['post'])->find($id);
            return view('backend.client.profile.edit_profile', compact('user'));
        } else {
            abort(403);
        }
    }

    public function ClientProfileUpdateData($id, Request $request)
    {
        if (Auth::guard('web')->user() && Auth::guard('web')->user()->id == $id) {
            $request->validate([
                'name' => 'required'
            ]);
            $data = User::find($id);
            $data->name = $request->name;
            if ($request->file('image')) {
                $file = $request->file('image');
                @unlink(public_path('upload/user_images' . $data->image));
                $filename = date('YmdHi') . $data->id . $file->getClientOriginalName();
                $file->move(public_path('upload/user_images'), $filename);
                $data->image = $filename;
            }
            $data->save();
            $message = array(
                'alert-type' => 'success',
                'message' => 'Your Profile Updated Successfully',
            );
            return redirect()->route('client.profile.view', $id)->with($message);
        } else {
            abort(403);
        }
    }

    public function ClientProfileUpdatePassword($id, Request $request)
    {
        if (Auth::guard('web')->user() && Auth::guard('web')->user()->id == $id) {
            $validateData = $request->validate([
                'password_old' => 'required|min:6',
                'password' => 'required|min:6|confirmed',
            ]);

            $hashPwd = Auth::user()->password;

            if (Hash::check($request->password_old, $hashPwd)) {
                $user = User::find(Auth::id());
                $user->password = Hash::make($request->password);
                $user->save();
                Auth::logout();
                return redirect()->route('client.login');
            } else {
                return redirect()->back();
            }
        } else {
            abort(403);
        }
    }
}
