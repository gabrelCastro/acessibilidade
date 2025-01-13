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
        Schema::create('sessao', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('avaliacao_id');
            $table->foreign('avaliacao_id')->references('id')->on('avaliacao')->onDelete('cascade');
            $table->string('titulo');
            $table->string('avaliador');
            $table->text('descricao');
            $table->integer('tempo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sessao');
    }
};
