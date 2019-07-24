<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Domaine;
use App\Sousdomaine;
use App\Produit;
use App\User;
use App\Http\Controllers\ChatController;
use Illuminate\Support\Facades\Auth;
use App\Discussion;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\SearchRequest;

class LorionController extends Controller
{
    public function index(Request $request)
    {
       // dd($request->session()->all());
        $doms = Domaine::get();
        $sous_doms = SousDomaine::get();
        $produits = DB::table('produits')->inRandomOrder()->paginate(10);

        $msg_not_reads = new Discussion();

        return view('lorion/accueil',compact('doms','sous_doms','produits','msg_not_reads'));
    }

    public function show_produit($id)
    {
        $doms = Domaine::get();
        $sous_doms = SousDomaine::get();
        $produit = Produit::findOrFail($id);
       // $users = User::where('is_admin',1)->get() ;
       $msg_not_reads = new Discussion();
        return view('lorion/show',compact('doms','sous_doms','produit','msg_not_reads'));
    }

    public function show_liste_sous_domaine($sous_domaine_id)
    {
        $produits = Produit::where('sous_domaine_id',$sous_domaine_id)->get();
        $doms = Domaine::get();
        $sous_doms = SousDomaine::get();
       // $users = User::where('is_admin',1)->get() ;
        $msg_not_reads= new Discussion();
        return view('lorion/sous_domaine', compact('produits','doms','sous_doms','msg_not_reads'));
    }

    public function search(SearchRequest $request) {
        $mot = $request->get('search');
        $doms = Domaine::get();
        $sous_doms = SousDomaine::get();
        $produits = DB::table('produits')->where('nom','LIKE',$mot.'%')
                                        ->orWhere('description','LIKE',$mot.'%')->get();
        //dd($produits);
        return view('lorion/search',compact('produits','doms','sous_doms','msg_not_reads','$mot'));
    }
}
