<?php

namespace App\Listeners;

use App\Services\AuditoriaService;
use Illuminate\Auth\Events\Logout;

class LogLogout
{
    /**
     * Regista o logout do utilizador.
     */
    public function handle(Logout $event): void
    {
        AuditoriaService::registrar(
            'logout',
            'autenticacao',
            'Utilizador terminou a sessão no SNRP.'
        );
    }
}
