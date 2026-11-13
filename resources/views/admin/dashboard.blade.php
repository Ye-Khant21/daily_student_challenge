<h1>Admin Dashboard</h1>
<a href="{{ route('home') }}">Back to home</a>
<a href="{{ route('admin.challenges.create') }}">Create daily challenge</a>

<h2>Student submissions</h2>

@if (session('success'))
<p>{{ session('success') }}</p>
@endif

@foreach ($errors->all() as $error)
<p>{{ $error }}</p>
@endforeach

@forelse ($submissions as $submission)
<article>
    <h3>{{ $submission->challenge->title }}</h3>
    <p>Student: {{ $submission->user->name }}</p>
    <p>{{ $submission->answer }}</p>

    @if ($submission->reviewed_at === null)
    <p>Awaiting review</p>
    <form method="POST" action="{{ route('admin.submissions.approve', $submission) }}">
        @csrf
        @method('PATCH')

        <label for="points-{{ $submission->id }}">Points</label>
        <input id="points-{{ $submission->id }}" name="points_awarded"
            type="number" min="0" max="{{ $submission->challenge->max_points }}"
            step="1" required>

        <label for="feedback-{{ $submission->id }}">Feedback (optional)</label>
        <textarea id="feedback-{{ $submission->id }}" name="feedback"
            rows="3" maxlength="2000"></textarea>

        <button type="submit">Save review</button>
    </form>
    @else
    <p>Score: {{ $submission->points_awarded }} / {{ $submission->challenge->max_points }}</p>
    @if ($submission->feedback !== null && $submission->feedback !== '')
    <p>Feedback: {{ $submission->feedback }}</p>
    @endif
    @endif
</article>
<hr>
@empty
<p>No submissions yet.</p>
@endforelse

{{ $submissions->links() }}
