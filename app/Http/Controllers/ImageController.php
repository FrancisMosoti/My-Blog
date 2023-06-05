<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ImageController extends Controller
{
    //
    public function update(Request $request, $user)
    {
        $request->validate([
            'image' =>'required|image|max:2048'
        ]);

            // Store the new profile photo
            $profilePhoto = $request->file('image');
            $filename = time() . '_' . $profilePhoto->getClientOriginalName();
            // $path = $profilePhoto->storeAs('public/uploads', $filename);

            $storagePath = 'storage/uploads/';

            $profilePhoto->move(public_path($storagePath), $filename);

            // Update the profile_photo column in the user model
            User::where('id', $user)->update(['profile_photo' => $filename]);
            


            return redirect()->back()->with('success', 'Profile photo updated successfully');
    }
}