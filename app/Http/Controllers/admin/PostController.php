<?php

namespace App\Http\Controllers\admin;

use App\Models\Tag;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware(['permission:manage pages']);
    }

    public function PostView()
    {
        $data["allData"] = Post::all();
        return view('backend.admin.post.view_post', $data);
    }

    public function PostAdd()
    {
        $data["categories"] = Category::all();
        $data["tags"] = Tag::all();
        return view('backend.admin.post.add_post', $data);
    }

    public function PostStore(Request $request)
    {
        $request->validate([
            'title' => 'required|min:3|max:255',
            'description' => 'required',
            'content' => 'required',
            'category_id' => 'required',
            'slug' => 'unique:posts,slug',
            'active' => 'required'
        ]);
        $post = new Post();
        $post->title = $request->title;
        $post->description = $request->description;
        $post->content = $request->content;
        if ($request->slug != "") {
            $post->slug = $request->slug;
        } else {
            $post->slug = Str::slug($request->title);
        }
        $post->category_id = $request->category_id;
        if ($request->hasFile('thumb')) {
            $file = $request->file('thumb');
            $filename = date('YmdHi') . Auth::user()->id . $post->slug . "." . $file->getClientOriginalExtension();
            $file->move(public_path('upload/post_images'), $filename);
            $post->thumb = $filename;
        }
        $post->active  = $request->active;
        $post->author_id = Auth::user()->id;
        $post->save();
        $post->tag()->attach($request->tags);
        $message = array(
            'message' => 'Post Added Successfully',
            'alert-type' => 'success'
        );
        return Redirect()->route('admin.post.view')->with($message);
    }

    public function PostEdit(int $id)
    {
        $data["categories"] = Category::all();
        $data["tags"] = Tag::all();
        $data["post"] = Post::find($id);
        return view('backend.admin.post.edit_post', $data);
    }

    public function PostUpdate(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|min:3|max:255',
            'description' => 'required',
            'content' => 'required',
            'category_id' => 'required',
            // 'slug' => 'unique:posts,slug',
            'active' => 'required'
        ]);
        $post  = Post::find($id);
        $post->title = $request->title;
        $post->description = $request->description;
        $post->content = $request->content;
        if ($request->slug) {
            $post->slug = $request->slug;
        } else {
            $post->slug = Str::slug($request->title);
        }
        $post->category_id = $request->category_id;
        if ($request->hasFile('thumb')) {
            @unlink(public_path('upload/post_images/' . $post->thumb));
            $file = $request->file('thumb');
            $filename = date('YmdHi') . Auth::user()->id . $post->slug . "." . $file->getClientOriginalExtension();
            $file->move(public_path('upload/post_images'), $filename);
            $post->thumb = $filename;
        }
        $post->active = $request->active;
        $post->save();
        if ($request->tags) {
            $post->tag()->detach();
            $post->tag()->attach($request->tags);
        }
        $message = array(
            'message' => 'Post Updated Successfully',
            'alert-type' => 'success'
        );
        return Redirect()->route('admin.post.view')->with($message);
    }

    public function PostUpdateAprrover(Request $request)
    {
        $post = Post::find($request->id);
        if (!empty($post->approvor_id)) {
            $post->approvor_id = null;
        } else {
            $post->approvor_id = Auth::user()->id;
        }
        $post->save();
        return response()->json(["status" => "success"]);
    }

    public function PostDelete($id)
    {
        $post = Post::find($id);
        @unlink(public_path('upload/post_images/' . $post->thumb));
        if (Storage::cloud()->exists('hoanm_img/' . $post->thumb)) {
            Storage::cloud()->delete('hoanm_img/' . $post->thumb);
        }
        $post->tag()->detach();
        $post->delete();
        $message = array(
            'message' => 'Post Deleted Successfully',
            'alert-type' => 'danger'
        );
        return Redirect()->route('admin.post.view')->with($message);
    }
}
