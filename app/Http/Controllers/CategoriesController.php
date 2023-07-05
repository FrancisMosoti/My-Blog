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

    public function destroy($id)
    {
        // Find the item by ID and delete it
        $item = Categories::find($id);
        $item->delete();

        // Redirect to the appropriate page or perform any other action
        return redirect()->back()->with('success', 'Category has been deleted successfully.');
    }




}