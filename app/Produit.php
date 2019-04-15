<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    protected $fillable = ['sous_domaine_id','nom','prix_vente','description','image'];
    public function sousdomaines()
    {
        return $this->belongsTo('App\Sousdomaine');
    }
}
