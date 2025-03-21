<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RedirectWwwToNonWww
{
    public function handle(Request $request, Closure $next)
    {
        if (strpos($request->getHost(), 'www.') === 0) {
            $nonWwwHost = str_replace('www.', '', $request->getHost());
            return redirect()->to($request->getScheme() . '://' . $nonWwwHost . $request->getRequestUri(), 301);
        }

        return $next($request);
    }
}
