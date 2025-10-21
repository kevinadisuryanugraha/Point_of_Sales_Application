@extends('app')
@section('title', $title)

@section('content')

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row">
        <!-- Modal Keranjang -->
        <div class="modal fade" id="cartModal" tabindex="-1" aria-labelledby="cartModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md modal-dialog-scrollable">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title" id="cartModalLabel"><i class="mdi mdi-cart"></i> Keranjang Belanja</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body" id="cart-items" style="max-height: 400px; overflow-y: auto;">
                        <p class="text-muted text-center m-0">Keranjang kosong</p>
                    </div>

                    <!-- Footer keranjang akan diisi dinamis lewat JS -->
                    <div class="modal-footer flex-column" id="cart-total"></div>
                </div>
            </div>
        </div>

        <!-- Bagian Produk -->
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="mb-0 fw-bold">Daftar Produk</h5>

                <form method="GET" action="{{ route('orders.index') }}" class="d-flex w-50">
                    <input type="text" name="search" class="form-control me-2" placeholder="Cari produk..."
                        value="{{ request('search') }}">
                    <button type="submit" class="btn btn-secondary">Cari</button>
                </form>

                <!-- Tombol Keranjang -->
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#cartModal">
                    <i class="mdi mdi-cart"></i> Lihat Keranjang
                </button>
            </div>

            <div class="row">
                @forelse ($products as $product)
                    <div class="col-md-3 mb-3">
                        <div class="card h-100 shadow-sm product-card" data-id="{{ $product->id }}"
                            data-name="{{ $product->product_name }}" data-price="{{ $product->product_price }}">
                            <img src="{{ Storage::url($product->product_photo) }}" class="card-img-top"
                                alt="{{ $product->product_name }}">
                            <div class="card-body text-center">
                                <h6 class="card-title mb-1 fw-semibold">{{ $product->product_name }}</h6>
                                <p class="text-primary fw-bold mb-0">Rp {{ number_format($product->product_price) }}</p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <p class="text-muted text-center">Produk tidak ditemukan.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <script>
        const cartItems = document.getElementById('cart-items');
        const cartTotal = document.getElementById('cart-total');

        let cart = {};
        const taxRate = 0.1; // 10% pajak
        const discount = 5000; // contoh diskon Rp 5.000

        function renderCart() {
            cartItems.innerHTML = '';

            let subtotal = 0;
            for (let id in cart) {
                let item = cart[id];
                let itemSubtotal = item.price * item.qty;
                subtotal += itemSubtotal;

                const div = document.createElement('div');
                div.className = 'cart-item';
                div.innerHTML = `
                <div class="cart-info">
                    <strong>${item.name}</strong>
                    <small>${item.qty} x Rp ${item.price.toLocaleString()}</small>
                </div>
                <div class="cart-actions">
                    <div class="quantity-controls">
                        <button type="button" onclick="updateQty('${id}', -1)">-</button>
                        <span>${item.qty}</span>
                        <button type="button" onclick="updateQty('${id}', 1)">+</button>
                    </div>
                    <span class="cart-price">Rp ${itemSubtotal.toLocaleString()}</span>
                    <i class="mdi mdi-delete remove-item" onclick="removeItem('${id}')"></i>
                </div>
            `;
                cartItems.appendChild(div);
            }

            if (Object.keys(cart).length === 0) {
                cartItems.innerHTML = '<p class="text-muted text-center m-0">Keranjang kosong</p>';
            }

            // Hitung pajak & total akhir
            const tax = subtotal * taxRate;
            const grandTotal = subtotal + tax - discount;

            // Update footer keranjang + tombol bayar
            cartTotal.innerHTML = `
            <div class="cart-summary p-2 w-100">
                <div class="d-flex justify-content-between mb-1">
                    <span class="text-muted">Subtotal</span>
                    <span class="fw-semibold">Rp ${subtotal.toLocaleString()}</span>
                </div>

                <div class="d-flex justify-content-between mb-1">
                    <span class="text-muted">Pajak (10%)</span>
                    <span class="fw-semibold">Rp ${tax.toLocaleString()}</span>
                </div>

                <div class="d-flex justify-content-between mb-1">
                    <span class="text-muted">Diskon</span>
                    <span class="fw-semibold text-danger">- Rp ${discount.toLocaleString()}</span>
                </div>

                <hr class="my-2">

                <div class="d-flex justify-content-between align-items-center">
                    <span class="fw-bold fs-6">Total</span>
                    <span class="fw-bold fs-5 text-success">Rp ${grandTotal.toLocaleString()}</span>
                </div>

                <form id="checkout-form" action="{{ route('orders.store') }}" method="POST" class="mt-3">
                    @csrf
                    <input type="hidden" name="products" id="products-input">
                    <input type="hidden" name="order_amount" id="order-amount" value="${grandTotal}">
                    <input type="hidden" name="order_change" id="order-change" value="0">

                    <button type="submit" class="btn btn-success w-100">
                        <i class="mdi mdi-playlist-coin"></i> BAYAR
                    </button>
                </form>
            </div>
        `;

            // Hidden input untuk dikirim ke controller
            let products = [];
            for (let id in cart) {
                let item = cart[id];
                products.push({
                    product_id: id,
                    qty: item.qty,
                    price: item.price
                });
            }
            document.getElementById('products-input').value = JSON.stringify(products);

            // Hidden input total juga update setiap kali render
            document.getElementById('order-amount').value = grandTotal;
        }

        function updateQty(id, change) {
            if (cart[id]) {
                cart[id].qty += change;
                if (cart[id].qty <= 0) {
                    delete cart[id];
                }
                renderCart();
            }
        }

        function removeItem(id) {
            delete cart[id];
            renderCart();
        }

        // Klik produk untuk masuk ke keranjang
        document.querySelectorAll('.product-card').forEach(card => {
            card.addEventListener('click', () => {
                const id = card.dataset.id;
                const name = card.dataset.name;
                const price = parseInt(card.dataset.price);

                if (cart[id]) {
                    cart[id].qty += 1;
                } else {
                    cart[id] = {
                        name: name,
                        price: price,
                        qty: 1
                    };
                }
                renderCart();
            });
        });

        // Ganti script lama dengan yang ini untuk debug
        document.addEventListener('submit', function(e) {
            if (e.target.id === 'checkout-form') {
                console.log('=== FORM SUBMIT DEBUG ===');
                console.log('Form element:', e.target);
                console.log('Form action:', e.target.action);
                console.log('Form method:', e.target.method);

                // Cek cart
                console.log('Cart contents:', cart);

                if (Object.keys(cart).length === 0) {
                    e.preventDefault();
                    alert('Keranjang masih kosong!');
                    return;
                }

                let products = [];
                let subtotal = 0;

                for (let id in cart) {
                    let item = cart[id];
                    products.push({
                        product_id: id,
                        qty: item.qty,
                        price: item.price
                    });
                    subtotal += item.price * item.qty;
                }

                const tax = subtotal * taxRate;
                const grandTotal = subtotal + tax - discount;

                console.log('Products to send:', products);
                console.log('Subtotal:', subtotal);
                console.log('Tax:', tax);
                console.log('Grand Total:', grandTotal);

                // Set hidden inputs
                const productsInput = document.getElementById('products-input');
                const orderAmountInput = document.getElementById('order-amount');
                const orderChangeInput = document.getElementById('order-change');

                if (!productsInput) {
                    console.error('products-input element not found!');
                    e.preventDefault();
                    return;
                }

                if (!orderAmountInput) {
                    console.error('order-amount element not found!');
                    e.preventDefault();
                    return;
                }

                productsInput.value = JSON.stringify(products);
                orderAmountInput.value = grandTotal;

                console.log('Hidden input values:');
                console.log('products:', productsInput.value);
                console.log('order_amount:', orderAmountInput.value);
                console.log('order_change:', orderChangeInput ? orderChangeInput.value : 'not found');

                // Cek CSRF token
                const csrfToken = document.querySelector('input[name="_token"]');
                if (!csrfToken) {
                    console.error('CSRF token not found!');
                    e.preventDefault();
                    alert('CSRF token tidak ditemukan. Refresh halaman dan coba lagi.');
                    return;
                }

                console.log('CSRF token:', csrfToken.value);

                // Cek semua form data
                const formData = new FormData(e.target);
                console.log('All form data:');
                for (let [key, value] of formData.entries()) {
                    console.log(`${key}: ${value}`);
                }

                // Tampilkan loading state
                const submitBtn = e.target.querySelector('button[type="submit"]');
                submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm"></span> Processing...';
                submitBtn.disabled = true;

                console.log('Form will be submitted now...');

                // Tidak preventDefault, biarkan form submit normal
                // e.preventDefault(); // HAPUS INI untuk testing
            }
        });

        // Tambahkan event listener untuk memonitor jika form benar-benar terkirim
        window.addEventListener('beforeunload', function(e) {
            console.log('Page is about to unload - form might be submitting');
        });

        // Monitor network requests (jika ada fetch/ajax)
        const originalFetch = window.fetch;
        window.fetch = function(...args) {
            console.log('Fetch request:', args);
            return originalFetch.apply(this, arguments);
        };

        function clearCart() {
            cart = {};
            renderCart();
        }

        function updateQty(id, change) {
            if (cart[id]) {
                const newQty = cart[id].qty + change;
                if (newQty <= 0) {
                    delete cart[id];
                } else if (newQty > 999) { // Maksimal qty
                    alert('Maksimal quantity adalah 999');
                    return;
                } else {
                    cart[id].qty = newQty;
                }
                renderCart();
            }
        }
    </script>

    {{-- CSS Hover --}}
    <style>
        /* CSS yang sudah dibersihkan dari duplikat */
        .cart-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 8px 0;
            border-bottom: 1px solid #eee;
            margin-bottom: 8px;
        }

        .cart-summary {
            font-size: 0.95rem;
            line-height: 1.4;
        }

        .cart-summary hr {
            border-top: 1px dashed #ccc;
        }

        .cart-info {
            flex: 1;
        }

        .cart-info strong {
            display: block;
            font-size: 14px;
            margin-bottom: 2px;
        }

        .cart-info small {
            font-size: 12px;
            color: #666;
        }

        .cart-actions {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .quantity-controls {
            display: flex;
            align-items: center;
            margin-right: 10px;
        }

        .quantity-controls button {
            border: none;
            background: #f1f1f1;
            color: #333;
            width: 24px;
            height: 24px;
            line-height: 22px;
            text-align: center;
            border-radius: 4px;
            font-size: 14px;
            cursor: pointer;
            transition: background 0.2s;
        }

        .quantity-controls button:hover {
            background: #ddd;
        }

        .quantity-controls button:active {
            background: #ccc;
        }

        .quantity-controls span {
            display: inline-block;
            min-width: 20px;
            text-align: center;
            font-size: 13px;
            margin: 0 6px;
            font-weight: 500;
        }

        .cart-price {
            font-weight: 600;
            font-size: 14px;
            color: #28a745;
            min-width: 80px;
            text-align: right;
        }

        .remove-item {
            cursor: pointer;
            color: #888;
            font-size: 18px;
            transition: color 0.2s;
            padding: 2px;
        }

        .remove-item:hover {
            color: #dc3545;
        }

        .product-card {
            cursor: pointer;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            border-radius: 10px;
            overflow: hidden;
        }

        .product-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
        }

        .product-card:active {
            transform: translateY(0px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .product-card img {
            height: 200px;
            object-fit: cover;
        }

        /* Loading state untuk tombol bayar */
        .btn-loading {
            position: relative;
            color: transparent !important;
        }

        .btn-loading::after {
            content: "";
            position: absolute;
            width: 16px;
            height: 16px;
            top: 50%;
            left: 50%;
            margin-left: -8px;
            margin-top: -8px;
            border: 2px solid #fff;
            border-radius: 50%;
            border-top-color: transparent;
            animation: spin 0.8s linear infinite;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }
    </style>

@endsection
