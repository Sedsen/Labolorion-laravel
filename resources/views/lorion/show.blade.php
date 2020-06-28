@extends('lorion/template')

@section('content')
<br>
    
    <div class="row">
        
        <div class="col-lg-6 col-md-6">
            <img src="{{ url("/uploads/$produit->image")}}" alt="{{ $produit->id }}" class="img-fluid img-thumbnail" width="500px" 
            style="border:none;">
            
        </div>
        
        <div class="col col-lg-4 col-md-4">
            <!--<a href=" {{ url("show_liste/$produit->sous_domaine_id") }} "> {{ $sous_doms->where('id',$produit->sous_domaine_id)->first()->nomSousDomaine }} </a>-->
            <div class=" text-center" >
              <h4 style="font-size:32px;margin-bottom:15px;font-weight:500;">{{ $produit->nom }}</h4>
            </div>
           <!-- <div class="text-center" style="">
              <h4> <i class="fas fa-fw fa-info-circle" ></i>  <u>Informations</u> </h4>
            </div>-->
            <div class="" style="font-size:1.25em;font-weight:500; margin:30px;">
                <i class="fas fa-fw fa-money-bill text-secondary" ></i> Prix:{{ $produit->prix_vente }} Fr CFA

            </div>
            <div class="" style="font-size:1.25em;font-weight:500; margin:30px;">
                <i class="fas fa-fw fa-tag text-secondary"></i>Catégorie:
                <a href=" {{ url("show_liste/$produit->sous_domaine_id") }} ">
                     {{ $sous_doms->where('id',$produit->sous_domaine_id)->first()->nomSousDomaine }} 
                </a>
            </div>
            @auth
                <div style="font-size:1.25em;font-weight:500; margin:30px;">
                    <a href="{{ url('/cart') }}"><i class="fas fa-fw fa-shopping-cart text-secondary"></i> Panier</a>
                    @if ($qty > 0)
                        <span class="badge badge-danger">
                            {{ $qty }}
                        </span>
                    @endif
                    
                </div>
                <div>
                    {!! Form::open( ['url' => "/cart/$produit->id",'class'=>'form-inline']) !!}
                        {!! Form::number("number", 1, ['class' => "form-control mr-2"]) !!}
                        {!! Form::submit("Ajouter au panier", ['class' => "form-control btn btn-primary"]) !!}
                        <br>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    {!! Form::close() !!}
                    
                </div>
            @endauth
           {{--  --}}
            

            <div style="margin:30px;">
                 
                <span style="font-size:1.25em;font-weight:500; "><i class="fas fa-fw fa-info-circle text-secondary"></i>Description</span> 
                <div class="">
                    <?php echo $produit->description; ?>
                </div>
            </div>
            @guest
                <div>
                    <p>
                        Pour pouvoir faire des achats vous devez vous <a href="{{ url("login") }}"> connecter</a>
                    </p>
                    
                </div>
            @endguest
            
           <!-- <div class="" style="font-size:1.25em;font-weight:500; margin:30px;">
                <i class="fas fa-fw fa-clock"></i> {{ $produit->updated_at }}
            </div>-->
            <div>
            @auth
                @if (Auth::user()->is_admin == 1)
                    <a href="{{ url("admin/edit/$produit->id") }} " class="btn btn-danger" style="font-size:1.25em;font-weight:500; margin:30px;"> 
                        <i class="fas fa-fw fa-edit"></i> Modifier</a>
                @endif
            @endauth
                
            </div>
        </div>

    </div>
    <hr>
    <div class="offset-lg-3 col-lg-3">
        @isset($all_product_categ)
            Ces produits pourraient aussi vous intéresser <br>
            <div id="slider" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner" role="listbox">
                    @foreach ($all_product_categ as $item)
                        <div class="carousel-item text-center" id="first">
                            <a href="{{ url("show/$item->id") }}">
                                <img src="{{ url("/uploads/$item->image") }}" 
                                alt="" width="300" height="" >
                            </a>
                            {{ $item->nom }}
                        </div>
                    @endforeach
                </div>
                  <a class="carousel-control-prev" href="#slider" role="button" data-slide="prev" 
                    style="background:rgba(0, 0, 0, 0.3);height:50px;border-radius:50%;top:45%">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#slider" role="button" data-slide="next" 
                    style="background:rgba(0, 0, 0, 0.3);height:50px;border-radius:50%;top:45%">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
            
        @endisset
        
    </div>    
    <hr>

        
    <br>

@endsection
