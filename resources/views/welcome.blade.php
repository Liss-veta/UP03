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
                overflow-y: auto
            }
            * {
                scrollbar-width: thin;
                scrollbar-color: #bca8bc #7986CB;
            }

            /* для Chrome/Edge/Safari */
            *::-webkit-scrollbar {
                height: 12px;
                width: 12px;
            }
            *::-webkit-scrollbar-track {
                background: #7986CB;
            }
            *::-webkit-scrollbar-thumb {
                background-color: #bca8bc;
                border-radius: 5px;
                border: 3px solid #7986CB;
            }
        </style>
    </head>
    <body id="app">


    </body>
</html>
