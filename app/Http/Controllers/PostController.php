<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::join('authors', 'posts.author_id', '=', 'authors.id')
            ->join('categories', 'posts.category_id', '=', 'categories.id')
            ->select('posts.id', 'posts.title', 'posts.song_name', 'authors.name as author_name', 'categories.name as category_name', 'posts.written_date', 'posts.image')
            ->orderByDesc('posts.id')
            ->take(10)
            ->get();
        // $posts = Post::all();
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $authors = Author::all();
        $categories = Category::all();

        return view('posts.create', compact('authors', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'title' => 'required',
            'song_name' => 'required',
            'author_id' => 'required',
            'category_id' => 'required',
            'written_date' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Create a new Post instance and save it to the database
        $post = new Post;
        $post->title = $validatedData['title'];
        $post->song_name = $validatedData['song_name'];
        $post->author_id = $validatedData['author_id'];
        $post->category_id = $validatedData['category_id'];
        $post->written_date = $validatedData['written_date'];
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $post->image = 'images/' . $imageName;
        }
        $post->save();

        return redirect()->route('posts.index')->with('success', 'Tạo bài viết thành công.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $post = Post::join('authors', 'posts.author_id', '=', 'authors.id')
            ->join('categories', 'posts.category_id', '=', 'categories.id')
            ->select('posts.title', 'posts.song_name', 'categories.name as category_name', 'posts.summary', 'posts.content', 'authors.name as author_name', 'posts.written_date', 'posts.image')
            ->findOrFail($id);

        return view('posts.show', compact('post'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $authors = Author::all();
        $categories = Category::all();

        return view('posts.edit', compact('post', 'authors', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'title' => 'required',
            'song_name' => 'required',
            'author_id' => 'required',
            'category_id' => 'required',
            'written_date' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Find the Post instance and update it with the new data
        $post = Post::findOrFail($id);
        $post->title = $validatedData['title'];
        $post->song_name = $validatedData['song_name'];
        $post->author_id = $validatedData['author_id'];
        $post->category_id = $validatedData['category_id'];
        $post->written_date = $validatedData['written_date'];

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $post->image = 'images/' . $imageName;
        }
        $post->save();

        return redirect()->route('posts.index')->with('success', 'Cập nhật bài viết thành công.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find the Post instance and delete it
        $post = Post::findOrFail($id);
        if ($post->image) {
            $imagePath = public_path($post->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }
        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Xóa bài viết thành công.');
    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');

        $posts = Post::join('authors', 'posts.author_id', '=', 'authors.id')
            ->join('categories', 'posts.category_id', '=', 'categories.id')
            ->select('posts.id', 'posts.title', 'posts.song_name', 'authors.name as author_name', 'categories.name as category_name', 'posts.written_date', 'posts.image')
            ->where('authors.name', 'like', "%$keyword%")
            ->orWhere('categories.name', 'like', "%$keyword%")
            ->orWhere('posts.title', 'like', "%$keyword%")
            ->orWhere('posts.song_name', 'like', "%$keyword%")
            ->orWhere('posts.written_date', 'like', "%$keyword%")
            ->get();

        return view('posts.search', compact('posts', 'keyword'));
    }
}
