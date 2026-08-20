<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Cria a tabela de histórico de transferências patrimoniais.
     */
    public function up(): void
    {
        Schema::create('transferencia_patrimonials', function (Blueprint $table) {

            $table->id();

            // Património que está a ser transferido
            $table->foreignId('patrimonio_id')
                ->constrained('patrimonios')
                ->cascadeOnDelete();

            // Proprietário anterior
            $table->foreignId('proprietario_anterior_id')
                ->constrained('pessoas')
                ->restrictOnDelete();

            // Novo proprietário
            $table->foreignId('novo_proprietario_id')
                ->constrained('pessoas')
                ->restrictOnDelete();

            // Data da transferência
            $table->date('data_transferencia');

            // Observação
            $table->text('observacao')
                ->nullable();

            $table->timestamps();
        });
    }

    /**
     * Remove a tabela.
     */
    public function down(): void
    {
        Schema::dropIfExists('transferencia_patrimonials');
    }
};