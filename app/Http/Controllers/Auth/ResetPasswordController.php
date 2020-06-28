<?php

namespace App\Http\Controllers\Auth;

use App\Domaine;
use App\Http\Controllers\Controller;
use App\Sousdomaine;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;


class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
    public function showResetForm(Request $request, $token = null)
    {
        $doms  = Domaine::get();
        $sous_doms = Sousdomaine::get();
        $titre = "Reinitialiser le mot de passe";
        return view('auth.passwords.reset', compact('titre', 'doms', 'sous_doms'))->with(
            ['token' => $token, 'email' => $request->email]
        );
    }
    protected function rules()
    {
        return [
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:5',
        ];
    }
}
