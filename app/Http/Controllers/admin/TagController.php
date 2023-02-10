<?php

namespace App\Http\Controllers\admin;

use App\Models\Tag;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TagController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware(['permission:manage pages']);
    }

    public function TagView()
    {
        $data['allData'] = Tag::all();
        return view('backend.admin.setup.tag.view_tag', $data);
    }

    public function TagAdd()
    {
        return view('backend.admin.setup.tag.add_tag');
    }

    public function TagStore(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:tags,name|min:3|max:255'
        ]);
        $tag = new Tag();
        $tag->name = $request->name;
        if ($request->slug) {
            $tag->slug = $request->slug;
        } else {
            $tag->slug = Str::slug($request->name);
        }
        $tag->save();
        $message = array(
            'message' => 'Tag Inserted Successfully',
            'alert-type' => 'success'
        );

        return Redirect()->route('admin.tag.view')->with($message);
    }

    public function TagEdit($id)
    {
        $data['tag'] = Tag::find($id);
        return view('backend.admin.setup.tag.edit_tag', $data);
    }

    public function TagUpdate(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|min:3|max:255'
        ]);
        $tag = Tag::find($id);
        $tag->name = $request->name;
        if ($request->slug) {
            $tag->slug = $request->slug;
        } else {
            $tag->slug = Str::slug($request->name);
        }
        $tag->save();
        $message = array(
            'message' => 'Tag Updated Successfully',
            'alert-type' => 'success'
        );

        return Redirect()->route('admin.tag.view')->with($message);
    }

    public function TagDelete($id)
    {
        $tag = Tag::find($id);
        $tag->delete();
        $message = array(
            'message' => 'Tag Deleted Successfully',
            'alert-type' => 'error'
        );

        return Redirect()->route('admin.tag.view')->with($message);
    }
}
