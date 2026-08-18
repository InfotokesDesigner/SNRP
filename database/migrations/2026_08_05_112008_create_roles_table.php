<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Criar tabela de perfis de acesso
     */
    public function up(): void
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();

            $table->string('nome', 50)
                  ->unique();

            $table->text('descricao')
                  ->nullable();

            $table->boolean('ativo')
                  ->default(true);

            $table->timestamps();
        });
    }

    /**
     * Remover tabela de perfis de acesso
     */
    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};