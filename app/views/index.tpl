@extends('layout')

@section('content')
    <h1>Index page</h1>

    <?php if (empty($user)): ?>
        <p>Welcome to the site where you can make <a href="/register">registration</a> your's account or do <a href="/login">login</a>.</p>
    <?php else : ?>
        <p>Your detailed information:</p>
    <?php endif; ?>

    <?php if (!empty($user)): ?>
        <?php
            $displayFields = [
                'name' => 'First name',
                'last_name' => 'Last name',
                'middle_name' => 'Middle name',
                'birth_year' => 'Birth year',
                'location' => 'Location',
                'marital_status' => 'Marital status',
                'email' => 'Email',
                'phone' => 'Phone',
                'education' => 'Education',
                'experience' => 'Experience',
                'additional' => 'Additional',
                'filename' => 'Uploaded file',
            ];
        ?>
        <table class="userDetails">
            <?php foreach ($displayFields as $key => $fieldTitle) : ?>
                <?php if (!empty($user->$key)) : ?>
                    <tr>
                        <td>{{ $fieldTitle }}</td>
                        <td>
                            <?php if ($key === 'filename') : ?>
                                <img src="/uploads/{{ \Services\UserService::produceUserCategoryDir($user) . $user->filename }}"/>
                            <?php else : ?>
                                {{ $user->$key }}
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endif; ?>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
@stop