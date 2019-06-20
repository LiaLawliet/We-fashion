@extends('layouts.master')

@section('content')
<div class="row">
    <div class="col-md-6">
        <h1><strong>title</strong> :{{$product->name}}</h1>
	    <p><strong>Genre :</strong>{{$product->genre->name?? 'aucun'}}</p>
        <p><strong>Date de création : </strong> : {{$product->created_at}}</p>
        <p><strong>Date de mise à jour : </strong> : {{$product->updated_at}}</p>
        <p><strong>Statut :</strong> {{$product->status}}</p>
        <h2>Les tailles disponibles :</h2>
        <ul>
        @forelse($product->sizes as $size)
            <li>{{$size->name}}</li>
        @empty
        aucune taille
        @endforelse
        </ul>
    </div>
    <div class="col-md-6">
    <h2><strong>Image</strong></h2>
    @if(!empty($product->picture))
        <div class="col-xs-6 col-md-3">
            <a href="#" class="thumbnail">
                @if ($product->genre_id === 1)
                <img style='height: 400px;object-fit: cover;' src="{{asset('/img/hommes/'.$product->picture)}}" alt="{{$product->name}}">
                @else
                <img style='height: 400px;object-fit: cover;' src="{{asset('/img/femmes/'.$product->picture)}}" alt="{{$product->name}}">
                @endif
            </a>
        </div>
    @endif
    </div>
</div>
@endsection 
