@extends('layouts.global')

@section('title') Orders List @endsection

@section('content')

<form action="{{route('orders.index')}}">
    <div class="row">
        <div class="col-md-5">
            <input value="{{Request::get('buyer_email')}}" name="buyer_email" type="text" class="form-control" placeholder="Search by buyer email">
        </div>
        <div class="col-md-2">
            <select name="status" class="form-control" id="status">
                <option value="">ANY</option>
                <option {{Request::get('status') == "SUBMIT" ? "selected" : ""}} value="SUBMIT">SUBMIT</option>
                <option {{Request::get('status') == "PENDING" ? "selected" : ""}} value="PENDING">PENDING</option>
                <option {{Request::get('status') == "PROCESS" ? "selected" : ""}} value="PROCESS">PROCESS</option>
                <option {{Request::get('status') == "FINISH" ? "selected" : ""}} value="FINISH">FINISH</option>
                <option {{Request::get('status') == "CANCEL" ? "selected" : ""}} value="CANCEL">CANCEL</option>
            </select>
        </div>
        <div class="col-md-2">
            <input type="submit" value="Filter" class="btn" style="background-color:#bd1544;color:#fff;">
        </div>
    </div>
</form>

<hr class="my-3">

<div class="row">
    <div class="table-responsive">
        <table class="table table-stripped table-bordered">
            <thead>
                <tr>
                    <th><b>Invoice Number</b></th>
                    <th><b>Status</b></th>
                    <th><b>Buyer</b></th>
                    <th><b>Total Quantity</b></th>
                    <th><b>Order Date</b></th>
                    <th><b>Total Bill</b></th>
                    <th><b>Action</b></th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td>{{$order->invoice_number}}</td>
                        <td>
                            @if($order->status == "SUBMIT")
                                <span class="badge bg-danger text-light">{{$order->status}}</span>
                            @elseif($order->status == "PENDING")
                                <span class="badge bg-warning text-light">{{$order->status}}</span>
                            @elseif($order->status == "PROCESS")
                                <span class="badge bg-info text-light">{{$order->status}}</span>
                            @elseif($order->status == "FINISH")
                                <span class="badge bg-success text-light">{{$order->status}}</span>
                            @elseif($order->status == "CANCEL")
                                <span class="badge bg-dark text-light">{{$order->status}}</span>
                            @endif
                        </td>
                        <td>
                            {{$order->user->name}} <br>
                            <small>{{$order->user->email}}</small>
                        </td>
                        <td>{{$order->totalQuantity}} pc (s)</td>
                        <td>{{$order->created_at}}</td>
                        <td>{{number_format($order->total_bill, 2)}}</td>
                        <td>
                            <a href="{{route('orders.edit', ['id' => $order->id])}}" class="btn btn-info btn-sm">Edit</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="10">{{$orders->appends(Request::all())->links()}}</td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

@endsection
