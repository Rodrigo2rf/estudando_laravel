<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supermercado extends Model
{
    protected $fillable = ['nome', 'user_id'];

    public function users(){
        return $this->belongsTo(User::class);
    }

    public function feiras(){
        return $this->hasMany(Feira::class);
    }

}
