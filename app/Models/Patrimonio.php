<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Patrimonio extends Model
{
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
}