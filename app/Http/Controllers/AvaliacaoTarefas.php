<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Tarefa;
use App\Models\Teste;
use App\Models\Sessao;
use App\Models\SessaoTarefa;
use Illuminate\Support\Facades\DB;


class AvaliacaoTarefas extends Controller
{
    public function index(Request $request){

        $avaliacaoId = $request->cookie('demanda_authenticated');

        if($avaliacaoId != null){
            
            $usuario = Auth::user();
            $sessao = Sessao::where('id',$request->id)->first();
            $sessao_id = $sessao->id;
            $tarefas = Tarefa::where('avaliacao_id',$avaliacaoId)->with(['avaliacoes' => function ($query) use ($sessao_id): void {
                $query->where('sessao_id', $sessao_id);
            }])->get();

            //dd($tarefas);
            return view('avaliacaoTarefas',['sessao'=>$sessao,'tarefas'=>$tarefas,'usuario'=>$usuario]);
        }
        
        return route('/');
    
    }

    public function store(Request $request){
         // Validação dos dados recebidos
         $validated = $request->validate([
            'idSessao' => 'required|exists:sessao,id',
            'idTarefa' => 'required|exists:tarefa,id',
            'relatorio' => 'required|string',
            'descricao' => 'required|string',
        ]);

        $valor= false;
        if($validated['relatorio'] == "sim"){
            $valor = true;
        }

        // Inserindo na tabela de relacionamento
        DB::table('avaliacaoTarefa')->insert([
            'sessao_id' => $validated['idSessao'],
            'tarefa_id' => $validated['idTarefa'],
            'conseguiuRealizar' => $valor,
            'relatorio' => $validated['descricao'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('sessao',["id"=>$validated['idSessao']]);


    }

    public function edit(Request $request){

        $validated = $request->validate([
            'idSessao' => 'required|exists:sessao,id',
            'idTarefa' => 'required|exists:tarefa,id',
            'relatorio' => 'required|string',
            'descricao' => 'required|string',
        ]);

        $valor= false;
        if($validated['relatorio'] == "sim"){
            $valor = true;
        }

        // Inserindo na tabela de relacionamento
        DB::table('avaliacaoTarefa')->where('sessao_id',$validated['idSessao'])->where('tarefa_id',$validated['idTarefa'])->update([
            'conseguiuRealizar' => $valor,
            'relatorio' => $validated['descricao'],
            'updated_at' => now(),
        ]);

        return redirect()->route('sessao',["id"=>$validated['idSessao']]);
    }

    public function delete(Request $request){


        $validated = $request->validate([
            'idSessao' => 'required|exists:sessao,id',
            'idTarefa' => 'required|exists:tarefa,id',
        ]);

        DB::table('avaliacaoTarefa')->where('sessao_id',$validated['idSessao'])->where('tarefa_id',$validated['idTarefa'])->delete();

        return redirect()->route('sessao',["id"=>$validated['idSessao']]);


    }





}