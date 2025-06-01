@extends('admin.template.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="min-h-screen p-6 text-foreground dark:text-white">
    <div class="max-w-6xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Kiri: Informasi Pesanan -->
        <div class="bg-card shadow-lg rounded-xl p-6">
            <h2 class="text-xl font-semibold mb-4">
                Id Pesanan : <span class="font-bold">{{$order->order_code}}</span>
            </h2>
            <form action="{{route('admin.transaction.store', $order->id)}}" method="post">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-sm font-medium mb-1">Nama</label>
                        <input type="text" value="{{$order->customer->name}}"
                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 w-full rounded-lg border border-gray-200 bg-transparent py-2.5 pr-14 pl-3 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-800 dark:bg-white/[0.03] dark:text-white/90 dark:placeholder:text-white/30"
                            disabled>
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">Phone</label>
                        <input type="text" value="{{$order->customer->phone}}"
                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 w-full rounded-lg border border-gray-200 bg-transparent py-2.5 pr-14 pl-3 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-800 dark:bg-white/[0.03] dark:text-white/90 dark:placeholder:text-white/30"
                            disabled>
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">Pilih metode pembayaran</label>
                        <select
                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 w-full rounded-lg border border-gray-200 bg-transparent py-2.5 pr-14 pl-3 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-800 dark:bg-gray-800 dark:text-white/90 dark:placeholder:text-white/30" name="payment_method">
                            <option value="cash" selected>Cash</option>
                            <option value="qris">Qris</option>
                        </select>
                    </div>
                </div>
                <div class="flex justify-between gap-4">
                    <a href="{{route('admin.order')}}"
                        class="text-center flex-1 bg-cyan-600 hover:bg-cyan-700 text-white py-2 rounded-lg">Kembali</a>
                    <button
                        class="flex-1 bg-yellow-400 hover:bg-yellow-500 text-black font-medium py-2 rounded-lg">Checkout
                        Now</button>
                </div>
            </form>
        </div>

        <!-- Kanan: Ordered Menu -->
        <div class="bg-card shadow-lg rounded-xl p-6">
            <h2 class="text-xl font-semibold mb-4">Ordered Menu</h2>
            <table class="w-full text-left text-sm">
                <thead>
                    <tr class="border-b font-semibold">
                        <th class="pb-2">Menu</th>
                        <th class="pb-2">Notes</th>
                        <th class="pb-2">Qty</th>
                        <th class="pb-2">Harga</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- {{dd($order->order_detail)}} --}}
                    @foreach ($order->order_detail as $item)
                    <tr class="border-b">
                        <td class="py-2">{{$item->menu->name}}</td>
                        <td class="py-2">{{$item->notes}}</td>
                        <td class="py-2">{{$item->qty}}</td>
                        <td class="py-2">
                            @rupiah($item->menu->price * $item->qty)
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="flex justify-between items-center mt-6 text-base font-medium">
                <span>Total</span>
                <span class="text-red-600 dark:text-red-400">@rupiah($total)</span>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="mt-10 text-center text-sm text-muted-foreground dark:text-muted">
        <p>
            Copyright © 2023 <span class="font-semibold text-blue-600 dark:text-blue-400">ResToGo</span>. All rights
            reserved.
        </p>
        <p class="mt-1">Version <span class="font-semibold">1.0.0</span></p>
    </div>
</div>

@endsection

@push('js')
<script>
    let table = new DataTable('#categoryTable');

</script>
@endpush
