<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Posts;
use App\Models\Comments;
use App\Models\Categories;

class AdminController extends Controller
{
    //
    public function index(){
        return view('admin.index',['users' => User::all()]);
    }
    public function side(){;
        return view('admin.side',['categories' => Categories::all()]);
    }

    public function login(){
        return view('admin.login');
    }
    public function comment(){
        return view('admin.comments',['comments' => Comments::all()]);
    }
    
    public function register(){
        return view('admin.register');
    }
    public function posts(){
        return view('admin.posts',['posts' => Posts::all()]);
    }

    public function destroy($id)
    {
        // Find the item by ID and delete it
        $item = User::find($id);
        $item->delete();

        // Redirect to the appropriate page or perform any other action
        return redirect()->back()->with('success', 'User has been deleted successfully.');
    }

    // rfegister admin
    

    
}