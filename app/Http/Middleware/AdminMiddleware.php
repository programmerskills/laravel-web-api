<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    
    public function handle($request, Closure $next)
    {
        if(Auth::check() && Auth::user()->role==1)
        {
            //dd(Auth::user());
            // return redirect('/d');
            return $next($request);
        }
        else
        {
            
            return redirect('/login');
        }
        
    }
}
