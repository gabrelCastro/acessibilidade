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
        Schema::create('avaliacaoTarefa', function (Blueprint $table) {
            $table->unsignedBigInteger('sessao_id');
            $table->unsignedBigInteger('tarefa_id');
            $table->boolean('conseguiuRealizar');
            $table->longText('relatorio');
            $table->timestamps();
    
            $table->primary(['sessao_id', 'tarefa_id']); // Definindo a chave primária composta
            $table->foreign('sessao_id')->references('id')->on('sessao')->onDelete('cascade');
            $table->foreign('tarefa_id')->references('id')->on('tarefa')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('avaliacaoTarefa');
    }
};
