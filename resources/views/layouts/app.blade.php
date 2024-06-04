<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('layouts.meta')

    @include('layouts.css.student_css')
</head>

<body>
    @include('layouts.navigation')



    <!-- Page Content -->
    <main>
        {{ $slot }}
    </main>
    @include('layouts.footer')

    @include('layouts.js.student_js')
</body>
<style>
    .h3_category-item {
        padding: 20px 10px 20px 15px;
    }

    .h3_category-item-content a {
        font-size: 20px;
    }

    .loader-wrapper {
        display: none;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        text-align: center;
        z-index: 9999;
    }

    .loader {
        border: 8px solid #f3f3f3;
        border-radius: 50%;
        border-top: 8px solid #3498db;
        width: 60px;
        height: 60px;
        animation: spin 1.5s linear infinite;
        margin-bottom: 10px;
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }
</style>

</html>
