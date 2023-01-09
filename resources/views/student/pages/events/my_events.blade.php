@extends('student.layouts.app')

@section('content')
<div class="text-white mx-auto max-w-7xl px-8">
    <h1 class="mb-8 text-center text-4xl font-bold">Acara Saya</h1>
    <section aria-labelledby="product-heading" class="mt-6 lg:col-span-2 lg:mt-0 xl:col-span-3">
        <div class="grid grid-cols-1 gap-y-4 sm:grid-cols-2 sm:gap-x-6 sm:gap-y-10 lg:gap-x-8 xl:grid-cols-3">
            @if(count($events) == 0)
            <div class="col-span-1 sm:col-span-2 xl:col-span-3">
                <h1 class="text-2xl">Acara tidak ditemukan.</h1>
            </div>
            @endif
            @foreach($events as $event)
            <div class="group relative flex flex-col overflow-hidden rounded-lg border border-gray-200">
                <div class="group-hover:opacity-75 sm:aspect-none sm:h-48">
                    <img src="{{ asset('storage/' . $event->banner) }}"
                        alt="Eight shirts arranged on table in black, olive, grey, blue, white, red, mustard, and green."
                        class="h-full w-full object-cover object-center sm:h-full sm:w-full">
                </div>
                <div class="bg-white flex flex-1 flex-col space-y-2 p-4">
                    @if(\Carbon\Carbon::parse($event->start)->gt(\Carbon\Carbon::now()) &&\Carbon\Carbon::parse($event->end)->lt(\Carbon\Carbon::now()))
                    <span
                        class="self-start inline-flex items-center rounded-full bg-amber-100 px-2.5 py-0.5 text-xs font-medium text-amber-800">Berakhir</span>
                    @elseif(\Carbon\Carbon::parse($event->end)->lessThan(\Carbon\Carbon::now()))
                    <span
                        class="self-start inline-flex items-center rounded-full bg-red-100 px-2.5 py-0.5 text-xs font-medium text-red-800">Berakhir</span>
                    @else
                    <span
                        class="self-start inline-flex items-center rounded-full bg-green-100 px-2.5 py-0.5 text-xs font-medium text-green-800">Belum Mulai</span>
                    @endif
                    <h3 class="text-sm font-medium text-gray-900">
                        <a href="{{ route('student.my_events.detail', ['event' => $event->id]) }}">
                            <span aria-hidden="true" class="absolute inset-0"></span>
                            {{ $event->name }}
                        </a>
                    </h3>
                    <p class="text-sm text-gray-500">{{ substr($event->description, 0, 50) .
                        (strlen($event->description) > 50 ? '...' : '') }}</p>
                    <div class="flex flex-1 flex-col justify-end">
                        <p class="text-xs font-medium uppercase text-pink-500">{{
                            \Carbon\Carbon::parse($event->start)->translatedFormat('l, j F H:i') }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="mt-4">
            {{ $events->links() }}
        </div>
    </section>
</div>
@endsection