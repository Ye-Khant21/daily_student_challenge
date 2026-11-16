@extends('layouts.app')

@section('title', 'Log in')

@section('page-class', 'account-page')

@section('content')
<h1>Log in</h1>

<form class="panel" method="POST" action="{{ route('login.store') }}">
    @csrf

    <p>
        <label for="email">Email</label>
        <input id="email" name="email" type="email"
            value="{{ old('email') }}" autocomplete="username" required>
    </p>

    <p>
        <label for="password">Password</label>
        <input id="password" name="password" type="password"
            autocomplete="current-password" required>
    </p>

    <button type="submit">Log in</button>
</form>

<p><a href="{{ route('register') }}">Create an account</a></p>
@endsection
