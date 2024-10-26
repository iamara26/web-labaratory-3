<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create User</title>
    <link rel="stylesheet" href="{{ asset('des1.css') }}">
</head>
<body style="background: url('{{ asset('imagewb/bg.jpeg') }}') no-repeat center center fixed; background-size: cover;">

    <div class="hero">

        <div class="form-container">
            <h1>Create New User</h1>
            <form action="{{ route('users.store') }}" method="POST">
                @csrf

                <!-- Display Validation Errors -->
                @if ($errors->any())
                    <div class="error-container">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required><br>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required><br>

                <label for="role">Role:</label>
                <select id="role" name="role" required>
                    <option value="">Select Role</option>
                    <option value="Admin" {{ old('role') == 'Admin' ? 'selected' : '' }}>Admin</option>
                    <option value="Customer" {{ old('role') == 'Customer' ? 'selected' : '' }}>Customer</option>
                </select><br>

                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required><br>

                <label for="password_confirmation">Confirm Password:</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required><br>

                <button type="submit">Create User</button>
            </form>
            <a href="{{ route('users.index') }}" class="back-link">Back to User List</a>
        </div>
    </div>
</body>
</html>
