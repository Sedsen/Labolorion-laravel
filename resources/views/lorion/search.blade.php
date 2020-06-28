@extends('lorion/template')

@section('content')
    <br>

    <div class="row">
        <div class="col-lg-10 col-sm-10 col-md-10">
            <div class="text-center text-secondary">
                <h4> Résultats de la recherche: <?php echo $_GET["search"]; ?></h4>
            </div>

                <ul class="">
                    {{-- dd($produit) --}}
                    @foreach ($produits as $produit)
                        <ol>
                            <br>
                            <div class="col-lg-2">
                                <img class="" src="{{ url("/uploads/$produit->image")}}" alt="" style="height:8rem;float:left;">
                            </div>
                            <div class="" style ="font-size: 25px; font-weight:200; margin-left:30px;">
                               
                                <a href=" {{url("/show/$produit->id")}} " class="">{{ $produit->nom }}</a>
                              
                            </div> 
                            <div class="" style="margin-left: 50px;border-radius:10px;padding:10px;">
                                <p > <?php echo Str::limit($produit->description,90) ; ?> <a href=" {{url("/show/$produit->id")}}" class="text-white">
                                    <i class="fas fa-arrow-circle-right fa-fw"></i> </a> </p>
                            </div>
                        </ol>
                        <hr>
                    @endforeach
                </ul>
            
    </div>
    
@endsection
