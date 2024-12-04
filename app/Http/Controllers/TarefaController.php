<?php

namespace App\Http\Controllers;

use App\Models\Tarefa;
use Illuminate\Http\Request;


class TarefaController extends Controller
{
    public function store(Request $request){
        
        $dados = json_decode($request->json);
    
        foreach ($dados as $dado){
        
        $tarefa = new Tarefa();

        $tarefa->titulo = $dado->titulo;
        $tarefa->descricao = $dado->descricao;
        $tarefa->tempo = $dado->tempo;
        $tarefa->avaliacao_id = $request->demanda_id;

        $tarefa->save();

        }
        return redirect()->route('teste');
        
    }

    public function delete(Request $request){

        Tarefa::where('id',$request->id)->delete();
        return redirect()->route('teste');

    }
    

}