@extends('layouts.master')

@section('content')
<article class="row">
    <div class="col-md-12">
    @if(count($book)>0)
    <h1>{{$book->title}}</h1>
    @if(count($book->picture) > 0)
        <div class="col-xs-6 col-md-12">
            <a href="#" class="thumbnail">
            <img src="{{asset('images/'.$book->picture->link)}}" alt="{{$book->picture->title}}">
            </a>
        </div>
    @endif
    <h2>Description :</h2>
    {{$book->description}}    
    <h3>Auteur(s) :</h3>
    <ul>
        @forelse($book->authors as $author)
        <li >{{$author->name}}</li>
        @empty
        <li>Aucun auteur</li>
        @endforelse
    </ul>
    @else 
    <h1>Désolé aucun article</h1>
    @endif 
 </li>
    </div>
</article>

</ul>
@endsection 

