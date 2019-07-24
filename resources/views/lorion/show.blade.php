@extends('lorion/template')

@section('content')
<br>
    <div class="text-center text-secondary">
        <h4>{{ $produit->nom }}</h4>
    </div>
    <div class="row">
        <div class="col-lg-6 col-md-6">
            <img src="/uploads/{{ $produit->image }}" alt="{{ $produit->id }}" class="img-fluid img-thumbnail" width="500px">
        </div>
        <div class="col col-lg-4 col-md-4">
            <a href=" {{ url("show_liste/$produit->sous_domaine_id") }} "> {{ $sous_doms->where('id',$produit->sous_domaine_id)->first()->nomSousDomaine }} </a>
            <p class="alert alert-warning text-center" style="">
               <u>Prix de vente:</u>  {{ $produit->prix_vente }} Fr
            </p>
        </div>
    </div>
    <hr>
    <div class="text-info text-center h4">
        Description
    </div>
    <hr>

    <div class="col-lg-6 offset-lg-3">
        <?php echo $produit->description; ?>
    </div>
    <br>

@endsection
