<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DemandaController;
use App\Http\Controllers\DemandaGController;


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    Route::get('/',[DemandaController::class,'index'])->name('demanda.mostrar');

    Route::post('/demandas',[DemandaController::class,'armazenar'])->name('demanda.senha');

    Route::get('/demanda-cadastro',[DemandaGController::class,'index'])->name('demanda-cadastro');

    Route::post('/demanda-cadastro',[DemandaGController::class,'store'])->name('demanda-armazenar');

});