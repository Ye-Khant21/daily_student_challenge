@extends('layouts.app')

@section('title', 'Past challenges')

@section('content')
<h1>Previous Challenges</h1>

@forelse ($challenges as $challenge)
<article>
    <h2>{{ $challenge->title }}</h2>
    <p>Date: {{ $challenge->challenge_date }}</p>
    <p class="prose">{{ $challenge->description }}</p>
    <p>Maximum points: {{ $challenge->max_points }}</p>
    <p>Created by: {{ $challenge->creator->name }}</p>
</article>
@empty
<p>No previous challenges yet.</p>
@endforelse
@endsection
