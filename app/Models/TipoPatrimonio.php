<?php

namespace App\Models;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TipoPatrimonio extends Model
{
    use Auditable;

    protected $fillable = [
        'nome',
        'descricao',
        'ativo',
    ];

    /**
     * Define o módulo da auditoria.
     */
    public function getAuditoriaModulo(): string
    {
        return 'tipos_patrimonio';
    }

    public function patrimonios(): HasMany
    {
        return $this->hasMany(Patrimonio::class);
    }
}