<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Atende uma solicitação recebida
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        //Verifica se o usuário está logado e se tem o papel de admin
        if (Auth::check() && Auth::user()->role === 'admin') {
            return $next($request);
        }
        //Se não for admin

        return redirect()->route('dashboard')->with('error', 'Apenas administradores podem realizar esta ação.');
    }
}
