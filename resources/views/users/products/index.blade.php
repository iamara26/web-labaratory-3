<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <title>𝘼𝙡𝙡-𝙎𝙩𝙖𝙧 𝘾𝙖𝙥𝙨</title>
    <link rel="stylesheet" href="{{ asset('style.css') }}">
</head>
<body style="background: url('{{ asset('details/capbg.jpeg') }}') no-repeat center center fixed; background-size: cover;">

    <div class="hero">
        <nav>
            <img src="{{ asset('details/c6.png') }}" class="logo" alt="Gonzales Stitch & Style Logo">
            <ul>
                <li><a href="{{ route('users.home') }}">HOME</a></li>
                <li><a href="{{ route('users.profile.index') }}">PROFILE</a></li>
                <li><a href="{{ route('users.products.index') }}">VIEW PRODUCTS</a></li>
            </ul>

            <div class="nav-right">
                <!-- Logout Button -->
                <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="logout-button" aria-label="Logout">LOGOUT</button>
                </form>
            </div>
        </nav>

        <!-- Main content container -->
        <div class="main-container">
            <!-- Sidebar for Category Filter -->
            <div class="sidebar">
                <form action="{{ route('users.products.index') }}" method="GET" class="category-filter">
                    <label for="category_id">Filter by Category:</label>
                    <select name="category_id" id="category_id" onchange="this.form.submit()">
                        <option value="">All Categories</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </form>
            </div>

            <!-- Product Cards Section -->
            <div class="content">
            <h1>𝘼𝙡𝙡-𝙎𝙩𝙖𝙧 𝘾𝙖𝙥𝙨</h1>
                <div class="product-cards">
                    @forelse($products as $product)
                        <div class="product-card">
                            <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->product_name }}" class="product-image">
                            <h3 class="product-name">{{ $product->product_name }}</h3>
                            <p class="product-price">Price: ₱{{ number_format($product->price, 2) }}</p>
                            <p class="product-stock">Stock: {{ $product->stock }}</p>
                            <button class="add-to-cart" aria-label="Add {{ $product->product_name }} to cart">Add to Cart</button>
                        </div>
                    @empty
                        <p class="no-products">No products found</p>
                    @endforelse
                </div>

                <!-- Loading Indicator -->
                <div id="loading" style="display: none;">Loading...</div>

                <!-- Pop-up content for About section -->
                <div id="about" class="popup-content" style="display:none;">
                    <h2>Welcome to Gonzales Stitch & Style</h2>
                    <p>Welcome to Gonzales Stitch & Style – your premier destination for high-quality, custom-made basketball jerseys. At our shop, we specialize in crafting stylish and durable jerseys that not only represent your team but also stand out on the court. With a passion for sportswear and a dedication to top-notch tailoring, we ensure that each jersey is designed with precision and care. Whether you're a player looking to make a statement or a fan wanting to support your team in style, Gonzales Stitch & Style has got you covered. Explore our collection and find the perfect fit for your game!</p>
                    <button onclick="closePopup()">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Show the popup content
        document.getElementById('about-link').addEventListener('click', function(e) {
            e.preventDefault();
            document.querySelector('.popup-content').style.display = 'block';
        });

        // Close the popup content
        function closePopup() {
            document.querySelector('.popup-content').style.display = 'none';
        }

        // Show loading indicator
        function fetchProducts() {
            document.getElementById('loading').style.display = 'block';
            // Fetch products logic...
            // Hide loading indicator once products are loaded
            document.getElementById('loading').style.display = 'none';
        }
    </script>
</body>
</html>
