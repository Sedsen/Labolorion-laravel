<?php

namespace App\Http\Controllers\Auth;

use App\Domaine;
use App\Http\Controllers\Controller;
use App\Sousdomaine;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
    public function showLinkRequestForm()
    {
        $doms = Domaine::get();
        $sous_doms = Sousdomaine::get();
        $titre = " Mot de passe oublié ";
        return view('auth.passwords.email', compact('titre', 'doms', 'sous_doms'));
    }
}