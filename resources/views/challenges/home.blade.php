<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daily Student Challenge</title>
</head>

<body>
    <h1>Daily Student Challenge</h1>
    @auth
    <p>Welcome, {{ auth()->user()->name }}!</p>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Log out</button>
    </form>
    @else
    <a href="{{ route('login') }}">Log in</a>
    <a href="{{ route('register') }}">Create an account</a>
    @endauth
    <p>Learn something new. Complete one challenge every day.</p>

    <h2>Today's Challenge</h2>

    @if ($challenge)
    <h3>{{ $challenge->title }}</h3>
    <p>{{ $challenge->description }}</p>
    <p>Maximum points: {{ $challenge->max_points }}</p>
    <p>Created by: {{ $challenge->creator->name }}</p>
    @auth
    @if ($submission)
    <p>Answer submitted.</p>
    @if ($submission->reviewed_at === null)
    <p>Awaiting review.</p>
    @endif
    @else
    <form method="POST" action="{{ route('submissions.store', $challenge) }}">
        @csrf

        <label for="answer">Your answer</label>
        <textarea id="answer" name="answer" rows="5"
            maxlength="5000" required>{{ old('answer') }}</textarea>

        @error('answer')
        <p>{{ $message }}</p>
        @enderror

        <button type="submit">Submit answer</button>
    </form>
    @endif
    @else
    <p><a href="{{ route('login') }}">Log in to submit an answer</a></p>
    @endauth
    @else
    <p>No challenge is available today. Please check again later.</p>
    @endif
    <a href="{{ route('challenges.history') }}">Previous Challenges</a>
</body>

</html>
