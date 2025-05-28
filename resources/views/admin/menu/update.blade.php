@extends('admin.template.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="card w-full dark:bg-[#171F2F] shadow-2xl p-3 rounded-2xl">
    @if ($errors->any())
    <div class="bg-red-500 text-white rounded-lg w-fit px-3 py-1">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form action="{{route('menu.update', $menu->id)}}" method="post" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
            <div class="input-group">
                <label class="block py-2">Name: </label>
                <input type="text" name="name" value="{{$menu->name}}"
                    class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-200 bg-transparent py-2.5 pr-14 pl-3 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden xl:w-[430px] dark:border-gray-800 dark:bg-white/[0.03] dark:text-white/90 dark:placeholder:text-white/30">
            </div>
            <div class="input-group">
                <label class="block py-2">Category: </label>
                <select name="category" class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-200 bg-transparent py-2.5 pr-14 pl-3 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden xl:w-[430px] dark:border-gray-800 dark:bg-gray-800 dark:text-white/90 dark:placeholder:text-white/30">
                    @foreach ($categories as $category)
                        <option value="{{$category->id}}">{{$category->category}}</option>
                    @endforeach
                </select>
            </div>
            <div class="input-group">
                <label class="block py-2">Description: </label>
                <textarea name="desc" rows="5"
                    class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 rounded-lg border border-gray-200 bg-transparent py-2.5 pr-14 pl-3 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden xl:w-[430px] dark:border-gray-800 dark:bg-white/[0.03] dark:text-white/90 dark:placeholder:text-white/30">{{$menu->desc}}</textarea>
            </div>
            <div class="input-group">
                <label class="block py-2">Stock: </label>
                <input type="number" min="0" name="stock" value="{{$menu->stock}}"
                    class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-200 bg-transparent py-2.5 pr-14 pl-3 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden xl:w-[430px] dark:border-gray-800 dark:bg-white/[0.03] dark:text-white/90 dark:placeholder:text-white/30">
            </div>
            <div class="input-group">
                <label class="block py-2">Price: </label>
                <input type="text" name="price" value="{{$menu->price}}"
                    class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-200 bg-transparent py-2.5 pr-14 pl-3 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden xl:w-[430px] dark:border-gray-800 dark:bg-white/[0.03] dark:text-white/90 dark:placeholder:text-white/30">
            </div>
            <div class="input-group">
                <label class="block py-2">Image: </label>
                <input type="file" name="image"
                    class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 w-full rounded-lg border border-gray-200 bg-transparent py-2.5 pl-3 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden xl:w-[430px] dark:border-gray-800 dark:bg-white/[0.03] dark:text-white/90 dark:placeholder:text-white/30">
            </div>
        </div>
        <button class="rounded-lg my-2 bg-blue-500 text-gray-300 px-5 py-2">
            Submit
        </button>
    </form>
</div>
@endsection
