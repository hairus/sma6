<?php

namespace App\Http\Middleware;

use Closure;

class sibaMiddleware
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
        $user = $request->user();
        if($user){
            if($user->role == 99)
            {

            return $next($request);
          }
        }
        return abort('403');
    }
}
