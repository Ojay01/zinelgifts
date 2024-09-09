<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use Illuminate\Http\Request;

class BlogPostController extends Controller
{
    public function index()
    {
        $blogs = BlogPost::latest()->paginate(10);
        return view('blogs', compact('blogs'));
    }

    public function show($slug)
    {
        $blog = BlogPost::where('slug', $slug)->firstOrFail();
        return view('blogs_details', compact('blog'));
    }

    public function create()
    {
        return view('blog.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required',
            'thumbnail' => 'required|string',
            'slug' => 'required|string|unique:blog_posts,slug',
        ]);

        BlogPost::create($request->all());

        return redirect()->route('blog.index');
    }

    public function edit($slug)
    {
        $post = BlogPost::where('slug', $slug)->firstOrFail();
        return view('blog.edit', compact('post'));
    }

    public function update(Request $request, $slug)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required',
            'thumbnail' => 'required|string',
            'slug' => 'required|string|unique:blog_posts,slug,' . $slug . ',slug',
        ]);

        $post = BlogPost::where('slug', $slug)->firstOrFail();
        $post->update($request->all());

        return redirect()->route('blog.index');
    }

    public function destroy($slug)
    {
        $post = BlogPost::where('slug', $slug)->firstOrFail();
        $post->delete();

        return redirect()->route('blog.index');
    }
}
