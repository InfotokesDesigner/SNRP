<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TransferenciaPatrimonial extends Model
{
    protected $table = 'transferencia_patrimonials';

    protected $fillable = [
        'patrimonio_id',
        'proprietario_anterior_id',
        'novo_proprietario_id',
        'data_transferencia',
        'observacao',
    ];

    protected $casts = [
        'data_transferencia' => 'date',
    ];

    /**
     * Patrimônio que foi transferido.
     */
    public function patrimonio(): BelongsTo
    {
        return $this->belongsTo(Patrimonio::class);
    }

    /**
     * Proprietário anterior.
     */
    public function proprietarioAnterior(): BelongsTo
    {
        return $this->belongsTo(
            Pessoa::class,
            'proprietario_anterior_id'
        );
    }

    /**
     * Novo proprietário.
     */
    public function novoProprietario(): BelongsTo
    {
        return $this->belongsTo(
            Pessoa::class,
            'novo_proprietario_id'
        );
    }
}