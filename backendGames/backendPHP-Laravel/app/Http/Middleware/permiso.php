<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class permiso
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        Log::info("permiso");
        //Si el valor de is admin que nos llega por la url es true, entonces seguimos
      // con la ejecución del middleware
        if($request->is_admin === '1'){
        return $next($request);
        } else {
        //La respuesta debe ir en un json ya que no acepta texto plano
        return response()->json('No estás autorizado', 401);
        }
    }
}
