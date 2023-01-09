@extends('student.layouts.app')

@section('content')
<div class="mx-auto max-w-7xl">
    @include('student.components.alerts.success')
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
                    <div class="flex flex-wrap items-start justify-between">
                        <div class="flex justify-center px-1">
                            <img class="h-9 sm:h-10" src="https://tailwindui.com/img/logos/tuple-logo-gray-400.svg"
                                alt="Tuple">
                        </div>
                        <div class="flex justify-center px-1">
                            <img class="h-9 sm:h-10" src="https://tailwindui.com/img/logos/workcation-logo-gray-400.svg"
                                alt="Workcation">
                        </div>
                        <div class="flex justify-center px-1">
                            <img class="h-9 sm:h-10" src="https://tailwindui.com/img/logos/statickit-logo-gray-400.svg"
                                alt="StaticKit">
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
                        @foreach($events as $event)
                        <div class="swiper-slide">
                            <div class="flex flex-col">
                                <img class="rounded-md" src="{{ asset('storage/' . $event->banner) }}"
                                    alt="Event Banner">
                                <div class="mt-4">
                                    <h3 class="text-center text-2xl md:text-3xl font-bold text-pink-700">
                                        {{ $event->name }}</h3>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    var swiper = new Swiper(".mySwiper", {
    pagination: {
      el: ".swiper-pagination",
    },
  });
</script>
@endpush