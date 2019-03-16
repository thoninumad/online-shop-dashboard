<?php

namespace App\Http\Controllers;

use Mail;
use App\Mail\OrderShipped;
use App\Mail\OrderFinished;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class OrderController extends Controller
{

    public function __construct() {
        $this->middleware(function($request, $next) {
            if(Gate::allows('manage-orders')) return $next($request);

            abort(403, 'Anda tidak memiliki cukup hak akses');
        });
    }

    public function index(Request $request)
    {
        $status = $request->get('status');
        $buyer_email = $request->get('buyer_email');

        $orders = \App\Order::with('user')
        ->with('products')
        ->whereHas('user', function($query) use ($buyer_email) {
            $query->where('email', 'LIKE', "%$buyer_email%");
        })
        ->where('status', 'LIKE', "%$status%")
        ->orderBy('id', 'DESC')
        ->paginate(10);
        return view('orders.index', ['orders' => $orders]);
    }

    public function edit($id)
    {
        $order = \App\Order::findOrFail($id);
        return view('orders.edit', ['order' => $order]);
    }

    public function update(Request $request, $id)
    {
        $order = \App\Order::findOrFail($id);

        $order->status = $request->get('status');
        $order->receipt_number = $request->get('receipt_number');
        $order->save();

        if($order->receipt_number!='' AND $order->status=='PROCESS') {
            Mail::to($order->user->email)->send(new OrderShipped($order));
        } else if($order->status=='FINISH') {
            Mail::to($order->user->email)->send(new OrderFinished($order));
        }

        return redirect()->route('orders.edit', ['id' => $order->id])->with('status', 'Order status successfully updated');
    }

}
