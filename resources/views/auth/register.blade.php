@extends('layouts.app')

@section('title', 'Register')

@section('page-class', 'account-page')

@section('content')
<h1>Create your student account</h1>

<form class="panel" method="POST" action="{{ route('register.store') }}">
    @csrf

    <p>
        <label for="name">Name</label>
        <input id="name" name="name" type="text"
            value="{{ old('name') }}" required>
    </p>

    <p>
        <label for="email">Email</label>
        <input id="email" name="email" type="email"
            value="{{ old('email') }}" required>
    </p>

    <p>
        <label for="password">Password</label>
        <input id="password" name="password" type="password"
            minlength="8" required>
    </p>

    <p>
        <label for="password_confirmation">Confirm password</label>
        <input id="password_confirmation"
            name="password_confirmation"
            type="password" required>
    </p>

    <button type="submit">Register</button>
</form>
@endsection
