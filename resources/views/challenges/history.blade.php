<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Previous Challenges</title>
</head>

<body>
    <a href="{{ route('home') }}">Back to today's challenge</a>

    <h1>Previous Challenges</h1>

    @forelse ($challenges as $challenge)
    <article>
        <h2>{{ $challenge->title }}</h2>
        <p>Date: {{ $challenge->challenge_date }}</p>
        <p>{{ $challenge->description }}</p>
        <p>Maximum points: {{ $challenge->max_points }}</p>
        <p>Created by: {{ $challenge->creator->name }}</p>
    </article>
    <hr>
    @empty
    <p>No previous challenges yet.</p>
    @endforelse
</body>

</html>