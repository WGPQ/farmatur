<?php

namespace App\Http\Middleware;

use Closure;

class MDusuarioAdministrador
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
        $usuario_actual=\Auth::user();
        if($usuario_actual->tipouser!=2){
         return view("mensajes.msj_rechazado")->with("msj","Esta seccion es solo visible para el usuario estandard <br/> usted aun no ha sido asignado como usuario standard , consulte al administrador del sistema");
        }
        return $next($request);
    }
}
