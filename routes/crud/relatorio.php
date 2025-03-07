<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RelatorioController;

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    Route::match(['get', 'post'],'/erro', action: [RelatorioController::class, 'index'])->name('index.mostrar');
    
});

