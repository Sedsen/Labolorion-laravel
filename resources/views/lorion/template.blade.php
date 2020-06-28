<!DOCTYPE html>
<html lang="fr">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="keywords" content="Lorion,Education, Fabricant et distributeur, Editeur de solutions pédagogiques pour l'enseignement scientifique et technique et pour la recherche scientifique, Equipe les écoles, collèges, lycées et établissements supérieurs depuis 5 ans. ">
  <meta name="author" content="">

  {{ Html::style(url('bootstrap/css/bootstrap.min.css')) }}
  {{-- Html::style(url('bootstrap/bootswatch.css')) --}}
  {{  Html::style(url('css/style-chat.css')) }}
  {{  Html::style(url('css/style.css')) }}



  <title>Lorion Education | {{ $titre }}</title>

  <!-- Custom fonts for this template
  <link href="template/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">-->

  {{ Html::style(url('template/vendor/fontawesome-free/css/all.min.css')) }}
  {{--  <!-- Page level plugin CSS
  <link href="template/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">-->
  {{ Html::style(url('template/vendor/datatables/dataTables.bootstrap4.css')) }}--}}

  {{--  <!-- Custom styles for this template
  <link href="template/css/sb-admin.css" rel="stylesheet">-->
  <link rel="shortcut icon" href=" {{ url("img/favicon.ico") }} " type="image/x-icon">--}}
  {{ Html::style(url('template/css/sb-admin.css')) }}
  {{ Html::script(url('ckeditor2/ckeditor.js')) }}
 
</head>

