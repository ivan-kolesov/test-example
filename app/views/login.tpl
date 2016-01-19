@extends('layout')

@section('scripts')
    <script type="text/javascript" src="/assets/js/formPrototype.js"></script>
    <script type="text/javascript" src="/assets/js/loginForm.js"></script>
@stop

@section('content')
    <h1 data-key="loginTitle">Login</h1>

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

    <form method="post" action="/login" id="loginForm" class="table">
        <table>
            <tr>
                <td><label for="email" data-key="loginFieldEmail">Email</label></td>
                <td><input id="email" type="email" name="email"/></td>
            </tr>
            <tr>
                <td><label for="password" data-key="loginFieldPassword">Password</label></td>
                <td><input id="password" type="password" name="password"/></td>
            </tr>
            <tr>
                <td></td>
                <td><button type="button" id="js-login" data-key="loginButtonSubmit">Login</button></td>
            </tr>
        </table>
    </form>
@stop