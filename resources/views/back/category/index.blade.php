@extends('layouts.master')

@section('content')
    

    <div class="row">
        <div class="col-12 text-left">
            <a href="{{ route('category.create') }}">
                <button type="button" class="btn btn-primary">Ajouter une Catégorie</button>
            </a>
            {{$categories->links()}}
{{-- On inclut le fichier des messages retournés par les actions du contrôleurs BookController--}}
@include('back.product.partials.flash')
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-2 col-sm-3 col-md-4 col-lg-3 font-weight-bold">Nom</div>
        
    </div>
    @foreach ($categories as $categorie)
        <div class="row">
            <div class="col-2 col-sm-3 col-md-4 col-lg-3">{{ $categorie->name }}</div>

            
            <a href="{{ route('category.edit', $categorie->id) }}">
                <div class="col-1">
                    <i class="fas fa-edit"></i>
                </div>
            </a>
            <div class="col-1">
                <form action="{{ route('category.destroy', $categorie->id) }}" method="post" class="delete_category">
                    <input name="_method" type="hidden" value="DELETE">
                    {{ csrf_field() }}
                    <button type="submit" class="bg-transparent border-0">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </form>
            </div>
        </div>
        <hr>
    @endforeach
    
@endsection

@section('scripts')
    @parent
    <script src="{{asset('js/confirm.js')}}"></script>
@endsection