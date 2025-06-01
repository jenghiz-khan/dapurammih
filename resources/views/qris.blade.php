<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Payment | Dapur Ammih</title>
    @vite('resources/css/app.css')
</head>

<body>
    <div class="container mx-auto">
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
            <div class="card bg-white shadow-lg p-3 rounded-2xl">
                <div class="grid grid-cols-1 sm:grid-cols-2 items-center justify-center">
                    <div class="card-body">
                        <h2 class="text-lg">Upload bukti pembayaran</h2>
                        <small class="text-red-500 font-semibold mb-2">
                            Notes: Simpan bukti pembayaran dan berikan pada kasir
                        </small>
                        <input type="file" name="receipt" class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 rounded-lg border border-gray-200 bg-transparent text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden xl:w-[430px] dark:border-gray-800 dark:bg-white/[0.03] dark:text-white/90 dark:placeholder:text-white/30 max-w-full py-3 px-2">
                        <button class="px-3 py-2 rounded-lg bg-blue-500 text-white mt-2">Submit</button>
                    </div>
                    <div class="qris w-full">
                        <img src="{{asset('assets/images/qris.png')}}" alt="qris" class="w-1/2 mx-auto">
                        <a href="{{asset('assets/images/qris.png')}}" download="{{asset('assets/images/qris.png')}}" class="px-3 py-2 rounded-lg bg-green-500 text-white mt-2 block mx-auto w-fit">Download QRIS</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
