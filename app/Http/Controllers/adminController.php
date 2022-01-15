<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supermercado;
use Auth;
use Illuminate\Support\Facades\DB;

class adminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Cadastrar 
    public function formSupermercado()
    {
        return view('area-interna.supermercado.index');
    }

    public function cadastrarSupermercado(Request $request)
    {
        DB::beginTransaction();
        $supermercado = Supermercado::create([
            'nome'      => $request->nome,
            'user_id'   => Auth::user()->id
        ]);
        DB::commit();

        $request->session()->flash('mensagem',"Supermercado {$request->nome} adicionado com sucesso!");

        // Rota nomeada
        return redirect()->route('dashboard');
    }

    public function formEditarSupermercado(int $id, Request $request)
    {
        // verificar se o id pertence ao usuário
        $supermercado = Supermercado::find($id);

        // Verifica se existe alguma mensagem
        $mensagem = $request->session()->get('mensagem');
    
        return view('area-interna.supermercado.editar', compact('supermercado', 'mensagem'));
    }

    public function editarSupermercado(Request $request){

        $supermercado = Supermercado::find($request->id);
        $supermercado->nome = $request->nome; 
        $supermercado->save();

        $request->session()->flash('mensagem',"Supermercado {$request->nome} editado com sucesso!");

        return redirect()->route('editar_supermercado',$request->id);
    }


    public function excluirSupermercado(int $id, Request $request)
    {
        $supermercado = Supermercado::find($id);
        $supermercado->delete();

        $request->session()->flash('mensagem',"Supermercado {$supermercado->nome} excluido com sucesso!");

        return redirect()->route('dashboard');
    }
}
