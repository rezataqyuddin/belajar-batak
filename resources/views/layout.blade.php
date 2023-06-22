<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Surat Batak</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Batak&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('/css/base.css') }}" type="text/css">
    @vite('resources/css/app.css')
</head>

<body class="antialiased">
    <div class="relative batak sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
        <div class="w-full p-6 lg:p-8">
            <div class="relative top-0 right-0">
                <img class="w-20 h-20 rounded-full" src="https://flowbite.com/docs/images/people/profile-picture-5.jpg" alt="">
                <span class="top-0 left-7 absolute  w-3.5 h-3.5 bg-green-400 border-2 border-white dark:border-gray-800 rounded-full"></span>
            </div>
            @yield('content')

        </div>
    </div>
</body>

</html>