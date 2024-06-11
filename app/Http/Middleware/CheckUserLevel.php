<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUserLevel
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $level
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $level)
    {
        if (Auth::check() && Auth::user()->nivel == $level) {
            return $next($request);
        }

        // Redirecionar ou retornar uma resposta apropriada se o usuário não tiver o nível requerido.
        return redirect('/')->with('error', 'Você não tem permissão para acessar esta página.');
    }
}
