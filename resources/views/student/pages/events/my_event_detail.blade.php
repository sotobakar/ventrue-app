@extends('student.layouts.app')

@section('content')
<div class="text-white mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
    @if(session('success'))
    <div class="mb-4">
        @include('student.components.alerts.success')
    </div>
    @endif
    <div class="grid grid-cols-3 gap-x-8">
        <div class="col-span-3 md:col-span-2">
            <img class="mt-4 rounded-lg" src="{{ asset('storage/' . $event->banner)}}" alt="Gambar Event">
            <h1 class="mt-4 text-4xl font-bold">{{ $event->name }}</h1>
        </div>
        <div class="col-span-3 md:col-span-1">
            <div class="bg-white p-4 rounded-md text-gray-900 mt-4 flex">
                <img class="w-20 border-2 border-gray-900" src="{{ asset('storage/' . $event->organization->image)}}" alt="">
                <div class="ml-8">
                    <h2 class="font-medium text-base">Penyelenggara</h2>
                    <h3 class="font-medium text-lg text-pink-500">{{ $event->organization->name }}</h3>
                </div>
            </div>
            <dl class="my-4 space-y-6">
                <div>
                    <dt class="flex items-center">
                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-pink-500 text-white">
                            <i class="far fa-thumbtack text-3xl"></i>
                        </div>
                        <p class="ml-4 text-lg font-medium leading-6 text-white">{{ $event->location }}</p>
                    </dt>
                </div>
                <div>
                    <dt class="flex items-center">
                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-pink-500 text-white">
                            <i class="far fa-globe text-3xl"></i>
                        </div>
                        <p class="ml-4 text-lg font-medium leading-6 text-white">{{ ucwords($event->type) }}</p>
                    </dt>
                </div>
                @if($event->meeting_link)
                <div>
                    <dt class="flex items-center">
                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-pink-500 text-white">
                            <i class="far fa-link text-3xl"></i>
                        </div>
                        <p class="ml-4 text-lg underline font-medium leading-6 text-white ho"><a target="_blank"
                                href="{{ $event->meeting_link }}">Link Meeting</a></p>
                    </dt>
                </div>
                @endif
                <div>
                    <dt class="flex items-center">
                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-pink-500 text-white">
                            <i class="far fa-calendar text-3xl"></i>
                        </div>
                        <p class="ml-4 text-lg font-medium leading-6 text-white">{{
                            \Carbon\Carbon::parse($event->start)->translatedFormat('l, j F H:i') }}</p>
                    </dt>
                </div>
                @if($reminder)
                <button disabled type="button"
                    class="inline-flex items-center rounded-md border border-transparent bg-pink-400 px-4 py-2 text-sm font-medium text-white shadow-sm">
                    <i class="-ml-1 mr-2 fas fa-clock"></i>
                    Pengingat sudah disetel pada tanggal {{ \Carbon\Carbon::parse($reminder->remind_at)->translatedFormat("l, d F Y H:i") }}
                </button>
                @else
                <div x-data="{modal: false}">
                    <button @click="modal = true" type="button"
                        class="inline-flex items-center rounded-md border border-transparent bg-pink-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-pink-700 focus:outline-none focus:ring-2 focus:ring-pink-500 focus:ring-offset-2">
                        <i class="-ml-1 mr-2 fas fa-bell-on"></i>
                        Ingatkan Saya
                    </button>
                    <div x-show="modal" x-cloak class="relative z-10" aria-labelledby="modal-title" role="dialog"
                        aria-modal="true">
                        <!--
                          Background backdrop, show/hide based on modal state.
                      
                          Entering: "ease-out duration-300"
                            From: "opacity-0"
                            To: "opacity-100"
                          Leaving: "ease-in duration-200"
                            From: "opacity-100"
                            To: "opacity-0"
                        -->
                        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
        
                        <div class="fixed inset-0 z-10 overflow-y-auto">
                            <div class="flex min-h-full items-center justify-center p-4 text-center sm:items-center sm:p-0">
                                <!--
                              Modal panel, show/hide based on modal state.
                      
                              Entering: "ease-out duration-300"
                                From: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                To: "opacity-100 translate-y-0 sm:scale-100"
                              Leaving: "ease-in duration-200"
                                From: "opacity-100 translate-y-0 sm:scale-100"
                                To: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                            -->
                                <div @click.outside="modal = false"
                                    class="relative transform overflow-hidden rounded-lg bg-white px-4 pt-5 pb-4 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-sm sm:p-6">
                                    <div>
                                        <div
                                            class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-yellow-100">
                                            <!-- Heroicon name: outline/check -->
                                            <i class="fal fa-bell text-yellow-600 text-lg"></i>
                                        </div>
                                        <div class="mt-3 text-center sm:mt-5">
                                            <h3 class="text-lg font-medium leading-6 text-gray-900" id="modal-title">
                                                Ingatkan Saya
                                            </h3>
                                            <div class="mt-2">
                                                <p class="text-sm text-gray-500">Reminder akan dikirim ke email Anda.</p>
                                            </div>
                                        </div>
                                        <form class="mt-2"
                                            action="{{ route('student.my_events.remind', ['event' => $event->id]) }}"
                                            method="post" enctype="multipart/form-data">
                                            @csrf
                                            @method('POST')
                                            <div>
                                                <label for="minutes_before"
                                                    class="block text-sm font-medium text-gray-700">Waktu Ingat</label>
                                                <select id="minutes_before" name="minutes_before"
                                                    class="mt-1 block w-full rounded-md border-gray-300 py-2 pl-3 pr-10 text-base text-gray-900 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                                                    <option value="15">15 menit sebelum acara mulai</option>
                                                    <option value="30">30 menit sebelum acara mulai</option>
                                                    <option value="60">1 jam sebelum acara mulai</option>
                                                </select>
                                            </div>
        
                                            <div class="mt-5 sm:mt-6">
                                                <button type="submit"
                                                    class="inline-flex w-full justify-center rounded-md border border-transparent bg-yellow-400 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-yellow-500 focus:outline-none focus:ring-2 focus:ring-yellow-300 focus:ring-offset-2 sm:text-sm">Ingat</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </dl>
        </div>
    </div>
    <div class="mt-4">
        <h2 class="font-medium text-xl">Description</h2>
        <p class="mt-2">{{ $event->description }}</p>
    </div>
    <div class="bg-white my-4 p-4 rounded-md shadow-md text-gray-900">
        <h2 class="font-medium text-2xl">Materi Acara</h2>
        @if($event->materials->count() > 0)
        <ul>
            <?php $i = 1; ?>
            @foreach($event->materials as $material)
            <li class="text-pink-500 font-medium text-lg">
                <a target="_blank" href="{{ asset('storage/' . $material->path) }}">{{ $i++ . '. ' . $material->name
                    }}</a>
            </li>
            @endforeach
        </ul>
        @else
        <div class="mt-2 flex flex-col items-center">
            <i class="far fa-folder-open text-5xl"></i>
            <h2>Belum ada materi</h2>
        </div>
        @endif
    </div>
    <div class="bg-white my-4 p-4 rounded-md shadow-md text-gray-900">
        <h2 class="font-medium text-2xl">Absensi Acara</h2>
        {{-- Check if attendance is open --}}
        @if($event->attendance_open)

        {{-- If student have not yet attended then show button --}}
        @if(!$event->attendees->contains(Auth::user()->student->id))
        <div class="mt-4 flex">
            <form id="attend_event" class="hidden"
                action="{{ route('student.my_events.attend', ['event' => $event->id]) }}" method="POST">
                @csrf
            </form>
            <button form="attend_event" type="submit"
                class="inline-flex items-center rounded-md border border-transparent bg-green-600 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                Absen
            </button>
        </div>
        @else
        <h2 class="text-green-500">Anda sudah absen di acara ini.</h2>
        @endif
        @else
        <div class="mt-2 flex flex-col items-center text-red-500">
            <i class="far fa-times text-5xl"></i>
            <h2>Absen ditutup</h2>
        </div>
        @endif
    </div>
    <div class="bg-white my-4 p-4 rounded-md shadow-md text-gray-900">
        <h2 class="font-medium text-2xl">Feedback Acara</h2>
        @if(!$feedback_exists)
        <form class="mt-4 flex flex-col gap-y-2"
            action="{{ route('student.my_events.feedback', ['event' => $event->id]) }}" method="POST">
            @csrf
            <div>
                <label for="rating" class="block text-sm font-medium text-gray-700">Nilai Acara</label>
                <select id="rating" name="rating"
                    class="mt-1 block w-full rounded-md border-gray-300 py-2 pl-3 pr-10 text-base focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                    <option selected>5</option>
                    <option>4</option>
                    <option>3</option>
                    <option>2</option>
                    <option>1</option>
                </select>
            </div>
            <div>
                <label for="body" class="block text-sm font-medium text-gray-700">Masukan tentang acara</label>
                <div class="mt-1">
                    <textarea rows="4" name="body" id="body"
                        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"></textarea>
                </div>
            </div>
            <button type="submit"
                class="self-start inline-flex items-center rounded-md border border-transparent bg-yellow-400 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-yellow-500 focus:outline-none focus:ring-2 focus:ring-yellow-300 focus:ring-offset-2">
                Kirim Feedback
            </button>
        </form>
        @else
        <h2 class="text-green-500">Anda sudah mengisi feedback acara.</h2>
        @endif
    </div>
    <div class="bg-white my-4 p-4 rounded-md shadow-md text-gray-900">
        <h2 class="font-medium text-2xl">Sertifikat Acara</h2>
        <div class="mt-4 flex">
            <button type="button"
                class="inline-flex items-center rounded-md border border-transparent bg-gray-600 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                Ingatkan Saya
            </button>
        </div>
    </div>
</div>
@endsection