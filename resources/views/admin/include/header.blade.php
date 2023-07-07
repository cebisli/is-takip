<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title','İş Takip Sistemi')</title>

    <link rel="stylesheet" href="{{ asset('/') }}assets/css/main/app.css">
    <link rel="stylesheet" href="{{ asset('/') }}assets/css/main/app-dark.css">
    <link rel="shortcut icon" href="{{ asset('/') }}assets/images/logo/favicon.svg" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('/') }}assets/images/logo/favicon.png" type="image/png">

    <link rel="stylesheet" href="{{ asset('/') }}assets/css/shared/iconly.css">
    <link rel="stylesheet" href="{{ asset('/') }}genel.css">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="{{ asset('/') }}assets/css/pages/fontawesome.css">
    <link rel="stylesheet" href="{{ asset('/') }}assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="{{ asset('/') }}assets/css/pages/datatables.css">
    
    <script src="{{ asset('js/app.js') }}"></script>
    

    @yield('css')
</head>

<body>
    <div id="app">
