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
    Schema::create('patrimonios', function (Blueprint $table) {

        $table->id();


        // Identificação única do património
        $table->string('codigo', 50)
              ->unique();


        // Tipo: Casa, Terreno, Viatura...
        $table->foreignId('tipo_patrimonio_id')
              ->constrained('tipo_patrimonios')
              ->cascadeOnDelete();


        // Proprietário
        $table->foreignId('pessoa_id')
              ->constrained('pessoas')
              ->cascadeOnDelete();


        // Instituição responsável
        $table->foreignId('instituicao_id')
              ->constrained('instituicoes')
              ->cascadeOnDelete();


        // Dados do bem
        $table->string('nome');

        $table->text('descricao')
              ->nullable();


        // Localização
        $table->text('localizacao')
              ->nullable();


        // Coordenadas GPS
        $table->decimal('latitude', 10, 7)
              ->nullable();

        $table->decimal('longitude', 10, 7)
              ->nullable();


        // QR Code
        $table->string('qr_code')
              ->nullable();


        // Situação do bem
        $table->enum('estado', [
            'Ativo',
            'Transferido',
            'Inativo'
        ])
        ->default('Ativo');


        $table->timestamps();

    });
}

    /**
     * Reverse the migrations.
     */
    
    public function down(): void
{
    Schema::dropIfExists('patrimonios');
}
};
