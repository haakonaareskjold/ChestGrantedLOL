<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <title>@yield('title')</title>
    <style>
        body {
            background-color: #EA5E3D;
            color: #ffffff;
            font-family: 'Roboto', sans-serif;
        }
        a, a:hover, a:focus, a:active {
            text-decoration: none;
            color: inherit;
        }
        .container {
            display: flex;
            flex-direction: column;
            margin-bottom: 2rem;
        }
        .git {
            display: flex;
            align-self: center;
            margin-top: 1rem;
        }
        .return {
            display: flex;
            align-self: flex-end;
        }
        .item {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            list-style: none;
            margin-top: 1rem;
        }
        .form {
            display: flex;
            flex-wrap: wrap;
            list-style: none;
            margin-top: 5%;
            justify-content: center;
        }
        .info {
            margin-bottom: 2rem;
            display: flex;
            align-self: center;
            margin-top: 25%;
        }
    </style>
</head>
<body>
<div class="container">
    <x-git-plug />
    @yield('content')
</div>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
