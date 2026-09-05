<?php

namespace App\Models;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Instituicao extends Model
{
    use Auditable;

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

    /**
     * Define o módulo da auditoria.
     */
    public function getAuditoriaModulo(): string
    {
        return 'instituicoes';
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}