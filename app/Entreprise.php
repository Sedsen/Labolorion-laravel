<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entreprise extends Model
{
    protected $fillable = ['nom', 'description', 'presentation', 'services', 'contacts', 'logo'];

    //
}
