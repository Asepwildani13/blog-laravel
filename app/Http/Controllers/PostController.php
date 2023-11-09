<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        if ($user->isAdmin()) {
            // cek jika pengguna itu admin maka tampilkan semua post
            $posts = Post::all();
        } else {
            // jika pengguna bukan admin maka tampilkan post sesuai dengan user
            $posts = Post::where('user_id', $user->id)->get();
        }

        return view('post.index', [
            'title' => 'Manage Post',
            'posts' => $posts,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('post.create', [
            'title' => 'Create Post',
            'categories' => Category::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'slug' => 'required',
            'content' => 'required',
            'img' => 'required|image|max:1024',
            'category_id' => 'required',
            'user_id' => 'required',
        ]);

        if ($request->has('img')) {
            $path = $request->file('img')->store('post-img');
            $data['img'] = $path;
        }

        Post::create([
            'title' => $request->title,
            'slug' => $request->slug,
            'excerpt' => Str::limit($request->content, 100), // mengambil 20 kata dari title,
            'content' => $request->content,
            'img' => $data['img'],
            'category_id' => $request->category_id,
            'user_id' => $request->user_id,
        ]);
        return redirect('admin/post')->with('success', 'Data created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('post.show', [
            'title' => 'Detail Post',
            'post' => Post::findOrFail($id),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('post.edit', [
            'title' => 'Edit Post',
            'post' => Post::findOrFail($id),
            'categories' => Category::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'title' => 'required',
            'slug' => 'required',
            'content' => 'required',
            'img' => 'image|max:1024',
            'category_id' => 'required',
            'user_id' => 'required',
        ]);
        $post = Post::findOrFail($id);

        if ($request->has('img')) {
            if ($post->img) {
                Storage::delete($post->img);
            }
            $path = $request->file('img')->store('post-img');
            $data['img'] = $path;
        }

        $post->update([
            'title' => $request->title,
            'slug' => $request->slug,
            'excerpt' => Str::limit($request->content, 100), // mengambil 20 kata dari title,
            'content' => $request->content,
            'img' => $post->img,
            'category_id' => $request->category_id,
        ]);
        return redirect('admin/post')->with('success', 'Data updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        if ($post->img) {
            Storage::delete($post->img);
        }

        $post->delete();
        return back()->with('success', 'Data deleted successfully');
    }
}