<body id="page-top">

  <nav class="navbar navbar-expand navbar-dark static-top sticky-top" style="background-color:#212529">

    <a class="navbar-brand mr-1 h4" href="{{ url('/') }}" style="padding-left:25px" title="Accueil">Lorion Education</a>

    {{-- - <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
      <i class="fas fa-bars"></i>
    </button>--}}

    <!--<div class="collapse navbar-collapse" id="collapsibleNavId">-->
    <div class="container" >

    <!-- Navbar Search-->
    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0" action="{{ url('/search') }}" method="GET" id="search-form" >
      <div class="input-group" >
        <input type="search" class="form-control"  placeholder="Rechercher" name="search" aria-describedby="basic-addon2">
        <div class="input-group-append">
          <button class="btn btn-primary" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>
    
    <!-- Navbar -->
        
    <ul class="navbar-nav ml-auto ml-md-0 justify-content-lg-end">
      <li class="recherche nav-item">
        <a href="#" class="text-light nav-link"> <i class="fas fa-search"></i> </a> 
      </li>
        @if (Auth::user())
            @if (Auth::user()->is_admin == 1)
                <li class="nav-item">
                    <a class="nav-link" title="Administration" href="{{ url('admin') }}"><i class="fas fa-fw fa-tachometer-alt"></i> 
                      <span class="hide">Administration</span>  </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" title="Les utilisateurs" href="{{ url('admin/show_users') }}"> <i class="fas fa-fw fa-user"></i>
                      <span class="hide">Utilisateurs</span>  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ url('admin/entreprise') }}" class="nav-link" title="Entreprise"> <img src=" {{ url("img/favicon.ico") }} ">
                    <span class="hide">Entreprise</span> 
                  </a>
                </li>
                @if (isset($msg_not_reads))
                  <li class="nav-item  no-arrow mx-1">
                      
                      <a class="nav-link " title="Messagerie" href=" {{ url("chat", [Auth::id()]) }}"  id="messagesDropdown" role="button" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-envelope fa-fw"></i>
                          <span class="badge badge-danger">{{ $msg_not_reads->where('user_id',Auth::id())->where('is_read',0)->get()->count() }}</span>

                      </a>
                  </li>
                @endif
            @else 
              @if (isset($msg_not_reads))
                  <li class="nav-item  no-arrow mx-1">
                      
                      <a class="nav-link " title="Messagerie" href=" {{ url('chat/') }}"  id="messagesDropdown" role="button" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-envelope fa-fw"></i>
                          <span class="badge badge-danger"></span>

                      </a>
                  </li>
              @endif
            @endif
            
        @endif


      <li class="nav-item dropdown no-arrow">

        <ul class="navbar-nav ml-auto justify-content-lg-end">
            <!-- Authentication Links -->
            @guest
                <li class="nav-item">
                    <a class="nav-link" title="Se connecter" href="{{ route('login') }}"><i class="fas fa-fw fa-sign-in-alt"></i> <span class="hide"> {{ __('Connexion') }} </span> </a>
                </li>
                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" title="S'enrégistrer" href="{{ route('register') }}"> <i class="fas fa-fw fa-save"></i> <span class="hide"> {{ __("S'enrégistrer") }} </span></a>
                    </li>
                @endif
            @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        <i class="fas fa-fw fa-user-circle"></i> {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" title="Se déconnecter" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                                         <i class="fas fa-fw fa-sign-out-alt"></i>{{ __('Deconnexion') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            @endguest
        </ul>
      </li>
    </ul>
    </div>
  </nav>


  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="sidebar navbar-nav">
     <!--<li class="nav-item active">
        <a class="nav-link" href=" {{url('/admin')}} ">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span>
        </a>
      </li>-->

        <li class="nav-item">
            <a class="nav-link text-left ml-3" title="Accueil" href="{{ url('/') }}"> <!--<i class="fas fa-home fa-fw"></i>--> Accueil</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-left ml-3" title="Présentation" href="{{ url('/presentation') }}">Présentation  </a>
        </li>
        @if (isset($doms))
            @foreach ($doms as $domaine)
                <li class="nav-item dropdown">
                <a class="nav-link text-left ml-3 dropdown-toggle" title="{{ $domaine->nom_domaine }}" href="#" id="dropdownId{{$domaine->id}}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <!--<i class="fas fa-fw fa-layer-group"></i>-->{{ $domaine->nom_domaine }}</a>

                    <div class="dropdown-menu bg-dark" aria-labelledby="dropdownId{{$domaine->id}}">
                        @foreach ($sous_doms->where('domaine_id',$domaine->id) as $sous_domaine)
                            <a class="dropdown-item text-info" title="{{ $sous_domaine->nomSousDomaine }}" href=" {{ url("show_liste/$sous_domaine->id") }} ">
                                <!--<i class="fas fa-book fa-fw"></i>--> {{ $sous_domaine->nomSousDomaine }}</a>

                        @endforeach

                    </div>
                </li>
            @endforeach
        @endif
        <li class="nav-item">
            <a class="nav-link text-left ml-3" title="Services" href="{{ url('services') }}"> Services</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-left ml-3" title="Contact" href="{{ url('contact') }}"> Contact</a>
        </li>
    </ul>

    <div id="content-wrapper">
        <div class="img">
            @yield('image')

        </div>
        <div class="description">
          @yield('description')
        </div>
      <div class="justify-content-center">

        <div>
            @yield('content')
        </div>

      </div>
      <footer class="footer" style="padding:50px 30px;color:#ccc;background-color:#212529;display:flex;bottom:0;width:100%;margin-top:100px;">
        <div class="container" >
            <div class="row">
                @if (isset($doms))
                    @foreach ($doms as $domaine)
                        <div class="col-md-2 col-lg-2 col-sm-3 footer-nav text-center">
                            <p class="text-light">
                                {{ $domaine->nom_domaine }}
                            </p>
                            <div>
                                    @foreach ($sous_doms->where('domaine_id',$domaine->id) as $sous_domaine)
                                        <a class="" href=" {{ url("show_liste/$sous_domaine->id") }} "style="color:rgba(255, 255, 255, 0.5);" >{{ $sous_domaine->nomSousDomaine }}</a> <br>
                                    @endforeach
                            </div>
                        </div>
                    @endforeach
                @endif
                @if (Auth::user())
                  @if (Auth::user()->is_admin == 1)
                      <div class="col-md-2 col-lg-2 col-sm-3 footer-nav text-center">
                          <a class="text-light" title="Administration" href="{{ url('admin') }}" style="">
                            <span class="hide">Administration</span>  </a>
                      </div>
                      <div class="col-md-2 col-lg-2 col-sm-3 footer-nav text-center">
                          <a class="text-light" title="Les utilisateurs" href="{{ url('admin/show_users') }}" style="">
                            <span class="hide">Utilisateurs</span>  </a>
                      </div>
                      <div class="col-md-2 col-lg-2 col-sm-3 footer-nav text-center">
                        <a href="{{ url('admin/entreprise') }}" class="text-light" title="Entreprise" style="">
                          <span class="hide">Entreprise</span> 
                        </a>
                      </div>
                      
                    @endif
                  @endif
                
            </div>

        </div>

      </footer>

    </div>
    <!-- /.content-wrapper -->

  </div>
  <!-- #wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up" style="margin-top:15px;"></i>
  </a>


  <!-- Bootstrap core JavaScript -->
  {{ Html::script(url('template/vendor/jquery/jquery.min.js')) }}
  {{ Html::script(url('template/vendor/bootstrap/js/bootstrap.bundle.min.js')) }}
  {{ Html::script(url('js/demo.js')) }}
  {{ Html::script(url('template/js/sb-admin.js')) }}
  {{ Html::script(url('template/vendor/jquery-easing/jquery.easing.min.js')) }}
   {{--   {{ Html::script(url('template/vendor/chart.js/Chart.min.js')) }}
  {{ Html::script(url('template/vendor/datatables/jquery.dataTables.js')) }}
  {{ Html::script(url('template/vendor/datatables/dataTables.bootstrap4.js')) }}
--}}

