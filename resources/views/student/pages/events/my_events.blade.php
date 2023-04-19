@extends('student.layouts.app')

@section('content')
    <div class="text-white mx-auto max-w-7xl px-8">
        <h1 class="mb-8 text-center text-4xl font-bold">Acara Saya</h1>
        <section aria-labelledby="product-heading" class="mt-6 lg:col-span-2 lg:mt-0 xl:col-span-3">
            <div class="grid grid-cols-1 gap-y-4 sm:grid-cols-2 sm:gap-x-6 sm:gap-y-10 lg:gap-x-8 xl:grid-cols-3">
                @if (count($events) == 0)
                    <div class="col-span-1 sm:col-span-2 xl:col-span-3">
                        <h1 class="text-2xl">Acara tidak ditemukan.</h1>
                    </div>
                @endif
                @foreach ($events as $event)
                    <div class="group relative flex flex-col overflow-hidden rounded-lg border border-gray-200">
                        <div class="group-hover:opacity-75 sm:aspect-none sm:h-64">
                            <img src="{{ asset('storage/' . $event->banner) }}"
                                alt="Eight shirts arranged on table in black, olive, grey, blue, white, red, mustard, and green."
                                class="h-full w-full object-cover object-center sm:h-full sm:w-full">
                        </div>
                        <div class="bg-white flex flex-1 flex-col space-y-2 p-4">
                            <span @class([
                                'self-start inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium',
                                'bg-green-100 text-green-800' =>
                                    $event->status == config('constants.EVENT.STATUS.2'),
                                'bg-amber-100 text-amber-800' =>
                                    $event->status == config('constants.EVENT.STATUS.1'),
                                'bg-red-100 text-red-800' =>
                                    $event->status == config('constants.EVENT.STATUS.0')
                            ])>{{ $event->status }}</span>
                            <h3 class="text-sm font-medium text-gray-900">
                                <a href="{{ route('student.my_events.detail', ['event' => $event->id]) }}">
                                    <span aria-hidden="true" class="absolute inset-0"></span>
                                    {{ $event->name }}
                                </a>
                            </h3>
                            <p class="text-sm text-gray-500">
                                {{ substr($event->description, 0, 50) . (strlen($event->description) > 50 ? '...' : '') }}
                            </p>
                            <div class="flex flex-1 flex-col justify-end">
                                <p class="text-xs font-medium uppercase text-pink-500">
                                    {{ \Carbon\Carbon::parse($event->start)->translatedFormat('l, j F H:i') }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
        @if ($events->hasPages())
            <div class="mt-4">
                {{ $events->links('vendor.pagination.simple-tailwind') }}
            </div>
        @endif
    </div>
@endsection
