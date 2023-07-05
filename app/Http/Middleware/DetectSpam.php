<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Cache;
use Jenssegers\Agent\Agent;

class DetectSpam
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
    
        $agent = new Agent();

        if ($agent->isRobot()) {
            // Log or handle the spam attempt (e.g., notify the admin)
            // You can use $request to access the submitted data for further analysis
            // For example, $request->input('email') will give you the value of the 'email' input field
            
            return response()->json(['error' => 'Spam detected.'], 403);
        }else{

            return $next($request);
        }
            
    
}
}