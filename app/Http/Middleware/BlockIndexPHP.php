<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BlockIndexPHP
{
    public function handle($request, Closure $next)
    {
        if (strpos($request->getRequestUri(), 'index.php') !== false) {
            return redirect('/');
        }
        return $next($request);
    }
}
