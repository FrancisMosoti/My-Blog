<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categories;

class CategoriesController extends Controller
{


    public function store(Request $request){
        // validation
        $request->validate([
            'category' => 'required|string|max:20|min:3',
        ]);

        Categories::create([
            'categories' => $request->input('category'),

        ]);

        session()->flash('success', 'Category posted successfully');

        return back();
    }


}
