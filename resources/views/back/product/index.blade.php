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
            <th>Modifier</th>
            <th>Supprimer</th>
        </tr>
    </thead>
    <tbody>
    @forelse($products as $product)
        <tr>
            <td>{{$product->name}}</td>
	        <td>{{$product->category->name?? 'aucune category' }}</td>
            <td>{{$product->price}} €</td>
            <td>{{$product->status}}</td>
            <td>
                <a class="btn btn-secondary" href="{{route('product.show', $product->id)}}"><span aria-hidden="true">Détails</span></a>
            </td>
            <td>
                <a class="btn btn-primary" href="{{route('product.edit', $product->id)}}"><span aria-hidden="true">Modifier</span></a>
            </td>
            <td><a class='btn btn-danger'>Supprimer</a></td>
        </tr>
    @empty
        aucun produit ...
    @endforelse
    </tbody>
</table>
{{$products->links()}}
@endsection 
