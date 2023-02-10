<?php

namespace App\Http\Controllers\client;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class PostController extends Controller
{
    //

    public function PostHightlight()
    {
        return Post::with(['category', 'author'])->orderBy('created_at', 'DESC')->limit(3)->get();
    }

    public function GetPosts()
    {
        return Post::with(['category', 'author'])->orderBy('created_at', 'DESC')->limit(5)->get();
    }

    public function GetPost(Post $post)
    {
        $data['post'] = $post;
        $data['post_same_category'] = Post::with(['category', 'author'])
            ->where('category_id', $post->category_id)
            ->whereKeyNot($post->id)
            ->orderBy('created_at', 'DESC')
            ->inRandomOrder()
            ->limit(2)
            ->get();
        $data['post_popular'] = Post::with(['category', 'author'])
            ->orderBy('views', 'DESC')
            ->inRandomOrder()
            ->limit(2)
            ->get();
        // dd($data);
        if (!(Session::get('post_id') == $post->id)) {
            $post->increment('views');
            Session::put('post_id', $post->id);
        }
        return view('backend.client.post.view_post', $data);
    }

    public function getPostByCategory(Category $category)
    {
        $data['posts'] = Post::with(['category', 'author'])
            ->where('category_id', $category->id)
            ->orderBy('created_at', 'DESC')
            ->limit(5)
            ->get();
        $data['category'] = $category;
        return view('backend.client.post.view_category_post', $data);
    }
    public function getPostByCategoryJson($id)
    {
        $data['posts'] = Post::with(['category', 'author'])
            ->where('category_id', $id)
            ->orderBy('created_at', 'DESC')
            ->paginate(5);
        $data['category_id'] = $id;
        return response()->json($data);
    }
}
