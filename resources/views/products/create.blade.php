@extends('layouts.global')

@section('title') Create Product @endsection

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

        <form action="{{route('products.store')}}" method="POST" enctype="multipart/form-data" class="shadow-sm p-3 bg-white">
            @csrf

            <label for="name">Name</label><br>
            <input type="text" value="{{old('name')}}" class="form-control {{$errors->first('name') ? "is-invalid" : ""}}" name="name" placeholder="Product Name">
            <div class="invalid-feedback">
                {{$errors->first('name')}}
            </div>
            <br>

            <label for="image">Image</label><br>
            <input type="file" class="form-control {{$errors->first('image') ? "is-invalid" : ""}}" name="image">
            <div class="invalid-feedback">
                {{$errors->first('image')}}
            </div>
            <br>

            <label for="description">Description</label><br>
            <textarea name="description" id="description" class="form-control {{$errors->first('description') ? "is-invalid" : ""}}" placeholder="Give a description about this product">{{old('description')}}</textarea>
            <div class="invalid-feedback">
                {{$errors->first('description')}}
            </div>
            <br>

            <label for="producer">Producer</label><br>
            <input type="text" value="{{old('producer')}}" class="form-control {{$errors->first('producer') ? "is-invalid" : ""}}" name="producer" placeholder="Product Producer">
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
            <input type="number" class="form-control {{$errors->first('stock') ? "is-invalid" : ""}}" name="stock" id="stock" min="0" value="{{old('stock') ? old('stock') : 0}}">
            <div class="invalid-feedback">
                {{$errors->first('stock')}}
            </div>
            <br>

            <label for="price">Price</label><br>
            <input type="number" value="{{old('price')}}" class="form-control {{$errors->first('price') ? "is-invalid" : ""}}" name="price" id="price" placeholder="Product Price">
            <div class="invalid-feedback">
                {{$errors->first('price')}}
            </div>
            <br>

            <label for="weight">Weight (kg)</label><br>
            <input type="number" value="{{old('weight')}}" class="form-control {{$errors->first('weight') ? "is-invalid" : ""}}" name="weight" id="weight" placeholder="Product Weight">
            <div class="invalid-feedback">
                {{$errors->first('weight')}}
            </div>
            <br>

            <button class="btn btn-primary" name="save_action" value="PUBLISH">Publish</button>
            <button class="btn btn-secondary" name="save_action" value="DRAFT">Save as draft</button>
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
</script>

@endsection
