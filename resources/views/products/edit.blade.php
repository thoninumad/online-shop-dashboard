@extends('layouts.global')

@section('title') Edit Product @endsection

@section('select2-css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet"/>
@endsection

@section('content')

<div class="row">
    <div class="col-md-8">
        @if(session('status'))
            <div class="alert alert-success">
                {{session('status')}}
            </div>
        @endif

        <form action="{{route('products.update', ['id' => $product->id])}}" method="POST" enctype="multipart/form-data" class="shadow-sm p-3 bg-white">
            @csrf
            <input type="hidden" name="_method" value="PUT">

            <label for="name">Name</label><br>
            <input type="text" class="form-control {{$errors->first('name') ? "is-invalid" : ""}}" name="name" placeholder="Product Name" value="{{old('name') ? old('name') : $product->name}}">
            <div class="invalid-feedback">
                {{$errors->first('name')}}
            </div>
            <br>

            <label for="image">Image</label><br>
            <small class="text-muted">Current Image</small><br>
            @if($product->image)
                <img src="{{asset('storage/'.$product->image)}}" width="96px"/>
            @endif
            <br><br>
            <input type="file" class="form-control" name="image">
            <small class="text-muted">Kosongkan jika tidak ingin mengubah</small>
            <br><br>

            <label for="slug">Slug</label><br>
            <input type="text" class="form-control {{$errors->first('slug') ? "is-invalid" : ""}}" name="slug" placeholder="enter-a-slug" value="{{old('slug') ? old('slug') : $product->slug}}">
            <div class="invalid-feedback">
                {{$errors->first('slug')}}
            </div>
            <br>

            <label for="description">Description</label><br>
            <textarea name="description" id="description" class="form-control {{$errors->first('description') ? "is-invalid" : ""}}">{{old('description') ? old('description') : $product->description}}</textarea>
            <div class="invalid-feedback">
                {{$errors->first('description')}}
            </div>
            <br>

            <label for="producer">Producer</label><br>
            <input type="text" value="{{old('producer') ? old('producer') : $product->producer}}" class="form-control {{$errors->first('producer') ? "is-invalid" : ""}}" name="producer" placeholder="Product Producer">
            <div class="invalid-feedback">
                {{$errors->first('producer')}}
            </div>
            <br>

            <label for="categories">Categories</label><br>
            <select name="categories[]" multiple id="categories" class="form-control {{$errors->first('categories') ? "is-invalid" : ""}}"></select>
            <div class="invalid-feedback">
                {{$errors->first('categories')}}
            </div>
            <br><br>

            <label for="stock">Stock</label><br>
            <input type="number" class="form-control {{$errors->first('stock') ? "is-invalid" : ""}}" name="stock" id="stock" placeholder="Product Stock" value="{{old('stock') ? old('stock') : $product->stock}}">
            <div class="invalid-feedback">
                {{$errors->first('stock')}}
            </div>
            <br>

            <label for="price">Price</label><br>
            <input type="number" class="form-control {{$errors->first('price') ? "is-invalid" : ""}}" name="price" id="price" placeholder="Product Price" value="{{old('price') ? old('price') : $product->price}}">
            <div class="invalid-feedback">
                {{$errors->first('price')}}
            </div>
            <br>

            <label for="weight">Weight (kg)</label><br>
            <input type="number" value="{{old('weight') ? old('weight') : $product->weight}}" class="form-control {{$errors->first('weight') ? "is-invalid" : ""}}" name="weight" id="weight" placeholder="Product Weight">
            <div class="invalid-feedback">
                {{$errors->first('weight')}}
            </div>
            <br>


            <label for="status">Status</label>
            <select name="status" id="status" class="form-control">
                <option {{$product->status == 'PUBLISH' ? 'selected' : ''}} value="PUBLISH">PUBLISH</option>
                <option {{$product->status == 'DRAFT' ? 'selected' : ''}} value="DRAFT">DRAFT</option>
            </select>
            <br>

            <button class="btn btn-primary" value="PUBLISH">Update</button>
        </form>
    </div>
</div>

@endsection

@section('select2-js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

<script>
$("#categories").select2({
    ajax: {
        url: "{{route('categories.search')}}",
        processResults: function(data){
            return {
                results: data.map(function(item){
                    return {id: item.id, text:item.name}
                })
            }
        }
    }
});

var categories = {!! $product->categories !!}

categories.forEach(function(category) {
    var option = new Option(category.name, category.id, true, true);
    $('#categories').append(option).trigger('change');
});
</script>

@endsection
