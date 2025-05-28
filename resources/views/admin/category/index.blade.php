@extends('admin.template.app')

@section('title', 'Admin Dashboard')

@section('content')
<a href="{{route('category.create')}}" class="rounded-full bg-green-500 text-gray-300 px-3 py-2 block my-2 w-fit text-center">Tambah Data</a>
<div class="w-full overflow-x-auto dark:text-white/90">
    <table id="categoryTable" class="min-w-full">
        <!-- table header start -->
        <thead>
            <tr class="border-gray-100 border-y dark:border-gray-800">
                <th class="py-3">
                    <div class="flex items-center">
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
                            Action
                        </p>
                    </div>
                </th>
            </tr>
        </thead>
        <!-- table header end -->

        <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
            @foreach ($categories as $category)
            <tr>
                <td class="py-3">
                    <div class="flex items-center">
                        <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                            {{$category->category}}
                        </p>
                    </div>
                </td>
                <td class="py-3">
                    <div class="flex items-center">
                        <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                            {{$category->desc}}
                        </p>
                    </div>
                </td>
                <td class="py-3">
                    <div class="flex items-center gap-3">
                        <a href="{{route('category.edit', $category->id)}}" class="rounded-full bg-green-500 text-gray-300 px-3 py-2">
                            Edit
                        </a>
                        <a href="{{route('category.destroy', $category->id)}}" data-confirm-delete="true" class="rounded-full bg-red-500 text-gray-300 px-3 py-2">
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

</script>
@endpush
