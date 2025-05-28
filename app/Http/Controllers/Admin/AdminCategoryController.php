<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;

class AdminCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Delete Data!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);
        $categories = Category::all();
        return view('admin.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category' => 'required',
        ]);

        $category = new Category;
        $category->category = $request->category;
        $category->desc = $request->desc;
        if($category->save()){
            Alert::toast('Successfully Inserted', 'success');
            return redirect()->route('category.index');
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
        $category = Category::find($id);
        return view('admin.category.update', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'category' => 'required',
        ]);

        $category = Category::find($id);
        $category->category = $request->category;
        $category->desc = $request->desc;
        if($category->save()){
            Alert::toast('Successfully Updated', 'success');
            return redirect()->route('category.index');
        }
        
        Alert::toast('Something error', 'Error');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::find($id);
        if($category->delete()){
            Alert::toast('Successfully Deleted', 'success');
            return redirect()->route('category.index');
        }
        Alert::toast('Something error', 'Error');
        return redirect()->back();
    }
}
