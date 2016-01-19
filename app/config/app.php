<?php

return [
    'errors' => [
        'email.required' => 'Email is required',
        'email.email' => 'Email not correct',
        'password.required' => 'Password is required',
        'password.confirmed' => 'Passwords are mismatched',
        'file.mimes' => 'Uploaded file not gif, png or jpeg',
        'user.email_duplicate' => 'User with specified email exists',
        'user.unexpected' => 'Unexpected error',
    ],

    'errorsPages' => [
        404 => '404',
        403 => '403',
    ],

    'userUploadDir' => APP_DIR . '../public/uploads/',
];