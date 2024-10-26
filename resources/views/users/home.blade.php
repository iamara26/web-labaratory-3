<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
                    <button type="submit" class="logout-button">LOGOUT</button>
                </form>
            </div>
        </nav>

        <!-- Main content container -->
        <div class="form-container">
        <h1>𝘼𝙡𝙡-𝙎𝙩𝙖𝙧 𝘾𝙖𝙥𝙨</h1>
            <!-- Pop-up content for About section -->
            <div id="about" class="popup-content" style="display:none;">
                <h2>Welcome to Gonzales Stitch & Style</h2>
                <p>Welcome to Gonzales Stitch & Style – your premier destination for high-quality, custom-made basketball jerseys. At our shop, we specialize in crafting stylish and durable jerseys that not only represent your team but also stand out on the court. With a passion for sportswear and a dedication to top-notch tailoring, we ensure that each jersey is designed with precision and care. Whether you're a player looking to make a statement or a fan wanting to support your team in style, Gonzales Stitch & Style has got you covered. Explore our collection and find the perfect fit for your game!</p>
                <button onclick="closePopup()">Close</button>
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
    </script>
</body>
</html>
