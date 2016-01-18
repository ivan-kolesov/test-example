@extends('layout')

@section('scripts')
    <script type="text/javascript" src="/assets/js/formPrototype.js"></script>
    <script type="text/javascript" src="/assets/js/registerForm.js"></script>
@stop

@section('content')
    <h1 data-key="registrationTitle">Sign in</h1>

    <div class="errors">
        <?php if (!empty($errors)) : ?>
            <ul>
            <?php foreach ($errors as $error) : ?>
                <?php if (!empty(\Kernel\Config::get('app.errors')[$error])) : ?>
                    <li>{{ \Kernel\Config::get('app.errors')[$error] }}</li>
                <?php endif; ?>
            <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>

    <label for="js-language" data-key="registrationSelectLanguage">Change language</label>
    <select id="js-language">
        <option value="en">English</option>
        <option value="ru">Русский</option>
    </select>

    <form method="post" action="/register" id="registerForm" enctype="multipart/form-data">
        <ul>
            <li>
                <label data-key="registrationFieldName">First name</label><span>*</span>
                <input type="text" name="name" value="{{ !empty($user->name) ? $user->name : '' }}">
            </li>
            <li>
                <label data-key="registrationFieldLastName">Last name</label><span>*</span>
                <input type="text" name="last_name" value="{{ !empty($user->last_name) ? $user->last_name : '' }}">
            </li>
            <li>
                <label data-key="registrationFieldMiddleName">Middle name</label>
                <input type="text" name="middle_name" value="{{ !empty($user->middle_name) ? $user->middle_name : '' }}">
            </li>
            <li>
                <label data-key="registrationFieldBirthYear">Birth year</label>
                <input type="number" name="birth_year" value="{{ !empty($user->birth_year) ? $user->birth_year : '' }}">
            </li>
            <li>
                <label data-key="registrationFieldLocation">Location</label>
                <input type="text" name="location" value="{{ !empty($user->location) ? $user->location : '' }}">
            </li>
            <li>
                <label data-key="registrationFieldMaritalStatus">Marital status</label>
                <input type="text" name="marital_status" value="{{ !empty($user->marital_status) ? $user->marital_status : '' }}">
            </li>
            <li>
                <label data-key="registrationFieldEmail">Email</label><span>*</span>
                <input type="email" name="email" value="{{ !empty($user->email) ? $user->email : '' }}">
            </li>
            <li>
                <label data-key="registrationFieldPhone">Phone</label>
                <input type="text" name="phone" value="{{ !empty($user->phone) ? $user->phone : '' }}">
            </li>
            <li>
                <label data-key="registrationFieldPassword">Password</label><span>*</span>
                <input type="password" name="password">
            </li>
            <li>
                <label data-key="registrationFieldPasswordConfirmed">Password to confirm</label><span>*</span>
                <input type="password" name="password_confirmed">
            </li>
            <li>
                <label data-key="registrationFieldEducation">Education</label>
                <textarea name="education">{{ !empty($user->education) ? $user->education : '' }}</textarea>
            </li>
            <li>
                <label data-key="registrationFieldExperience">Experience</label>
                <textarea name="experience">{{ !empty($user->experience) ? $user->experience : '' }}</textarea>
            </li>
            <li>
                <label data-key="registrationFieldAdditional">Additional</label>
                <textarea name="additional">{{ !empty($user->additional) ? $user->additional : '' }}</textarea>
            </li>
            <li>
                <label data-key="registrationFieldFilename">Photo</label>
                <input type="file" name="filename">
            </li>
        </ul>
        <button type="button" id="js-register" data-key="registrationButtonSubmit">Sign in</button>
    </form>
@stop