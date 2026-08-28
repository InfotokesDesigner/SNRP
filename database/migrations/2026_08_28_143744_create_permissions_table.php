<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Cria a tabela de permissões do SNRP.
     */
    public function up(): void
    {
        Schema::create('permissions', function (Blueprint $table) {

            $table->id();

            $table->string('nome', 100)
                  ->unique();

            $table->string('modulo', 100);

            $table->text('descricao')
                  ->nullable();

            $table->boolean('ativo')
                  ->default(true);

            $table->timestamps();

        });
    }

    /**
     * Remove a tabela de permissões.
     */
    public function down(): void
    {
        Schema::dropIfExists('permissions');
    }
};
