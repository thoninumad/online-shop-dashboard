@extends('layouts.global')

@section('title') Edit Order @endsection

@section('content')

<div class="row">
    <div class="col-md-8">
        @if(session('status'))
            <div class="alert alert-success">
                {{session('status')}}
            </div>
        @endif

        <form action="{{route('orders.update', ['id' => $order->id])}}" method="POST" class="shadow-sm p-3 bg-white">
            @csrf
            <input type="hidden" name="_method" value="PUT">

            <label for="invoice_number">Invoice Number</label>
            <input type="number" class="form-control" value="{{$order->invoice_number}}" disabled>
            <br>

            <label for="">Buyer</label><br>
            <input disabled class="form-control" type="text" value="{{$order->user->name}}">
            <br>

            <label for="created_at">Order Date</label><br>
            <input class="form-control" type="text" value="{{$order->created_at}}" disabled>
            <br>

            <label for="">Products ({{$order->totalQuantity}}) </label><br>
            <ul>
                @foreach($order->products as $product)
                    <li>{{$product->name}} <b>({{$product->pivot->quantity}})</b></li>
                @endforeach
            </ul>

            <label for="">Total Price</label><br>
            <input class="form-control" type="number" value="{{$order->total_price, 2}}" disabled>
            <br>

            <label for="status">Status</label><br>
            <select class="form-control" name="status" id="status">
                <option {{$order->status == "SUBMIT" ? "selected" : ""}} value="SUBMIT">SUBMIT</option>
                <option {{$order->status == "PROCESS" ? "selected" : ""}} value="PROCESS">PROCESS</option>
                <option {{$order->status == "FINISH" ? "selected" : ""}} value="FINISH">FINISH</option>
                <option {{$order->status == "CANCEL" ? "selected" : ""}} value="CANCEL">SCANCEL</option>
            </select>
            <br>

            <input type="submit" class="btn btn-primary" value="Update">
        </form>
    </div>
</div>

@endsection
