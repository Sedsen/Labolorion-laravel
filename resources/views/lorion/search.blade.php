@extends('lorion/template')

@section('content')
    <br>

    <div class="row">
        <div class="col-lg-9 col-md-10">
            <div class="text-center text-secondary">
                <h4> Résultats de la recherche: <?php echo $_GET["search"]; ?></h4>
            </div>

                <ul class="list-unstyled">
                    @foreach ($produits as $produit)
                        <li>
                            <br>
                            <div class="text-center">
                                <a href=" {{url("/show/$produit->id")}} " class="">{{ $produit->nom }}</a>
                            </div> <br>

                            <div class="bg-secondary text-light" style="margin-left: 50px;border-radius:10px;padding:10px;">
                                <p > <?php echo Str::limit($produit->description,90) ; ?> <a href=" {{url("/show/$produit->id")}}" class="text-white">
                                    <i class="fas fa-arrow-circle-right fa-fw"></i> </a> </p>
                            </div>
                        </li>
                    @endforeach
                </ul>
    </div>
@endsection
