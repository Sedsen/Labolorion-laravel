@extends('lorion/template')

@section('content')
    <div class="container">
        <div class="card-deck">
            @foreach ($produits as $produit)
            <div class="col col-lg-3 col-sm-6 col-10 col-md-6">
                <div class="card bg-secondary" style="width: 15rem; height:25rem;">
                    <img class="card-img-top" src="{{ url("/uploads/$produit->image")}}" alt="" style="height:15rem;">
                    <div class="card-body">
                        <span class="card-title text-light">{{ $produit->nom }}</span>
                        <p class="card-text" style="position:absolute;bottom:2%;">
                        <a href="{{ url("/show/$produit->id") }}" class="btn btn-info btn-lg">Details</a>
                            <!--<span class="alert alert-danger"> {{ $produit->prix_vente }} Fr </span>-->
                        </p>
                    </div>
                </div>
            </div>

            @endforeach

        </div>
    </div>
    <div class="row d-flex justify-content-center text-center" style="margin-bottom:20px;">
        {{ $produits->render() }}
    </div>
@endsection
