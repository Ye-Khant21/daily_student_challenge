@extends('layouts.app')

@section('title', 'Today’s challenge')

@section('content')
<div class="hero">
    <div class="hero-content">
        <time class="hero-date" datetime="{{ today()->toDateString() }}">{{ today()->format('l, F j') }}</time>
        <h1>Today’s challenge</h1>
        @auth
            <p>Welcome, {{ auth()->user()->name }}.</p>
        @else
            <p>Learn something new, one challenge at a time.</p>
        @endauth
    </div>
</div>

@if ($challenge)
    <article class="featured">
        <div class="card-heading">
            <h2>{{ $challenge->title }}</h2>
            <span class="badge">{{ $challenge->max_points }} points possible</span>
        </div>
        <p class="prose">{{ $challenge->description }}</p>
        <p class="meta">Created by {{ $challenge->creator->name }}</p>

        <div class="challenge-response">
            @auth
                @if ($submission)
                    <p class="notice success" role="status">
                        {{ $submission->reviewed_at === null ? 'Answer submitted. Awaiting review.' : 'Your answer has been reviewed.' }}
                    </p>
                    <a href="{{ route('student.dashboard') }}">View my submissions</a>
                @else
                    <form method="POST" action="{{ route('submissions.store', $challenge) }}">
                        @csrf
                        <label for="answer">Your answer</label>
                        <textarea id="answer" name="answer" rows="5"
                                  maxlength="5000" required>{{ old('answer') }}</textarea>
                        <button type="submit">Submit answer</button>
                    </form>
                @endif
            @else
                <a class="button" href="{{ route('login') }}">Log in to submit an answer</a>
            @endauth
        </div>
    </article>
@else
    <section class="featured panel">
        <h2>No challenge today</h2>
        <p class="meta">Check back tomorrow or browse previous challenges.</p>
        <a class="button secondary" href="{{ route('challenges.history') }}">Browse past challenges</a>
    </section>
@endif
@endsection
