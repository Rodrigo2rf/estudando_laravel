<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Supermercado, Produto, Feira, Carrinho};
use Auth;
use Illuminate\Support\Facades\DB;

class adminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Cadastrar 
    public function formSupermercado(Request $request)
    {
        // recuperar os supermercados do usuário
        $supermercados = Supermercado::query()->where('user_id', '=', Auth::user()->id)->orderBy('nome')->get();

        // Verifica se existe alguma mensagem
        $mensagem = $request->session()->get('mensagem');        

        return view('area-interna.supermercado.index', compact('supermercados','mensagem'));
    }

    public function formFeira(Request $request)
    {
        // recuperar os supermercados do usuário
        $supermercados = Supermercado::query()->where('user_id', '=', Auth::user()->id)->orderBy('nome')->get();

        // Retorna todas as feiras
        $feiras = Feira::getFeiras(Auth::user()->id);

        // Verifica se existe alguma mensagem
        $mensagem = $request->session()->get('mensagem');

        return view('area-interna.feira.formulario', compact('supermercados','mensagem','feiras'));
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
        return redirect()->route('form_supermercado');
    }

    public function cadastrarFeira(Request $request)
    {
        DB::beginTransaction();
        $supermercado = Feira::create([
            'data'      => $request->data,
            'user_id'   => Auth::user()->id,
            'supermercado_id'   => $request->supermercado,
        ]);
        DB::commit();

        $request->session()->flash('mensagem',"Feira adicionada com sucesso!");

        // Rota nomeada
        return redirect()->route('cadastrar_feira');
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

        return redirect()->route('form_supermercado');
    }

    public function informacoesFeira(int $id, Request $request)
    {
        $supermercados = Supermercado::all();
        $feira = Feira::find($id);

        # recupera produtos da feira
        $produtosFeira = Feira::getProdutos($id);

        $total = 0;
        foreach($produtosFeira as $produto){
            $total += $produto->preco_final;
        }

        # Verifica se existe alguma mensagem
        $mensagem = $request->session()->get('mensagem');
    
        return view('area-interna.feira.informacao', compact('supermercados', 'feira', 'mensagem', 'produtosFeira', 'total'));
    }

    public function editarFeira(Request $request)
    {
        if ($request->input('action') == 'editarFeira') {

            $feira = Feira::find($request->id);
    
            $feira->data = $request->data;
            $feira->supermercado_id = $request->supermercado;

            $feira->save();
            $request->session()->flash('mensagem', "Feira editada com sucesso!");

            return redirect()->route('informacoes_feira', $request->id);
        }
        
        if ($request->input('action') == 'adicionarProdutoAoCarrinho') {

            $query = DB::table('produtos')
                ->where('nome', 'like', $request->nome)
                ->get();
            
            if (!isset($query[0]->id)) {
                    DB::beginTransaction();

                    # cadastrar produto
                    $produto = Produto::create([
                        'nome' => $request->nome
                    ]);

                # cadastrar produto e feira ao carrinho
                $carrinho = Carrinho::create([
                    'produto_id'    => $produto->id,
                    'quantidade'    => $request->quantidade,
                    'preco'         => $request->preco,
                    'preco_final'   => $request->preco * $request->quantidade,
                    'feira_id'      => $request->id
                ]);
                DB::commit();
            } else {
                DB::beginTransaction();

                # cadastrar produto e feira ao carrinho
                $carrinho = Carrinho::create([
                    'produto_id'    => $query[0]->id,
                    'quantidade'    => $request->quantidade,
                    'preco'         => $request->preco,
                    'preco_final'   => $request->preco * $request->quantidade,
                    'feira_id'      => $request->id
                ]);
                DB::commit();
            }
            $request->session()->flash('mensagem', "O produto: <b>{$request->nome}</b> foi adicionado ao carrinho!");

            return redirect()->route('informacoes_feira', $request->id);
        }
    }

    public function excluirItemCarrinho(int $item_id ,int $info_id, Request $request)
    {
        $carrinho = Carrinho::find($item_id);
        $carrinho->delete();

        $request->session()->flash('mensagem',"Item excluido com sucesso!");

        return redirect()->route('informacoes_feira',$info_id);
    }

    public function getAutocompleteData(Request $request){
        if($request->has('string')){
            $produtos = Produto::where('nome','ilike','%'.$request->input('string').'%')->get();
            $output = '<ul class="dropdown-menu" style="display:block; position:absolute; width: 100%;
            padding-left: 10px;">';
                foreach($produtos as $produto){
                    $output .= '<li><a href="#">'.$produto->nome.'</a></li>';
                }
            $output .= '</ul>';
            echo $output;
        }
    }
}
