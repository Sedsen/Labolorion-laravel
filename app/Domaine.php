<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Domaine extends Model
{
    protected $fillable = ['nom_domaine'];

    public function sousdomaines()
    {
        return $this->hasMany('App\Sousdomaine');
    }
}
