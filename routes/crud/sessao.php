<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SessaoController;


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    Route::get('/sessoes',[SessaoController::class,'index'])->name('verSessoes');

    Route::post('/cadastrar-sessao',[SessaoController::class,"store"])->name("cadastrar-sessao");

    Route::post('/deletar-sessao',[SessaoController::class,"delete"])->name("deletar-sessao");

    Route::put('/editar-sessao',[SessaoController::class,"update"])->name("editar-sessao");

});