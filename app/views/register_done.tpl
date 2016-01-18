@extends('layout')

@section('content')
    <h1>Registered</h1>
    <p>Your account have been registered</p>
    <p>
        Your name is: {{ $user->name }}
        <?php if (!empty($user->filename)) : ?>
            <br/>Your uploaded image is: <img src="/uploads/{{ \Services\UserService::produceUserCategoryDir($user) . $user->filename }}"/>
        <?php endif; ?>
    </p>
@stop