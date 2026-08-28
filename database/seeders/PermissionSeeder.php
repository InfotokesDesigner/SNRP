<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Executa o seeder das permissões do SNRP.
     */
    public function run(): void
    {
        $permissions = [

            // Dashboard
            [
                'nome' => 'dashboard.visualizar',
                'modulo' => 'dashboard',
                'descricao' => 'Visualizar o Dashboard',
            ],

            // Utilizadores
            [
                'nome' => 'utilizadores.visualizar',
                'modulo' => 'utilizadores',
                'descricao' => 'Visualizar utilizadores',
            ],
            [
                'nome' => 'utilizadores.criar',
                'modulo' => 'utilizadores',
                'descricao' => 'Criar utilizadores',
            ],
            [
                'nome' => 'utilizadores.editar',
                'modulo' => 'utilizadores',
                'descricao' => 'Editar utilizadores',
            ],
            [
                'nome' => 'utilizadores.eliminar',
                'modulo' => 'utilizadores',
                'descricao' => 'Eliminar utilizadores',
            ],

            // Instituições
            [
                'nome' => 'instituicoes.visualizar',
                'modulo' => 'instituicoes',
                'descricao' => 'Visualizar instituições',
            ],
            [
                'nome' => 'instituicoes.criar',
                'modulo' => 'instituicoes',
                'descricao' => 'Criar instituições',
            ],
            [
                'nome' => 'instituicoes.editar',
                'modulo' => 'instituicoes',
                'descricao' => 'Editar instituições',
            ],
            [
                'nome' => 'instituicoes.eliminar',
                'modulo' => 'instituicoes',
                'descricao' => 'Eliminar instituições',
            ],

            // Pessoas
            [
                'nome' => 'pessoas.visualizar',
                'modulo' => 'pessoas',
                'descricao' => 'Visualizar pessoas',
            ],
            [
                'nome' => 'pessoas.criar',
                'modulo' => 'pessoas',
                'descricao' => 'Criar pessoas',
            ],
            [
                'nome' => 'pessoas.editar',
                'modulo' => 'pessoas',
                'descricao' => 'Editar pessoas',
            ],
            [
                'nome' => 'pessoas.eliminar',
                'modulo' => 'pessoas',
                'descricao' => 'Eliminar pessoas',
            ],

            // Tipos de Património
            [
                'nome' => 'tipos_patrimonio.visualizar',
                'modulo' => 'tipos_patrimonio',
                'descricao' => 'Visualizar tipos de património',
            ],
            [
                'nome' => 'tipos_patrimonio.criar',
                'modulo' => 'tipos_patrimonio',
                'descricao' => 'Criar tipos de património',
            ],
            [
                'nome' => 'tipos_patrimonio.editar',
                'modulo' => 'tipos_patrimonio',
                'descricao' => 'Editar tipos de património',
            ],
            [
                'nome' => 'tipos_patrimonio.eliminar',
                'modulo' => 'tipos_patrimonio',
                'descricao' => 'Eliminar tipos de património',
            ],

            // Patrimónios
            [
                'nome' => 'patrimonios.visualizar',
                'modulo' => 'patrimonios',
                'descricao' => 'Visualizar patrimónios',
            ],
            [
                'nome' => 'patrimonios.criar',
                'modulo' => 'patrimonios',
                'descricao' => 'Criar patrimónios',
            ],
            [
                'nome' => 'patrimonios.editar',
                'modulo' => 'patrimonios',
                'descricao' => 'Editar patrimónios',
            ],
            [
                'nome' => 'patrimonios.eliminar',
                'modulo' => 'patrimonios',
                'descricao' => 'Eliminar patrimónios',
            ],

            // Transferências
            [
                'nome' => 'transferencias.visualizar',
                'modulo' => 'transferencias',
                'descricao' => 'Visualizar transferências patrimoniais',
            ],
            [
                'nome' => 'transferencias.criar',
                'modulo' => 'transferencias',
                'descricao' => 'Criar transferências patrimoniais',
            ],

            // Consulta Pública
            [
                'nome' => 'consulta_publica.visualizar',
                'modulo' => 'consulta_publica',
                'descricao' => 'Consultar património publicamente',
            ],

            // Relatórios
            [
                'nome' => 'relatorios.visualizar',
                'modulo' => 'relatorios',
                'descricao' => 'Visualizar relatórios',
            ],
            [
                'nome' => 'relatorios.exportar',
                'modulo' => 'relatorios',
                'descricao' => 'Exportar relatórios',
            ],

            // Auditoria
            [
                'nome' => 'auditoria.visualizar',
                'modulo' => 'auditoria',
                'descricao' => 'Visualizar registos de auditoria',
            ],

            // Administração
            [
                'nome' => 'administracao.visualizar',
                'modulo' => 'administracao',
                'descricao' => 'Aceder à área de administração',
            ],
        ];

        foreach ($permissions as $permission) {
            Permission::updateOrCreate(
                ['nome' => $permission['nome']],
                [
                    'modulo' => $permission['modulo'],
                    'descricao' => $permission['descricao'],
                    'ativo' => true,
                ]
            );
        }
    }
}

