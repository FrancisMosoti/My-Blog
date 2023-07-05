<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DetectForbiddenWords
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $forbiddenWords = [
            'suicide',
            // Add more forbidden words as needed
        ];

        $inputData = $request->all();

        foreach ($inputData as $key => $value) {
            if (is_string($value)) {
                foreach ($forbiddenWords as $word) {
                    if (stripos($value, $word) !== false) {
                        // Log or handle the presence of forbidden words (e.g., notify the admin)
                        // You can use $request to access the submitted data for further analysis
                        // For example, $request->input('email') will give you the value of the 'email' input field

                        return response()->json(['error' => 'Forbidden words detected.'], 403);
                    }
                }
            }
        }

        return $next($request);
    }
}
