<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Reminder Event</title>
</head>
<body>
    <div class="bg-gray-900 px-4 py-8">
        <img class="h-8 md:h-16 mx-auto" src="{{ asset('img/logo.png')}}" alt="">
    </div>
    <div class="mt-8 text-center">
        <h1 class="font-bold text-xl">Halo, sekedar mengingatkan, acara Anda sebentar lagi mulai!</h1>
        <h2 class="mt-4">Klik tombol dibawah ini untuk mengarah ke acara.</h2>
        <a target="_blank" href="{{ route('student.events.detail', ['event' => $event->id]) }}" class="inline-flex items-center rounded-md border border-transparent bg-pink-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-pink-700 focus:outline-none focus:ring-2 focus:ring-pink-500 focus:ring-offset-2">Menuju Halaman Acara</a>
    </div>
</body>
</html>