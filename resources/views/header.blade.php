<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{ Html::style(url('bootstrap/css/bootstrap.min.css')) }}
    <title>Lorion Education</title>
</head>
<body>
    @yield('content')
    {{ Html::script(url('js/jquery.js')) }}
    {{ Html::script(url('bootstrap/js/bootstrap.min.js')) }}
</body>
</html>