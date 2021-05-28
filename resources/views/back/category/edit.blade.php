@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h1>Editer une Catégorie :  </h1>
                <form action="{{route('category.update', $category->id)}}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{method_field('PUT')}}
                    <div class="form">
                        <div class="form-group">
                            <label for="name">Nom  :</label>
                            <input type="text" name="name" value="{{$category->name}}" class="form-control" id="name"
                                   placeholder="Titre de la catégorie">
                            @if($errors->has('name')) <span class="error bg-warning text-warning">{{$errors->first('name')}}</span>@endif
                        </div>
                        

            </div><!-- #end col md 6 -->
            <div class="col-md-6">
                <button type="submit" class="btn btn-primary">Modifier une catégorie</button>
                
            </div><!-- #end col md 6 -->
            </form>
        </div>
@endsection