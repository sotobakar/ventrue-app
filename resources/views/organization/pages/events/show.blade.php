@extends('organization.layouts.app')

@section('content')
<h1 class="text-2xl font-semibold text-gray-900">Detil Acara</h1>
<div class="mt-8 flex flex-col">
    <div class="flex gap-x-4">
        <img src="{{ asset('storage/' . $event->banner) }}"
            class="w-1/2 mb-2 mx-auto object-fill rounded border border-gray-200">
        <div class="w-1/2">
            <div class="flex flex-col gap-y-2 px-4 sm:px-6">
                <div>
                    <h3 class="text-lg font-medium leading-6 text-gray-900">Nama Acara</h3>
                    <p class="mt-1 text-sm text-gray-500">{{ $event->name }}</p>
                </div>
                <div>
                    <h3 class="text-lg font-medium leading-6 text-gray-900">Jenis Acara</h3>
                    <p class="mt-1 text-sm text-gray-500">{{ ucfirst($event->type) }}</p>
                </div>
                <div>
                    <h3 class="text-lg font-medium leading-6 text-gray-900">Kategori Acara</h3>
                    <p class="mt-1 text-sm text-gray-500">{{ ucfirst($event->event_category->name) }}</p>
                </div>
                <div>
                    <h3 class="text-lg font-medium leading-6 text-gray-900">Lokasi</h3>
                    <p class="mt-1 text-sm text-gray-500">{{ $event->location }}</p>
                </div>
                <div>
                    <h3 class="text-lg font-medium leading-6 text-gray-900">Meeting Link</h3>
                    @if($event->meeting_link)
                    <a href="{{ $event->meeting_link }}" target="_blank" class="mt-1 text-sm text-pink-500">{{ $event->meeting_link }}</a>
                    @else
                    <p class="mt-1 text-sm text-gray-500">-</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection