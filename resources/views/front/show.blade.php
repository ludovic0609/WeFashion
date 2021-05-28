@extends('layouts.master')

@section('CSS')
    <style>
        #productName {
            font-size: 1.5rem;
        }
        #productPrice {
            color: #636363;
        }
    </style>
@endsection

@section('content')
    <div class="row">
        <div class="col-12 col-md-6">
            @if($product->picture) 
                <img src="{{ asset('/images/' . $product->picture->link) }}" alt="{{ $product->picture->title }}" class="w-100">
            @endif
        </div>
        <div class="col-12 col-md-6 my-4 my-md-0">
            @if(isset($categories->name))
           <a href="{{ route('category', $product->category_id) }}" class="badge badge-primary">{{ $categories->name }}</a>
           @endif
           @if(!isset($categories->name))
           <a href="" class="badge badge-primary">Aucune catégorie</a>
           @endif

            <p id="productName">{{ $product->name }}</p>
            <p id="productPrice">{{ $product->price }}€ </p>
            
            @if ($discount=='1')
                <span class="badge badge-info text-uppercase">En solde !!!</span>
            @endif
            <select class="custom-select my-4">
                <option selected disabled>Taille</option>
                @foreach ($product->sizes as $size)
                    <option value="{{ $size }}">{{ $size->name }}</option>
                @endforeach
            </select>
            <button type="button" class="btn btn-secondary btn-lg">Acheter</button>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-12">
            <p>{{ $product->description }}</p>
            <p class="mt-2"><span class="font-weight-bold">Référence produit : </span>{{ $product->reference }}</p>
        </div>
    </div>
@endsection