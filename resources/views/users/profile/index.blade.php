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

        <div class="container">
            <form action="{{ route('users.profile.update') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ auth()->user()->name }}" required>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ auth()->user()->email }}" required>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary">Update Profile</button>
            </form>

            <h2>Change Password</h2>

            <form action="{{ route('users.profile.changePassword') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="old_password">Old Password</label>
                    <input type="password" name="old_password" id="old_password" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="new_password">New Password</label>
                    <input type="password" name="new_password" id="new_password" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="confirm_password">Confirm Password</label>
                    <input type="password" name="confirm_password" id="confirm_password" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary">Change Password</button>
            </form>

            <h2>Delete Account</h2>

            <form action="{{ route('users.profile.delete') }}" method="POST">
                @csrf
                @method('DELETE')

                <button type="submit" class="btn btn-danger">Delete Account</button>
            </form>
        </div>
    </div>
</body>
</html>
