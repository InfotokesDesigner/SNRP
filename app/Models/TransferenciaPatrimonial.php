<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Traits\Auditable;

class TransferenciaPatrimonial extends Model
{
    use Auditable;
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
 * Define o módulo da auditoria.
 */
public function getAuditoriaModulo(): string
{
    return 'transferencias';
}

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