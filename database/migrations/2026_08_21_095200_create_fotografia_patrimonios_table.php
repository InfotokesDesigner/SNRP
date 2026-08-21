<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Cria a tabela de fotografias dos patrimónios.
     */
    public function up(): void
    {
        Schema::create('fotografia_patrimonios', function (Blueprint $table) {

            $table->id();

            $table->foreignId('patrimonio_id')
                ->constrained('patrimonios')
                ->cascadeOnDelete();

            $table->string('caminho');

            $table->string('nome_original')->nullable();

            $table->string('descricao')->nullable();

            $table->boolean('principal')
                ->default(false);

            $table->timestamps();
        });
    }

    /**
     * Remove a tabela de fotografias.
     */
    public function down(): void
    {
        Schema::dropIfExists('fotografia_patrimonios');
    }
};