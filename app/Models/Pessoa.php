<?php

namespace App\Models;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pessoa extends Model
{
    use Auditable;

    protected $fillable = [
        'user_id',
        'codigo_cidadao',
        'nome_completo',
        'bi',
        'nif',
        'data_nascimento',
        'sexo',
        'telefone',
        'email',
        'morada',
        'fotografia',
        'ativo'
    ];


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


    public function patrimonios(): HasMany
    {
        return $this->hasMany(Patrimonio::class);
    }


    /**
     * Transferências em que a pessoa era o proprietário anterior.
     */
    public function transferenciasComoAnterior(): HasMany
    {
        return $this->hasMany(
            TransferenciaPatrimonial::class,
            'proprietario_anterior_id'
        );
    }


    /**
     * Transferências em que a pessoa passou a ser o novo proprietário.
     */
    public function transferenciasComoNovo(): HasMany
    {
        return $this->hasMany(
            TransferenciaPatrimonial::class,
            'novo_proprietario_id'
        );
    }
}