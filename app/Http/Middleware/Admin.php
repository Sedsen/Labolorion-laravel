<?php

namespace App\Http\Middleware;


use Illuminate\Contracts\Auth\Factory as Auth;

use Closure;

class Admin 
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    protected $auth;

    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    public function handle($request, Closure $next)
    {
        
        if ($this->auth->user() !== null) {
            $user = $this->auth->user();
            if ($user->is_admin == 1)
            {
                return $next($request);
            }
           // dd($user->is_admin);           
        }
       // dd($this->auth->user());
         return redirect('/');;
    }
   
}
