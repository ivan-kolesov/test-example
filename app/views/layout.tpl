<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">

        <title>Just site: {{ isset($pageTitle) ? $pageTitle : '' }}</title>
        <link media="all" type="text/css" rel="stylesheet" href="/assets/css/main.css">
    </head>
<body>
    <div id="header">
        <div class="siteTitle">Just a registration site</div>

        <div class="account">
            <?php if (!empty($user)): ?>
                <div class="info">Your are logged as {{ $user->name }}</div>
                <ul>
                    <li><a href="/logout">Logout</a></li>
                </ul>
            <?php else: ?>
                <ul>
                    <li><a href="/login">Login</a></li>
                    <li><a href="/register">Sign in</a></li>
                </ul>
            <?php endif; ?>
        </div>
    </div>
    <div id="content">
        @yeld('content')
    </div>
    <script type="text/javascript" src="/assets/js/main.js"></script>
    <script type="text/javascript" src="/assets/js/xhr.js"></script>
    <script type="text/javascript" src="/assets/js/dictionary.js"></script>
    @yeld('scripts')
</body>
</html>