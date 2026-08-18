<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TipoPatrimonio;

class TipoPatrimonioSeeder extends Seeder
{
    public function run(): void
    {
        $tipos = [

            [
                'nome' => 'Casa',
                'descricao' => 'Residências e imóveis habitacionais',
                'ativo' => true,
            ],

            [
                'nome' => 'Terreno',
                'descricao' => 'Terrenos urbanos ou rurais',
                'ativo' => true,
            ],

            [
                'nome' => 'Viatura',
                'descricao' => 'Veículos automóveis',
                'ativo' => true,
            ],

            [
                'nome' => 'Outro',
                'descricao' => 'Outros tipos de bens patrimoniais',
                'ativo' => true,
            ],

        ];


        foreach ($tipos as $tipo) {

            TipoPatrimonio::updateOrCreate(
                ['nome' => $tipo['nome']],
                $tipo
            );

        }
    }
}