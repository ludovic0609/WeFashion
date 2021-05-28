@extends('layouts.master')

@section('CSS')
    <style>
        .product-img {
            height: 20rem;
            background-size: cover;
        }
        .product-name {
            color: black;
            font-size: 1.2rem;
        }
        .product-price {
            color: #636363;
        }
    </style>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
        <h4><p class="text-right">{{ $products->total() }} résultats</p></h4>
        </div>
    </div>
    <div class="row">
        @foreach ($products as $product)
            <div class="col-12 col-sm-6 col-md-4 mb-4">
                <a href="{{ route('product', $product->id) }}">

                
                <div class="product-img" @if($product->picture) style="background-image: url('{{ asset('/images/' . $product->picture->link) }}')" @endif></div>
               
                
                
              


                    
                    <p class="product-name">{{ $product->name }}</p>
                    <p class="product-price">{{ $product->price }}€</p>
                </a>
            </div>
        @endforeach
    </div>
    <div class="row">
        <div class="col-sm" style="left:87%;">
            <h4>{{ $products->links() }}</h4>
        </div>
    </div>
@endsection

