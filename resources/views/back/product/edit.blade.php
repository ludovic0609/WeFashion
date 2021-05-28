@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h1>Editer un Produit :  </h1>
                <form action="{{route('product.update',$product->id)}}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{method_field('PUT')}}
                    <div class="form">
                        <div class="form-group">
                            <label for="name">Nom  :</label>
                            <input type="text" name="name" value="{{$product->name}}" class="form-control" id="name"
                                   placeholder="Titre du produit">
                            @if($errors->has('name')) <span class="error bg-warning text-warning">{{$errors->first('name')}}</span>@endif
                        </div>
                        <div class="form-group">
                            <label for="title">Prix :</label>
                            <input type="number" name="price" step="0.01"  min="0"  value="{{$product->price}}" class="form-control" id="price"
                                   placeholder="Prix du produit">
                            @if($errors->has('price')) <span class="error bg-warning text-warning">{{$errors->first('price')}}</span>@endif
                        </div>

                        <div class="form-group">
                            <label for="ref">Référence :</label>
                            <input type="text" name="reference" value="{{$product->reference}}" class="form-control" id="reference"
                                   placeholder="Référence du produit">
                            @if($errors->has('reference')) <span class="error bg-warning text-warning">{{$errors->first('reference')}}</span>@endif
                        </div>


                        <div class="form-group">
                            <label for="price">Description :</label>
                            <textarea type="text" name="description"class="form-control">{{$product->description}}</textarea>
                            @if($errors->has('description')) <span class="error bg-warning text-warning">{{$errors->first('description')}}</span> @endif
                        </div>
                    </div>
                    <div class="form-select">
                    <label for="categorie">Catégorie :</label>
                    <select id="categorie" name="category_id">
                        <option value="0" {{ is_null($product->category_id)? 'selected' : '' }} >Aucune catégorie</option>
                        @foreach($categories as $id => $name)
                            <option @if($product->category_id==$id) selected  @endif   value="{{$id}}">{{$name}}</option>
                        @endforeach
                    </select>
                    </div>

                    <h3>Choisissez une ou des tailles disponibles</h3>
                    <div class="form-inline">
                        <div class="form-group">
                    @forelse($sizes as $id => $name)
                        <label class="control-label" for="author{{$id}}">{{$name}}</label>
                        <input name="sizes[]" value="{{$id}}"
                                @if( is_null($product->sizes) == false and  in_array($id, $product->sizes()->pluck('id')->all()))
                                checked
                                @endif
                                type="checkbox" class="form-control"
                                id="size{{$id}}">
                    @empty
                    @endforelse
                        </div>
                    </div>
                    
            </div><!-- #end col md 6 -->
            <div class="col-md-6">
                <button type="submit" class="btn btn-primary">Modifiez un produit</button>
                <div class="input-radio">
            <h2>Visible</h2>
            <input type="radio" @if($product->product_visible == '1') checked @endif name="product_visible" value="1" checked> oui<br>
            <input type="radio" @if($product->product_visible == '0') checked @endif name="product_visible" value="0" > non<br>
            <h2>Produit en solde</h2>
            <input type="radio" @if($product->state_product == '1') checked @endif name="state_product" value="1" checked> oui<br>
            <input type="radio" @if($product->state_product == '0') checked @endif name="state_product" value="0" > non<br>


            </div>
            <div class="input-file">
                <h2>File :</h2>
                <label for="genre">Titre de l' image :</label>
                <input type="text" name="title_image" value="{{old('title_image')}}">
                <input class="file" type="file" name="picture" >
                @if($errors->has('picture')) <span class="error bg-warning text-warning">{{$errors->first('picture')}}</span> @endif
            </div>
            @if($product->picture)
            <div class="form-group">
                <h2>Image associée :</h2>
                
            </div>
            <div class="form-group">
            <img width="300" src="{{asset('images/' . $product->picture->link)}}" alt="">
            </div>
            @endif
            </div><!-- #end col md 6 -->
            </form>
        </div>
@endsection