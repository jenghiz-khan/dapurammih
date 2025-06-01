<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Order;
use App\Models\Transaction;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function index()
    {
        $transaction = Transaction::all()->count();
        $menu = Menu::all()->count();
        $order = Order::where('payment_status', 'pending')->get()->count();
        return view('admin.dashboard', compact('transaction', 'menu', 'order'));
    }

}
