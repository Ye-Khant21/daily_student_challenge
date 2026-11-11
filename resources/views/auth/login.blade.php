<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Log in</title>
</head>

<body>
    <h1>Log in</h1>

    @foreach ($errors->all() as $error)
    <p>{{ $error }}</p>
    @endforeach

    <form method="POST" action="{{ route('login.store') }}">
        @csrf

        <p>
            <label for="email">Email</label>
            <input id="email" name="email" type="email"
                value="{{ old('email') }}" autocomplete="username" required>
        </p>

        <p>
            <label for="password">Password</label>
            <input id="password" name="password" type="password"
                autocomplete="current-password" required>
        </p>

        <button type="submit">Log in</button>
    </form>

    <p><a href="{{ route('register') }}">Create an account</a></p>
</body>

</html>