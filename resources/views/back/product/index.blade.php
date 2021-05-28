@extends('layouts.master')

@section('content')
    

    <div class="row">
        <div class="col-12 text-left">
            <a href="{{ route('product.create') }}">
                <button type="button" class="btn btn-primary">Ajouter un Produit</button>
            </a>
            {{$products->links()}}
{{-- On inclut le fichier des messages retournés par les actions du contrôleurs BookController--}}
@include('back.product.partials.flash')
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-2 col-sm-3 col-md-4 col-lg-3 font-weight-bold">Nom</div>
        <div class="col-2 col-lg-1 font-weight-bold">Catégorie</div>
        <div class="col-2 font-weight-bold">Prix</div>
        <div class="col-2 font-weight-bold">État</div>
        <div class="col-2 font-weight-bold">En solde</div>
    </div>
    @foreach ($products as $product)
        <div class="row">
            <div class="col-2 col-sm-3 col-md-4 col-lg-3">{{ $product->name }}</div>

            @if($product->category_id==NULL)
            <div class="col-2 col-lg-1"><b> Aucune catégorie </b></div>
            @endif

            @foreach ($categories as $categorie)
                @if($product->category_id==$categorie->id)

                    <div class="col-2 col-lg-1"><b> {{$categorie->name}} </b></div>
                    
                @endif

            @endforeach
            
            <div class="col-2">{{ $product->price }} €</div>
            <div class="col-2">
                @if ($product->product_visible)
                    <span class="badge badge-success">Visible</span>
                @else
                    <span class="badge badge-danger">Non visible</span>
                @endif

            </div>
            <div class="col-2">
                @if ($product->state_product=='1')
                    <span class="badge badge-warning">Oui</span>
                @else
                    <span class="badge badge-dark">Non</span>
                @endif
                
            </div>
            <a href="{{ route('product.edit', $product->id) }}">
                <div class="col-1">
                    <i class="fas fa-edit"></i>
                </div>
            </a>
            <div class="col-1">
                <form action="{{ route('product.destroy', $product->id) }}" method="post" class="delete-form">
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

@section('JS')
    <script src="{{ asset('js/confirm.js') }}"></script>
@endsection