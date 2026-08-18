<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            [
                'nome' => 'Administrador',
                'descricao' => 'Acesso total ao sistema',
                'ativo' => true,
            ],
            [
                'nome' => 'Operador',
                'descricao' => 'Cadastro e gestão autorizada',
                'ativo' => true,
            ],
            [
                'nome' => 'Técnico',
                'descricao' => 'Validação de informações em campo',
                'ativo' => true,
            ],
            [
                'nome' => 'Cidadão',
                'descricao' => 'Gestão do próprio património',
                'ativo' => true,
            ],
            [
                'nome' => 'Parceiro',
                'descricao' => 'Acesso limitado ao sistema',
                'ativo' => true,
            ],
        ];

        foreach ($roles as $role) {

            Role::updateOrCreate(
                ['nome' => $role['nome']],
                $role
            );

        }
    }
}