<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Cria a tabela de auditoria do SNRP.
     */
    public function up(): void
    {
        Schema::create('auditorias', function (Blueprint $table) {
            $table->id();

            // Utilizador que realizou a ação
            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            // Ação realizada
            // Ex.: login, logout, criar, editar, eliminar, transferir
            $table->string('acao', 50);

            // Módulo onde a ação ocorreu
            // Ex.: utilizadores, pessoas, patrimonios, transferencias
            $table->string('modulo', 100)->nullable();

            // Tipo e ID do registo afetado
            // Permite relacionar a auditoria com diferentes modelos
            $table->string('auditable_type', 150)->nullable();
            $table->unsignedBigInteger('auditable_id')->nullable();

            // Descrição legível da ação
            $table->text('descricao')->nullable();

            // Estado dos dados antes da alteração
            $table->json('dados_anteriores')->nullable();

            // Estado dos dados depois da alteração
            $table->json('dados_novos')->nullable();

            // Informações técnicas da operação
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();

            $table->timestamps();

            // Índices para facilitar consultas e filtros
            $table->index('acao');
            $table->index('modulo');
            $table->index(['auditable_type', 'auditable_id']);
            $table->index('created_at');
        });
    }

    /**
     * Remove a tabela de auditoria.
     */
    public function down(): void
    {
        Schema::dropIfExists('auditorias');
    }
};
