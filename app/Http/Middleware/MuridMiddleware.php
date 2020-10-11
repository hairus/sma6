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
         /*=== buat pengecekan bahwa jika hari ini ada ujian maka redirecy ke halaman soal===*/
         $mst = mst_operator::whereDay('created_at', date('d'))->count();
         /*==================================================================================*/
         if($user){
             if($user->role == 6)
             {
//               if($mst == 2)
//               {
//                   return redirect(url('siswa/gg'));
//               }
             return $next($request);
           }
         }
         return abort('403');
     }
}
