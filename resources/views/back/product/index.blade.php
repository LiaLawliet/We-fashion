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
            <td>
            <button data-toggle="modal" onclick="deleteData({{$product->id}})" data-target="#DeleteModal" class="btn btn-danger" type="submit">Supprimer</button>
                <!-- <form class="delete" method="POST" action="{{route('product.destroy', $product->id)}}">
                    {{csrf_field()}}
                    {{method_field('DELETE')}}
                    <input data-toggle="modal" onclick="deleteData({{$product->id}})" 
data-target="#DeleteModal" class="btn btn-danger" type="submit" value="Supprimer"/>
                </form> -->
            </td>
        </tr>
    @empty
        aucun produit ...
    @endforelse
    </tbody>
</table>
<div id="DeleteModal" class="modal fade text-danger" role="dialog">
   <div class="modal-dialog ">
     <!-- Modal content-->
     <form action="" id="deleteForm" method="post">
         <div class="modal-content">
             <div class="modal-header bg-danger">
                 <button type="button" class="close" data-dismiss="modal">&times;</button>
                 <h4 class="modal-title text-center">CONFIRMATION DE LA SUPPRESSION</h4>
             </div>
             <div class="modal-body">
                 {{ csrf_field() }}
                 {{ method_field('DELETE') }}
                 <p class="text-center">Etes vous sûr de vouloir supprimer ce produit ?</p>
             </div>
             <div class="modal-footer">
                 <center>
                     <button type="button" class="btn btn-success" data-dismiss="modal">Annuler</button>
                     <button type="submit" name="" class="btn btn-danger" data-dismiss="modal" onclick="formSubmit()">Oui, supprimer</button>
                 </center>
             </div>
         </div>
     </form>
   </div>
  </div>
  <script type="text/javascript">
     function deleteData(id)
     {
         var id = id;
         var url = '{{ route("product.destroy", ":id") }}';
         url = url.replace(':id', id);
         $("#deleteForm").attr('action', url);
     }

     function formSubmit()
     {
         $("#deleteForm").submit();
     }
  </script>
{{$products->links()}}
@endsection 
