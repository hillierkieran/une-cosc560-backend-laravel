<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Load Vite scripts and styles -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <!-- Bootstrap Dashboard CSS -->
    <link href="{{ Vite::asset('resources/css/dashboard.css') }}" rel="stylesheet" >

    <!-- Bootstrap CSS and JS bundles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" >
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" ></script>
</head>

<body>
    <!-- SVG Sprites -->
    @include('components.svg-sprites')

    <!-- Navbar -->
    @include('components.navbar')

    <div class="container-fluid">
        <div class="row">

            <!-- Sidebar -->
            @include('components.sidebar')

            <!-- Main Content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
