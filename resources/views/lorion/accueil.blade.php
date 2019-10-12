@extends('lorion/template')

{{-- commentaire blade --}}

@section('image')
    <div id="carouselId" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselId" data-slide-to="0" class="active"></li>
                <li data-target="#carouselId" data-slide-to="1"></li>
                <li data-target="#carouselId" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner" role="listbox">
                <div class="carousel-item active">
                    <img src="{{ url("img/livre.jpg") }}" alt="First slide" width="100%">
                </div>
                <div class="carousel-item">
                    <img src="{{ url("img/ordi.jpg") }}" alt="Second slide" width="100%">
                </div>
                <div class="carousel-item">
                    <img src="{{ url("img/sell.jpg") }}" alt="Third slide"  width="100%">
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselId" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselId" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
@endsection

@section('content')
    <div class="container">


        <div>
            <div class="card-deck">
                @foreach ($produits as $produit)
                <div class="col col-lg-3 col-sm-6 col-10 col-md-6">
                    <div class="card bg-secondary" style="width: 15rem; height:23rem;">
                        <img class="card-img-top" src="{{ url("/uploads/$produit->image")}}" alt="" style="height:15rem;">
                        <div class="card-body">
                            <span class="card-title text-light">{{ $produit->nom }}</span>
                            <p class="card-text" style="position:absolute;bottom:2%;">
                            <a href="{{ url("/show/$produit->id") }}" class="btn btn-info btn-lg"> Details</a>
                               <!-- <span id="prix{{ $produit->id }} " class="alert alert-danger"> {{ $produit->prix_vente }} Fr </span>-->
                            </p>
                        </div>
                    </div> <br>
                </div>

                @endforeach


            </div>
        </div>

    </div>
    <div class="row d-flex justify-content-center text-center" style="margin-bottom:20px;">
        {{ $produits->render() }}
    </div>
@endsection
