<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title','İş Takip Sistemi')</title>

    <link rel="stylesheet" href="{{ asset('/') }}assets/css/main/app.css">
    <link rel="stylesheet" href="{{ asset('/') }}assets/css/main/app-dark.css">
    <link rel="shortcut icon" href="{{ asset('/') }}assets/images/logo/favicon.svg" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('/') }}assets/images/logo/favicon.png" type="image/png">

    <link rel="stylesheet" href="{{ asset('/') }}assets/css/shared/iconly.css">
    <link rel="stylesheet" href="{{ asset('/') }}genel.css">
    <script src="{{ asset('js/app.js') }}"></script>

    @yield('css')
</head>

<body>
    <div id="app">
