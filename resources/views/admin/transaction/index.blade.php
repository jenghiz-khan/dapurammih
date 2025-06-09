{{-- @php
    $grandTotal = $transactions->sum(function ($t) {
        return $t->transaction_detail->sum('total');
    });
@endphp --}}

@extends('admin.template.app')

@section('title', 'Admin Dashboard')

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/datetime/1.5.3/css/dataTables.dateTime.min.css">
@endsection

@section('content')
{{-- <a href="{{route('category.create')}}" class="rounded-full bg-green-500 text-gray-300 px-3 py-2 block my-2 w-fit
text-center">Tambah Data</a> --}}
<div class="w-full overflow-x-auto dark:text-white/90">
    {{-- <table>
        <tbody>
            <tr>
                <td>Minimum date:</td>
                <td><input type="text" id="min" name="min"></td>
            </tr>
            <tr>
                <td>Maximum date:</td>
                <td><input type="text" id="max" name="max"></td>
            </tr>
        </tbody>
    </table> --}}
    <div class="flex my-2">
        <div class="w-1/2">
            <label for="min">Minimum date:</label>
            <input type="text" id="min" name="min"
                class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-200 bg-transparent py-2.5 pr-14 pl-3 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden xl:w-[430px] dark:border-gray-800 dark:bg-white/[0.03] dark:text-white/90 dark:placeholder:text-white/30"
                readonly>
        </div>
        <div class="w-1/2">
            <label for="max">Maximum date:</label>
            <input type="text" id="max" name="max"
                class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-200 bg-transparent py-2.5 pr-14 pl-3 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden xl:w-[430px] dark:border-gray-800 dark:bg-white/[0.03] dark:text-white/90 dark:placeholder:text-white/30" readonly>
        </div>
    </div>
    <table id="transactionTable" class="min-w-full">
        <!-- table header start -->
        <thead>
            <tr class="border-gray-100 border-y dark:border-gray-800">
                <th class="py-3">
                    <div class="flex items-center">
                        <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                            Customer
                        </p>
                    </div>
                </th>
                <th class="py-3">
                    <div class="flex items-center col-span-2">
                        <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                            Order Code
                        </p>
                    </div>
                </th>
                <th class="py-3">
                    <div class="flex items-center col-span-2">
                        <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                            Payment Method
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
                            Date
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
            {{-- {{ dd($transactions->count()) }} --}}
            @foreach ($transactions as $transaction)
            <tr>
                <td class="py-3">
                    <div class="flex items-center">
                        <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                            {{$transaction->customer->name}}
                        </p>
                    </div>
                </td>
                <td class="py-3">
                    <div class="flex items-center">
                        <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                            {{$transaction->order_code}}
                        </p>
                    </div>
                </td>
                <td class="py-3">
                    <div class="flex items-center">
                        <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                            {{$transaction->payment_method}}
                        </p>
                    </div>
                </td>
                <td class="py-3">
                    <div class="flex items-center">
                        <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                            @rupiah($transaction->transaction_detail->sum('total'))
                        </p>
                    </div>
                </td>
                <td class="py-3">
                    <div class="flex items-center">
                        <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                            {{$transaction->created_at->toDateString()}}
                        </p>
                    </div>
                </td>
                <td class="py-3">
                    <a href="{{route('admin.transaction.detail', $transaction->id)}}"
                        class="rounded-full bg-blue-500 text-gray-300 px-3 py-2">
                        Detail
                    </a>
                </td>
            </tr>
            @endforeach
            <!-- table item -->
            <!-- table body end -->
        </tbody>
        <tfoot>
            <tr>
                <td>Total</td>
                <td colspan="4"></td>
                <td></td>
            </tr>
        </tfoot>
    </table>
</div>
@endsection

@push('js')
{{-- <script>
    let table = new DataTable('#categoryTable');

</script> --}}
<script src="https://cdn.datatables.net/datetime/1.5.3/js/dataTables.dateTime.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/datetime/1.5.3/js/dataTables.dateTime.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/3.1.1/js/buttons.dataTables.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/3.1.1/js/dataTables.buttons.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/3.1.1/js/buttons.print.min.js"></script>

<script type="text/javascript" src="https://cdn.datatables.net/buttons/3.1.1/js/buttons.html5.min.js"></script>

<script>
    let minDate, maxDate;

    // Custom filtering function which will search data in column four between two values
    DataTable.ext.search.push(function (settings, data, dataIndex) {
        let min = minDate.val();
        let max = maxDate.val();
        let date = new Date(data[4]);

        if (
            (min === null && max === null) ||
            (min === null && date <= max) ||
            (min <= date && max === null) ||
            (min <= date && date <= max)
        ) {
            return true;
        }
        return false;
    });

    // Create date inputs
    minDate = new DateTime('#min', {
        format: 'MMMM Do YYYY'
    });
    maxDate = new DateTime('#max', {
        format: 'MMMM Do YYYY'
    });

    // DataTables initialisation
    let table = new DataTable('#transactionTable', {
        responsive: true,
        columnDefs: [{
            "defaultContent": "",
            "targets": "_all"
        }],
        layout: {
            topStart: {
                buttons: [{
                    extend: 'print',
                    className: 'bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg text-sm',
                    exportOptions: {
                        columns: [0, 1, 2, 3]
                    }
                }, ]
            }
        },
        footerCallback: function (row, data, start, end, display) {
        let api = this.api();

        // Helper function to remove formatting
        let parsePrice = function (val) {
        let div = document.createElement('div');
        div.innerHTML = val;
        let text = div.textContent || div.innerText || "";

        return Number(
            text
                .replace(/Rp\.?\s?/i, '')
                .replace(/\./g, '')
                .replace(/,/g, '')
        ) || 0;
    };

        // Calculate total
        let total = api
            .column(3, { search: 'applied' }) // Index 3 is the "Price" column
            .data()
            .reduce((acc, val) => acc + parsePrice(val), 0);

        // Format back to IDR
        let formatted = new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0
        }).format(total);

        // Update footer
        $(api.column(5).footer()).html(formatted);
    }
    });

    // Refilter the table
    document.querySelectorAll('#min, #max').forEach((el) => {
        el.addEventListener('change', () => table.draw());
    });

</script>
@endpush
