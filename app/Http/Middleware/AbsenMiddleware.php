<?php

namespace App\Http\Middleware;

use Closure;
use App\User;

class AbsenMiddleware
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
        //dd($user);
        if($user->role == 5)
        {
          return $next($request);
        }
      }
      return abort('403');
        return $next($request);
    }
}
