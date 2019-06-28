@extends('layouts.master')

@section('content')
<p><button data-toggle="modal" onclick="createData()" data-target="#CreateModal" class="btn btn-primary" type="submit">Ajouter une catégorie</button></p>
<table class="table table-striped">
    <thead>
        <tr>
            <th style='width:70%;'>Nom</th>
            <th>Modifier</th>
            <th>Supprimer</th>
        </tr>
    </thead>
    <tbody>
    @forelse($categories as $category)
        <tr>
            <td>{{$category->name}}</td>
            <td>
                <button data-toggle="modal" data-target="#EditModal" onclick="editData({{$category->id}},'{{$category->name}}')" class="btn btn-primary" href="{{route('categories.edit', $category->id)}}">Modifier</button>
            </td>
            <td>
                <button data-toggle="modal" onclick="deleteData({{$category->id}})" data-target="#DeleteModal" class="btn btn-danger" type="submit">Supprimer</button>
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
                </div>
                <div class="modal-body">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <p class="text-center">Etes vous sûr de vouloir supprimer cette catégorie ?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal">Annuler</button>
                    <button type="submit" name="" class="btn btn-danger" data-dismiss="modal" onclick="deleteSubmit()">Oui, supprimer</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div id="EditModal" class="modal fade text-danger" role="dialog">
    <div class="modal-dialog ">
        <!-- Modal content-->
        <form action="" id="editForm" method="post">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <input type="text" name="name" class="form-control" id="editName" placeholder="Nom de la catégorie">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                    <button type="submit" name="" class="btn btn-primary" data-dismiss="modal" onclick="editSubmit()">Modifier</button>
                </div>
            </div>
        </form>
    </div>
</div>


<div id="CreateModal" class="modal fade text-danger" role="dialog">
    <div class="modal-dialog ">
        <!-- Modal content-->
        <form action="" id="createForm" method="post">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    {{ csrf_field() }}
                    {{ method_field('POST') }}
                    <input type="text" name="name" class="form-control" id="createName" placeholder="Nom de la catégorie">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                    <button type="submit" name="" class="btn btn-primary" data-dismiss="modal" onclick="createSubmit()">Ajouter</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript">

    function deleteData(id)
    {
        var id = id;
        var url = '{{ route("categories.destroy", ":id") }}';
        url = url.replace(':id', id);
        $("#deleteForm").attr('action', url);
    }
    function deleteSubmit()
    {
        $("#deleteForm").submit();
    }


    
    function editData(id,name)
    {
        var id = id;
        var url = '{{ route("categories.update", ":id") }}';
        url = url.replace(':id', id);
        $('#editName').val(name);
        $("#editForm").attr('action', url);
    }
    function editSubmit()
    {
        $("#editForm").submit();
    }


    function createData()
    {
        var url = '{{ route("categories.store", ":id") }}';
        $("#createForm").attr('action', url);
    }
    function createSubmit()
    {
        $("#createForm").submit();
    }
</script>
{{$categories->links()}}
@endsection 