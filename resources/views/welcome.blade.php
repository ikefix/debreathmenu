<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome - FoodHub</title>

    <link href="https://fonts.bunny.net/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #fff8f3, #ffe5d0);
            color: #1a1a1a;
            margin: 0;
            padding: 0;
        }

        /* CART ICON */
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

        /* SIDEBAR CART */
        .cart-sidebar {
            position: fixed;
            top: 0;
            right: -350px;
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

        /* HEADER */
        .header {
            text-align: center;
            background: #ef3b2d;
            color: white;
            padding: 60px 20px;
            border-bottom-left-radius: 40px;
            border-bottom-right-radius: 40px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
        }

        .header h1 {
            font-size: 3rem;
            margin: 0;
        }

        .header p {
            font-size: 1.1rem;
            opacity: 0.9;
            margin-bottom: 20px;
        }

        .header .category-btn {
            display: inline-block;
            background: white;
            color: #ef3b2d;
            padding: 10px 24px;
            border-radius: 25px;
            font-weight: 600;
            text-decoration: none;
            transition: 0.3s;
            border: 2px solid white;
        }

        .header .category-btn:hover {
            background: transparent;
            color: white;
            border-color: white;
        }

        /* GRID */
        .container {
            max-width: 1200px;
            margin: 50px auto;
            padding: 0 20px;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 30px;
        }

        .card {
            background: #fff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
            transition: all 0.35s ease;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
        }

        .no-image {
            width: 100%;
            height: 210px;
            background: linear-gradient(135deg, #fff1eb 0%, #ace0f9 100%);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: #444;
            border-bottom: 4px solid #ef3b2d;
        }

        .no-image .icon {
            font-size: 2.8rem;
            margin-bottom: 8px;
        }

        .card img {
            width: 100%;
            height: 210px;
            object-fit: cover;
            border-bottom: 4px solid #ef3b2d;
        }

        .card-content {
            padding: 20px;
            text-align: center;
        }

        .card-content h3 {
            font-size: 1.4rem;
            color: #333;
            margin-bottom: 10px;
        }

        .price {
            color: #16a34a;
            font-weight: 700;
            font-size: 1.2rem;
            margin: 10px 0;
        }

        .btn {
            display: inline-block;
            background: #ef3b2d;
            color: white;
            padding: 10px 22px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            margin-top: 15px;
            transition: 0.3s;
            border: none;
            cursor: pointer;
        }

        .btn:hover {
            background: #d42e21;
        }

        .footer {
            text-align: center;
            margin-top: 70px;
            padding: 25px 0;
            color: #444;
            font-size: 0.9rem;
            border-top: 1px solid #ddd;
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
                        @method('DELETE')
                        <button class="remove-btn">🗑️</button>
                    </form>
                </div>
            @if(!empty($cart))
                <form action="{{ route('order.complete') }}" method="POST">
                    @csrf
                    <button type="submit" class="checkout-btn">Complete Order ✅</button>
                </form>
            @endif

        </div>

        @if(!empty($cart))
            <a href="#" class="checkout-btn">Complete Order ✅</a>
        @endif
    </div>

    <!-- HEADER -->
    <div class="header">
        <h1><i class='bx bx-bowl-hot'></i> Welcome to FoodHub</h1>
        <p>Discover fresh and delicious meals around you</p>
        <a href="{{ route('browse.categories') }}" class="category-btn">
            <i class='bx bx-list-ul'></i> Browse by Category
        </a>
    </div>


    <!-- FOOD GRID -->
    <div class="container">
        <div class="grid">

            @forelse($foods as $food)
                <div class="card">

                    @if($food->image_url)
                        <img src="{{ $food->image_url }}" alt="{{ $food->name }}">
                    @else
                        <div class="no-image">
                            <div class="icon">🍲</div>
                            <p>No image available</p>
                        </div>
                    @endif

                    <div class="card-content">
                        <h3>{{ $food->name }}</h3>
                        <p class="price">₦{{ number_format($food->price, 2) }}</p>
                        <p>{{ Str::limit($food->description, 80) }}</p>

                        <form action="{{ route('add.to.cart', $food->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn">Order Now</button>
                        </form>

                    </div>
                </div>
            @empty
                <p class="no-foods">No foods uploaded yet.</p>
            @endforelse

        </div>
    </div>

    <div class="footer">
        &copy; {{ date('Y') }} FoodHub | Fresh & Delicious Meals 🍲
    </div>

    <!-- ✅ JS TOGGLE SCRIPT -->
    <script>
        function toggleCart() {
            document.getElementById("cartSidebar").classList.toggle("active");
        }
    </script>

</body>

</html>
