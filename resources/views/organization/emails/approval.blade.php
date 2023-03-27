<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Permintaan Persetujuan</title>
</head>
<body>
    <div class="bg-gray-900 px-4 py-8">
        <img class="h-8 md:h-16 mx-auto" src="{{ asset('img/logo.png')}}" alt="">
    </div>
    <h2 class="mt-4">
      Yth. Bapak/Ibu {{ $approver->name }},
    </h2>
    <p class="mt-12">Pada tanggal {{ \Carbon\Carbon::parse($event->start)->translatedFormat("d F Y") }} pukul {{ \Carbon\Carbon::parse($event->start)->translatedFormat("H:i") }} akan dilaksanakan acara {{ $event->name }} yang diselenggarakan oleh organisasi kemahasiswaan {{ $event->organization->name }} dibawah naungan Bapak/Ibu penyetuju. Penyelenggara acara meminta izin kepada Bapak/Ibu untuk menyetujui dan memverifikasi acara tersebut. Dibawah dilampirkan file pendukung penyelenggaraan acara.</p>
    <h2 class="mt-4">Terimakasih</h2>
    <div class="mt-8 text-center">
        <h2 class="mt-4">Klik tombol dibawah ini untuk menyetujui dan memverifikasi acara.</h2>
        <a target="_blank" href="{{ $approveLink }}" class="mt-2 inline-flex items-center rounded-md border border-transparent bg-pink-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-pink-700 focus:outline-none focus:ring-2 focus:ring-pink-500 focus:ring-offset-2">Approve Acara</a>
    </div>
</body>
</html>