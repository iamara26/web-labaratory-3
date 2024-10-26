<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Details</title>
    <link rel="stylesheet" href="{{ asset('des1.css') }}">
</head>
<body style="background: url('{{ asset('imagewb/bg.jpeg') }}') no-repeat center center fixed; background-size: cover;">

    <div class="hero">

        <div class="user-details-container">
            <h1>User Details</h1>
            <p><strong>Name:</strong> {{ $user->name }}</p>
            <p><strong>Email:</strong> {{ $user->email }}</p>
            <p><strong>Role:</strong> {{ $user->role }}</p>

            <a href="{{ route('users.edit', $user->id) }}" class="edit-button">Edit User</a>
            <a href="{{ route('users.index') }}" class="back-link">Back to User List</a>
        </div>
    </div>
</body>
</html>
