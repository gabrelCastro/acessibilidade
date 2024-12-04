<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Demandas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class DemandaController extends Controller
{

    public function index(Request $request){
        $demandas = Demandas::all();
        $usuario = Auth::user();
        
        return view('demandas',['demandas' => $demandas, 'usuario' => $usuario]);
    }

    public function armazenar(Request $request){

        $demanda = Demandas::find($request->input('id'));
        
        // $teste = $demanda->passoword === $request->input('password');
        

        if($demanda->password == $request->input('password')){

            Cookie::queue('demanda_authenticated', $demanda->id, 240);

            // Retorne uma view de sucesso
            if($request->input("testes") == "true")
                return redirect()->route('teste',['demanda_Id'=>$request->id]);
            else{
                return redirect()->route('index.mostrar');
            }
        }
        else{
            return redirect()->route('demanda.mostrar');
        }
        
    }

    
    //
}
