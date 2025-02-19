<?php

use App\Http\Controllers\AvaliacaoController;
use App\Http\Controllers\SessaoController;
use App\Http\Controllers\RedirectionController;
use App\Http\Controllers\DemandaController;
use App\Http\Controllers\AvaliacaoTarefas;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DemandaGController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Use App\Http\Controllers\RelatorioController;
use App\Http\Controllers\TarefaController;
use App\Http\Controllers\TesteController;
use App\Http\Controllers\ProblemaController;

Route::match(['get', 'post'],'/erro', [RelatorioController::class, 'index'])->name('index.mostrar')->middleware('auth');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {


    Route::get('/erro/{id}', [AvaliacaoController::class,'index'])->name('erro.mostrar');

    Route::post('/erro-store',[AvaliacaoController::class,'store'])->name('erro.armazenar');

    Route::delete('/erro-remove',[AvaliacaoController::class,'remove'])->name('erro.remove');

    Route::put('/erro-update',[AvaliacaoController::class,'update'])->name('erro.update');

    Route::get('/',[DemandaController::class,'index'])->name('demanda.mostrar');

    Route::post('/demandas',[DemandaController::class,'armazenar'])->name('demanda.senha');

    Route::get('/demanda-cadastro',[DemandaGController::class,'index'])->name('demanda-cadastro');

    Route::post('/demanda-cadastro',[DemandaGController::class,'store'])->name('demanda-armazenar');

    Route::get('/testeUsuario', [TesteController::class,'index'])->name('teste');

    Route::post('/cadastrar-tarefa',[TarefaController::class,"store"])->name('cadastrarTarefa');

    Route::post('/excluir-tarefa',[TarefaController::class,"delete"])->name('excluirTarefa');

    Route::get('/sessoes',[SessaoController::class,'index'])->name('verSessoes');

    Route::put('/tarefasEditar',[TarefaController::class,"update"])->name("editarTarefa");

    Route::put('/editar-teste',[TesteController::class,"update"])->name("editar-teste");

    Route::post('/cadastrar-sessao',[SessaoController::class,"store"])->name("cadastrar-sessao");

    Route::post('/deletar-sessao',[SessaoController::class,"delete"])->name("deletar-sessao");

    Route::put('/editar-sessao',[SessaoController::class,"update"])->name("editar-sessao");

    Route::get('/sessao',[AvaliacaoTarefas::class,"index"])->name("sessao");

    Route::post('/sessao',[AvaliacaoTarefas::class,"store"])->name("sessaoStore");

    Route::post('/avaliacaoEditar',[AvaliacaoTarefas::class,"edit"])->name("editarAvaliacao");

    Route::post('/avaliacaoRemover',[AvaliacaoTarefas::class,"delete"])->name("removerAvaliacao");

    Route::get('/problemas',[ProblemaController::class,"index"])->name("problemasVer");

    Route::post('/problemas',[ProblemaController::class,"store"])->name("problemasAdicionar");

    Route::delete('/problemas',[ProblemaController::class,"delete"])->name("problemasRemover");

    Route::put('/problemas',[ProblemaController::class,"edit"])->name("problemasEditar");
});

