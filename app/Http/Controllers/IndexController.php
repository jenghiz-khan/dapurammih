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
        $menus = $categoryId ? Menu::where([
            ['category_id', '=' ,$categoryId],
            ['stock', '>' , 0]
        ])->get() : Menu::where('stock', '>', 0)->get();
        $categories = Category::all();
        $bestMenus = Menu::where([
            ['best_menu', '=' ,'true'],
            ['stock', '>' , 0]
        ])->get();

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
            'cart' => ['required', function ($attribute, $value, $fail) {
                        $items = json_decode($value, true);
                        if (!is_array($items) || empty($items)) {
                            $fail('The cart cannot be empty.');
                        }
                    }],
        ]);

        // dd($request->all());

        $cart_request = json_decode($request->cart);

        foreach ($cart_request as $item) {
            $menu = Menu::find($item->id);
            $is_stock_sufficient = $menu->stock - $item->quantity < 0 ? true : false;
            if($is_stock_sufficient){
                // stok habis
                return redirect()->back()->withErrors(['msg' => $menu->name . ' is out of stock']);
            }
            // Stok cukup
            // $menu->stock = $menu->stock - $item->quantity;
            // $menu->save();
        }

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

        foreach ($cart_request as $item) {
            $order_detail = new Order_detail;
            $order_detail->order_id = $order->id;
            $order_detail->menu_id = $item->id;
            $order_detail->qty = $item->quantity;
            $order_detail->price = $item->price * $item->quantity;
            $order_detail->notes = $item->notes;
            if($order_detail->save()){
                $menu->stock = $menu->stock - $item->quantity;
                $menu->save();
            }
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
