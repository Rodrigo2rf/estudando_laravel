<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Supermercado extends Model
{
    protected $fillable = ['nome', 'user_id', 'logo'];

    public function users(){
        return $this->belongsTo(User::class);
    }

    public function feiras(){
        return $this->hasMany(Feira::class);
    }

    public function getLogoUrlAttribute()
    {   
        if ($this->logo) {
            return Storage::url($this->logo);
        }
        return asset('/resources/img/not-found.png');
    }

}
