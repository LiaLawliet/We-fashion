@extends('layouts.master')

@section('content')
<h1>Tous les produits</h1>
	<div class="row">
	@forelse($products as $product)
		<div class="col-md-3">
			<a href="{{url('product', $product->id)}}">
				<div class="card" style="width: 90%;">
					@if ($product->genre_id === 1)
					<img class="card-img-top" src="{{asset('/img/hommes/'.$product->picture)}}" alt="Card image cap">
					@else
					<img class="card-img-top" src="{{asset('/img/femmes/'.$product->picture)}}" alt="Card image cap">
					@endif
					<div class="card-body">
						<h5 class="card-title">{{$product->name}}</h5>
						<p class="card-text">price €</p>
					</div>
				</div>
			</a>
		</div>
	@empty
	<span>Désolé pour l'instant aucun produit n'est publié sur le site</span>
	@endforelse
	</div>
@endsection 

