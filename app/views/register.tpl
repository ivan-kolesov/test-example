@extends('layout')

@section('scripts')
    <script type="text/javascript" src="/assets/js/formPrototype.js"></script>
    <script type="text/javascript" src="/assets/js/registerForm.js"></script>
@stop

@section('content')
    <h1 data-key="registrationTitle">Sign in</h1>

    <p><a href="/" data-key="linkBackToIndex">Back to index page</a></p>

    <div class="errors hide">
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

    <label for="js-language" data-key="selectLanguage">Change language</label>
    <select id="js-language">
        <option value="en">English</option>
        <option value="ru">Русский</option>
    </select>

    <p>Please, filling the following form. Fields with <sup>*</sup> are required</p>

    <form method="post" action="/register" id="registerForm" enctype="multipart/form-data" class="table">
        <table>
            <tr>
                <td><label for="name" data-key="registrationFieldName">First name</label><span>*</span></td>
                <td><input id="name" type="text" name="name" value="{{ !empty($user->name) ? $user->name : '' }}"></td>
            </tr>
            <tr>
                <td><label for="last_name" data-key="registrationFieldLastName">Last name</label><span>*</span></td>
                <td><input id="last_name" type="text" name="last_name" value="{{ !empty($user->last_name) ? $user->last_name : '' }}"></td>
            </tr>
            <tr>
                <td><label for="middle_name" data-key="registrationFieldMiddleName">Middle name</label></td>
                <td><input id="middle_name" type="text" name="middle_name" value="{{ !empty($user->middle_name) ? $user->middle_name : '' }}"></td>
            </tr>
            <tr>
                <td><label for="birth_year" data-key="registrationFieldBirthYear">Birth year</label></td>
                <td><input id="birth_year" type="number" name="birth_year" value="{{ !empty($user->birth_year) ? $user->birth_year : '' }}"></td>
            </tr>
            <tr>
                <td><label for="location" data-key="registrationFieldLocation">Location</label></td>
                <td><input id="location" type="text" name="location" value="{{ !empty($user->location) ? $user->location : '' }}"></td>
            </tr>
            <tr>
                <td><label for="marital_status" data-key="registrationFieldMaritalStatus">Marital status</label></td>
                <td><input id="marital_status" type="text" name="marital_status" value="{{ !empty($user->marital_status) ? $user->marital_status : '' }}"></td>
            </tr>
            <tr>
                <td><label for="email" data-key="registrationFieldEmail">Email</label><span>*</span></td>
                <td><input id="email" type="email" name="email" value="{{ !empty($user->email) ? $user->email : '' }}"></td>
            </tr>
            <tr>
                <td><label for="phone" data-key="registrationFieldPhone">Phone</label></td>
                <td><input id="phone" type="text" name="phone" value="{{ !empty($user->phone) ? $user->phone : '' }}"></td>
            </tr>
            <tr>
                <td><label for="password" data-key="registrationFieldPassword">Password</label><span>*</span></td>
                <td><input id="password" type="password" name="password"></td>
            </tr>
            <tr>
                <td><label for="password_confirmed" data-key="registrationFieldPasswordConfirmed">Password to confirm</label><span>*</span></td>
                <td><input id="password_confirmed" type="password" name="password_confirmed"></td>
            </tr>
            <tr>
                <td><label for="education" data-key="registrationFieldEducation">Education</label></td>
                <td><textarea id="education" name="education" rows="3">
                    {{ !empty($user->education) ? $user->education : '' }}</textarea>
                </td>
            </tr>
            <tr>
                <td><label for="experience" data-key="registrationFieldExperience">Experience</label></td>
                <td><textarea id="experience" name="experience" rows="3">
                    {{ !empty($user->experience) ? $user->experience : '' }}</textarea>
                </td>
            </tr>
            <tr>
                <td><label for="additional" data-key="registrationFieldAdditional">Additional</label></td>
                <td><textarea id="additional" name="additional" rows="3">
                    {{ !empty($user->additional) ? $user->additional : '' }}</textarea>
                </td>
            </tr>
            <tr>
                <td><label for="file" data-key="registrationFieldFilename">Photo</label></td>
                <td><input id="file" type="file" name="filename"></td>
            </tr>
            <tr>
                <td></td>
                <td><button type="button" id="js-register" data-key="registrationButtonSubmit">Sign in</button></td>
            </tr>
        </table>
    </form>
@stop