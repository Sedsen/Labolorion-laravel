<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Sousdomaine;
use App\Produit;
use App\Http\Requests\ProduitsRequest;
use App\Http\Requests\ModifProduitRequest;
use App\Domaine;
use App\User;

class ProduitController extends Controller
{
    public function index()
    {
        $sous = new Sousdomaine();
        $sous_domaines = Sousdomaine::orderBy('nomSousDomaine', 'ASC')->get();
        $produits = Produit::paginate(10);
        $doms = Domaine::get();
        $sous_doms = SousDomaine::get();
        $users = User::where('is_admin', 1)->get();
        $titre = "Administration - produits";
        return view('admin/produit', compact('sous_domaines', 'produits', 'sous', 'doms', 'titre', 'sous_doms', 'users'));
    }

    public function add_produit(ProduitsRequest $request)
    {
        $sous_domaine = Sousdomaine::where('nomSousDomaine', $request->get('sous_domaine_id'))->first();
        $produit = new Produit([
            'nom' => $request->get('nom'),
            'prix_vente' => $request->get('prix_vente'),
            'description' => $request->get('description'),
            'sous_domaine_id' => $sous_domaine->id
        ]);
        $produit->save();
        $imageName = $produit->id . '.' . $request->file('image')->getClientOriginalExtension();
        $request->file('image')->move(base_path() . '/public/uploads/', $imageName);
        $produit->image = $imageName;
        $produit->save();
        return redirect('admin/produit');
    }

    public function delete($id)
    {
        $produit = Produit::findOrFail($id);
        $produit->delete();
        return redirect('admin/produit');
    }
    public function update(ModifProduitRequest $request, $id)
    {
        $sous_domaine = Sousdomaine::where('id', $request->get('sous_domaine_id'))->first();
        // dd($request->get('sous_domaine_id'));
        $produit = Produit::findOrFail($id);
        $produit->nom = $request->get('nom');
        $produit->prix_vente = $request->get('prix_vente');
        $produit->description = $request->get('description');
        $produit->sous_domaine_id = $sous_domaine->id;
        $produit->save();
        return redirect('admin/produit');
    }

    public function edit($id)
    {
        $produit = Produit::findOrFail($id);
        $sous_domaines = Sousdomaine::where('id', $id)->get();
        $doms = Domaine::get();
        $sous_doms = SousDomaine::get();
        $users = User::where('is_admin', 1)->get();

        $titre = "Administration - Mise à jour des produits";
        // $list = Sousdomaine::all('nomSousDomaine')->toArray();
        $list = [];
        foreach ($sous_doms as $sous) {
            // $list['id'] = $sous->id;
            $list[$sous->id] = $sous->nomSousDomaine;
        }

        // dd($list);
        return view('admin/produit-edit', compact('produit', 'sous_domaines', 'titre', 'doms', 'sous_doms', 'users', 'list'));
    }
}