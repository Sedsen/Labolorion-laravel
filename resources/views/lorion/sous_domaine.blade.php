@extends('admin/admin-template')

@section('content')
    <div class="container">
        <div class="card-deck">
            @foreach ($produits as $produit)
            <div class="col col-lg-3">
                <div class="card" style="width: 15rem; height:25rem;">
                    <img class="card-img-top" src="/uploads/{{$produit->image}}" alt="" style="height:15rem;">
                    <div class="card-body">
                        <span class="card-title text-secondary">{{ $produit->nom }}</span>
                        <p class="card-text" style="position:absolute;bottom:2%;">
                        <a href="{{ url("/show/$produit->id") }}" class="btn btn-info">Details</a>
                            <span class="alert alert-danger"> {{ $produit->prix_vente }} Fr </span>
                        </p>
                    </div>
                </div>
            </div>
                
            @endforeach
               
        </div>
    </div>
@endsection