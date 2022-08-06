<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class PakGuard
{
    public function handle(Request $request, Closure $next)
    {
        if(!\Auth::check()){
            return redirect ('login')->with('err','No permission');
        }
        return $next($request);
    }
}
