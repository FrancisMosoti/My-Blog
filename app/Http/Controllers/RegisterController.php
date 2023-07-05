<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\User;
use App\Rules\PhoneValidation;
use App\Notifications\RegisterSuccess;
use Illuminate\Support\Facades\Notification;

class RegisterController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest');
    }
    //
    public function view(){
        return view('auth/register');
    }

    public function store(Request $request):RedirectResponse
    {

        // validation
        $request->validate([
            'name' => 'required|string|max:255|min:3',
            'email' => 'required|email',
            'phone' => ['required','numeric', new PhoneValidation()],
            'password' => ['required','confirmed'],
            'terms' => ['required']
        ]);

        User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => validatePhone($request->input('phone'))['phone'],
            'password' => $request->input('password')
        ]);

        Notification::route('slack', config('notification.register'))->notify(new RegisterSuccess());

        return redirect('/login')->with('success', 'Registration Successful. Now Login');

    } 

}
