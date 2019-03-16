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

            <label for="">Total Bill</label><br>
            <input class="form-control" type="number" value="{{$order->total_bill}}" disabled>
            <br>

            <label for="">Courier Service</label><br>
            <input disabled class="form-control" type="text" value="{{$order->courier_service}}">
            <br>

            <label for="payment_evidence">Payment Evidence</label><br>
            @if($order->payment_evidence)
                <img src="{{asset('storage/'.$order->payment_evidence)}}" width="300px" class="img-responsive"/>
            @else
                <small class="text-muted">No upload</small>
            @endif
            <br><br>

            @if($order->payment_evidence && $order->status!="SUBMIT")
            <label for="receipt_number">Receipt Number</label>
            <input type="number" name="receipt_number" class="form-control" value="{{$order->receipt_number}}" {{$order->status == "FINISH" ? "disabled" : ""}}>
            <br>
            @endif

            <label for="status">Status</label><br>
            <select class="form-control" name="status" id="status">
                <option {{$order->status == "SUBMIT" ? "selected" : ""}} value="SUBMIT">SUBMIT</option>
                <option {{$order->status == "PENDING" ? "selected" : ""}} value="PENDING">PENDING</option>
                <option {{$order->status == "PROCESS" ? "selected" : ""}} value="PROCESS">PROCESS</option>
                <option {{$order->status == "FINISH" ? "selected" : ""}} value="FINISH">FINISH</option>
                <option {{$order->status == "CANCEL" ? "selected" : ""}} value="CANCEL">CANCEL</option>
            </select>
            <br>

            <input type="submit" class="btn btn-primary" value="Update">
        </form>
    </div>
</div>

@endsection
