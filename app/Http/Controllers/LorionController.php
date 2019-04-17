<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Domaine;
use App\Sousdomaine;
use App\Produit;
use App\User;

class LorionController extends Controller
{
    public function index()
    {
        $doms = Domaine::get();
        $sous_doms = SousDomaine::get();
        $produits = Produit::get();
        $users = User::where('is_admin',1)->get() ;
        return view('lorion/accueil',compact('doms','sous_doms','produits','users'));
    }

    public function show_produit($id)
    {
        $doms = Domaine::get();
        $sous_doms = SousDomaine::get();
        $produit = Produit::findOrFail($id);
        $users = User::where('is_admin',1)->get() ;
        return view('lorion/show',compact('doms','sous_doms','produit','users'));
    }

    public function show_liste_sous_domaine($sous_domaine_id)
    {
        $produits = Produit::where('sous_domaine_id',$sous_domaine_id)->get();
        $doms = Domaine::get();
        $sous_doms = SousDomaine::get();
        $users = User::where('is_admin',1)->get() ;
        return view('lorion/sous_domaine', compact('produits','doms','sous_doms','users'));
    }
}
