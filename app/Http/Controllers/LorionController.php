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
use App\Entreprise;
use App\Http\Requests\CartRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\SearchRequest;

class LorionController extends Controller
{
    protected $nb_paginate = 20;
    public function index(Request $request)
    {
        // dd($request->session()->all());
        $doms = Domaine::get();
        $sous_doms = SousDomaine::get();
        $produits = DB::table('produits')->inRandomOrder()->paginate($this->nb_paginate);
        $titre = ' Accueil | Nous vous offrons tout une gamme de produits scolaires';
        $entreprise = Entreprise::findOrFail(1);

        $msg_not_reads = new Discussion();

        return view('lorion/accueil', compact('doms', 'sous_doms', 'produits', 'msg_not_reads', 'titre', 'entreprise'));
    }

    public function show_produit($id)
    {
        $doms = Domaine::get();
        $sous_doms = SousDomaine::get();
        $produit = Produit::findOrFail($id);
        // $id_categ = Sousdomaine::where('')
        $all_product_categ = Produit::where('sous_domaine_id', $produit->sous_domaine_id)->where('id', '!=', $id)->get(); //->random(4);
        $admins = User::where('is_admin', 1)->get();
        // $users = User::where('is_admin',1)->get() ;
        $msg_not_reads = new Discussion();
        $titre = " | Voir les détails sur  $produit->nom ";
        $cart = session()->get('cart');
        $qty = 0;

        if (isset($cart)) {
            foreach ($cart as $item) {
                $qty += $item['quantite'];
            }
        }

        return view('lorion/show', compact('doms', 'sous_doms', 'produit', 'msg_not_reads', 'titre', 'admins', 'cart', 'qty', 'all_product_categ'));
    }

    public function show_liste_sous_domaine($sous_domaine_id)
    {
        // $produits = Produit::where('sous_domaine_id', $sous_domaine_id)->get();
        $produits = Produit::where('sous_domaine_id', $sous_domaine_id)->paginate(20);
        // dd($produits);
        $doms = Domaine::get();
        $sous_doms = SousDomaine::get();
        // $users = User::where('is_admin',1)->get() ;
        $titre = " Liste des produits de notre section " . Sousdomaine::find($sous_domaine_id)->nomSousDomaine;
        $msg_not_reads = new Discussion();
        return view('lorion/sous_domaine', compact('produits', 'doms', 'sous_doms', 'msg_not_reads', 'titre'));
    }

    public function search(SearchRequest $request)
    {
        $mot = $request->get('search');
        $doms = Domaine::get();
        $sous_doms = SousDomaine::get();
        /* $produits = DB::table('produits')->where('nom', 'LIKE', '%' . $mot . '%')
            ->orWhere('description', 'LIKE', '%' . $mot . '%')->get();*/
        $produits = DB::table('produits')->join('sousdomaines', 'produits.sous_domaine_id', '=', 'sousdomaines.id')
            ->where('produits.nom', 'LIKE', '%' . $mot . '%')
            ->orWhere('produits.description', 'LIKE', '%' . $mot . '%')
            ->orWhere('produits.prix_vente', 'LIKE', '%' . $mot . '%')
            ->orWhere('sousdomaines.nomSousDomaine', 'LIKE', '%' . $mot . '%')->get(['produits.id', 'produits.nom', 'produits.image', 'produits.description']);
        //dd($produits);
        $titre = "Résultats de la recherche de $mot";
        return view('lorion/search', compact('produits', 'doms', 'sous_doms', 'msg_not_reads', '$mot', 'titre'));
    }

    public function afficher_services($id = 1)
    {
        $doms = Domaine::get();
        $sous_doms = SousDomaine::get();
        $entreprise = Entreprise::findOrFail($id);
        $titre = "Nos services que nous vous proposons";
        return view('lorion.services', compact('doms', 'sous_doms', 'entreprise', 'titre'));
    }
    public function afficher_presentation($id = 1)
    {
        $doms = Domaine::get();
        $sous_doms = SousDomaine::get();
        $entreprise = Entreprise::findOrFail($id);
        $titre = "Présentation de l'entreprise";
        return view('lorion.presentation', compact('doms', 'sous_doms', 'entreprise', 'titre'));
    }

    public function afficher_contact($id = 1)
    {
        $doms = Domaine::get();
        $sous_doms = SousDomaine::get();
        $entreprise = Entreprise::findOrFail($id);
        $titre = "Nous contacter";
        return view('lorion.contact', compact('doms', 'sous_doms', 'entreprise', 'titre'));
    }

    public function afficher_cart()
    {
        $doms = Domaine::get();
        $sous_doms = SousDomaine::get();
        $titre = "Panier";
        $cart = session()->get('cart');
        $qty = 0;
        $total = 0;
        if (isset($cart)) {
            foreach ($cart as $item) {
                $qty += $item['quantite'];
                $total += $item['total'];
            }
        }
        return view('lorion.cart', compact('doms', 'sous_doms', 'titre', 'cart', 'qty', 'total'));
    }
    public function add_cart(CartRequest $request, $id)
    {
        $produit = Produit::findOrFail($id);
        if (!$produit) {
            abort(404);
        }
        $cart = session()->get('cart');
        if (!$cart) {
            $cart = [
                $id => [
                    'id' => $produit->id,
                    'nom' => $produit->nom,
                    'prix_vente' => $produit->prix_vente,
                    'quantite' => $request->get('number'),
                    'total' => $produit->prix_vente * $request->get('number')
                ]
            ];
            session()->put('cart', $cart);
            //dd($cart);
            // return redirect()->back()->with('success', 'Le produit a été ajouté avec succès!');
            return redirect("/show/$id");
        }
        // $cart[$id]['quantite'] += $request->get('number');
        //
        if (isset($cart[$id])) {
            $cart[$id]['quantite'] += $request->get('number');
            $cart[$id]['total'] += $produit->prix_vente * $request->get('number');
            session()->put('cart', $cart);

            return redirect("/show/$id");
        } else {
            $cart[$id] = [
                'id' => $produit->id,
                'nom' => $produit->nom,
                'prix_vente' => $produit->prix_vente,
                'quantite' => $request->get('number'),
                'total' => $produit->prix_vente * $request->get('number')
            ];
            session()->put('cart', $cart);
            return redirect("/show/$id");
        }
    }

    public function delete_cart($id)
    {
        $produit = Produit::findOrFail($id);
        if (!$produit) {
            abort(404);
        }
        $cart = session()->get('cart');
        if (isset($cart[$id])) {
            session()->forget('cart.' . $id);
            return redirect("/cart");
        }
        return redirect("/cart");
    }
    public function delete_all_cart()
    {
        session()->flush();
        return redirect("/cart");
    }
}
