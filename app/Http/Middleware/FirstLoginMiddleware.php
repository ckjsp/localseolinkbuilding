<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FirstLoginMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(session("verified")) {
            Auth::logout();
            return redirect('/login')->with('verified' , 'Your email has been verified. You can now log in.');
        }
        if (Auth::check() && !Auth::user()->phone_number && !Auth::user()->company_website_url && !Auth::user()->country) {
            if (Auth::user()->role == 'Advertiser') {
                session(['show_advertiser_modal' => true]);
            }
            return redirect('/user/profile')->with(['errorMsg' => 'Oops! First edit your profile properly, after you can access other page.', 'show_advertiser_modal' => true]);
        }
        return $next($request);
    }
}
