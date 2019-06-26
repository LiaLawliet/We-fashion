@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h1>Modifiez un produit :  </h1>
                <form action="{{route('product.update')}}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form">
                        <div class="form-group">
                            <label for="name"><h3>Nom:</h3></label>
                            <input type="text" name="name" value="{{old('name')}}" class="form-control" id="name" placeholder="Nom du produit">
                            @if($errors->has('name')) <span class="error text-danger">{{$errors->first('name')}}</span>@endif
                        </div>
                        <div class="form-group">
                            <label for="price"><h3>Prix:</h3></label>
                            <input type="text" name="price" value="{{old('price')}}" class="form-control" id="price" placeholder="Nom du produit">
                            @if($errors->has('price')) <span class="error text-danger">{{$errors->first('price')}}</span>@endif
                        </div>
                        <div class="form-group">
                            <label for="reference"><h3>Reference:</h3></label>
                            <input type="text" name="reference" value="{{old('reference')}}" class="form-control" id="reference" placeholder="Référence">
                            @if($errors->has('reference')) <span class="error text-danger">{{$errors->first('reference')}}</span>@endif
                        </div>
                        <div class="form-group">
                            <label for="price"><h3>Description :</h3></label>
                            <textarea type="text" name="description"class="form-control">{{old('description')}}</textarea>
                            @if($errors->has('description')) <span class="error text-danger">{{$errors->first('description')}}</span> @endif
                        </div>
                    </div>
                    @forelse($categories as $id => $name)
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="category_id" id="categories{{$id}}" {{ old('category_id')==$id? 'checked' : '' }} value="{{$id}}">
                            <label class="form-check-label" for="category{{$id}}">{{$name}}</label>
                        </div>
                    @empty
                    @endforelse
                    @if($errors->has('category_id')) <span class="alert-danger">{{$errors->first('category_id')}}</span>@endif
                    <h3>Choisissez un/des tailles</h3>
                    <div class="">
                        <div class="form-group">
                        @forelse($sizes as $id => $name)
                            <div class="form-check form-check-inline">
                                <input {{ ( !empty(old('sizes')) and in_array($id, old('sizes')) ) ? 'checked' : ''  }} class="form-check-input" type="checkbox" name="sizes[]" id="sizes{{$id}}" value="{{$id}}">
                                <label class="form-check-label" for="size{{$id}}">{{$name}}</label>
                            </div>
                        @empty
                        @endforelse
                        @if($errors->has('sizes')) <span class="alert-danger">{{$errors->first('sizes')}}</span>@endif
                        </div>
                    </div>
                </div><!-- #end col md 6 -->
                <div class="col-md-6">
                    <button type="submit" class="btn btn-primary">Ajouter un produit</button>
                    <div class="form-group custom-radio">
                        <h2>Status : </h2>
                        <input type="radio" name="status" value="published" @if(old('status') == 'published') checked @endif>
                        <label for="status">Publié</label>
                        <input type="radio" name="status" value="unpublished" @if(old('status') == 'unpublished') checked @endif>
                        <label for="status">Non publié</label>
                        @if($errors->has('status')) <span class="alert-danger">{{$errors->first('status')}}</span>@endif
                    </div>
                    <div class="form-group custom-radio">
                        <input type="radio" name="sales" value="onSales" @if(old('sales') == 'onSales') checked @endif>
                        <label for="sales">En solde</label>
                        <input type="radio" name="sales" value="standard" @if(old('sales') == 'standard') checked @endif>
                        <label for="sales">Standard</label>
                        @if($errors->has('sales')) <span class="alert-danger">{{$errors->first('sales')}}</span>@endif
                    </div>
                    <div class="imgInput">
                        <h2>Image : </h2>
                        <input id="picture" type="file" name="picture">
                        @if($errors->has('picture')) <span class="alert-danger">{{$errors->first('picture')}}</span>@endif
                    </div>
                </div><!-- #end col md 6 -->
            </form>
        </div>
@endsection
