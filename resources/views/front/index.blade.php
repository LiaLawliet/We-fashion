@extends('layouts.master')

@section('content')
<h1>Tous les produits</h1>
	@forelse($products as $product)
	<div class="row">
		<div class="col-xs-12 col-md-3">
			<h2><a href="{{url('product', $product->id)}}">{{$product->name}}</a></h2>
		</div>
	</div>
	@empty
	<span>Désolé pour l'instant aucun produit n'est publié sur le site</span>
	@endforelse
@endsection 

