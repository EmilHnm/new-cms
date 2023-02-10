<?php

namespace App\Http\Controllers\client;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{
    //

    public function SearchView(Request $request)
    {
        $search = $request->get('q') ?? '';
        $data['query'] = $search;
        $data['posts'] = [];
        if ($search) {
            $data['posts'] = Post::search('title:' . $search . '*')
                ->query(function ($builder) {
                    $builder->with(['category', 'author']);
                })->paginate(10);
            // $data['posts'] = Post::with(['category', 'author'])->where("title", "LIKE", "%" . $search . "%")->paginate(10);
            $data['page'] = json_decode($data['posts']->toJSON());
        }
        // dd($data['page']);
        return view('backend.client.search.search', $data);
    }
}
