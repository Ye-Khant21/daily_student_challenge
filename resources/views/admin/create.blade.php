<h1>Create daily challenge</h1>

@foreach ($errors->all() as $error)
<p>{{ $error }}</p>
@endforeach

<form method="POST" action="{{ route('admin.challenges.store') }}">
    @csrf

    <p>
        <label for="title">Title</label>
        <input id="title" name="title" value="{{ old('title') }}"
            maxlength="255" required>
    </p>

    <p>
        <label for="description">Instructions</label>
        <textarea id="description" name="description" rows="5"
            maxlength="5000" required>{{ old('description') }}</textarea>
    </p>

    <p>
        <label for="challenge_date">Challenge date</label>
        <input id="challenge_date" name="challenge_date" type="date"
            value="{{ old('challenge_date') }}" required>
    </p>

    <p>
        <label for="max_points">Maximum points</label>
        <input id="max_points" name="max_points" type="number"
            min="1" max="1000" value="{{ old('max_points', 10) }}" required>
    </p>

    <p>
        <label>
            <input name="is_published" type="checkbox" value="1" {{ old('is_published') ? 'checked' : '' }} />

            Publish challenge
        </label>
    </p>

    <button type="submit">Save challenge</button>
</form>

<a href="{{ route('admin.submissions.index') }}">Back to admin dashboard</a>