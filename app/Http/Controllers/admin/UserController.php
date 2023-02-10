<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class UserController extends Controller
{
    //
    //
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware(['permission:manage users']);
    }

    public function UserView()
    {
        $data['allData'] = User::with('roles')->get();
        return view('backend.admin.user.view_user', $data);
    }

    public function UserAdd()
    {
        $data['roles'] = Role::all();
        $data['permissions'] = Permission::all();
        return view('backend.admin.user.add_user', $data);
    }

    public function UserStore(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        $data = new User();
        $data->name = $request->name;
        $data->email = $request->email;
        $data->password = bcrypt($request->password);
        $data->assignRole($request->role);
        $data->syncPermissions($request->permissions);
        $data->save();

        $message = array(
            'alert-type' => 'success',
            'message' => 'User Added Successfully',
        );

        return redirect()->route('admin.user.view')->with($message);
    }

    public function UserEdit($id)
    {
        $data['editData'] = User::with('roles')->find($id);
        $data['roles'] = Role::all();
        $data['permissions'] = Permission::all();
        return view('backend.admin.user.edit_user',  $data);
    }

    public function UserUpdate(Request $request, $id)
    {
        $request->validate([
            'role' => 'required',
            'name' => 'required',
            'email' => 'required',
        ]);

        $data = User::find($id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->syncRoles($request->role);
        $data->syncPermissions($request->permissions);
        if ($request->password != "") {
            $request->validate([
                'password' => 'min:6|confirmed',
            ]);
            $data->password = bcrypt($request->password);
        }

        $data->save();

        $message = array(
            'alert-type' => 'info',
            'message' => 'User Updated Successfully',
        );

        return redirect()->route('admin.user.view')->with($message);
    }

    public function UserDelete($id)
    {
        $user = User::find($id);
        $user->delete();
        $message = array(
            'alert-type' => 'success',
            'message' => 'User Deleted Successfully',
        );

        return redirect()->route('admin.user.view')->with($message);
    }
}
