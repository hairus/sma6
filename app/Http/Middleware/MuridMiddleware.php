<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\mst_operator;

class MuridMiddleware
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
    if ($user) {
      if ($user->role == 3) {
        return $next($request);
      }
    }
    return abort('403');
  }
}
