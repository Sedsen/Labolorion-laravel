<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Domaine;
use App\Sousdomaine;
use App\Produit;

class LorionController extends Controller
{
    public function index()
    {
        $doms = Domaine::get();
        $sous_doms = SousDomaine::get();
        $produits = Produit::get();
        return view('lorion/accueil',compact('doms','sous_doms','produits'));
    }

    public function show_produit($id)
    {
        $doms = Domaine::get();
        $sous_doms = SousDomaine::get();
        $produit = Produit::findOrFail($id);
        return view('lorion/show',compact('doms','sous_doms','produit'));
    }
}
