<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Screening Form</title>

        <script src="{{ asset('js/app.js')  }}" defer></script>

        <link href="{{ asset('/css/app.css') }}" rel="stylesheet">

    </head>
    <body class="antialiased">
        <div id="app">
            <screening-form></screening-form>
        </div>
    </body>
</html>
<script>

</script>
