<?php

namespace App\Listeners;

use App\Services\AuditoriaService;
use Illuminate\Auth\Events\Login;

class LogLogin
{
    /**
     * Regista o login do utilizador.
     */
    public function handle(Login $event): void
    {
        AuditoriaService::registrar(
            'login',
            'autenticacao',
            'Utilizador iniciou sessão no SNRP.'
        );
    }
}