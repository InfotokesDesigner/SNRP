<?php

namespace App\Services;

use App\Models\Auditoria;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class AuditoriaService
{
    /**
     * Regista uma operação no histórico de auditoria.
     */
    public static function registrar(
        string $acao,
        ?string $modulo = null,
        ?string $descricao = null,
        ?Model $registro = null,
        ?array $dadosAnteriores = null,
        ?array $dadosNovos = null
    ): Auditoria {
        return Auditoria::create([
            'user_id' => Auth::id(),

            'acao' => $acao,

            'modulo' => $modulo,

            'auditable_type' => $registro
                ? $registro::class
                : null,

            'auditable_id' => $registro?->getKey(),

            'descricao' => $descricao,

            'dados_anteriores' => $dadosAnteriores,

            'dados_novos' => $dadosNovos,

            'ip_address' => request()->ip(),

            'user_agent' => request()->userAgent(),
        ]);
    }
}