<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    /**
     * Atribui permissões aos perfis do SNRP.
     */
    public function run(): void
    {
        /*
         * ADMINISTRADOR
         * Acesso total ao sistema.
         */
        $administrador = Role::where('nome', 'Administrador')->first();

        if ($administrador) {
            $administrador->permissions()->sync(
                Permission::pluck('id')->toArray()
            );
        }

        /*
         * OPERADOR
         * Cadastro e gestão autorizada.
         */
        $operador = Role::where('nome', 'Operador')->first();

        if ($operador) {
            $operador->permissions()->sync(
                Permission::whereIn('nome', [
                    'dashboard.visualizar',

                    'instituicoes.visualizar',
                    'instituicoes.criar',
                    'instituicoes.editar',

                    'pessoas.visualizar',
                    'pessoas.criar',
                    'pessoas.editar',

                    'tipos_patrimonio.visualizar',

                    'patrimonios.visualizar',
                    'patrimonios.criar',
                    'patrimonios.editar',

                    'transferencias.visualizar',
                    'transferencias.criar',

                    'consulta_publica.visualizar',

                    'relatorios.visualizar',
                    'relatorios.exportar',
                ])->pluck('id')->toArray()
            );
        }

        /*
         * TÉCNICO
         * Validação e consulta de informações.
         */
        $tecnico = Role::where('nome', 'Técnico')->first();

        if ($tecnico) {
            $tecnico->permissions()->sync(
                Permission::whereIn('nome', [
                    'dashboard.visualizar',

                    'pessoas.visualizar',

                    'patrimonios.visualizar',
                    'patrimonios.editar',

                    'transferencias.visualizar',

                    'consulta_publica.visualizar',

                    'relatorios.visualizar',
                ])->pluck('id')->toArray()
            );
        }

        /*
         * CIDADÃO
         * Acesso limitado ao próprio património.
         */
        $cidadao = Role::where('nome', 'Cidadão')->first();

        if ($cidadao) {
            $cidadao->permissions()->sync(
                Permission::whereIn('nome', [
                    'dashboard.visualizar',
                    'patrimonios.visualizar',
                    'consulta_publica.visualizar',
                ])->pluck('id')->toArray()
            );
        }

        /*
         * PARCEIRO
         * Acesso limitado para consulta.
         */
        $parceiro = Role::where('nome', 'Parceiro')->first();

        if ($parceiro) {
            $parceiro->permissions()->sync(
                Permission::whereIn('nome', [
                    'dashboard.visualizar',
                    'patrimonios.visualizar',
                    'consulta_publica.visualizar',
                ])->pluck('id')->toArray()
            );
        }
    }
}

