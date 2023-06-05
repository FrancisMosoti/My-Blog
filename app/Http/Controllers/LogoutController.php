<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class LogoutController extends Controller
{
    //

                    /**
         * Log the user out of the application.
         */
        public function logout()
        {
            Auth::logout();
                // Optional: Clear any additional session data
            Session::flush();

            // Optional: Regenerate the CSRF token
            Session::regenerateToken();
                
            return redirect('login');
        }
}
