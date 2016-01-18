@extends('layout')

@section('content')
    <?php if (!empty($user)): ?>
        <p>Your are logged as {{ $user->name }}</p>
        <ul>
            <li><a href="/logout">Logout</a></li>
        </ul>
    <?php else: ?>
        <ul>
            <li><a href="/login">Login</a></li>
            <li><a href="/register">Sign in</a></li>
        </ul>
    <?php endif; ?>
@stop