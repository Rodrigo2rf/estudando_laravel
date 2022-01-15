<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supermercado;
use Auth;

class dashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');        
    }

    //
    public function index(Request $request)
    {   
        // Verifica se existe alguma mensagem
        $mensagem = $request->session()->get('mensagem');

        // recuperar os supermercados do usuário
        $supermercados = Supermercado::query()->where('user_id', '=', Auth::user()->id)->orderBy('nome')->get();

        return view('area-interna.index', compact('mensagem','supermercados'));
    }
}
