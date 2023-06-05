<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Models\Posts;
use App\Models\User;
use App\Models\Categories;

class PostController extends Controller
{
    //
    public function view(){
        return view('post',['categories' => Categories::all()]);
    }

    public function add(){
        return view('add',['categories' => Categories::all()]);
    }



    public function store(Request $request)
    {
        // validation
        $request->validate([
            'title' => 'required|max:255',
            'body' => 'required|max:1000',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category' => 'required',
        ], ['body.required' => 'A body of a post is required']);


        
        $imagePath = $request->file('image')->store('uploads', 'public');
        

        Posts::create([
            'body' => $request->input('body'),
            'title' => $request->input('title'),
            'post_image' => $imagePath,
            'category'=> $request->input('category'),
            'user_id' => $request->User()->id
        ]);

        session()->flash('success', 'Your post has been saved.');

        return back();

    } 

    public function show($post)
    {
        $post = Posts::with('comments')->find($post);

        if(is_null($post)){
            return response("Post not found", 404);
        }

        return view('show', ['post' => $post,'categories' => Categories::all()]);

    }

    public function destroy($id)
    {
        $post = Posts::findOrFail($id);
        $post->delete();

        return redirect('home')->with('success', 'Post deleted successfully');
    }
    

}