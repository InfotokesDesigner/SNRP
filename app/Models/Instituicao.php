<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Instituicao extends Model
{
    protected $table = 'instituicoes';

    protected $fillable = [
        'nome',
        'sigla',
        'nif',
        'telefone',
        'email',
        'endereco',
        'logo',
        'ativo'
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}