<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FotografiaPatrimonio extends Model
{
    protected $fillable = [
        'patrimonio_id',
        'caminho',
        'nome_original',
        'descricao',
        'principal',
    ];

    protected $casts = [
        'principal' => 'boolean',
    ];

    /**
     * Património ao qual pertence esta fotografia.
     */
    public function patrimonio(): BelongsTo
    {
        return $this->belongsTo(Patrimonio::class);
    }
}