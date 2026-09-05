<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Traits\Auditable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, Auditable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
    'name',
    'email',
    'password',
    'role_id',
    'instituicao_id',
    'ativo',
    'ultimo_acesso',
];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function instituicao(): BelongsTo
{
    return $this->belongsTo(Instituicao::class);
}

    public function role(): BelongsTo
{
    return $this->belongsTo(Role::class);
}


    /**
     * Verifica se o utilizador possui determinada permissão.
     */
    /**
 * Define o módulo da auditoria.
 */
                 public function getAuditoriaModulo(): string
{
         return 'utilizadores';
    }public function hasPermission(string $permission): bool
    {
        if (!$this->role || !$this->role->ativo) {
            return false;
        }

        return $this->role
            ->permissions()
            ->where('nome', $permission)
            ->where('permissions.ativo', true)
            ->exists();
    }




}
