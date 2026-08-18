<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Criar tabela de instituições
     */
    public function up(): void
    {
        Schema::create('instituicoes', function (Blueprint $table) {

            $table->id();

            $table->string('nome');

            $table->string('sigla', 20)
                  ->unique();

            $table->string('nif', 30)
                  ->nullable()
                  ->unique();

            $table->string('telefone', 30)
                  ->nullable();

            $table->string('email')
                  ->nullable();

            $table->text('endereco')
                  ->nullable();

            $table->string('logo')
                  ->nullable();

            $table->boolean('ativo')
                  ->default(true);

            $table->timestamps();

        });
    }

    /**
     * Remover tabela
     */
    public function down(): void
    {
        Schema::dropIfExists('instituicoes');
    }
};