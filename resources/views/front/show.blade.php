@extends('layouts.master')

@section('content')
<article class="row">
    <div class="col-md-12">
    @if(count($product)>0)
    <h1>{{$product->title}}</h1>
    @if(count($product->picture) > 0)
        <div class="col-xs-12 col-md-6">
            <a href="#" class="thumbnail">
                <img class="" src="{{asset('/img/'.$product->category_id.'/'.$product->picture)}}" alt="{{$product->name}}">
            </a>
        </div>
    @endif
    <h2>Description :</h2>
    {{$product->description}}    
    <h3>Prix :</h3>
    {{$product->price}} €
    <h3>Taille :</h3>
    <select name="" id=""></select>
        @foreach($product->sizes as $size)
        <option value="">{{$size->name}}</option>
        @endforeach
    </select>
    @else 
    <h1>Désolé aucun article</h1>
    @endif 
 </li>
    </div>
</article>

</ul>
@endsection 

