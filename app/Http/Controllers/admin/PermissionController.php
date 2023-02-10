<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware(['permission:manage permissions']);
    }

    public function PermissionView()
    {
        $data['allData'] = Permission::all();
        return view('backend.admin.permission.view_permission', $data);
    }

    public function PermissionAdd()
    {
        return view('backend.admin.permission.add_permission');
    }

    public function PermissionStore(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:permissions'
        ]);
        Permission::create(['name' => $request->name]);
        $message = array(
            'message' => 'Permission added successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.permission.view')->with($message);
    }

    public function PermissionEdit($id)
    {
        $data['permission'] = Permission::find($id);
        return view('backend.admin.permission.edit_permission', $data);
    }

    public function PermissionUpdate($id, Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);
        $permission = Permission::find($id);
        $permission->name = $request->name;
        $permission->save();
        $message = array(
            'message' => 'Permission updated successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.permission.view')->with($message);
    }

    public function PermissionDelete($id)
    {
        $permission = Permission::find($id);
        $permission->delete();
        $message = array(
            'message' => 'Permission deleted successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.permission.view')->with($message);
    }
}
