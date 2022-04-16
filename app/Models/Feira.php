<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Feira extends Model
{
    protected $fillable = ['data', 'user_id', 'supermercado_id'];

    public function getProdutos(int $id)
    {
        return DB::table('feiras')
            ->join('carrinhos', 'feiras.id', '=', 'carrinhos.feira_id')
            ->join('produtos', 'produtos.id', '=', 'carrinhos.produto_id')
            ->where('feiras.id', '=', $id)
            ->orderBy('produtos.nome','asc')
            ->select('feiras.id', 'produtos.nome', 'carrinhos.id as item_id', 'carrinhos.preco', 'carrinhos.quantidade', 'carrinhos.preco_final')
            ->get();
    }

    public function getFeiras(int $id)
    {
        return DB::table('feiras')
            ->join('supermercados', 'feiras.supermercado_id', '=', 'supermercados.id')
            ->join('users', 'feiras.user_id', '=', 'users.id')
            ->leftjoin('carrinhos', 'carrinhos.feira_id', '=', 'feiras.id')
            ->select('feiras.data', 'feiras.id', 'supermercados.nome',DB::raw('sum(carrinhos.preco_final) as preco_final'))
            ->where('users.id', '=', $id)
            ->orderBy('data','desc')
            ->groupBy('feiras.data', 'feiras.id', 'supermercados.nome')
            ->limit(5)
            ->get();
    }

    public function getAllFeiras(int $id)
    {
        return DB::table('feiras')
            ->join('supermercados', 'feiras.supermercado_id', '=', 'supermercados.id')
            ->join('users', 'feiras.user_id', '=', 'users.id')
            ->leftjoin('carrinhos', 'carrinhos.feira_id', '=', 'feiras.id')
            ->select('feiras.data', 'feiras.id', 'supermercados.nome',DB::raw('sum(carrinhos.preco_final) as preco_final'))
            ->where('users.id', '=', $id)
            ->orderBy('data','desc')
            ->groupBy('feiras.data', 'feiras.id', 'supermercados.nome')
            ->get();
    }

    public function users(){
        return $this->belongsTo(User::class);
    }

    public function supermercados(){
        return $this->belongsTo(Supermercado::class);
    }
}
