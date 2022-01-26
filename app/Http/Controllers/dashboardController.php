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
        $supermercados = Supermercado::query()->where('user_id', '=', Auth::user()->id)->orderBy('nome')->get();

        // Recuperar as feiras do usuário
        $feiras  = DB::table('feiras')->join('supermercados', 'feiras.supermercado_id', '=', 'supermercados.id')
            ->join('users', 'feiras.user_id', '=', 'users.id')
            ->select('feiras.data', 'feiras.id', 'supermercados.nome')
            ->where('users.id', '=', Auth::user()->id)
            ->get();

        return view('area-interna.index', compact('mensagem','supermercados','feiras'));
    }
}
