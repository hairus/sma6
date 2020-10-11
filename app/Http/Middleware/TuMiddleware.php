<?php

namespace App\Http\Middleware;

use Closure;

class TuMiddleware
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
        //filter user disini dengan cek apakah role 1 = untuk siswa 2= untuk guru 3= untuk admin
        if($user)
        {
            if($user->role == 9)
            {

                return $next($request);
            }
        }
        return abort('403');
    }
}
