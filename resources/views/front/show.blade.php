@extends('layouts.master')

@section('content')
<article class="row" style='padding: 30px 10px;'>
    @if(count($product)>0)
    <div class="col-md-6">
    <h1>{{$product->name}}</h1>
    @if(count($product->picture) > 0)
        <img class="" style='max-width: 400px; margin: 30px 0px;' src="{{asset('/img/'.$product->category_id.'/'.$product->picture)}}" alt="{{$product->name}}">
    @endif
        <h2 style='margin: 10px 0px;'>Description :</h2>
        {{$product->description}}    
    </div>
    <div class="col-md-6">
        <h3>Prix :</h3>
        {{$product->price}} €
        <br><br>
        <h3>Taille :</h3>
        <select name="" id="">
            @foreach($product->size as $size)
            <option value="{{$size->id}}">{{$size->name}}</option>
            @endforeach
        </select>
        <br><br>
        <button class='btn btn-success btn-lg'>Acheter</button>
    </div>
    @else 
    <h1>Désolé aucun article</h1>
    @endif 
</article>
@endsection 

