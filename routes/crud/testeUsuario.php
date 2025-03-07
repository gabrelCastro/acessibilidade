<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TesteController;

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {


    Route::get('/testeUsuario', [TesteController::class,'index'])->name('teste');

    Route::put('/editar-teste',[TesteController::class,"update"])->name("editar-teste");

});