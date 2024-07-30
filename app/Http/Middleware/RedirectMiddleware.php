<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RedirectMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()->role->name == 'Advertiser' && ($request->is('publisher*') || $request->is('lslb-admin*'))) {
            return redirect('advertiser');
        }
        if(Auth::check() && Auth::user()->role->name == 'Publisher' && ($request->is('advertiser*') || $request->is('lslb-admin*'))){
            return redirect('publisher');
        }
        if(Auth::check() && Auth::user()->role->name == 'Admin' && ($request->is('advertiser*') || $request->is('publisher*'))){
            return redirect('lslb-admin');
        }
        return $next($request);
    }
}
