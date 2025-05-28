<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Menu;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    //

    public function index() 
    {
        $menus = Menu::all();
        $categories = Category::all();
        $bestMenus = Menu::where('best_menu', 'true')->get();

        // dd($bestMenus);
        // if(count($bestMenus) > 0){
        //     dd($bestMenus);
        // }
        // dd('kosong');
        return view('index', compact('menus', 'bestMenus', 'categories'));
    }

    public function getMenu($id){
        $menu = Menu::find($id);
        return response()->json([
            'status' => 'success',
            'data' => $menu
        ]);
    }

    public function order(Request $request)
    {
        $cart = new Cart;
        $customer = new Customer;

        dd($request->all());

        $customer->name = $request->cust_name;
        $customer->phone = $request->phone;
        $customer->save();
        $cart_request = json_decode($request->cart);
        foreach ($cart_request as $item) {
            $cart->customer_id = $customer->id;
            $cart->menu_id = $item->id;
            $cart->qty = $item->qty;
            $cart->price = $item->price;
            $cart->save();
        }

        return redirect()->back();
    }

}
