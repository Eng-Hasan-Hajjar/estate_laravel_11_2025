<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Your property</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Bootstrap CSS -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="container mx-auto p-4">
        @include('layouts.navigation')

        <!-- Page Heading -->
        <header class="mb-6">
            {{ $header ?? '' }} <!-- هذا هو مكان عرض العنوان -->
        </header>

        <!-- Page Content -->
        <main>
            {{ $slot }} <!-- هذا هو المكان الذي يتم فيه عرض المحتوى الرئيسي -->
        </main>
    </div>
</body>
</html>
