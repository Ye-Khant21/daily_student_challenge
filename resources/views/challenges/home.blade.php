<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daily Student Challenge</title>
</head>

<body>
    <h1>Daily Student Challenge</h1>
    <p>Learn something new. Complete one challenge every day.</p>

    <h2>Today's Challenge</h2>

    @if ($challenge)
    <h3>{{ $challenge->title }}</h3>
    <p>{{ $challenge->description }}</p>
    <p>Maximum points: {{ $challenge->max_points }}</p>
    <p>Created by: {{ $challenge->creator->name }}</p>
    @else
    <p>No challenge is available today. Please check again later.</p>
    @endif
    <a href="{{ route('challenges.history') }}">Previous Challenges</a>
</body>

</html>