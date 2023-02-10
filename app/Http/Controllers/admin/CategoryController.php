<?php

namespace App\Http\Controllers\admin;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware(['permission:manage pages']);
    }

    public function CategoryView()
    {
        $data['allData'] = Category::with(['creators', 'parent'])->get();
        return view('backend.admin.setup.category.view_category', $data);
    }

    public function CategoryAdd()
    {
        $data['categories'] = Category::all();
        return view('backend.admin.setup.category.add_category', $data);
    }

    public function CategoryStore(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required|unique:categories|min:3|max:255',
        ]);

        $category = new Category();
        $category->name = $request->name;
        if ($request->slug) {
            $category->slug = $request->slug;
        } else {
            $category->slug = Str::slug($request->name);
        }
        if ($request->parent_id) {
            $category->parent_id = $request->parent_id;
        }
        $category->creator = auth()->user()->id;
        $category->save();

        $message = array(
            'message' => 'Category Inserted Successfully',
            'alert-type' => 'success'
        );

        return Redirect()->route('admin.category.view')->with($message);
    }

    public function CategoryEdit($id)
    {
        $data['category'] = Category::find($id);
        $data['categories'] = Category::where('id', '!=', $id)->get();
        return view('backend.admin.setup.category.edit_category', $data);
    }

    public function CategoryUpdate(Request $request, $id)
    {

        $validateData = $request->validate([
            'name' => 'required|min:3|max:255',
        ]);

        $category = Category::find($id);
        $category->name = $request->name;

        if ($request->slug) {
            $category->slug = $request->slug;
        } else {
            $category->slug = Str::slug($request->name);
        }
        if ($request->parent_id) {
            $category->parent_id = $request->parent_id;
        } else {
            $category->parent_id = null;
        }

        $category->save();

        $message = array(
            'message' => 'Category Updated Successfully',
            'alert-type' => 'info'
        );

        return Redirect()->route('admin.category.view')->with($message);
    }

    public function CategoryDelete($id)
    {
        DB::table('categories')->where('id', $id)->delete();

        $notification = array(
            'message' => 'Category Deleted Successfully',
            'alert-type' => 'error'
        );

        return Redirect()->back()->with($notification);
    }
}
