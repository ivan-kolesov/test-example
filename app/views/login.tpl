@extends('layout')

@section('scripts')
    <script type="text/javascript" src="/assets/js/formPrototype.js"></script>
    <script type="text/javascript" src="/assets/js/loginForm.js"></script>
@stop

@section('content')
    <h1>Login</h1>

    <div class="errors"></div>

    <form method="post" action="/login" id="loginForm">
        <ul>
            <li>
                <label>Email</label>
                <input type="email" name="email"/>
            </li>
            <li>
                <label>Password</label>
                <input type="password" name="password"/>
            </li>
        </ul>

        <button type="button" id="js-login">Login</button>
    </form>
@stop