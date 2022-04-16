<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Produto extends Model
{
    protected $fillable = ['nome'];

    public function carrinhos(){
        return $this->hasMany(Carrinho::class);
    }

    public function getProdutosByUser($user_id){
        return DB::table('produtos')
            ->join('carrinhos', 'produtos.id', '=', 'carrinhos.produto_id')
            ->join('feiras', 'feiras.id', '=', 'carrinhos.feira_id')
            ->where('feiras.user_id','=', $user_id)
            ->orderBy('produtos.nome', 'asc')
            ->distinct('produtos.nome')
            ->get(); 
    }

    public function getProdutosById($produto_id, $user_id){
        return DB::table('produtos')
            ->join('carrinhos', 'produtos.id', '=', 'carrinhos.produto_id')
            ->join('feiras', 'feiras.id', '=', 'carrinhos.feira_id')
            ->join('supermercados', 'feiras.supermercado_id', '=', 'supermercados.id')
            ->select('produtos.nome as produto','produtos.id as produto_id','supermercados.nome as supermercado', 'carrinhos.preco as preco','feiras.data as data')
            ->where('feiras.user_id','=', $user_id)
            ->where('produtos.id','=', $produto_id)
            ->orderBy('feiras.data', 'desc')
            ->get(); 
    }
}
