<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class AdminMenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Delete Data!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);
        $menus = Menu::all();
        return view('admin.menu.index', compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.menu.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'category' => 'required',
            'stock' => 'required',
            'price' => 'required',
            'image' => 'required|mimes:jpg,bmp,png',
        ]);

        $menu = new Menu;
        $menu->name = $request->name;
        $menu->category_id = $request->category;
        $menu->desc = $request->desc;
        $menu->stock = $request->stock;
        $menu->price = $request->price;
        $path = $request->file('image')->store('menu_img');
        $menu->image = $path;

        if($menu->save()){
            Alert::toast('Successfully Inserted', 'success');
            return redirect()->route('menu.index');
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
        $categories = Category::all();
        $menu = Menu::find($id);
        return view('admin.menu.update', compact('categories', 'menu'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name' => 'required',
            'category' => 'required',
            'stock' => 'required',
            'price' => 'required',
            'image' => 'mimes:jpg,bmp,png',
        ]);

        $menu = Menu::find($id);
        $menu->name = $request->name;
        $menu->category_id = $request->category;
        $menu->desc = $request->desc;
        $menu->stock = $request->stock;
        $menu->price = $request->price;
        if($request->file('image')){
            $path = $request->file('image')->store('menu_img');
            $menu->image = $path;
        }
        // dd('gak ada');

        if($menu->save()){
            Alert::toast('Successfully Inserted', 'success');
            return redirect()->route('menu.index');
        }

        Alert::toast('Something error', 'Error');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $menu = Menu::find($id);
        if($menu){
            Storage::delete($menu->image);
            $menu->delete();
            Alert::toast('Successfully Deleted', 'success');
            return redirect()->back();
        }else{
            Alert::toast('Something error', 'error');
            return redirect()->back();
        }
    }

    public function bestMenu(Request $request, $id)
    {
        $menu = Menu::find($id);
        $menu->best_menu = $request->best_menu;
        $menu->save();
        return response()->json([
            'success' => true,
            'saved_value' => $menu->best_menu,
        ]);
        // dd($request->best_menu);
    }
}
