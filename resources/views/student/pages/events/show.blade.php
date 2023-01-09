@extends('student.layouts.app')

@section('content')
<div class="text-white mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
    @if(session('success'))
    <div class="mb-4">
        @include('student.components.alerts.success')
    </div>
    @endif
    <h1 class="text-4xl font-bold">{{ $event->name }}</h1>
    <img class="mt-4 rounded-lg" src="{{ asset('storage/' . $event->banner)}}" alt="Gambar Event">
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
        <div>
            <dt class="flex items-center">
                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-pink-500 text-white">
                    <i class="far fa-calendar text-3xl"></i>
                </div>
                <p class="ml-4 text-lg font-medium leading-6 text-white">{{
                    \Carbon\Carbon::parse($event->start)->translatedFormat('l, j F H:i') }}</p>
            </dt>
        </div>
    </dl>
    <div class="mt-4">
        <h2 class="font-medium text-xl">Description</h2>
        <p class="mt-2">{{ $event->description }}</p>
    </div>
    <div class="bg-white my-4 p-4 rounded-md shadow-md text-gray-900">
        <h2 class="font-medium text-2xl">Pendaftaran Acara</h2>
        @if(!$studentRegistered)
        @if(\Carbon\Carbon::parse($event->registration_end)->lessThan(\Carbon\Carbon::now()))
        <span
            class="self-start inline-flex items-center rounded-full bg-red-100 px-2.5 py-0.5 text-sm font-medium text-red-800">Pendaftaran
            Sudah Ditutup</span>
        @else
        <span
            class="self-start inline-flex items-center rounded-full bg-green-100 px-2.5 py-0.5 text-sm font-medium text-green-800">Pendaftaran
            Masih Dibuka!</span>
        @endif
        @else
        <h3 class="text-green-800">Anda sudah terdaftar di acara ini.</h3>
        @endif
        <div class="mt-4 flex">
            @if(!$studentRegistered)
            <form id="register_event" action="{{ route('student.events.register', ['event' => $event->id]) }}"
                method="POST" class="hidden">
                @csrf
                @method('POST')
            </form>
            <button type="submit" form="register_event"
                class="mr-4 inline-flex items-center rounded-md border border-transparent bg-pink-600 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-pink-700 focus:outline-none focus:ring-2 focus:ring-pink-500 focus:ring-offset-2">
                Daftar
            </button>
            @endif
            <button type="button"
                class="inline-flex items-center rounded-md border border-transparent bg-gray-600 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                Ingatkan Saya
            </button>
        </div>
    </div>
</div>
@endsection