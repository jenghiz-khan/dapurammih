@extends('template.master')

@section('title', 'Dapur Ammih Menu')

@section('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/regular.min.css" />
<script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
@endsection

@section('content')
<div class="container mx-auto">
    <div class="md:flex md:h-screen">
        <div class="left flex-1 md:w-2/3">
            @if (count($bestMenus) > 0)
            <section id="best-seller" class="py-3">
                <div class="mx-2">
                    <h1 class="text-2xl dark:text-darkMode py-3 md:text-3xl">Our Best Menu</h1>
                    <div class="swiper">
                        <!-- If we need navigation buttons -->
                        <div class="flex justify-end gap-3 py-2">
                            <button
                                class="card-button-prev rounded-full bg-black text-white hover:bg-white hover:text-black hover:border dark:hover:border-0 dark:hover:bg-gray-500 dark:bg-gray-700 cursor-pointer p-3 dark:text-darkMode w-12 h-w-12 text-center text-lg">&lt</button>
                            <button
                                class="card-button-next rounded-full bg-black text-white hover:bg-white hover:text-black hover:border dark:hover:border-0 dark:hover:bg-gray-500 dark:bg-gray-700 cursor-pointer p-3 dark:text-darkMode w-12 h-w-12 text-center text-lg">&gt</button>
                        </div>
                        <div class="swiper-wrapper py-3">
                            @foreach ($bestMenus as $bestMenu)
                            <div
                                class="card swiper-slide rounded-2xl overflow-hidden p-2 dark:bg-[#1E2939] shadow-xl max-w-sm">
                                <img src="{{asset('storage/'.$bestMenu->image)}}" alt="menu"
                                    class="rounded-2xl md:w-[266px] md:h-[266px] w-[164px] h-[164px] m-auto object-fill">
                                <div class="card-body py-2">
                                    <div class="card-title md:text-2xl text-[15px] dark:text-darkMode mb-2">
                                        {{$bestMenu->name}}</div>
                                    <div class="flex justify-between md:items-center md:flex-row flex-col gap-2">
                                        <div class="flex flex-col gap-1">
                                            <div class="dark:text-darkMode md:text-sm text-[12px] text-gray-500">
                                                {{$bestMenu->category->category}}
                                            </div>
                                            <div class="price dark:text-darkMode md:text-lg text-[12px] font-semibold">
                                                {{$bestMenu->price}}
                                            </div>
                                        </div>
                                        <button
                                            class="order bg-black md:text-base text-white md:py-2 md:px-3 md:rounded-xl rounded text-[12px] w-full md:w-auto py-2"
                                            onclick="handleOrderNow(this)" data-menu-id="{{$bestMenu->id}}">Order
                                            Now</button>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </section>
            @endif

            <section id="menus">
                <h1 class="text-2xl dark:text-darkMode py-3 md:text-3xl">Explore Our Menu</h1>

                <div class="category py-3 w-full overflow-x-auto flex gap-3">
                    @foreach ($categories as $category)
                    <div class="bg-black cursor-pointer text-white py-1 px-3 rounded-xl w-fit">{{$category->category}}
                    </div>
                    @endforeach
                </div>

                <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                    @foreach ($menus as $menu)
                    <div class="card swiper-slide rounded-2xl overflow-hidden p-2 dark:bg-[#1E2939] shadow-xl max-w-sm">
                        <img src="{{asset('storage/'.$menu->image)}}" alt="menu"
                            class="rounded-2xl md:w-[266px] md:h-[266px] w-[164px] h-[164px] m-auto object-fill">
                        <div class="card-body py-2">
                            <div class="card-title md:text-2xl text-[15px] dark:text-darkMode mb-2">{{$menu->name}}
                            </div>
                            <div class="flex justify-between md:items-center md:flex-row flex-col gap-2">
                                <div class="flex flex-col gap-1">
                                    <div class="dark:text-darkMode md:text-sm text-[12px] text-gray-500">Healthy
                                        {{$menu->category->category}}
                                    </div>
                                    <div class="price dark:text-darkMode md:text-lg text-[12px] font-semibold">
                                        {{$menu->price}}
                                    </div>
                                </div>
                                <button
                                    class="order bg-black md:text-base text-white md:py-2 md:px-3 md:rounded-xl rounded text-[12px] w-full md:w-auto py-2"
                                    onclick="handleOrderNow(this)" data-menu-id="{{$menu->id}}">Order Now</button>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </section>
        </div>

        <div id="myCart"
            class="w-1/3 my-3 relative bg-white shadow-lg p-4 rounded-xl overflow-y-auto hidden lg:block dark:bg-[#1E2939]">
            <h2 class="text-lg font-semibold dark:text-darkMode">Customer Information</h2>
            <form action="{{route('home.order')}}" method="post">
                @csrf
                <div class="border border-gray-300 rounded-md p-2 w-full max-w-md my-2">
                    <label class="block text-sm font-semibold text-gray-800 mb-1 dark:text-darkMode">Customer
                        Name</label>
                    <input type="text" name="cust_name" placeholder="Your name..."
                        class="w-full text-gray-400 placeholder:text-gray-400 outline-none bg-transparent" />
                </div>
                <div class="border border-gray-300 rounded-md p-2 w-full max-w-md">
                    <label class="block text-sm font-semibold text-gray-800 mb-1 dark:text-darkMode">Phone
                        Number</label>
                    <input type="text" name="phone" placeholder="Ex: 628..."
                        class="w-full text-gray-400 placeholder:text-gray-400 outline-none bg-transparent" />
                </div>

                <input type="text" name="cart" id="input_cart">

                <div class="mt-3">
                    <h2 class="text-lg font-semibold text-darkMode">Current Order</h2>
                    <div class="h-52 bg-gray-100 p-3 gap-2 current-order rounded-lg overflow-y-scroll dark:bg-[#242d3c]"
                        id="card_cart">
                        {{-- <div class="card h-28 bg-white dark:bg-[#1f2939] shadow-xl p-3 rounded-xl my-2">
                            <div class="flex w-full h-full relative gap-2">
                                <img src="https://images.unsplash.com/photo-1546069901-ba9599a7e63c?q=80&w=1480&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                                    alt="order-thumb" class="rounded-lg object-cover w-1/3">
    
                                <div class="dark:text-darkMode">
                                    <h3 class="text-lg">Salad</h3>
                                    <div class="price">Rp.1.300.000</div>
                                    <div class="qty flex">
                                        <button
                                            class="minus inline-flex items-center justify-center w-10 h-10 bg-white rounded-full">-</button>
                                        <input type="number" value="1" name="qty" min="0" class="text-center w-1/2">
                                        <button
                                            class="minus inline-flex items-center justify-center w-10 h-10 bg-white rounded-full">+</button>
                                    </div>
                                </div>
                                <div
                                    class="absolute top-0 right-0 bg-red-500 py-1 px-4 cursor-pointer text-white rounded-lg">
                                    <i class="fa-solid fa-trash"></i>
                                </div>
                            </div>
                        </div> --}}

                        {{-- CARD SHOW HERE --}}
                    </div>

                    <div class="dark:text-darkMode my-3">
                        <h2 class="text-lg font-semibold mb-3">Payment Summary</h2>
                        <div class="flex justify-between">
                            <div class="total">Total</div>
                            <div class="font-semibold text-green-500" id="cart_total">Rp.0</div>
                        </div>
                    </div>
                    <button class="w-full bg-black p-3 dark:text-darkMode rounded-full text-white">Order Now</button>
                </div>
            </form>
            <div id="closeButton" onclick="showCart()" class="top-0 right-0 absolute p-3 sm:hidden">
                &#10006;
            </div>
        </div>
    </div>
</div>

{{-- MODAL BOX --}}
<div id="cart-modal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
            <!-- Modal header -->
            <div
                class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                <button type="button" id="cart-modal-close"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                    <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-4 md:p-5 space-y-4 dark:text-white">
                <input type="hidden" value="123" id="menu_input" readonly>
                <div class="input-group">
                    <div class="flex justify-between items-center">
                        <label class="py-2">Notes:</label>
                        <small>*Optional</small>
                    </div>
                    <textarea name="desc" rows="5" id="notes_input"
                        class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 rounded-lg border border-gray-200 bg-transparent py-2.5 pr-14 pl-3 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-800 dark:bg-white/[0.03] dark:text-white/90 dark:placeholder:text-white/30 w-full"></textarea>
                </div>
                <!-- Modal footer -->
                <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                    <button type="button" id="addToCartButton"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Add
                        To Cart</button>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- END OF MODAL BOX --}}

