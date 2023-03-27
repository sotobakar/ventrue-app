@extends('student.layouts.app')

@section('content')
<div class="mx-auto px-8 max-w-7xl">
    <div class="bg-white p-4 lg:grid lg:grid-cols-3 lg:gap-x-8 xl:grid-cols-4 rounded-lg">
        <aside class="md:px-6">
            <h2 class="sr-only">Filters</h2>

            <div x-data="{ open: false }" class="block lg:hidden">
                <div class="flex justify-between items-center">
                    <h2 class="text-lg font-medium">Filter</h2>
                    <button type="button" class="p-2">
                        <i @click="open = ! open" class="far fa-bars text-2xl"></i>
                    </button>
                </div>
                <form x-show="open" x-transition x-cloak class="space-y-5 divide-y divide-gray-200">
                    <div>
                        <fieldset>
                            <legend class="block text-sm md:text-lg font-medium text-gray-900">Cari berdasarkan nama</legend>
                            <div class="space-y-3 pt-2">
                                <div class="flex items-center">
                                    <input type="text" name="filter[name]" id="name" value="{{ request()->get('filter')['name'] ?? null }}"
                                        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500 sm:text-sm"
                                        placeholder="Nama event disini...">
                                    <button type="submit">
                                        <i class="ml-2 fas fa-search text-xl hover:text-pink-500"></i>
                                    </button>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                    <div class="pt-4">
                        <fieldset>
                            <legend class="block text-sm md:text-lg font-medium text-gray-900">Kategori</legend>
                            <div class="space-y-3 pt-6">
                                @foreach($event_categories as $event_category)
                                <div class="flex items-center">
                                    <input name="filter[event_category][]" value="{{ $event_category->id }}" type="checkbox" {{ in_array($event_category->id, request()->get('filter')['event_category'] ?? []) ? 'checked' : ''}}
                                        class="h-4 w-4 rounded border-gray-300 text-pink-600 focus:ring-pink-500">
                                    <label for="event_category" class="ml-3 text-sm text-gray-600">{{
                                        ucfirst($event_category->name) }}</label>
                                </div>
                                @endforeach
                            </div>
                        </fieldset>
                    </div>

                    <div class="pt-4">
                        <fieldset>
                            <legend class="block text-sm md:text-lg font-medium text-gray-900">Jenis</legend>
                            <div class="space-y-3 pt-6">
                                @foreach($types as $type)
                                <div class="flex items-center">
                                    <input name="filter[type][]" value="{{ $type }}" type="checkbox" {{ in_array($type, request()->get('filter')['type'] ?? []) ? 'checked' : ''}}
                                        class="h-4 w-4 rounded border-gray-300 text-pink-600 focus:ring-pink-500">
                                    <label class="ml-3 text-sm text-gray-600">{{ ucfirst($type) }}</label>
                                </div>
                                @endforeach
                            </div>
                        </fieldset>
                    </div>
                </form>
            </div>
            <div class="hidden lg:block">
                <form class="space-y-5 divide-y divide-gray-200">
                    <div>
                        <fieldset>
                            <legend class="block text-sm md:text-lg font-medium text-gray-900">Cari berdasarkan nama</legend>
                            <div class="space-y-3 pt-2">
                                <div class="flex items-center">
                                    <input type="text" name="filter[name]" id="name" value="{{ request()->get('filter')['name'] ?? null }}"
                                        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500 sm:text-sm"
                                        placeholder="Nama event disini...">
                                    <button type="submit">
                                        <i class="ml-2 fas fa-search text-xl hover:text-pink-500"></i>
                                    </button>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                    <div class="pt-4">
                        <fieldset>
                            <legend class="block text-sm md:text-lg font-medium text-gray-900">Kategori</legend>
                            <div class="space-y-3 pt-6">
                                @foreach($event_categories as $event_category)
                                <div class="flex items-center">
                                    <input name="filter[event_category][]" value="{{ $event_category->id }}" type="checkbox" {{ in_array($event_category->id, request()->get('filter')['event_category'] ?? []) ? 'checked' : ''}}
                                        class="h-4 w-4 rounded border-gray-300 text-pink-600 focus:ring-pink-500">
                                    <label for="event_category" class="ml-3 text-sm text-gray-600">{{
                                        ucfirst($event_category->name) }}</label>
                                </div>
                                @endforeach
                            </div>
                        </fieldset>
                    </div>

                    <div class="pt-4">
                        <fieldset>
                            <legend class="block text-sm md:text-lg font-medium text-gray-900">Jenis</legend>
                            <div class="space-y-3 pt-6">
                                @foreach($types as $type)
                                <div class="flex items-center">
                                    <input name="filter[type][]" value="{{ $type }}" type="checkbox" {{ in_array($type, request()->get('filter')['type'] ?? []) ? 'checked' : ''}}
                                        class="h-4 w-4 rounded border-gray-300 text-pink-600 focus:ring-pink-500">
                                    <label class="ml-3 text-sm text-gray-600">{{ ucfirst($type) }}</label>
                                </div>
                                @endforeach
                            </div>
                        </fieldset>
                    </div>
                </form>
            </div>
        </aside>

        <section aria-labelledby="product-heading" class="mt-6 lg:col-span-2 lg:mt-0 xl:col-span-3">
            <div class="grid grid-cols-1 gap-y-4 sm:grid-cols-2 sm:gap-x-6 sm:gap-y-10 lg:gap-x-8 xl:grid-cols-3">
                @if(count($events) == 0)
                <div class="col-span-1 sm:col-span-2 xl:col-span-3">
                    <h1 class="text-2xl">Acara tidak ditemukan.</h1>
                </div>
                @endif
                @foreach($events as $event)
                <div class="group relative flex flex-col overflow-hidden rounded-lg border border-gray-200 bg-white">
                    @if($event->verified)
                    <div class="z-10 absolute top-2 left-2 rounded-lg py-1 px-2 bg-white flex items-center text-green-700 text-sm sm:text-base select-none">
                        <i class="far fa-shield-check"></i>
                        <span class="ml-2 font-medium">Verified</span>
                    </div>
                    @endif
                    <div class="bg-gray-200 group-hover:opacity-75 sm:aspect-none sm:h-48">
                        <img src="{{ asset('storage/' . $event->banner) }}"
                            alt="Eight shirts arranged on table in black, olive, grey, blue, white, red, mustard, and green."
                            class="h-full w-full object-cover object-center sm:h-full sm:w-full">
                    </div>
                    <div class="flex flex-1 flex-col space-y-2 p-4">
                        @if(\Carbon\Carbon::parse($event->registration_end)->lessThan(\Carbon\Carbon::now()))
                        <span
                            class="self-start inline-flex items-center rounded-full bg-red-100 px-2.5 py-0.5 text-xs font-medium text-red-800">Pendaftaran
                            Ditutup</span>
                        @else
                        <span
                            class="self-start inline-flex items-center rounded-full bg-green-100 px-2.5 py-0.5 text-xs font-medium text-green-800">Pendaftaran
                            Dibuka</span>
                        @endif
                        <h3 class="text-sm font-medium text-gray-900">
                            <a href="{{ route('student.events.detail', ['event' => $event->id]) }}">
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
</div>
@endsection