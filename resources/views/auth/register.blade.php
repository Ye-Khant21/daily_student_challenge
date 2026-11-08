<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>

<body>
    <h1>Create your student account</h1>

    @if ($errors->any())
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
    @endif

    <form method="POST" action="{{ route('register.store') }}">
        @csrf

        <p>
            <label for="name">Name</label><br>
            <input id="name" name="name" type="text"
                value="{{ old('name') }}" required>
        </p>

        <p>
            <label for="email">Email</label><br>
            <input id="email" name="email" type="email"
                value="{{ old('email') }}" required>
        </p>

        <p>
            <label for="password">Password</label><br>
            <input id="password" name="password" type="password"
                minlength="8" required>
        </p>

        <p>
            <label for="password_confirmation">Confirm password</label><br>
            <input id="password_confirmation"
                name="password_confirmation"
                type="password" required>
        </p>

        <button type="submit">Register</button>
    </form>

    <p><a href="{{ route('home') }}">Back to home</a></p>
</body>

</html>