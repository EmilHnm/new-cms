<?php

namespace App\Http\Controllers\admin;

use App\Models\Role;
use Termwind\Components\Dd;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware(['permission:manage roles']);
    }

    public function RoleView()
    {
        $data['allData'] = Role::with('permissions')->get();
        return view('backend.admin.role.view_role', $data);
    }

    public function RoleAdd()
    {
        $data['permissions'] = Permission::all();
        return view('backend.admin.role.add_role', $data);
    }

    public function RoleStore(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name',
        ]);
        $role = Role::create(['name' => $request->name]);
        $role->syncPermissions($request->permissions);
        $message = array(
            'message' => 'Role added successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.role.view')->with($message);
    }

    public function RoleEdit($id)
    {
        $data['role'] = Role::find($id);
        $data['permissions'] = Permission::all();
        return view('backend.admin.role.edit_role', $data);
    }

    public function RoleUpdate(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $role = Role::find($id);
        $role->name = $request->name;
        $role->syncPermissions($request->permissions);
        $role->save();

        $message = array(
            'message' => 'Role updated successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.role.view')->with($message);
    }

    public function RoleDelete($id)
    {
        $role = Role::find($id);
        $role->delete();

        $message = array(
            'message' => 'Role deleted successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.role.view')->with($message);
    }

    public function RolePermission(Request $request)
    {
        $id = $request->role;
        $role = Role::find($id);
        return response()->json($role->permissions->pluck('id')->toArray());
    }
}
