@extends('layouts.master')

@section('content')
<h1>Tous les produits</h1>
<div class="row">
	<div class="col-md-9">
		{{$products->links()}}
	</div>
	<div class="col-md-3">
		{{$nbproducts}} produit(s) dans la selection
	</div>
</div>
<div class="row">
@forelse($products as $product)
	<div class="col-md-4 col-xs-12">
		<a href="{{url('product', $product->id)}}">
			<div class="card" style="width: 90%; margin-bottom: 40px;">
				<img class="card-img-top" style='height: 400px;object-fit: cover;' src="{{asset('/img/'.$product->category_id.'/'.$product->picture)}}" alt="{{$product->name}}">
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
<div class="row">
	<div class="col-md-12">
		{{$products->links()}}
	</div>
</div>
@endsection 

