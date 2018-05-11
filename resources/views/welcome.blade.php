<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
        <legend>Laravel 5.4</legend>
        <div id="app">
            @{{ text }}
            <br>
              <div class="container">
                <routes></routes>
              </div>
            <hr>
        </div>

        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
