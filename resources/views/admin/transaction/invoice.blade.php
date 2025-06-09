<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Invoice</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 p-6 font-sans">
    <div class="max-w-2xl mx-auto bg-white rounded-lg p-8">
        <div class="flex items-center justify-between mb-6">
            <div class="text-lg font-medium">
                <p>Hello, {{ $transaction->customer->name }}.</p>
            </div>
            <div class="text-right">
                <h1 class="text-red-600 text-2xl font-semibold">Invoice</h1>
                <p class="text-sm text-green-500">ORDER {{ $transaction->order_code }}</p>
                <p class="text-sm text-gray-500">{{ $transaction->created_at->toDateString() }}</p>
            </div>
        </div>

        <table class="w-full text-left mb-6">
            <thead class="border-b border-gray-300">
                <tr class="text-gray-600">
                    <th class="py-2">Name</th>
                    <th class="py-2">Quantity</th>
                    <th class="py-2 text-right">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transaction->transaction_detail as $detail)
                <tr class="border-b border-gray-200">
                    <td class="py-2 text-red-600">{{ $detail->menu }}</td>
                    <td class="py-2">{{ $detail->qty }}</td>
                    <td class="py-2 text-right">@rupiah($detail->price)</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="text-right mb-6">
            {{-- <p class="text-gray-700">Subtotal: <span class="ml-2">$329.90</span></p>
            <p class="text-gray-700">Shipping & Handling: <span class="ml-2">$15.00</span></p> --}}
            <p class="text-lg font-semibold mt-2">Grand Total: <span class="text-black">@rupiah($total)</span></p>
            {{-- <p class="text-sm text-gray-500">TAX: $72.40</p> --}}
        </div>

        <p class="text-center text-gray-600 text-sm">Have a nice day.</p>
    </div>
</body>

</html>
