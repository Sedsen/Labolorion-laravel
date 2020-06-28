@extends('lorion/template')

@section('content')
    <div class="row">
        
            <div class="col-lg-7 offset-lg-2 col-md-10 offset-md-1 col-sm-10 offset-sm-1 col-10 offset-1">
                {!! Form::open(['action' => 'Admin\AdminController@update_entreprise','files' => true ]) !!}
                <div class="form-group">
                    <label for="my-input">Nom de entreprise </label>
                    {!! Form::text('nom', "$entreprises->nom", ["class" => "form-control"]) !!}
                </div>
                <div class="form-group">
                    <label for="my-textarea">Description</label>
                    {!! Form::textarea("description", "$entreprises->description", ['class'=> 'form-control','id'=>'description']) !!}
                </div>
            
                <div class="form-group">
                    <label for="Présentation">Présentation</label>
                    {!! Form::textarea("presentation", "$entreprises->presentation", ['class' => 'form-control','id'=>'presentation']) !!}
                </div>
                <div class="form-group">
                    <label for="Services">Services</label>
                    {!! Form::textarea("services", "$entreprises->services", ['class' => 'form-control','id'=>'services']) !!}
                </div>
                <div class="form-group">
                    <label for="Services">Contacts</label>
                    {!! Form::textarea("contacts", "$entreprises->contacts", ['class' => 'form-control','id'=>'contacts']) !!}
                </div>
                <div class="form-group">
                    <label for="Logo">Logo</label>
                    {!! Form::file("logo", null) !!}
                </div>
                <div class="form-group">
                    {!! Form::submit("Modifier", ['class'=> 'form-control btn btn-primary']) !!}
                </div>
            </div>

                <script >
                    CKEDITOR.replace('description',{
                        language: 'fr',
                        uiColor: "#F7B42C"
                    });
                </script>
                <script >
                    CKEDITOR.replace('presentation',{
                        language: 'fr',
                        uiColor: "#F7B42C"
                    });
                </script>
                <script >
                    CKEDITOR.replace('services',{
                        language: 'fr',
                        uiColor: "#F7B42C"
                    });
                </script>
                <script >
                    CKEDITOR.replace('contacts',{
                        language: 'fr',
                        uiColor: "#F7B42C"
                    });
                </script>
            
            {!! Form::close() !!}
            
    </div>
@endsection