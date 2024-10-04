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
        Schema::create('erros', function (Blueprint $table) {
            $table->id();
            $table->string('pgs');
            $table->unsignedBigInteger('id_item');
            $table->foreign('id_item')->references('id')->on('itens');
            $table->integer('em_cfmd');
            $table->longText('descricao');
            $table->timestamps();
            $table->unsignedBigInteger('demanda_id');
            $table->foreign('demanda_id')->references('id')->on('demanda')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('erros');
    }
};
