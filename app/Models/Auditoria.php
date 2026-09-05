<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Auditoria extends Model
{
    protected $table = 'auditorias';

    protected $fillable = [
        'user_id',
        'acao',
        'modulo',
        'auditable_type',
        'auditable_id',
        'descricao',
        'dados_anteriores',
        'dados_novos',
        'ip_address',
        'user_agent',
    ];

    protected $casts = [
        'dados_anteriores' => 'array',
        'dados_novos' => 'array',
    ];

    /**
     * Utilizador que realizou a ação.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Nome amigável da ação.
     */
    public function getAcaoFormatadaAttribute(): string
    {
        return match ($this->acao) {
            'login' => 'Login',
            'logout' => 'Logout',
            'criar' => 'Criação',
            'editar' => 'Edição',
            'eliminar' => 'Eliminação',
            'visualizar' => 'Visualização',
            'transferir' => 'Transferência',
            default => ucfirst(str_replace('_', ' ', $this->acao)),
        };
    }
}