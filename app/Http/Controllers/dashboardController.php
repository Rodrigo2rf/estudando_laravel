<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supermercado;
use App\Models\Feira;
use Auth;
use Illuminate\Support\Facades\DB;

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
        $supermercados = DB::table('supermercados')->count();

        // Recuperar as feiras do usuário
        $feiras = DB::table('feiras')->count();

        $produtos = DB::table('produtos')->count();

        return view('area-interna.index', compact('mensagem','supermercados','feiras','produtos'));
    }
}