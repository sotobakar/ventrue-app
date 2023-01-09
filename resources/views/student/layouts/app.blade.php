<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ventrue - Veteran Event for Us x Everyone</title>
    <link rel="shortcut icon" href="{{ asset('favicon.png') }}" type="image/x-icon">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://unpkg.com/alpinejs@3.10.5/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css')}}" />
    <style>
        [x-cloak] { display: none !important; }
    </style>
    @stack('css')
</head>

<body>
    <div class="relative overflow-hidden bg-gray-800">
        <div class="-z-10 hidden sm:absolute sm:inset-0 sm:block" aria-hidden="true">
            <svg class="absolute bottom-0 right-0 mb-48 translate-x-1/2 transform text-gray-700 lg:top-0 lg:mt-28 lg:mb-0 xl:translate-x-0 xl:transform-none"
                width="364" height="384" viewBox="0 0 364 384" fill="none">
                <defs>
                    <pattern id="eab71dd9-9d7a-47bd-8044-256344ee00d0" x="0" y="0" width="20" height="20"
                        patternUnits="userSpaceOnUse">
                        <rect x="0" y="0" width="4" height="4" fill="currentColor" />
                    </pattern>
                </defs>
                <rect width="364" height="384" fill="url(#eab71dd9-9d7a-47bd-8044-256344ee00d0)" />
            </svg>
        </div>
        <div x-data="{ open: false }" class="relative pt-6 pb-8 sm:pb-12">
            @include('student.components.navbar')
            <main class="mt-4 sm:mt-8">
                @yield('content')
            </main>
        </div>
        @include('student.components.footer')
    </div>
    <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
    @stack('scripts')
</body>

</html>