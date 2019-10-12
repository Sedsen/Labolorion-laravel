@extends('lorion/template')

@section('content')
<br>
    <div class="alert alert-success text-center text-secondary">
        <h4>{{ $produit->nom }}</h4>
    </div>
    <div class="row">
        <div class="col-lg-6 col-md-6">
            <img src="{{ url("/uploads/$produit->image")}}" alt="{{ $produit->id }}" class="img-fluid img-thumbnail" width="500px">
        </div>
        <div class="col col-lg-4 col-md-4">
            <!--<a href=" {{ url("show_liste/$produit->sous_domaine_id") }} "> {{ $sous_doms->where('id',$produit->sous_domaine_id)->first()->nomSousDomaine }} </a>-->
            <div class="alert alert-success text-center" style="">
              <h4> <i class="fas fa-fw fa-info-circle" ></i>  <u>Informations</u> </h4>

            </div>
            <div class="alert alert-secondary">
                <i class="fas fa-fw fa-money-bill" ></i> {{ $produit->prix_vente }} Fr

            </div>
            <div class="alert alert-secondary">
                <i class="fas fa-fw fa-tag"></i><a href=" {{ url("show_liste/$produit->sous_domaine_id") }} ">
                    {{ $sous_doms->where('id',$produit->sous_domaine_id)->first()->nomSousDomaine }} </a>
            </div>
            <div class="alert alert-secondary">
                <i class="fas fa-fw fa-clock"></i> {{ $produit->updated_at }}
            </div>
        </div>

    </div>
    <hr>
    <div class="alert alert-success text-info text-center h4">
        <i class="fas fa-fw fa-paragraph"></i> Description
    </div>
    <hr>

    <div class="col-lg-6 offset-lg-3">
        <?php echo $produit->description; ?>
    </div>
    <br>

@endsection
