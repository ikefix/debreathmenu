<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart</title>

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #fffaf5;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 700px;
            margin: 0 auto;
        }

        h2 {
            text-align: center;
            color: #ef3b2d;
        }

        .cart-item {
            background: #fff;
            padding: 15px;
            margin-bottom: 15px;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            display: flex;
            gap: 15px;
            align-items: center;
        }

        .cart-item img {
            width: 90px;
            height: 90px;
            border-radius: 10px;
            object-fit: cover;
        }

        .details {
            flex: 1;
        }

        .details h4 {
            margin: 0;
        }

        .qty {
            font-size: 0.9rem;
            color: #555;
        }

        .price {
            color: #10b981;
            font-weight: 700;
        }

        .total {
            text-align: right;
            font-size: 1.2rem;
            margin-top: 25px;
            font-weight: bold;
        }

        .btn {
            background: #ef3b2d;
            color: white;
            padding: 10px 18px;
            border-radius: 8px;
            text-decoration: none;
            display: inline-block;
            margin-top: 20px;
            font-weight: 600;
            text-align: center;
        }

        .empty {
            text-align: center;
            margin-top: 50px;
            color: #777;
            font-size: 1.1rem;
        }

    </style>
</head>
<body>

<div class="container">
    <h2>Your Cart 🛒</h2>

    @if(count($cart) > 0)
        @php $grandTotal = 0; @endphp

        @foreach($cart as $id => $item)
            @php
                $grandTotal += $item['price'] * $item['quantity'];
            @endphp

            <div class="cart-item">
                @if($item['image'])
                    <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}">
                @else
                    <img src="https://picsum.photos/100?random={{ $id }}" alt="">
                @endif

                <div class="details">
                    <h4>{{ $item['name'] }}</h4>
                    <p class="qty">Quantity: {{ $item['quantity'] }}</p>
                    <p class="price">₦{{ number_format($item['price'], 2) }}</p>
                </div>
            </div>
        @endforeach

        <p class="total">Total: ₦{{ number_format($grandTotal, 2) }}</p>

        <a href="#" class="btn">Proceed to Checkout</a>

    @else
        <p class="empty">Your cart is empty 😞</p>
    @endif

</div>

</body>
</html>
