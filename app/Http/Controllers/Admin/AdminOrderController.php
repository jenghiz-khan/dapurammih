<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Transaction;
use App\Models\Transaction_detail;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class AdminOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Cancel Order!';
        $text = "This will remove data from database!";
        confirmDelete($title, $text);
        $orders = Order::where('payment_status', 'pending')->get();
        // dd($orders);
        return view('admin.order.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function transaction($orderId)
    {
        $order = Order::find($orderId);
        $total = $order->order_detail->sum('price');
        return view('admin.order.transaction', compact('order', 'total'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function transactionStore(Request $request, $orderId)
    {
        $transaction = new Transaction;
        $order = Order::find($orderId);
        // dd($order->order_detail);
        $transaction->customer_id = $order->customer_id;
        $transaction->order_code = $order->order_code;
        $transaction->payment_method = $request->payment_method;
        // dd($order->order_detail);
        // dd($order->order_detail);
        // $transaction->menu = $orderId;
        if($transaction->save()){
            foreach ($order->order_detail as $item) {
                $transaction_detail = new Transaction_detail;
                $transaction_detail->transaction_id = $transaction->id;
                $transaction_detail->menu = $item->menu->name;
                $transaction_detail->qty = $item->qty;
                $transaction_detail->price = $item->menu->price;
                $transaction_detail->total = $item->menu->price * $item->qty;
                $transaction_detail->save();
            }

            $order = Order::find($orderId);
            $order->payment_status = 'done';
            $order->save();

            Alert::toast('Successfully Inserted', 'success');
            return redirect()->route('admin.transaction.detail', $transaction->id);
        }

        Alert::toast('Something error', 'Error');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function cancelOrder(string $id)
    {
        $order = Order::find($id);
        if($order->delete()){
            Alert::toast('Successfully Deleted', 'success');
            return redirect()->route('admin.order');
        }
        Alert::toast('Something error', 'Error');
        return redirect()->back();
    }
}
