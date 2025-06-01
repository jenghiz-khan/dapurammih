<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Menu;
use App\Models\Order;
use App\Models\Order_detail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    //

    public function index($categoryId = '') 
    {
        // dd($categoryId);
        $menus = $categoryId ? Menu::where('category_id', $categoryId)->get() : Menu::all();;
        $categories = Category::all();
        $bestMenus = Menu::where('best_menu', 'true')->get();

        return view('index', compact('menus', 'bestMenus', 'categories'));
    }

    public function getMenu($id){
        $menu = Menu::find($id);
        return response()->json([
            'status' => 'success',
            'data' => $menu
        ]);
    }

    public function cart(Request $request)
    {
        $validated = $request->validate([
            'cust_name' => 'required',
            'phone' => 'required',
            'cart' => 'required',
        ]);

        $customer = new Customer;
        $order = new Order;
        // $order_detail = new Order_detail;


        $customer->name = $request->cust_name;
        $customer->phone = $request->phone;
        $customer->save();

        $order->order_code = "PSN-" . rand(1000, 9999);
        $order->user_id = Auth::check() ? Auth::user()->id : null;
        $order->customer_id = $customer->id;
        $order->payment_status = 'pending';
        $order->save();

        $cart_request = json_decode($request->cart);
        foreach ($cart_request as $item) {
            $order_detail = new Order_detail;
            $order_detail->order_id = $order->id;
            $order_detail->menu_id = $item->id;
            $order_detail->qty = $item->quantity;
            $order_detail->price = $item->price * $item->quantity;
            $order_detail->notes = $item->notes;
            $order_detail->save();
        }

        // if($request->pay_method == 'cash'){
        //     return redirect()->route('home.order', $customer->id);
        // }
        // return redirect()->route('home.order.qris', $customer->id);
        return redirect()->route('home.order', $customer->id);
    }

    public function order($customerId)
    {
        $customer = Customer::find($customerId);
        $total = $customer->order->order_detail->sum('price');
        return view('checkout', compact('customer', 'total'));
    }

    public function qris($customerId)
    {
        $customer = Customer::find($customerId);
        return view('qris');
        // dd($customerId);
    }

}
