<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Receipt Order</title>

    <!-- Tailwind CSS CDN (or use your own build process) -->
    {{-- <script src="https://cdn.tailwindcss.com"></script> --}}

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback" />

    <!-- IonIcons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" />

    <!-- Your custom CSS (if needed) -->
    {{-- <link rel="stylesheet" href="{{asset('assets/customer/css/cekout.css')}}"> --}}
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 font-sans">

    <div class="container mx-auto px-4">
        <div class="flex justify-center mt-6">
            <img src="{{asset('assets/images/logo/logo.png')}}" alt="No Picture Added" class="rounded-full w-24 h-24 object-cover" />
        </div>

        <div class="flex justify-center items-center mt-4">
            <div class="w-full max-w-xl bg-white shadow-lg rounded-xl">
                <div class="p-6">
                    <div class="mb-4">
                        <div class="flex justify-center text-green-500 text-5xl">
                            <i class="fa-solid fa-circle-check"></i>
                        </div>
                        <div class="text-center mt-4">
                            <p class="text-xl font-semibold">Total pembayaran anda sebesar</p>
                            <div class="text-2xl font-bold text-green-600 mt-2">
                                @rupiah($total)
                            </div>
                        </div>
                        <div class="text-center mt-4">
                            <p class="text-lg">ID Pesanan = <span class="font-bold">{{$customer->order->order_code}}</span></p>
                            <div class="flex justify-center gap-4 mt-4">
                                <a href="{{route('homepage')}}" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded">Menu Utama</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-center pb-4">
                    <p class="text-gray-600">Terima Kasih!</p>
                    <small class="text-red-500">Notes: Ingat ID pesanan anda!</small>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
