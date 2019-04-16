<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\DomaineRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\Domaine;
use App\Sousdomaine;
use App\Produit;
use App\User;
use App\Http\Requests\SousDomaineRequest;

class AdminController extends Controller
{
    public function index()
    {
        $nombre_domaine = Domaine::count();
        $nombre_sous_domaine = Sousdomaine::count();
        $nombre_produit = Produit::count();
        $doms = Domaine::get();
        $sous_doms = SousDomaine::get();
        $users = User::where('is_admin',1)->get() ;
       // dd($users);
        return view('admin/dashboard',compact('nombre_domaine','nombre_sous_domaine','nombre_produit','doms','sous_doms','users'));
    }

    public function show_domaine()
    {
        $data = Domaine::all();
        $doms = Domaine::get();
        $sous_doms = SousDomaine::get();
        $users = User::where('is_admin',1)->get() ;
        return view('admin/domaine',compact('data','doms','sous_doms','users'));
    }
    public function add_domaine(DomaineRequest $request)
    {
        $inputs = Input::all();
        Domaine::create($inputs);
       //dd($data);
         return redirect()->route('domaine');
    }
    public function delete_domaine($id)
    {
        $domaine = Domaine::findOrFail($id);
        $domaine->delete();
        return redirect()->route('domaine');
    }

    public function update_domaine($id,DomaineRequest $request)
    {
        $domaine = Domaine::findOrFail($id);
       // dd(Input::get(['nom_domaine']));
        $domaine->nom_domaine = Input::get('nom_domaine');
        $domaine->save();
        return redirect()->route('domaine');
    }

    public function show_sous_domaine()
    {
        
        $domaines = new Domaine();
        $sous = new Sousdomaine();
        $doms = Domaine::get();
        $sous_doms = SousDomaine::get();
        $users = User::where('is_admin',1)->get() ;
        return view('admin/sous_domaine',compact('domaines','sous','doms','sous_doms','users'));
    }

    public function add_sous_domaine(SousDomaineRequest $request)
    {
        $inputs = Input::all();
        
        $domaine = Domaine::where('nom_domaine', $request->get('domaine_id'))->first();
        $inputs = array_merge($request->all(),['domaine_id' => $domaine->id]);

        Sousdomaine::create($inputs);
        //dd($inputs);
        return redirect()->route('sous_domaine');
    }

    public function delete_sous_domaine($id)
    {
        $sous = Sousdomaine::findOrFail($id);
        $sous->delete();
        return redirect()->route('sous_domaine');
    }

}
