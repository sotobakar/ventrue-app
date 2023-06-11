@extends('student.layouts.app')

@section('content')
    <div class="mx-auto max-w-7xl">
        <div class="lg:mx-4">
            @include('student.components.alerts.success')
        </div>
        <div class="py-4 sm:py-6 lg:grid lg:grid-cols-12 lg:gap-8">
            <div
                class="px-4 sm:px-6 sm:text-center md:mx-auto md:max-w-2xl lg:col-span-6 lg:flex lg:items-center lg:text-left">
                <div>
                    <h1 class="mt-4 text-4xl font-bold tracking-tight text-white sm:text-5xl md:text-6xl">
                        Gabung acara untuk mahasiswa UPNVJ</h1>
                    <p class="mt-3 text-base text-gray-300 sm:mt-5 sm:text-xl lg:text-lg xl:text-xl">Gabung
                        acara-acara baik acara akademik maupun non-akademik, jangan ketinggalan informasi
                        lagi sebagai mahasiswa UPNVJ!</p>
                    <p class="mt-8 text-base font-semibold text-white sm:mt-10">Digunakan oleh</p>
                    <div class="mt-5 w-full sm:mx-auto sm:max-w-lg lg:ml-0">
                        <div
                            class="flex flex-col gap-y-4 md:gap-0 md:flex-row flex-wrap items-center md:items-start justify-between">
                            <div class="flex items-center text-white">
                                <h2 class="text-2xl font-bold">{{ $statistics['eventsCount'] . '+' }}</h2>
                                <h3 class="ml-2 text-xl font-medium">Acara</h3>
                            </div>
                            <div class="flex items-center text-white">
                                <h2 class="text-2xl font-bold">{{ $statistics['organizationsCount'] . '+' }}</h2>
                                <h3 class="ml-2 text-xl font-medium">Organisasi</h3>
                            </div>
                            <div class="flex items-center text-white">
                                <h2 class="text-2xl font-bold">{{ $statistics['studentsCount'] . '+' }}</h2>
                                <h3 class="ml-2 text-xl font-medium">Mahasiswa</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="z-10 mt-16 sm:mt-24 lg:col-span-6 lg:mt-0">
                <div class="bg-white sm:mx-auto sm:w-full sm:max-w-md sm:overflow-hidden sm:rounded-lg p-6">
                    <!-- Swiper -->
                    <div class="swiper mySwiper" style="height: 400px;">
                        <div class="swiper-wrapper">
                            @foreach ($contents as $content)
                                <div class="swiper-slide">
                                    <div class="h-full flex flex-col select-none">
                                        <img class="rounded-md" src="{{ asset('storage/' . $content->event->banner) }}"
                                            alt="Event Banner">
                                        <div class="grow flex flex-col mt-4">
                                            <h3 class="text-center text-xl md:text-2xl font-bold text-pink-700">
                                                {{ $content->event->name }}</h3>
                                            <div class="grow flex items-center">
                                                <div class="w-1/2 flex items-center">
                                                    <img class="h-12 auto"
                                                        src="{{ asset('storage/' . $content->event->organization->image) }}"
                                                        alt="Foto Organisasi">
                                                    <h5 class="ml-2 font-medium lg:text-lg">
                                                        {{ $content->event->organization->name }}</h5>
                                                </div>
                                                <div class="w-1/2 text-center">
                                                    <h5 class="text-pink-500 font-medium">
                                                        {{ \Carbon\Carbon::parse($content->event->start)->translatedFormat('d F Y') }}
                                                    </h5>
                                                    <h5 class="text-pink-500 font-medium">
                                                        {{ \Carbon\Carbon::parse($content->event->start)->translatedFormat('H:i') }}
                                                    </h5>
                                                </div>
                                            </div>
                                            <a href="{{ route('student.events.detail', ['event' => $content->event->id]) }}"
                                                class="self-center rounded-md bg-pink-600 px-2.5 lg:px-3 py-1.5 lg:py-2 text-sm font-semibold text-white shadow-sm hover:bg-pink-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-pink-600">Halaman
                                                Acara</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        var swiper = new Swiper(".mySwiper", {
            autoplay: {
                delay: 5000,
            },
            loop: true,
        });
    </script>
@endpush
