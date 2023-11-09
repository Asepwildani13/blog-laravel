<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        return view('frontend.home', [
            'title' => 'Home',
            'posts' => Post::latest()->paginate(9)->withQueryString(),
            'postCarousels' => Post::latest()->take(3)->get(), // mengambil 3 terbaru untuk ditampilkan di carousel
            'categories' => Category::all(),
        ]);
    }
}
