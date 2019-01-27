@extends('layouts.global')

@section('title') Detail Product @endsection

@section('content')

<div class="col-md-8">
    <div class="card">
        <div class="card-body">
            <label><b>Product Name</b></label><br>
            {{$product->name}}
            <br><br>

            <label><b>Product Slug</b></label><br>
            {{$product->slug}}
            <br><br>

            <label><b>Product Image</b></label><br>
            @if($product->image)
                <img src="{{asset('storage/'.$product->image)}}" width="120px">
            @endif
            <br><br>

            <label><b>Product Description</b></label><br>
            {{$product->description}}
            <br><br>

            <label><b>Product Producer</b></label><br>
            {{$product->producer}}
            <br><br>

            <label><b>Product Categories</b></label><br>
            <ul class="pl-3">
            @foreach($product->categories as $category)
                <li>{{$category->name}}</li>
            @endforeach
            </ul>
            <br>

            <label><b>Product Stock</b></label><br>
            {{$product->stock}}
            <br><br>

            <label><b>Product Price</b></label><br>
            Rp. {{number_format($product->price, 2)}}
            <br><br>

            <label><b>Product Weight</b></label><br>
            {{$product->weight}} kg

        </div>
    </div>
</div>

@endsection
