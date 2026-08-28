<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckPermission
{
    /**
     * Verifica se o utilizador possui a permissão necessária.
     */
    public function handle(
        Request $request,
        Closure $next,
        string $permission
    ): Response {

        // Verifica se existe utilizador autenticado.
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        // Verifica se a conta está ativa.
        if (!auth()->user()->ativo) {
            auth()->logout();

            return redirect()
                ->route('login')
                ->with('error', 'A sua conta está desativada.');
        }

        // Verifica a permissão solicitada.
        if (!auth()->user()->hasPermission($permission)) {
            abort(403, 'Não tem permissão para executar esta ação.');
        }

        return $next($request);
    }
}