<div onclick="showCart()"
    class="fixed bottom-5 right-5 z-10 w-12 h-12 rounded-full inline-flex items-center justify-center dark:bg-[#101828] shadow-2xl sm:hidden">
    <i class="fa-solid fa-basket-shopping dark:text-white"></i>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/js/all.min.js"
    integrity="sha512-b+nQTCdtTBIRIbraqNEwsjB6UvL3UEMkXnhzd8awtCYh0Kcsjl9uEgwVFVbhoj3uu1DO1ZMacNvLoyJJiNfcvg=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/js/conflict-detection.min.js" integrity="sha512-K5+wFlOsuophh3a/Im5Xc/i3w5YnOJmfTS74GUNHUH0UPe2Y55Y8iLkFkLjYy6aJy999ZIoKjsmFJMhjq3MlHQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}
<script>
    document.addEventListener("DOMContentLoaded", function () {
        renderCart();
    });

</script>
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
                slidesPerView: 3
            },
        }
    })

</script>

<script>
    function showCart() {
        const myCart = document.querySelector('#myCart');
        // const closeCart = document.querySelector('#closeButton')
        myCart.classList.toggle('active')
    }

    let mouseDown = false;
    let startX, scrollLeft;
    const slider = document.querySelector('.category');

    const startDragging = (e) => {
        mouseDown = true;
        startX = e.pageX - slider.offsetLeft;
        scrollLeft = slider.scrollLeft;
    }

    const stopDragging = (e) => {
        mouseDown = false;
    }

    const move = (e) => {
        e.preventDefault();
        if (!mouseDown) {
            return;
        }
        const x = e.pageX - slider.offsetLeft;
        const scroll = x - startX;
        slider.scrollLeft = scrollLeft - scroll;
    }

    // Add the event listeners
    slider.addEventListener('mousemove', move, false);
    slider.addEventListener('mousedown', startDragging, false);
    slider.addEventListener('mouseup', stopDragging, false);
    slider.addEventListener('mouseleave', stopDragging, false);

    // function closeCart(){
    //     const myCart = document.querySelector('#myCart');
    //     // const closeCart = document.querySelector('#closeButton')
    //     myCart.classList.toggle('active')   
    // }

    async function handleOrderNow(button) {
        const menuId = button.getAttribute('data-menu-id');
        const menu_input = document.querySelector('#menu_input');
        const addToCartButton = document.querySelector('#addToCartButton');
        const modal = new Modal(document.getElementById('cart-modal'));

        menu_input.value = menuId;
        const {data} = await getData(menuId);

        addToCartButton.onclick = () => handleAddToCart(data, modal);

        const closeButton = document.querySelector('#cart-modal-close').addEventListener('click', function () {
            modal.hide();
        });

        modal.show();
    }

    async function getData(id) {
        let url = "{{ route('home.getMenu', ['id' => ':id']) }}".replace(':id', id);
        const menu = await fetch(url).then(res => {
            return res.json();
        });
        return menu;
    }

    function handleAddToCart(data, modal) {
        console.log(data)
        const notesInput = document.querySelector('#notes_input').value;
        data['notes'] = notesInput;
        // localStorage.setItem('cartItems', JSON.stringify([data]));
        let cart = JSON.parse(localStorage.getItem('cartItems')) || [];

        const existingIndex = cart.findIndex(item => item.id === data.id);
        if (existingIndex !== -1) {
            cart[existingIndex].quantity += 1;
        } else {
            cart.push({
                ...data,
                quantity: 1
            });
        }

        // Save updated cart
        localStorage.setItem('cartItems', JSON.stringify(cart));
        renderCart();
        modal.hide();
    }

    function setupDeleteButtons() {
        const deleteButtons = document.querySelectorAll('#delete-btn');
        deleteButtons.forEach(button => {
            button.addEventListener('click', function () {
                const id = this.getAttribute('data-id');
                deleteCartItem(id);
            });
        });
    }

    function deleteCartItem(id) {
        let cart = JSON.parse(localStorage.getItem('cartItems')) || [];
        cart = cart.filter(item => item.id != id);
        localStorage.setItem('cartItems', JSON.stringify(cart));
        renderCart();
    }

    function renderCart() {
        const cardCart = document.querySelector('#card_cart');
        const inputCart = document.querySelector('#input_cart');
        const storedData = localStorage.getItem("cartItems");
        const items = storedData ? JSON.parse(storedData) : [];
        const ASSET_URL = "{{ asset('storage') }}";
        cardCart.innerHTML = '';

        inputCart.value = JSON.stringify(items);

        if (items.length === 0) {
            cardCart.innerHTML = `
                    <h4 class="dark:text-white md:text-lg font-semibold w-full h-full flex justify-center items-center">Your cart is empty</h4>
                `;
            updateTotal(0);
            return;
        }

        let total = 0;
        items.forEach(item => {
            total += item.price * item.quantity;

            const card = document.createElement("div");
            card.className = "card h-28 bg-white dark:bg-[#1f2939] shadow-xl p-3 rounded-xl mb-2";

            card.innerHTML = `
                    <div class="flex w-full h-full relative gap-2">
                        <img src="${ASSET_URL}/${item.image}" alt="order-thumb" class="rounded-lg object-cover w-1/3">

                        <div class="dark:text-darkMode">
                            <h3 class="text-lg">${item.name}</h3>
                            <div class="price">Rp.${item.price.toLocaleString('id-ID')}</div>
                            <div class="qty flex">
                                <button class="minus inline-flex items-center justify-center w-10 h-10 bg-white rounded-full" id="qty_button" data-action="decrease" data-id="${item.id}">-</button>
                                <input type="number" value="${item.quantity}" name="qty" min="0" class="text-center w-1/2">
                                <button class="plus inline-flex items-center justify-center w-10 h-10 bg-white rounded-full" id="qty_button" data-action="increase" data-id="${item.id}">+</button>
                            </div>
                        </div>

                        <div class="absolute top-0 right-0 bg-red-500 py-1 px-4 cursor-pointer text-white rounded-lg" id="delete-btn" data-id="${item.id}">
                            <i class="fa-solid fa-trash"></i>
                        </div>
                    </div>
                `;

            cardCart.appendChild(card);
        });

        setupDeleteButtons();
        setQtyButton();

        updateTotal(total)
    }

    function setQtyButton() {
        const qtyButton = document.querySelectorAll('#qty_button');
        qtyButton.forEach(button => {
            button.addEventListener('click', function () {
                const id = this.getAttribute('data-id');
                const action = this.getAttribute('data-action');
                updateCartQty(id, action);
            })
        })
    }

    function updateCartQty(id, action) {
        let cart = JSON.parse(localStorage.getItem('cartItems'));
        const itemIndex = cart.findIndex(item => item.id == id);
        if (itemIndex !== -1) {
            if (action === "increase") {
                cart[itemIndex].quantity += 1;
            } else if (action === "decrease") {
                cart[itemIndex].quantity -= 1;
                if (cart[itemIndex].quantity <= 0) {
                    cart.splice(itemIndex, 1); // remove item if qty is 0
                }
            }

            localStorage.setItem('cartItems', JSON.stringify(cart));
            renderCart();
        }
    }

    function updateTotal(total) {
        const totalDisplay = document.getElementById('cart_total');
        if (totalDisplay) {
            totalDisplay.textContent = `Rp.${total.toLocaleString('id-ID')}`;
        }
    }

</script>
@endpush
