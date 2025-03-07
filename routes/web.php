<?php
require __DIR__ . '/crud/avaliacaoTarefas.php';
require __DIR__ . '/crud/demanda.php';
require __DIR__ . '/crud/erro.php';
require __DIR__ . '/crud/problema.php';
require __DIR__ . '/crud/sessao.php';
require __DIR__ . '/crud/tarefa.php';
require __DIR__ . '/crud/testeUsuario.php';
require __DIR__ . '/crud/relatorio.php';


use Illuminate\Support\Facades\Route;

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

});
