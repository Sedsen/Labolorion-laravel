@extends('lorion/template')

@section('content')
<div class="row">
    <div class="col-lg-4 offset-lg-2">
        {{ Form::open(['url' => "/admin/update_produit/$produit->id",'files' => true ]) }}
            <div class="form-group">
              <label for="Nom">Nom</label>
              <input type="text"
            class="form-control" name="nom" id="" aria-describedby="helpId" placeholder="Nom du produit" value="{{$produit->nom}}">
              @if ($errors->has('nom'))
                  <div class="alert alert-danger">
                      {{ $errors->first('nom') }}
                  </div>
              @endif
            </div>
            <div class="form-group">
              <label for="Prix">Prix de vente</label>
              <input type="number"
            class="form-control" name="prix_vente" id="" aria-describedby="helpId" placeholder="Prix de vente" value="{{$produit->prix_vente}}">
                @if ($errors->has('prix_vente'))
                    <div class="alert alert-danger">
                        {{ $errors->first('prix_vente') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
              <label for="Sous domaine">Sous domaine</label>
            <!--  <select class="form-control" name="sous_domaine_id" id="" >
                @foreach ($sous_doms as $sous_domaine)
                    <option>
                        {{ $sous_domaine->nomSousDomaine }}
                    </option>
                @endforeach


              </select>-->

              {!! Form::select("sous_domaine_id", $list, $produit->sous_domaine_id, ['class' => "form-control"]) !!}

            </div>


           <!-- <div class="form-group">
              {{ Form::label('Image du Produit') }}
              {{ Form::file('image',['values' => $produit->image]) }}
            </div>
            @if ($errors->has('image'))
                  <div class="alert alert-danger">
                      {{ $errors->first('image') }}
                  </div>
              @endif-->
            <button type="submit" class="btn btn-primary">Modifier</button>
        </div>
            <div class="col">
                <div class="form-group">
                    <label for="Description">Description</label>
                    <textarea class="form-control" name="description" id="" rows="3">{{ $produit->description }} </textarea>
                  </div>
                  @if ($errors->has('description'))
                        <div class="alert alert-danger">
                            {{ $errors->first('description') }}
                        </div>
                 @endif
            </div>

        {{ Form::close() }}
        <script >
            CKEDITOR.replace('description',{
                        language: 'fr',
                        uiColor: "#F7B42C"
                    });
        </script>
</div>


@endsection
