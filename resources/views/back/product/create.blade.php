@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h1>Créer un produit :  </h1>
                <form action="{{route('product.store')}}" method="post">
                    {{ csrf_field() }}
                    <div class="form">
                        <div class="form-group">
                            <label for="name"><h3>Nom:</h3></label>
                            <input type="text" name="name" value="{{old('name')}}" class="form-control" id="name" placeholder="Nom du produit">
                            @if($errors->has('name')) <span class="error text-danger">{{$errors->first('name')}}</span>@endif
                        </div>
                        <div class="form-group">
                            <label for="reference"><h3>Reference:</h3></label>
                            <input type="text" name="reference" value="{{old('reference')}}" class="form-control" id="reference" placeholder="Référence">
                            @if($errors->has('reference')) <span class="error text-danger">{{$errors->first('reference')}}</span>@endif
                        </div>
                        <div class="form-group">
                            <label for="price"><h3>Description :</h3></label>
                            <textarea type="text" name="description"class="form-control">{{old('description')}}</textarea>
                            @if($errors->has('description')) <span class="error text-danger">{{$errors->first('description')}}</span> @endif
                        </div>
                    </div>
                    <div class="form-select">
                        <label for="genre"><h3>Genre :</h3></label>
                        <select id="genre" name="genre_id">
                                <option value="0" {{ is_null(old('genre_id'))? 'selected' : '' }} >No genre</option>
                            @foreach($genres as $id => $name)
                                <option value="{{$id}}">{{$name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <h3>Choisissez un/des tailles</h3>
                    <div class="">
                        <div class="form-group">
                    @forelse($sizes as $id => $name)
                        <input name="sizes[]" value="{{$id}}" type="checkbox" {{ is_null(old('genre_id'))? 'selected' : '' }} class="" id="size{{$id}}">
                        <label class="control-label" for="size{{$id}}">{{$name}}</label>
                        <br>
                    @empty
                    @endforelse
                        </div>
                    </div>
            </div><!-- #end col md 6 -->
            <div class="col-md-6">
                <button type="submit" class="btn btn-primary">Ajouter un produit</button>
                <div class="input-radio">
            <h2>Status</h2>
            <input type="radio" name="status" value="published" checked> publier<br>
            <input type="radio" name="status" value="unpublished" checked> dépulier<br>
            </div>
            <div class="input-file">
                <h2>Image :</h2>
                <input class="file" type="file" name="picture" >
                @if($errors->has('picture')) <span class="error text-danger">{{$errors->first('picture')}}</span> @endif
            </div>
            </div><!-- #end col md 6 -->
            </form>
        </div>
@endsection
