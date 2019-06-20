@extends('layouts.master')

@section('content')
<h1>Tous les produits ({{$nbproducts}})</h1>
	<div class="row">
	@forelse($products as $product)
		<div class="col-md-4 col-xs-12">
			<a href="{{url('product', $product->id)}}">
				<div class="card" style="width: 90%; margin-bottom: 40px;">
					@if ($product->genre_id === 1)
					<img class="card-img-top" style='height: 400px;object-fit: cover;' src="{{asset('/img/hommes/'.$product->picture)}}" alt="{{$product->name}}">
					@else
					<img class="card-img-top" style='height: 400px;object-fit: cover;' src="{{asset('/img/femmes/'.$product->picture)}}" alt="{{$product->name}}">
					@endif
					<div class="card-body">
						<h5 class="card-title">{{$product->name}}</h5>
						<p class="card-text">{{$product->price}} €</p>
					</div>
				</div>
			</a>
		</div>
	@empty
	<span>Désolé pour l'instant aucun produit n'est publié sur le site</span>
	@endforelse
	</div>
@endsection 

