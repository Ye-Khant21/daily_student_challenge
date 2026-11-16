@extends('layouts.app')

@section('title', 'Manage challenges')

@section('content')
<div>
    <h1>Manage challenges</h1>

    <a href="{{ route('admin.submissions.index') }}">Back to admin dashboard</a>
    <a href="{{ route('admin.challenges.create') }}">Create daily challenge</a>

    <ul class="challenge-list">
        @forelse ($challenges as $challenge)
        <li>
            {{ $challenge->challenge_date }} — {{ $challenge->title }}
            ({{ $challenge->is_published ? 'Published' : 'Draft' }})
            <a href="{{ route('admin.challenges.edit', $challenge) }}">Edit</a>
        </li>
        @empty
        <li>No challenges yet.</li>
        @endforelse
    </ul>

    {{ $challenges->links('layouts.pagination') }}
</div>
@endsection
