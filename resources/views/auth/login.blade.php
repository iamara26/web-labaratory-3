<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Login -  𝘼𝙡𝙡-𝙎𝙩𝙖𝙧 𝘾𝙖𝙥𝙨</title>
    <link rel="stylesheet" href="{{ asset('style.css') }}">

    <style>
        body {
            background: url('{{ asset('details/capbg.jpeg') }}') no-repeat center center fixed;
            background-size: cover;
            font-family: Arial, sans-serif;
        }

        .login-container {
            max-width: 400px;
            margin: 100px auto;
            padding: 20px;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.2);
        }

        .login-container h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        .login-container .form-group {
            margin-bottom: 15px;
        }

        .login-container .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .login-container .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .login-container .btn-primary {
            width: 100%;
            padding: 10px;
            background-color: #007BFF; /* Changed to blue */
            border: none;
            border-radius: 5px;
            color: white;
            cursor: pointer;
        }

        .login-container .btn-primary:hover {
            background-color: #0056b3; /* Darker blue on hover */
        }

        .login-container .links {
            text-align: center;
            margin-top: 15px;
        }

        .login-container .links a {
            color: #007BFF; /* Changed to blue */
            text-decoration: none;
        }

        .login-container .links a:hover {
            text-decoration: underline;
            color: #0056b3; /* Darker blue on hover */
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group">
                <label for="email">Email Address</label>
                <input id="email" type="email" name="email" required autofocus>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input id="password" type="password" name="password" required>
            </div>

            <button type="submit" class="btn-primary">Login</button>

            <div class="links">
                @if (Route::has('register'))
                    <a href="{{ route('register') }}">Register</a> |
                @endif
                <a href="{{ route('password.request') }}">Forgot Password?</a>
            </div>
        </form>
    </div>
</body>
</html>
