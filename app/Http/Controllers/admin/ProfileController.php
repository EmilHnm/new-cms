<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function ProfileView()
    {
        $id = Auth::user()->id;
        $user = User::with('roles')->find($id);
        return view('backend.admin.profile.view_profile', compact('user'));
    }

    public function ProfileEdit()
    {
        $id = Auth::user()->id;
        $editData = User::find($id);
        return view('backend.admin.profile.edit_profile', compact('editData'));
    }
    public function ProfileStore(Request $request)
    {

        $data = User::find(Auth::user()->id);
        $data->name = $request->name;
        $data->email = $request->email;
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
            'message' => 'User Profile Updated Successfully',
        );


        return redirect()->route('admin.profile.view')->with($message);
    }

    public function PasswordView()
    {
        return view('backend.admin.profile.edit_password');
    }
    public function PasswordUpdate(Request $request)
    {
        $validateData = $request->validate([
            'oldpassword' => 'required',
            'password' => 'required|confirmed',
        ]);

        $hashPwd = Auth::user()->password;

        if (Hash::check($request->oldpassword, $hashPwd)) {
            $user = User::find(Auth::id());
            $user->password = Hash::make($request->password);
            $user->save();
            Auth::logout();
            return redirect()->route('admin.login');
        } else {
            return redirect()->back();
        }
    }
}
