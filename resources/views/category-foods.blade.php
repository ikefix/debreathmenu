<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $category->name }} - FoodHub</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #fff7f3;
            margin: 0;
            padding: 0;
        }

        /* ✅ CART ICON */
        .cart-icon {
            position: fixed;
            top: 20px;
            right: 25px;
            background: #ef3b2d;
            color: white;
            padding: 12px 18px;
            border-radius: 50px;
            font-size: 1.1rem;
            cursor: pointer;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            z-index: 999;
        }

        .cart-icon .count {
            background: white;
            color: #ef3b2d;
            padding: 3px 8px;
            border-radius: 8px;
            margin-left: 5px;
            font-weight: bold;
        }

        /* ✅ SIDEBAR CART */
        .cart-sidebar {
            position: fixed;
            top: 0;
            right: -400px;
            width: 350px;
            height: 100%;
            background: white;
            box-shadow: -5px 0 20px rgba(0, 0, 0, 0.2);
            transition: 0.35s;
            padding: 20px;
            overflow-y: auto;
            z-index: 1000;
        }

        .cart-sidebar.active {
            right: 0;
        }

        .cart-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .close-btn {
            cursor: pointer;
            font-size: 1.2rem;
        }

        .cart-item {
            display: flex;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid #eee;
        }

        .cart-item-info {
            flex: 1;
        }

        .remove-btn {
            border: none;
            background: none;
            cursor: pointer;
            font-size: 1.4rem;
        }

        .checkout-btn {
            display: block;
            background: #ef3b2d;
            color: white;
            text-align: center;
            padding: 12px;
            border-radius: 10px;
            margin-top: 20px;
            text-decoration: none;
            font-weight: bold;
        }

        .empty-cart {
            text-align: center;
            color: #777;
            margin-top: 50px;
            font-size: 1rem;
        }

        .container {
            max-width: 1100px;
            margin: 80px auto;
            padding: 0 20px;
        }

        h1 {
            text-align: center;
            color: #ef3b2d;
            margin-bottom: 20px;
        }

        .back-link {
            text-decoration: none;
            color: #ef3b2d;
            display: inline-flex;
            align-items: center;
            font-weight: 600;
            margin-bottom: 30px;
        }

        .back-link i {
            margin-right: 6px;
        }

        .foods-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }

        .food-card {
            background: white;
            border-radius: 14px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            text-align: center;
            padding: 20px;
            transition: 0.3s;
        }

        .food-card:hover {
            transform: translateY(-5px);
        }

        .food-card img {
            width: 100%;
            height: 180px;
            object-fit: cover;
            border-radius: 10px;
        }

        .food-placeholder {
            height: 180px;
            background: linear-gradient(135deg, #ffe0d9, #fff5f2);
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            font-size: 2rem;
        }

        .food-card h4 {
            margin: 12px 0 6px;
        }

        .price {
            color: #16a34a;
            font-weight: bold;
        }

        .btn {
            background: #ef3b2d;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 6px;
            cursor: pointer;
            margin-top: 8px;
            transition: 0.3s;
            text-decoration: none;
        }

        .btn:hover {
            background: #d82d21;
        }

        .footer {
            text-align: center;
            margin-top: 60px;
            color: #777;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>

    <!-- ✅ CART ICON -->
    <div class="cart-icon" onclick="toggleCart()">
        🛒 <span class="count">{{ session('cart') ? count(session('cart')) : 0 }}</span>
    </div>

    <!-- ✅ CART SIDEBAR -->
    <div id="cartSidebar" class="cart-sidebar">
        <div class="cart-header">
            <h3>My Cart</h3>
            <span class="close-btn" onclick="toggleCart()">✖</span>
        </div>

        <div class="cart-items">
            @php $cart = session('cart') ?? []; @endphp

            @forelse($cart as $id => $item)
                <div class="cart-item">
                    <div class="cart-item-info">
                        <strong>{{ $item['name'] }}</strong>
                        <p>₦{{ number_format($item['price'], 2) }} × {{ $item['quantity'] }}</p>
                    </div>

                    <form action="{{ route('cart.remove', $id) }}" method="POST">
                        @csrf
                        <button class="remove-btn">🗑️</button>
                    </form>

                </div>
            @empty
                <p class="empty-cart">Your cart is empty 🛒</p>
            @endforelse

            @if(!empty($cart))
                <form action="{{ route('order.complete') }}" method="POST">
                    @csrf
                    <button type="submit" class="checkout-btn">Complete Order ✅</button>
                </form>
            @endif
        </div>
    </div>

    <!-- ✅ MAIN CONTENT -->
    <div class="container">
        <a href="{{ route('browse.categories') }}" class="back-link">
            <i class='bx bx-arrow-back'></i> Back to Categories
        </a>

        <h1>{{ $category->name }}</h1>

        <div class="foods-grid">
            @forelse($category->foods as $food)
                <div class="food-card">
                    @if($food->image_url)
                        <img src="{{ $food->image_url }}" alt="{{ $food->name }}">
                    @else
                        <div class="food-placeholder">🍔</div>
                    @endif

                    <h4>{{ $food->name }}</h4>
                    <p class="price">₦{{ number_format($food->price, 2) }}</p>

                    <form action="{{ route('add.to.cart', $food->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn">Order Now</button>
                    </form>
                </div>
            @empty
                <p class="no-foods">No foods available in this category.</p>
            @endforelse
        </div>

        <div class="footer">
            &copy; {{ date('Y') }} FoodHub | Taste the joy in every bite 🍔
        </div>
    </div>

    <!-- ✅ JS TOGGLE SCRIPT -->
    <script>
        function toggleCart() {
            document.getElementById("cartSidebar").classList.toggle("active");
        }
    </script>

</body>
</html>
