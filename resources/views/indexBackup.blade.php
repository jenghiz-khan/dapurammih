@extends('template.master')

@section('title', 'Dapur Ammih Menu')

@section('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
@endsection

@section('content')
<div class="container mx-auto">
    <div class="grid grid-cols-12">
        <div class="left col-span-10">
            <section id="best-seller" class="py-3">
                <div class="container mx-auto">
                    <h1 class="text-2xl dark:text-lightMode py-3 md:text-3xl">Our Best Menu</h1>
            
                    {{-- <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <div
                            class="card rounded-2xl overflow-hidden p-2 dark:bg-[#1E2939] shadow-[-10px_-10px_30px_4px_rgba(0,0,0,0.1),_10px_10px_30px_4px_rgba(45,78,255,0.15)]">
                            <img src="https://images.unsplash.com/photo-1546069901-ba9599a7e63c?q=80&w=1480&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                                alt="menu" class="rounded-2xl">
                            <div class="card-body py-2">
                                <div class="card-title md:text-2xl text-[15px] dark:text-lightMode mb-2">Salad</div>
                                <div class="flex justify-between md:items-center md:flex-row flex-col gap-2">
                                    <div class="flex flex-col gap-1">
                                        <div class="dark:text-lightMode md:text-sm text-[12px] text-gray-500">Healthy Food</div>
                                        <div class="price dark:text-lightMode md:text-2xl text-[12px]">Rp. 1.200.000</div>
                                    </div>
                                    <button
                                        class="order bg-black md:text-lg text-white md:py-2 md:px-3 md:rounded-xl rounded text-[12px] w-full md:w-auto py-2">Order
                                        Now</button>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    <div class="swiper">
                        <!-- If we need navigation buttons -->
                        <div class="flex justify-end gap-3 py-2">
                            <button
                                class="card-button-prev rounded-full bg-black text-white hover:bg-white hover:text-black hover:border dark:hover:border-0 dark:hover:bg-gray-500 dark:bg-gray-700 cursor-pointer p-3 dark:text-lightMode w-12 h-w-12 text-center text-lg">&lt</button>
                            <button
                                class="card-button-next rounded-full bg-black text-white hover:bg-white hover:text-black hover:border dark:hover:border-0 dark:hover:bg-gray-500 dark:bg-gray-700 cursor-pointer p-3 dark:text-lightMode w-12 h-w-12 text-center text-lg">&gt</button>
                        </div>
                        <div class="swiper-wrapper py-3">
                            <div class="card swiper-slide rounded-2xl overflow-hidden p-2 dark:bg-[#1E2939] shadow-xl max-w-sm">
                                <img src="https://images.unsplash.com/photo-1546069901-ba9599a7e63c?q=80&w=1480&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                                    alt="menu" class="rounded-2xl">
                                <div class="card-body py-2">
                                    <div class="card-title md:text-2xl text-[15px] dark:text-lightMode mb-2">Salad</div>
                                    <div class="flex justify-between md:items-center md:flex-row flex-col gap-2">
                                        <div class="flex flex-col gap-1">
                                            <div class="dark:text-lightMode md:text-sm text-[12px] text-gray-500">Healthy Food</div>
                                            <div class="price dark:text-lightMode md:text-lg text-[12px] font-semibold">Rp.
                                                1.200.000</div>
                                        </div>
                                        <button
                                            class="order bg-black md:text-base text-white md:py-2 md:px-3 md:rounded-xl rounded text-[12px] w-full md:w-auto py-2">Order
                                            Now</button>
                                    </div>
                                </div>
                            </div>
            
                        </div>
                    </div>
                </div>
            </section>
            
            <section id="menus">
                <div class="container mx-auto">
                    <h1 class="text-2xl dark:text-lightMode py-3 md:text-3xl">Explore Our Menu</h1>
            
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <div class="card swiper-slide rounded-2xl overflow-hidden p-2 dark:bg-[#1E2939] shadow-xl max-w-sm">
                            <img src="https://images.unsplash.com/photo-1546069901-ba9599a7e63c?q=80&w=1480&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                                alt="menu" class="rounded-2xl">
                            <div class="card-body py-2">
                                <div class="card-title md:text-2xl text-[15px] dark:text-lightMode mb-2">Salad</div>
                                <div class="flex justify-between md:items-center md:flex-row flex-col gap-2">
                                    <div class="flex flex-col gap-1">
                                        <div class="dark:text-lightMode md:text-sm text-[12px] text-gray-500">Healthy Food</div>
                                        <div class="price dark:text-lightMode md:text-lg text-[12px] font-semibold">Rp. 1.200.000
                                        </div>
                                    </div>
                                    <button
                                        class="order bg-black md:text-base text-white md:py-2 md:px-3 md:rounded-xl rounded text-[12px] w-full md:w-auto py-2">Order
                                        Now</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    
        <div class="right col-span-2 bg-white shadow-lg my-3">
            
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
    const swiper = new Swiper('.swiper', {
        loop: true,
        spaceBetween: 20,
        navigation: {
            nextEl: '.card-button-next',
            prevEl: '.card-button-prev',
        },

        breakpoints: {
            0: {
                slidesPerView: 2
            },
            768: {
                slidesPerView: 2
            },
            1024: {
                slidesPerView: 4
            },
        }
    })

</script>
@endpush
