<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AcessoController extends Controller
{
    public function acessoNegado403(){
        return view('erro/403');
    }
}
