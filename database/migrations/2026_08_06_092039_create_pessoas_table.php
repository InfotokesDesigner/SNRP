<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('pessoas', function (Blueprint $table) {

        $table->id();

        // Ligação com o utilizador do sistema
        $table->foreignId('user_id')
              ->nullable()
              ->constrained('users')
              ->nullOnDelete();

        // Dados pessoais
        $table->string('nome_completo');

        $table->string('bi', 30)
              ->nullable()
              ->unique();

        $table->string('nif', 30)
              ->nullable()
              ->unique();

        $table->date('data_nascimento')
              ->nullable();

        $table->enum('sexo', [
            'Masculino',
            'Feminino'
        ])
        ->nullable();

        // Contactos
        $table->string('telefone', 30)
              ->nullable();

        $table->string('email')
              ->nullable();

        // Localização
        $table->text('morada')
              ->nullable();

        // Foto do perfil
        $table->string('fotografia')
              ->nullable();

        // Estado
        $table->boolean('ativo')
              ->default(true);

       $table->string('codigo_cidadao', 20)
              ->unique()
              ->nullable();
       $table->timestamps();

    });
}
    /**
     * Reverse the migrations.
     */
    
    public function down(): void
{
    Schema::dropIfExists('pessoas');
}
};
