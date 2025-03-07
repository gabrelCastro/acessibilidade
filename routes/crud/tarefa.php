<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TarefaController;


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    Route::post('/cadastrar-tarefa',[TarefaController::class,"store"])->name('cadastrarTarefa');

    Route::post('/excluir-tarefa',[TarefaController::class,"delete"])->name('excluirTarefa');

    Route::put('/tarefasEditar',[TarefaController::class,"update"])->name("editarTarefa");

});