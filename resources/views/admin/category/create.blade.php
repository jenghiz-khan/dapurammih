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
    <form action="{{route('category.store')}}" method="post">
        @csrf
        <div class="input-group">
            <label class="block py-2">Category Name: </label>
            <input type="text" name="category"
                class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-200 bg-transparent py-2.5 pr-14 pl-3 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden xl:w-[430px] dark:border-gray-800 dark:bg-white/[0.03] dark:text-white/90 dark:placeholder:text-white/30">
        </div>
        <div class="input-group">
            <label class="block py-2">Description: </label>
            <textarea name="desc" rows="5"
                class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 rounded-lg border border-gray-200 bg-transparent py-2.5 pr-14 pl-3 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden xl:w-[430px] dark:border-gray-800 dark:bg-white/[0.03] dark:text-white/90 dark:placeholder:text-white/30"></textarea>
        </div>
        <button class="rounded-lg my-2 bg-blue-500 text-gray-300 px-5 py-2">
            Submit
        </button>
    </form>
</div>
@endsection
