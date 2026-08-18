<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pessoa extends Model
{
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
    
}