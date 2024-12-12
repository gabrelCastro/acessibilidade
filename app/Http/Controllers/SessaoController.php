<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Demandas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class SessaoController extends Controller
{

    public function index(Request $request){
        return view('sessao');
    }




}