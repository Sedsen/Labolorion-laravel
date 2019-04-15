<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Sousdomaine;
use App\Produit;
use App\Http\Requests\ProduitsRequest;
use App\Http\Requests\ModifProduitRequest;

class ProduitController extends Controller
{
    public function index()
    {
        $sous = new Sousdomaine();
        $sous_domaines = Sousdomaine::orderBy('nomSousDomaine','ASC')->get();
        $produits = Produit::get(); 
        return view('admin/produit',compact('sous_domaines','produits','sous'));
    }

    public function add_produit(ProduitsRequest $request)
    {
        $sous_domaine = Sousdomaine::where('nomSousDomaine', $request->get('sous_domaine_id'))->first();
        $produit = new Produit(['nom' => $request->get('nom'),
                                'prix_vente' => $request->get('prix_vente'),
                                'description' => $request->get('description'),
                                'sous_domaine_id' => $sous_domaine->id
        ]);
        $produit->save();
        $imageName = $produit->id .'.'. $request->file('image')->getClientOriginalExtension();
        $request->file('image')->move(base_path().'/public/uploads/',$imageName);
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
    public function update(ModifProduitRequest $request,$id)
    {
        $sous_domaine = Sousdomaine::where('nomSousDomaine', $request->get('sous_domaine_id'))->first();
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
        $sous_domaines = Sousdomaine::where('id',$id)->get();
       // dd($sous_domaines);
        return view('admin/produit-edit', compact('produit','sous_domaines'));
    }
}
