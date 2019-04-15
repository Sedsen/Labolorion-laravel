@extends('admin/admin-template')

@section('content')
    <div class="row">
        <div class="card col-lg-2 domaine" style="margin-left:20px;">
            <div class="card-body">
                <p class="card-text text-right"> <strong> Domaine </strong><br>
                    {{ $nombre_domaine }}
                </p>               
                <a href="{{ url('admin/domaine') }}" class="btn btn-primary">Domaine</a>
            </div>
        </div>
        <div class="card col-lg-2 domaine">
            <div class="card-body">
                <p class="card-text text-right"> <strong> Sous-domaine </strong><br>
                    {{ $nombre_sous_domaine }}
                </p>               
            <a href="{{ url('admin/sous_domaine') }}" class="btn btn-primary">Sous-domaine</a>
            </div>
        </div>
        <div class="card col-lg-2 domaine">
            <div class="card-body">
                <p class="card-text text-right"> <strong> Produits </strong><br>
                    {{ $nombre_produit }}
                </p>               
            <a href="{{ url('admin/produit') }}" class="btn btn-primary">Produits</a>
            </div>
        </div>
        <div class="card col-lg-2 domaine">
            <div class="card-body">
                <p class="card-text text-right"> <strong> Discussion </strong><br>
                    Nombre
                </p>               
                <a href="#" class="btn btn-primary">Discussion</a>
            </div>
        </div>
    </div>
@endsection