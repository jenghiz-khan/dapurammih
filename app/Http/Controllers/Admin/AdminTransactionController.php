<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class AdminTransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::all();
        return view('admin.transaction.index', compact('transactions'));
    }

    public function detail($id)
    {
        $transaction = Transaction::find($id);
        $total = $transaction->order->order_detail->sum('price');
        // dd($transaction->order_code);
        return view('admin.transaction.invoice', compact('transaction', 'total'));
    }
}
