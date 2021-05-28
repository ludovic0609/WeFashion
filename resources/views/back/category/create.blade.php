@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h1>Créer une Catégorie :  </h1>
                <form action="{{route('category.store')}}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form">
                        <div class="form-group">
                            <label for="name">Nom  :</label>
                            <input type="text" name="name" value="{{old('name')}}" class="form-control" id="name"
                                   placeholder="Titre de la catégorie">
                            @if($errors->has('name')) <span class="error bg-warning text-warning">{{$errors->first('name')}}</span>@endif
                        </div>
                        

            </div><!-- #end col md 6 -->
            <div class="col-md-6">
                <button type="submit" class="btn btn-primary">Ajouter une catégorie</button>
                
            </div><!-- #end col md 6 -->
            </form>
        </div>
@endsection