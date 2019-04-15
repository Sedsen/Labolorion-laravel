@extends('admin/admin-template')

@section('content')
    <div class="row">
        <div class="col-lg-4 offset-lg-2">
            {{ Form::open(['action' => 'Admin\AdminController@add_sous_domaine']) }}
                <div class="form-group">
                    <legend> Ajouter un sous domaine </legend>
                    <label for="" class="sr-only">Sous domaine</label>
                    <input type="text"
                        class="form-control" name="nomSousDomaine" id="" aria-describedby="helpId" placeholder="Sous domaine">
                        @if ($errors->has('nomSousDomaine'))
                            <div class="alert alert-danger">
                                {{ $errors->first('nomSousDomaine') }}
                            </div> 
                        @endif
                
                </div>
                <div class="form-group">
                  <label for="domaine" class="sr-only">Domaine</label>
                  <select class="form-control" name="domaine_id" id="">
                    @foreach ($domaines->get() as $domaine)
                        <option>
                            {{ $domaine->nom_domaine }}
                        </option>     
                    @endforeach   
                         
                  </select>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary" type="submit">Ajouter</button>
                </div>
            {{ Form::close() }}
        </div>
    </div>

    <div class="row">
            <div class="container">
                <div class="table-responsive">
                    <table class="table table-striped table-hover table-sm">
                        <thead class="thead-light">
                            <tr>
                                <th>Num</th>
                                <th>Domaine</th>
                                <th>Sous domaine </th>
                                <th>Modifier</th>
                                <th>Supprimer</th>
                            </tr>
                        </thead>
                        <tbody>
                                                       
                                  
                                @foreach ($sous->get() as $row)
                                
                                    <tr>
                                        <td scope="row">{{$row->id}}</td>
                                        
                                        <td> {{ $domaines->where('id',$row->domaine_id)->get('nom_domaine')->first()->nom_domaine }} </td>
                                        <td>{{ $row->nomSousDomaine }} </td>
                                        <td>
                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modif{{$row->id}}">
                                                Modifier
                                            </button>
                                        </td>
                                        <td>
                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#suppr{{$row->id}}">
                                                Supprimer
                                            </button>
                                        </td>
                                    </tr>
                               
                                
                                
                                
                                <!-- Modal -->
                                <div class="modal fade" id="suppr{{$row->id}}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Suppression</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                            </div>
                                            <div class="modal-body">
                                                Voulez-vous confirmer la suppression de {{ $row->nomSousDomaine }} ?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <a href="{{url("admin/delete_/$row->id")}}" class="btn btn-danger">Supprimer</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
    
                                
                                
                                <!-- Modal -->
                            <!--<div class="modal fade" id="modif{{$row->id}}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Modification</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                            </div>
                                            <div class="modal-body">
                                                {{ Form::open(['url' => "admin/update/$row->id"]) }}
                                                    <div class="form-group">
                                                        <legend> Modification de domaine </legend>
                                                      <label for="" class="sr-only">Domaine</label>
                                                      <input type="text"
                                                    class="form-control" name="nom_domaine" id="" aria-describedby="helpId" placeholder="Domaine" value="{{$row->nom_domaine}}">
                                                        
                                                    </div>
                                                    <div class="form-group">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button class="btn btn-primary" type="submit">Modifier </button>
                                                    </div>
                                                {{ Form::close() }}
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>-->
                            @endforeach
                            
                        </tbody>
                    </table>
                </div>
            </div>  
        </div>
@endsection