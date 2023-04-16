<!doctype html>
<html x-cloak :class="{'theme-dark': dark }" x-data="data()" lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Windmill Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
     @vite(['resources/css/app.css','resources/css/custom.css', 'resources/js/app.js'])
     @livewireStyles
</head>

<body>
    <div class="flex h-screen bg-gray-50 dark:bg-gray-900" :class="{ 'overflow-hidden': isSideMenuOpen }">
        @include('livewire.layout.sidebar.sidebar')
        <div class="flex flex-col flex-1 w-full">
            @include('livewire.layout.header')
            @yield('content')
        </div>
    </div>
    @stack('scripts')
    <script src="{{ Vite::asset('resources/js/customAlpine.js') }}"></script>
    @livewireScripts
</body>

</html>
