<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Categories - FoodHub</title>
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #fff7f3;
            color: #111827;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1100px;
            margin: 60px auto;
            padding: 0 20px;
        }

        h1 {
            text-align: center;
            margin-bottom: 40px;
            font-size: 2.5rem;
            color: #ef3b2d;
        }

        .category {
            background: #fff;
            border-radius: 14px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            margin-bottom: 25px;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .category-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            cursor: pointer;
            padding: 20px 24px;
            background: #ef3b2d;
            color: white;
            font-weight: 700;
            font-size: 1.2rem;
        }

        .category-header:hover {
            background: #d82d21;
        }

        .arrow {
            transition: transform 0.3s ease;
        }

        
        .bx-bowl-hot{
            color:white;
        }

        .category.active .arrow {
            transform: rotate(90deg);
        }

        .foods {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.5s ease;
            background: #fff9f7;
            padding: 0 20px;
        }

        .foods.active {
            padding: 20px;
            max-height: 1000px;
        }

        .foods-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }

        .food-card {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.07);
            text-align: center;
            padding: 20px;
            transition: all 0.3s ease;
        }

        .food-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 15px rgba(0,0,0,0.1);
        }

        .food-card img {
            width: 100%;
            height: 160px;
            border-radius: 10px;
            object-fit: cover;
            margin-bottom: 10px;
        }

        .food-placeholder {
            height: 160px;
            background: linear-gradient(135deg, #ffe0d9, #fff5f2);
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            font-size: 2rem;
        }

        .food-card h4 {
            margin: 8px 0 6px;
            font-size: 1.1rem;
            color: #222;
        }

        .price {
            color: #16a34a;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .btn {
            background: #ef3b2d;
            color: white;
            border: none;
            padding: 8px 18px;
            border-radius: 6px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.3s;
            text-decoration: none;
        }

        .btn:hover {
            background: #d82d21;
        }

        .no-foods {
            color: #777;
            text-align: center;
            padding: 10px 0;
            font-style: italic;
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

    <div class="container">
    <h1><i class='bx bx-bowl-hot'></i> Explore Categories</h1>

    <div class="foods-grid">
        @forelse($categories as $category)
            <div class="food-card">
                <a href="{{ route('categories.show', $category->id) }}" style="text-decoration: none; color: inherit;">
                    @if($category->image)
                        <img src="{{ $category->image }}" alt="{{ $category->name }}">
                    @else
                        <div class="food-placeholder">🍽️</div>
                    @endif
                    <h4>{{ $category->name }}</h4>
                </a>
            </div>
        @empty
            <p class="no-foods">No categories found.</p>
        @endforelse
    </div>

    <div class="footer">
        &copy; {{ date('Y') }} FoodHub | Taste the joy in every bite 🍔
    </div>
</div>


    <script>
        function toggleFoods(id) {
            const foods = document.getElementById('foods-' + id);
            const category = document.getElementById('category-' + id);
            const isActive = foods.classList.contains('active');

            document.querySelectorAll('.foods').forEach(f => f.classList.remove('active'));
            document.querySelectorAll('.category').forEach(c => c.classList.remove('active'));

            if (!isActive) {
                foods.classList.add('active');
                category.classList.add('active');
            }
        }
    </script>

</body>
</html>
