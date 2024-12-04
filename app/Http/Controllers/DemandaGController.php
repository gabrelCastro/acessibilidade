<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Demandas;
use App\Models\Teste;
use Illuminate\Http\Request;

class DemandaGController extends Controller
{
    public function index(Request $request){
        
        return view("demanda_cadastro");

    }

    public function store(Request $request){
        echo($request);
        $urls = $request->input('url');
        $nome_paginas = $request->input('nome_pagina');
        $paginas = '{"paginas":[';

        if($request->guideliness){
        foreach($urls as $key=>$url){
            $paginas = $paginas.'{"url":"'.$url.'"'.','.'"pagina":'.'"'.$nome_paginas[$key].'"'.'},';
        }
        $paginas = substr($paginas,0,-1);
        $paginas = $paginas."]}";}
        
        $demanda_criar = new Demandas();

        $demanda_criar->nome = $request->nome;
        $demanda_criar->descricao = $request->descricao;
        $demanda_criar->password = $request->senha;
        $demanda_criar->status = "Em andamento";
        $demanda_criar->paginas = $paginas;
        if($request->input("testeComUsuario")){
            $demanda_criar->testeUsuario = true;
        }
        else{
            $demanda_criar->testeUsuario = false;
        }
        if($request->input("guideliness")){
            $demanda_criar->guideliness = true;
        }
        else{
            $demanda_criar->guideliness = false;
        }

        $demanda_criar->save();
        

        if($request->input("testeComUsuario"))
        {
            $teste = new Teste();
            $teste->titulo= $request->titulo;
            $teste->dispositivo= $request->dispositivo;
            $teste->avaliacao_id = $demanda_criar->id;
            $teste->save();
        }


        

        return redirect('/');
    }


}