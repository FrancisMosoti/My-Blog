<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Posts;
use App\Models\User;
use App\Models\Categories;

class HomeController extends Controller
{
    //
    public function index(){
        return view('home', ['posts'=> Posts::with('user')->withCount('comments')->latest()->get(),
    'categories' => Categories::all()]);
    }

    public function profile($profile){

        $user = User::find($profile);
        return view('profile', ['user' => $user, 'categories' => Categories::all()]);
    }

    public function destroy($id)
    {
        // Find the item by ID and delete it
        $item = Posts::find($id);
        dd($item);
        $item->delete();

        // Redirect to the appropriate page or perform any other action
        return redirect()->back()->with('success', 'Post deleted successfully.');
    }
    
}