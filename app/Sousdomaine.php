<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sousdomaine extends Model
{
    protected $fillable = ['nomSousDomaine','domaine_id'];

    public function domaines()
    {
        return $this->belongsTo('App\Domaine');
    }

    public function produits()
    {
        return $this->hasMany('App\Produit');
    }
}
