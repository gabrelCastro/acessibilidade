<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AvaliacaoController;


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    Route::get('/erro/{id}', [AvaliacaoController::class,'index'])->name('erro.mostrar');

    Route::post('/erro-store',[AvaliacaoController::class,'store'])->name('erro.armazenar');

    Route::delete('/erro-remove',[AvaliacaoController::class,'remove'])->name('erro.remove');

    Route::put('/erro-update',[AvaliacaoController::class,'update'])->name('erro.update');

});