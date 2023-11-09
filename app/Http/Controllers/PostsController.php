<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function index(Request $request)
    {
        $posts = Post::latest();

        if ($request->search) {
            $posts->where('title', 'like', '%' . $request->search . '%');
        }
        return view('frontend.posts', [
            'title' => 'All Posts',
            'posts' => $posts->paginate(10),
            'categories' => Category::all(),
        ]);
    }

    public function read(Post $post)
    {
        return view('frontend.read', [
            'title' => 'Posts',
            'post' => $post,
            'categories' => Category::all(),
        ]);
    }
}
