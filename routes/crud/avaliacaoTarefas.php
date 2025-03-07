<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AvaliacaoTarefas;

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    Route::get('/sessao',[AvaliacaoTarefas::class,"index"])->name("sessao");

    Route::post('/sessao',[AvaliacaoTarefas::class,"store"])->name("sessaoStore");

    Route::post('/avaliacaoEditar',[AvaliacaoTarefas::class,"edit"])->name("editarAvaliacao");

    Route::post('/avaliacaoRemover',[AvaliacaoTarefas::class,"delete"])->name("removerAvaliacao");

});