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
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Auth;
use App\Discussion;
use App\Entreprise;
use App\Http\Requests\EntrepriseRequest;

class AdminController extends Controller
{
    public function index()
    {
        $nombre_domaine = Domaine::count();
        $nombre_sous_domaine = Sousdomaine::count();
        $nombre_produit = Produit::count();
        $doms = Domaine::get();
        $sous_doms = SousDomaine::get();
        $msg_not_reads = new Discussion();
        $titre = "Adminstration";
        // $users = User::where('is_admin',1)->get() ;
        //dd(Auth::user()->is_admin);
        return view('admin/dashboard', compact('nombre_domaine', 'nombre_sous_domaine', 'titre', 'nombre_produit', 'doms', 'sous_doms', 'msg_not_reads'));
    }

    public function show_domaine()
    {
        $data = Domaine::all();
        $doms = Domaine::get();
        $sous_doms = SousDomaine::get();
        $titre = "Adminstration - Domaines";
        //$users = User::where('is_admin',1)->get() ;
        return view('admin/domaine', compact('data', 'titre', 'doms', 'sous_doms'));
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

    public function update_domaine($id, DomaineRequest $request)
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
        $titre = "Administration - Sous domaines";
        $users = User::where('is_admin', 1)->get();
        return view('admin/sous_domaine', compact('domaines', 'sous', 'titre', 'doms', 'sous_doms', 'users'));
    }

    public function add_sous_domaine(SousDomaineRequest $request)
    {
        $inputs = Input::all();

        $domaine = Domaine::where('nom_domaine', $request->get('domaine_id'))->first();
        $inputs = array_merge($request->all(), ['domaine_id' => $domaine->id]);

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

    public function update_sous_domaine($id, SousDomaineRequest $request)
    {
        $sous_domaine = Sousdomaine::findOrFail($id);
        //dd($sous_domaine);
        $sous_domaine->nomSousDomaine = $request->get('nomSousDomaine');
        $sous_domaine->save();
        return redirect()->route('sous_domaine');
    }

    public function show_users()
    {
        $doms = Domaine::get();
        $sous_doms = SousDomaine::get();
        $users = User::where('is_admin', 1)->get();
        $list_users = User::get();
        $titre = "Liste des utilisateurs et leur rôle";
        return view('admin/users', compact('doms', 'sous_doms', 'titre', 'users', 'list_users'));
    }

    public function add_users(UserRequest $request)
    {

        $admin = $request->get('is_admin');
        // dd($admin);
        $user = new User(
            [
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'password' => bcrypt($request->get('password')),
            ]
        );
        $user->save();
        if (isset($admin)) {
            $user->is_admin = 1;
            $user->save();
        }

        return redirect('admin/show_users');
    }

    public function delete_user($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect('admin/show_users');
    }

    public function voir_entreprise($id = 1)
    {
        $doms = Domaine::get();
        $sous_doms = SousDomaine::get();
        $entreprises = Entreprise::findOrFail($id);

        $titre = "Les informations sur l'entreprise";
        return view('admin/entreprise', compact('doms', 'sous_doms', 'titre', 'entreprises'));
    }

    public function update_entreprise($id = 1, EntrepriseRequest $request)
    {
        $entreprises = Entreprise::findOrFail($id);
        // dd($request);
        $entreprises->nom = $request->get('nom');
        $entreprises->description = $request->get('description');
        $entreprises->presentation = $request->get('presentation');
        $entreprises->services = $request->get('services');
        $entreprises->save();
        return redirect('admin/entreprise');
    }
}
