<?php

namespace App\Http\Middleware;

use App\Models\TipoDeUsuario;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AcessoComprador
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();
        $tipo = TipoDeUsuario::all()->where('id','=',$user['tipo_de_usuario_id']);

        $tipo = $tipo->pluck('tipo');
        if($tipo[0] == 'comprador' || $tipo[0] == 'admin'){
            return $next($request);
        }
        else{
            return redirect(route('403'));
        }
    }
}
