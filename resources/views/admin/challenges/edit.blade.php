@extends('layouts.app')

@section('title', 'Edit challenge')

@section('content')
<h1>Edit {{ $challenge->title }}</h1>

<form class="panel" method="POST" action="{{ route('admin.challenges.update', $challenge) }}">
    @csrf
    @method('PATCH')

    @if ($hasSubmissions)
    <p>This challenge has answers. You can still change its publish status.</p>
    @else
    <p>
        <label for="title">Title</label>
        <input id="title" name="title" maxlength="255"
            value="{{ old('title', $challenge->title) }}" required>
    </p>

    <p>
        <label for="description">Instructions</label>
        <textarea id="description" name="description" rows="5"
            maxlength="5000" required>{{ old('description', $challenge->description) }}</textarea>
    </p>

    <p>
        <label for="challenge_date">Challenge date</label>
        <input id="challenge_date" name="challenge_date" type="date"
            value="{{ old('challenge_date', $challenge->challenge_date) }}" required>
    </p>

    <p>
        <label for="max_points">Maximum points</label>
        <input id="max_points" name="max_points" type="number" min="1" max="1000"
            value="{{ old('max_points', $challenge->max_points) }}" required>
    </p>
    @endif

    <input type="hidden" name="is_published" value="0">
    <label>
        <input type="checkbox" name="is_published" value="1"
            @checked(old('is_published', $challenge->is_published))>
        Publish challenge
    </label>

    <button type="submit">Save changes</button>
</form>

<a href="{{ route('admin.challenges.index') }}">Back to challenges</a>
@endsection
