<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Domaine;
use App\Notifications\RegisterUser;
use App\Sousdomaine;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/admin';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm()
    {
        $doms = Domaine::get();
        $sous_doms = SousDomaine::get();
        $titre = "S'enrégistrer";
        return view('auth.register', compact('doms', 'sous_doms', 'titre'));
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        $user->notify(new RegisterUser());
        return $this->registered($request, $user)
            ?: redirect('/login')->with('success', "Veuillez confirmer votre compte en cliquant sur le lien que nous vous avions envoyé par mail!");
    }

    public function confirm($id, $token)
    {
        $user = User::where('id', $id)->where('confirmation_token', $token)->first();
        if ($user) {
            $user->update(['confirmation_token' => null]);
            $this->guard()->login($user);
            //dd($this->redirectPath());
            return redirect($this->redirectPath())->with('Votre compte a bien été confirmé');
        } else {
            return redirect('/login')->with('error', "Ce lien n'est pas valide");
        }
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:5', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'is_admin' => isset($data['is_admin']),
            'confirmation_token' => str_replace('/', '', bcrypt(str_random(16)))
        ]);
    }
}
