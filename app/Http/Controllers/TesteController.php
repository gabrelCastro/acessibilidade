<?php

namespace App\Http\Controllers;

use App\Models\Tarefa;
use App\Models\Teste;
use Illuminate\Http\Request;


class TesteController extends Controller
{
    public function index(Request $request){
        $demandaId = $request->cookie('demanda_authenticated');
        $teste = Teste::where('avaliacao_id',$demandaId)->first();
        $tarefas = Tarefa::where('avaliacao_id',$demandaId)->get();

        if($teste){
            return view('index',['id'=>$demandaId,'titulo' => $teste->titulo,'dispositivo'=>$teste->dispositivo,'tarefas'=>$tarefas]);
        }

        return view('welcome');
    }

    public function update(Request $request){
        Teste::where('avaliacao_id',$request->id)->update(['titulo'=>$request->titulo,'dispositivo'=>$request->dispositivo]);
        return redirect()->route('teste');
        
    }



}