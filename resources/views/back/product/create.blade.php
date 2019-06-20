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
                            <label for="title">Titre :</label>
                            <input type="text" name="title" value="" class="form-control" id="title"
                                   placeholder="Titre du livre">
                        </div>
                        <div class="form-group">
                            <label for="price">Description :</label>
                            <textarea type="text" name="description"class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="form-select">
                        <label for="genre">Genre :</label>
                        <select id="genre" name="genre_id">
                                <option value="0" {{ is_null(old('genre_id'))? 'selected' : '' }} >No genre</option>
                            @foreach($genres as $id => $name)
                                <option value="{{$id}}">{{$name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <h1>Choisissez un/des auteurs</h1>
                    <div class="">
                        <div class="form-group">
                    @forelse($sizes as $id => $name)
                        <input name="authors[]" value="{{$id}}" type="checkbox" class="" id="size{{$id}}">
                        <label class="control-label" for="size{{$id}}">{{$name}}</label>
                        <br>
                    @empty
                    @endforelse
                        </div>
                    </div>
            </div><!-- #end col md 6 -->
            <div class="col-md-6">
                <button type="submit" class="btn btn-primary">Ajouter un livre</button>
                <div class="input-radio">
            <h2>Status</h2>
            <input type="radio" name="status" value="published" checked> publier<br>
            <input type="radio" name="status" value="unpublished" checked> dépulier<br>
            </div>
            <div class="input-file">
                <h2>File :</h2>
                <input class="file" type="file" name="picture" >
            </div>
            </div><!-- #end col md 6 -->
            </form>
        </div>
@endsection
