@extends('admin.template.app')

@section('title', 'Admin Dashboard')

@section('content')
<a href="{{route('menu.create')}}"
    class="rounded-full bg-green-500 text-gray-300 px-3 py-2 block my-2 w-fit text-center">Tambah Data</a>
<div class="w-full overflow-x-auto dark:text-white/90">
    <table id="categoryTable" class="min-w-full">
        <!-- table header start -->
        <thead>
            <tr class="border-gray-100 border-y dark:border-gray-800">
                <th class="py-3">
                    <div class="flex items-center">
                        <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                            Name
                        </p>
                    </div>
                </th>
                <th class="py-3">
                    <div class="flex items-center col-span-2">
                        <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                            Category
                        </p>
                    </div>
                </th>
                <th class="py-3">
                    <div class="flex items-center col-span-2">
                        <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                            Description
                        </p>
                    </div>
                </th>
                <th class="py-3">
                    <div class="flex items-center col-span-2">
                        <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                            Stock
                        </p>
                    </div>
                </th>
                <th class="py-3">
                    <div class="flex items-center col-span-2">
                        <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                            Price
                        </p>
                    </div>
                </th>
                <th class="py-3">
                    <div class="flex items-center col-span-2">
                        <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                            Best Menu
                        </p>
                    </div>
                </th>
                <th class="py-3">
                    <div class="flex items-center col-span-2">
                        <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                            Image
                        </p>
                    </div>
                </th>
                <th class="py-3">
                    <div class="flex items-center col-span-2">
                        <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                            Action
                        </p>
                    </div>
                </th>
            </tr>
        </thead>
        <!-- table header end -->

        <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
            @foreach ($menus as $menu)
            <tr>
                <td class="py-3">
                    <div class="flex items-center">
                        <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                            {{$menu->name}}
                        </p>
                    </div>
                </td>
                <td class="py-3">
                    <div class="flex items-center">
                        <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                            {{$menu->category->category}}
                        </p>
                    </div>
                </td>
                <td class="py-3">
                    <div class="flex items-center">
                        <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                            {{$menu->desc}}
                        </p>
                    </div>
                </td>
                <td class="py-3">
                    <div class="flex items-center">
                        <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                            {{$menu->stock}}
                        </p>
                    </div>
                </td>
                <td class="py-3">
                    <div class="flex items-center">
                        <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                            {{$menu->price}}
                        </p>
                    </div>
                </td>
                <td class="py-3">
                    <div class="flex items-center">
                        <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                            <input type="checkbox" id="bestMenu{{ $menu->id }}" name="best_menu" onchange="setBestMenu({{$menu->id}})"
                                {{ $menu->best_menu == "true" ? 'checked' : '' }}>
                        </p>
                    </div>
                </td>
                <td class="py-3">
                    <div class="flex items-center">
                        <img src="{{asset('storage/'.$menu->image)}}" alt="menu_thumb" class="w-14 h-14">
                    </div>
                </td>
                <td class="py-3">
                    <div class="flex items-center gap-3">
                        <a href="{{route('menu.edit', $menu->id)}}"
                            class="rounded-full bg-green-500 text-gray-300 px-3 py-2">
                            Edit
                        </a>
                        <a href="{{route('menu.destroy', $menu->id)}}" data-confirm-delete="true"
                            class="rounded-full bg-red-500 text-gray-300 px-3 py-2">
                            Delete
                        </a>
                    </div>
                </td>
            </tr>
            @endforeach
            <!-- table item -->
            <!-- table body end -->
        </tbody>
    </table>
</div>
@endsection

@push('js')
<script>
    let table = new DataTable('#categoryTable');

    function setBestMenu(id) {
        let bestMenuValue = document.querySelector('#bestMenu' + id).checked;
        const csrfToken = "{{ csrf_token() }}";
        let url = "{{ route('admin.changeBestMenu', ['id' => ':id']) }}".replace(':id', id);
        let data = new FormData();
        data.append('best_menu', bestMenuValue.toString());
        let xhr = new XMLHttpRequest();
        xhr.open('POST', url);
        xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);
        xhr.onload = function () {
            if (xhr.status === 200) {
                console.log("Success:", xhr.responseText);
            } else {
                console.error("Error:", xhr.statusText);
            }
        };
        xhr.send(data);
    }

</script>
@endpush
