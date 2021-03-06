<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{ Html::style(url('bootstrap/css/bootstrap.min.css')) }}
    {{ Html::style(url('css/style.css')) }}
    {{ Html::script(url('ckeditor/ckeditor.js')) }}
    <title>Lorion Education</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="">
        <a class="navbar-brand" href="{{ url('/') }}">Lorion Education</a>
        <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavId">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">

                @if (isset($users))
                    
               
                    @foreach ($users as $user)
                        @if (session()->get('login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d') == $user->id)
                        
                            <li class="nav-item active">
                                <a class="nav-link" href="{{ url('admin') }}">Administration </a>
                            </li>
                            <li class="nav-item active">
                                <a class="nav-link" href="{{ url('admin/show_users') }}">Utilisateurs </a>
                            </li>
                        @endif
                    @endforeach

                 @endif
                
                <li class="nav-item">
                <a class="nav-link" href="{{ url('/') }}">Accueil</a>
                </li>
                @if (isset($doms))
                    @foreach ($doms as $domaine)
                        <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdownId{{$domaine->id}}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ $domaine->nom_domaine }}</a>
                            <div class="dropdown-menu bg-dark" aria-labelledby="dropdownId{{$domaine->id}}">
                                @foreach ($sous_doms->where('domaine_id',$domaine->id) as $sous_domaine)
                                    <a class="dropdown-item text-info" href=" {{ url("show_liste/$sous_domaine->id") }} ">{{ $sous_domaine->nomSousDomaine }}</a>
                                @endforeach
                            
                            </div>
                        </li>
                    @endforeach
                @endif
                
                
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="text" placeholder="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
        <ul class="navbar-nav ml-auto">
            <!-- Authentication Links -->
            @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Connexion') }}</a>
                </li>
                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __("S'enrégistrer") }}</a>
                    </li>
                @endif
            @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            @endguest
        </ul>
    </nav>

    
    
    <div class="contenu">
        @yield('content')
    </div>
    <footer>
        <div class="bg-dark text-light text-center" id="footer" style="width:100%;position:absolute;height:7%;">
            <ul class="list-unstyled">
                <a href=" {{url('/')}} ">Accueil</a>
                <a href="{{ route('login') }} ">Connexion</a>
            </ul>
        </div>
    </footer>
    {{ Html::script(url('js/jquery.js')) }}
    {{ Html::script(url('bootstrap/js/bootstrap.min.js')) }}
</body>
</html>