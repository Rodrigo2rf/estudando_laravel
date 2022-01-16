<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrinho extends Model
{
    protected $fillable = ['produto_id', 'feira_id', 'quantidade', 'preco', 'preco_final'];

    public function produtos(){
        return $this->hasMany(Produto::class);
    }
    public function feiras(){
        return $this->belongsTo(Feira::class);
    }
}
