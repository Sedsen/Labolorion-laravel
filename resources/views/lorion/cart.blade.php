@extends('lorion/template')
@section('description')
    <div style="height:100px"></div>
@endsection

@section('content')
<div class="col-lg-7 offset-lg-2">
    <h1 class="title text-center" style="font-weight: 200;font-size:40px;color:#525252;margin-top:50px;">
        Liste des produits du panier    
    </h1>
            <hr>
    @if (isset($cart))
        <table class="table table-striped table-inverse table-responsive  table-hover pt-4">
            <thead class="thead-inverse thead-dark">
                <tr>
                    <th scope="col">Produits</th>
                    <th scope="col">Prix</th>
                    <th scope="col">Quantité</th>
                    <th scope="col">Total</th>
                    <th scope="col">Supprimer</th>
                </tr>
                </thead>
                <tbody>
                    
                    
                        @foreach ($cart as $item)
                            <tr>
                                {{-- dd($item['id']) --}}
                                <?php $id = $item['id']; ?>
                                <td scope="row"> <a href="{{ url("show/$id") }}">{{ $item['nom'] }} </a> </td>
                                <td>{{ $item['prix_vente'] }}</td>
                                <td class="text-center">{{ $item['quantite'] }}</td>
                                <td>{{ $item['total']}}</td>
                                <td> <a href="{{ url("remove_cart/$id") }}" class="btn btn-danger">Supprimer</a> </td>
                            </tr>
                        @endforeach
                
                
                </tbody>
                    
                <tfoot>
                    <tr>
                        <th colspan="2" class="text-right">Total</th>
                        <th class="text-center">{{ $qty }}</th>
                        <th >{{ $total }} Fr CFA</th>
                        <th class="text-center"><a href="{{ url("remove_all") }}" class="btn btn-danger">vider</a></th>
                    </tr>
                </tfoot>
        </table>
            
    @else
        <div>
            Votre panier est vide.
        </div>
     @endif
     
</div>
    
@endsection