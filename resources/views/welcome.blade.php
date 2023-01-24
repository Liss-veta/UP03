<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            *{
                margin: 0;
                padding: 0;
                list-style-type: none;
            }
            a{
                text-decoration: none
            }
            body{
                background: #060A30;
            }
            input, textarea{
                outline: none;
            }
            html{
                overflow-x: hidden;
            }
        </style>
    </head>
    <body id="app">

    
    </body>
</html>
