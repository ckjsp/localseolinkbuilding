<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        if (!auth()->check()) {
            // Redirect to login or show an error message
            return redirect()->route('login');
        }
    
        if (!auth()->user()->hasRole($role)) {
            // Unauthorized access
            abort(403, 'Unauthorized');
        }
    
        return $next($request);
    }
}
