<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::orderBy('category_name', 'ASC');

        if ($request->search) {
            $categories->where('category_name', 'like', '%' . $request->search . '%');
        }

        return view('frontend.category', [
            'title' => 'All Category',
            'categories' => $categories->paginate(1),
        ]);
    }

    public function show(Category $category)
    {
        return view('frontend.showCategory', [
            'title' => 'Category',
            'category' => $category,
        ]);
    }
}
