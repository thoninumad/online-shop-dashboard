<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title></title>
    </head>
    <body>

        <h2>Selamat, Pesanan Anda Telah Sampai</h2>

        <hr class="my-3">

        <strong>Buyer</strong>           : {{$order->user->name}} <br>
        <strong>Order ID</strong>        : {{$order->id}} <br>
        <strong>Invoice Number</strong>  : {{$order->invoice_number}} <br>
        <strong>Total Bill</strong>      : Rp. {{number_format($order->total_bill, 2, ",", ".")}} <br>
        <strong>Courier Service</strong> : {{$order->courier_service}} <br>
        <strong>Receipt Number</strong> : {{$order->receipt_number}} <br>
        <strong>Order Status</strong>    : {{$order->status}} <br>

        <hr class="my-3">

        <h3>Detail Order</h3>
        Products ({{$order->totalQuantity}} items) <br>
        <ul>
            @foreach($order->products as $product)
                <li>{{$product->name}} <b>({{$product->pivot->quantity}} items)</b></li>
            @endforeach
        </ul>

        <hr class="my-3">

        Terima kasih telah berbelanja di PIPPO. <br>
        Sampaikan ulasan, saran, dan kritik Anda di kolom balasan email ini demi kebaikan PIPPO ke depan. <br><br>

        Terima kasih. <br><br><br>


        PIPPO LBMM ITS
    </body>
</html>
