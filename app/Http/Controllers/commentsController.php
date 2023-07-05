<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comments;

class commentsController extends Controller
{
    //

    public function store(Request $request, $post)
    {

        $request->validate([
            'body' =>'required|max:100'
        ]);

        Comments::create([
            'body' => $request->body,
            'posts_id' => $post,
            'user_id' => $request->user()->id
        ]);

        session()->flash('success', 'Your comment has been sent.');

        return back();
    }

    public function destroy($id)
    {
        $comments = Comments::findOrFail($id);
        $comments->delete();

        return redirect()->back()->with('success', 'Comment deleted successfully');
    }
}