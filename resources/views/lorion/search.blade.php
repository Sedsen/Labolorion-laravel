@extends('lorion/template')

@section('content')
    <br>
    <div class="text-center text-secondary">
        <h4> Résultats de la recherche </h4>
    </div>
    <div class="row">
        <div class="col-lg-9 col-md-10">


                <ul class="list-unstyled">
                    @foreach ($produits as $produit)
                        <li>
                            <a href=" {{url("/show/$produit->id")}} ">{{ $produit->nom }}</a>
                            <div class="bg-secondary text-light" style="margin-left: 50px;">
                                <p > <?php echo $produit->description; ?></p>
                            </div>
                        </li>
                    @endforeach
                </ul>
    </div>
@endsection
