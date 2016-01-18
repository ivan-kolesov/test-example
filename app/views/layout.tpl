<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">

        <title>{{ isset($pageTitle) ? $pageTitle : '' }}</title>
        <link media="all" type="text/css" rel="stylesheet" href="/assets/css/main.css">
    </head>
<body>
    @yeld('content')
    <script type="text/javascript" src="/assets/js/main.js"></script>
    <script type="text/javascript" src="/assets/js/xhr.js"></script>
    <script type="text/javascript" src="/assets/js/dictionary.js"></script>
    @yeld('scripts')
</body>
</html>