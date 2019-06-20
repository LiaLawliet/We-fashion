@extends('layouts.master')

@section('content')
<p><a href="{{route('product.create')}}"><button type="button" class="btn btn-primary btn-lg">Ajouter un livre</button></a></p>
{{$products->links()}}
<table class="table table-striped">
    <thead>
        <tr>
            <th>Nom</th>
            <th>Genre</th>
            <th>Prix</th>
            <th>Statut</th>
            <th>Détail</th>
            <th>Supprimer</th>
        </tr>
    </thead>
    <tbody>
    @forelse($products as $product)
        <tr>
            <td>{{$product->name}}</td>
	        <td>{{$product->genre->name?? 'aucun genre' }}</td>
            <td>{{$product->price}} €</td>
            <td>{{$product->status}}</td>
            <td>
                <a href="{{route('product.show', $product->id)}}"><span class="glyphicon glyphicon-eye-open" aria-hidden="true">SHOW</span></a>
            </td>
            <td><button class='btn btn-danger'>Supprimer</button></td>
        </tr>
    @empty
        aucun produit ...
    @endforelse
    </tbody>
</table>
{{$products->links()}}
@endsection 
