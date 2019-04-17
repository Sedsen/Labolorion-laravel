@extends('admin/admin-template')

@section('content')
    <div class="container">

        <div class="row">
            <div class="col col-lg-4 offset-lg-2">
                {{ Form::open(['action' => 'Admin\AdminController@add_users']) }}
                    <div class="form-group">
                      <label for="Nom">Nom</label>
                      <input type="text" class="form-control" name="name" id="name" aria-describedby="helpId" placeholder="Nom">
                    </div>
                    @if ($errors->has('name'))
                       <div class="alert alert-danger">
                            {{ $errors->first('name') }}
                        </div> 
                    @endif
                    <div class="form-group">
                      <label for="Email">Email</label>
                      <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelpId" placeholder="Email">
                    </div>
                    @if ($errors->has('email'))
                       <div class="alert alert-danger">
                            {{ $errors->first('email') }}
                        </div> 
                    @endif
                    <div class="form-group">
                      <label for="password">Mot de Passe</label>
                      <input type="password" class="form-control" name="password" id="password" placeholder="Mot de Passe">
                    </div>
                    @if ($errors->has('password'))
                       <div class="alert alert-danger">
                            {{ $errors->first('password') }}
                        </div> 
                    @endif
                    <div class="form-group">
                      <label for="passwordConfirmation">Confirmation du mot de passe</label>
                      <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Confirmation du mot de passe">
                    </div>
                    <div class="form-check">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="is_admin" id="is_admin" value="1" >
                        Administrateur
                      </label>
                    </div>
                    <button type="submit" class="btn btn-primary">Ajouter</button>
                {{ Form::close() }}
            </div>
        </div><br>

        <div class="row">
            <table class="table">
                <thead>
                    <tr>
                        <th>Num</th>
                        <th>Nom</th>
                        <th>E-Mail</th>
                        <th>Rôle</th>
                        <th>Supprimer</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($list_users as $user)
                        <tr>
                            <td scope="row"> {{$user->id}} </td>
                            <td> {{$user->name}} </td>
                            <td> {{$user->email}} </td>
                            
                            @if ($user->is_admin == 1)
                                 <td> Administrateur </td>
                            @else
                                <td> Utilisateur </td>
                            @endif
                            <td>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#suppr{{ $user->id }}">
                                    Supprimer
                                </button>
                            </td>
                              
                        </tr>
                        
                        
                        <!-- Modal -->
                        <div class="modal fade" id="suppr{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Suppression de l'utilisateur</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                    </div>
                                    <div class="modal-body">
                                        Voulez-vous confirmer la suppression de {{ $user->name }}
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <a href=" {{url("admin/delete_user/$user->id")}} " class="btn btn-danger" >Supprimer</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    @endforeach 
                </tbody>
            </table>
        </div>
    </div>
@endsection