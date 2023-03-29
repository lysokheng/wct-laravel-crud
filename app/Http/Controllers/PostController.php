<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'body' => 'required',
        ]);

        $validator = Validator::make($request->all(), [
            'image' => 'image|mimes:png,jpeg,jpg|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect('/home')->with('success', 'Post created unsuccessfully!');
        }

        $post = new Post();
        $post->title = $request->title;
        $post->body = $request->body;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extention = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extention;
            $file->move('uploads/posts/', $filename);
            $post->image = $filename;
        }
        $post->save();
        return redirect('/home')->with('success', 'Post created successfully!');
    }

    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    public function update(Post $post, Request $request)
    {
        $request->validate([
            'title' => 'required',
            'body' => 'required',
        ]);

        $validator = Validator::make($request->all(), [
            'image' => 'image|mimes:png,jpeg,jpg|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect('/home')->with('success', 'Post created unsuccessfully!');
        }

        $post->title = $request->title;
        $post->body = $request->body;
        if ($request->hasfile('image')) {
            $destination = 'uploads/posts/' . $post->image;
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $file = $request->file('image');
            $extention = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extention;
            $file->move('uploads/posts/', $filename);
            $post->image = $filename;
        }
        $post->save();
        return redirect('/home')->with('success', 'Post updated successfully!');
    }

    public function destroy(Post $post)
    {
        $destination = 'uploads/posts/' . $post->profile_image;
        if (File::exists($destination)) {
            File::delete($destination);
        }
        $post->delete();
        return redirect('/home')->with('success', 'Post deleted successfully!');
    }
}