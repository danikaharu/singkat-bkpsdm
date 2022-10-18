<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') - {{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" href="{{ asset('template/admin') }}/css/main/app.css">
    <link rel="stylesheet" href="{{ asset('template/admin') }}/css/main/app-dark.css">
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180"
        href="{{ asset('template/admin') }} /images/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32"
        href="{{ asset('template/admin') }}/images/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16"
        href="{{ asset('template/admin') }}/images/favicon/favicon-16x16.png">
    <link rel="stylesheet" href="{{ asset('template/admin') }}/css/shared/iconly.css">
    @stack('css')
</head>

<body>
    <div id="app">
        @include('layouts.partials.admin.sidebar')
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>
