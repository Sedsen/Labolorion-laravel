@extends('lorion/template')

@section('content')

    <div class="row">
        <div class="col-lg-4 offset-lg-2">
            {{ Form::open(['url' => '/admin/produit','files' => true ]) }}
                <div class="form-group">
                  <label for="Nom">Nom</label>
                  <input type="text"
                    class="form-control" name="nom" id="" aria-describedby="helpId" placeholder="Nom du produit">
                  @if ($errors->has('nom'))
                      <div class="alert alert-danger">
                          {{ $errors->first('nom') }}
                      </div>
                  @endif
                </div>
                <div class="form-group">
                  <label for="Prix">Prix de vente</label>
                  <input type="number"
                    class="form-control" name="prix_vente" id="" aria-describedby="helpId" placeholder="Prix de vente">
                    @if ($errors->has('prix_vente'))
                        <div class="alert alert-danger">
                            {{ $errors->first('prix_vente') }}
                        </div>
                    @endif
                </div>
                <div class="form-group">
                  <label for="Sous domaine">Sous domaine</label>
                  <select class="form-control" name="sous_domaine_id" id="">
                    @foreach ($sous_domaines as $sous_domaine)
                        <option>
                            {{ $sous_domaine->nomSousDomaine }}
                        </option>
                    @endforeach


                  </select>
                </div>

                <div class="form-group">
                  {{ Form::label('Image du Produit') }}
                  {{ Form::file('image',null) }}
                </div>
                @if ($errors->has('image'))
                      <div class="alert alert-danger">
                          {{ $errors->first('image') }}
                      </div>
                  @endif



                <button type="submit" class="btn btn-primary">Ajouter</button>
        </div>
        <div class="col">
            <div class="form-group">
                <label for="Description">Description</label>
                <textarea class="form-control" name="description" id="" rows="3"></textarea>
            </div>
              @if ($errors->has('description'))
                    <div class="alert alert-danger">
                        {{ $errors->first('description') }}
                    </div>
                @endif
        </div>
            <script >
                CKEDITOR.replace('description');//,{allowedContent: true}
            </script>
            {{ Form::close() }}

    </div>


    <div class="row">
        <div class="container">
            <div class="table-responsive" >
                <table class="table ">
                        <thead>
                            <tr>
                                <th>Num</th>
                                <th>Produits</th>
                                <th>Prix de vente</th>
                                <th>Sous-domaine</th>
                                <th>Modifier</th>
                                <th>Supprimer</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($produits as $produit)
                                <tr>
                                    <td scope="row"> {{ $produit->id }} </td>
                                    <td>{{ $produit->nom }}</td>
                                    <td>{{ $produit->prix_vente }}</td>
                                    <td>{{ $sous->where('id',$produit->sous_domaine_id)->get('nomSousDomaine')->first()->nomSousDomaine   }}</td>
                                    <td>

                                    <a href="{{ url("admin/edit/$produit->id") }}" class="btn btn-secondary">
                                            <i class="fas fa-fw fa-edit"></i> Modifier
                                        </a>
                                    </td>
                                    <td>
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#suppr{{$produit->id}}">
                                        <i class="fas fa-fw  fa-trash-alt"></i> Supprimer
                                    </button>
                                    </td>
                                </tr>


                                <!-- Modal -->
                                <div class="modal fade" id="suppr{{$produit->id}}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Suppression du produit</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                            </div>
                                            <div class="modal-body">
                                                    Voulez-vous confirmer la suppression de {{ $produit->nom }} ?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <a href="{{ url("admin/delete_produit/$produit->id") }}" class="btn btn-danger">Supprimer</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            @endforeach


                        </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="row d-flex justify-content-center text-center">
        {{ $produits->render() }}
    </div>

@endsection
