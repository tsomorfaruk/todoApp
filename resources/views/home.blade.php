<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Todo</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,400,600" rel="stylesheet">

{{--        fonts--}}
        <script src="https://kit.fontawesome.com/3b4174c44f.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="{{asset('css/app.css')}}">
    </head>
    <body>

        <div class="content">
            <div id="app">
                <App></App>
            </div>
        </div>

<script src="{{asset('js/app.js')}}"></script>
    </body>
</html>
