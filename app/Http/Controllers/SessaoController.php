<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Demandas;
use App\Models\Sessao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class SessaoController extends Controller
{

    public function index(Request $request){
        $demandaId = $request->cookie('demanda_authenticated');

        $sessoes = Sessao::where('avaliacao_id',$demandaId)->get();
        
        return view('sessao',['id'=>$demandaId,'sessoes'=>$sessoes]);
    

    }

    public function store(Request $request){

        $dados = json_decode($request->json);


        foreach ($dados as $dado){
            $sessaoCriar = new Sessao();
            $sessaoCriar->titulo = $dado->titulo;
            $sessaoCriar->avaliador = $dado->avaliador;
            $sessaoCriar->descricao = $dado->descricao;
            $sessaoCriar->tempo = intval($dado->tempo);
            $sessaoCriar->avaliacao_id = $request->avaliacao_id;
            $sessaoCriar->save();
        }

        return redirect()->route('verSessoes');
    }

    public function delete(Request $request){
        Sessao::where("id",$request->id)->delete();

        return redirect()->route('verSessoes');

    }

    public function update(Request $request){

        $dados = json_decode($request->enviarTarefa);

        $sessaoEditar = Sessao::where('id',$dados->id)->first();

        $sessaoEditar->avaliador = $dados->avaliador;

        if($dados->tempo == ""){
            $dados->tempo = 0;
        }

        $sessaoEditar->tempo = $dados->tempo;
        $sessaoEditar->descricao = $dados->descricao;
        $sessaoEditar->titulo = $dados->titulo;

        $sessaoEditar->save();


        return redirect()->route('verSessoes');

    }


}