@extends('layouts.app')

@section('title', 'My submissions')

@section('content')
<h1>My submissions</h1>

<div class="points-summary">
    <span>Total points</span>
    <strong>{{ $totalPoints }}</strong>
</div>

@forelse ($submissions as $submission)
<article>
    <h2>{{ $submission->challenge->title }}</h2>
    <p class="prose">{{ $submission->answer }}</p>

    @if ($submission->reviewed_at === null)
        <p>Awaiting review</p>
    @else
        <p>Score: {{ $submission->points_awarded }} / {{ $submission->challenge->max_points }}</p>

        @if ($submission->feedback !== null && $submission->feedback !== '')
            <p>Feedback: {{ $submission->feedback }}</p>
        @endif
    @endif
</article>
@empty
<p>You haven’t submitted an answer yet.</p>
@endforelse

{{ $submissions->links('layouts.pagination') }}
@endsection
