<?php

namespace App\Models;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Patrimonio extends Model
{
    use Auditable;

    protected $fillable = [
        'codigo',
        'tipo_patrimonio_id',
        'pessoa_id',
        'instituicao_id',
        'nome',
        'descricao',
        'localizacao',
        'latitude',
        'longitude',
        'qr_code',
        'estado',
    ];

    /**
     * Define o módulo da auditoria.
     */
    public function getAuditoriaModulo(): string
    {
        return 'patrimonios';
    }

    public function tipoPatrimonio(): BelongsTo
    {
        return $this->belongsTo(TipoPatrimonio::class);
    }

    public function pessoa(): BelongsTo
    {
        return $this->belongsTo(Pessoa::class);
    }

    public function instituicao(): BelongsTo
    {
        return $this->belongsTo(Instituicao::class);
    }

    /**
     * Histórico de transferências deste património.
     */
    public function transferencias(): HasMany
    {
        return $this->hasMany(TransferenciaPatrimonial::class);
    }

    /**
     * Fotografias deste património.
     */
    public function fotografias(): HasMany
    {
        return $this->hasMany(FotografiaPatrimonio::class);
    }
}