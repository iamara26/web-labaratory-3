<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <link rel="stylesheet" href="{{ asset('des1.css') }}">
</head>
<body>
    <div class="container">
        <aside class="sidebar">
            <!-- Navigation Link to Home Page -->
            <a href="{{ route('admin.home') }}" class="nav-link">Back to Home</a>

            <!-- Link to add a new user -->
            <a href="{{ route('admin.users.create') }}" class="add-user-link">Add New User</a>
        </aside>

        <main class="content">
            <h1>User List</h1>

            <!-- Display success message if available -->
            @if (session('success'))
                <div class="message">
                    {{ session('success') }}
                </div>
            @endif

            <!-- List of users -->
            <ul>
                @foreach ($users as $user)
                    <li>
                        <strong>{{ $user->name }}</strong> - <strong>{{ $user->role }}</strong> - {{ $user->email }}<br>
                        <a href="{{ route('admin.users.show', $user->id) }}" class="view-button">View</a>
                        <a href="{{ route('admin.users.edit', $user->id) }}" class="edit-button">Edit</a>
                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="delete-button">Delete</button>
                        </form>
                    </li>
                @endforeach
            </ul>
        </main>
    </div>
</body>
</html>
