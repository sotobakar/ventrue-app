@extends('biroakpk.layouts.app')

@section('content')
    <section id="detail">
        <h1 class="text-2xl font-semibold text-gray-900">Detil Acara</h1>
        <div class="mt-8 flex flex-col">
            <div class="flex gap-x-4">
                <img src="{{ asset('storage/' . $event->banner) }}"
                    class="w-1/2 mb-2 mx-auto object-fill rounded border border-gray-200">
                <div class="w-1/2 flex">
                    <div class="w-1/2 flex flex-col gap-y-2 px-4 sm:px-6">
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
                            @if ($event->meeting_link)
                                <a href="{{ $event->meeting_link }}" target="_blank"
                                    class="mt-1 text-sm text-pink-500">{{ $event->meeting_link }}</a>
                            @else
                                <p class="mt-1 text-sm text-gray-500">-</p>
                            @endif
                        </div>
                    </div>
                    <div class="w-1/2 flex flex-col gap-y-2 px-4 sm:px-6">
                        <div>
                            <h3 class="text-lg font-medium leading-6 text-gray-900">Waktu Mulai</h3>
                            <p class="mt-1 text-sm text-gray-500">
                                {{ \Carbon\Carbon::parse($event->start)->translatedFormat('l, j F Y H:i') }}</p>
                        </div>
                        <div>
                            <h3 class="text-lg font-medium leading-6 text-gray-900">Waktu Selesai</h3>
                            <p class="mt-1 text-sm text-gray-500">
                                {{ \Carbon\Carbon::parse($event->end)->translatedFormat('l, j F Y H:i') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div x-data="{ showModal: false }" class="mt-4 text-center">
            <div x-show="showModal" x-cloak class="relative z-10" aria-labelledby="modal-title" role="dialog"
                aria-modal="true">
                <div x-show="showModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
                    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                    class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity">
                </div>

                <div class="fixed inset-0 z-10 overflow-y-auto">
                    <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                        <div x-show="showModal" x-transition:enter="ease-out duration-300"
                            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                            x-transition:leave="ease-in duration-200"
                            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                            @click.outside="showModal = false"
                            class="relative transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg sm:p-6">
                            <div class="sm:flex sm:items-start">
                                <div
                                    class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-green-100 sm:mx-0 sm:h-10 sm:w-10">
                                    <i class="far fa-thumbs-up text-xl text-green-600"></i>
                                </div>
                                <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                                    <h3 class="text-base font-semibold leading-6 text-gray-900" id="modal-title">Setujui
                                        Acara</h3>
                                    <div class="mt-2">
                                        <p class="whitespace-normal text-sm text-gray-500">
                                            Dengan menekan tombol "Setujui", acara
                                            {{ $event->name }} sudah dapat diakses dan
                                            didaftarkan oleh mahasiswa.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
                                <form id="{{ 'approve-' . $event->id }}"
                                    action="{{ route('biroakpk.approvals.approve', ['event' => $event->id]) }}" method="POST">
                                    @csrf
                                    @method('POST')
                                </form>
                                <button @click="showModal= false" form="{{ 'approve-' . $event->id }}" type="submit"
                                    class="inline-flex w-full justify-center rounded-md bg-green-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-green-500 sm:ml-3 sm:w-auto">Setujui</button>
                                <button @click="showModal = false" type="button"
                                    class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button type="button" @click="showModal = true"
                class="rounded-md bg-green-600 px-3 py-2 text-lg font-semibold text-white shadow-sm hover:bg-green-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-600">Setujui Acara</button>
        </div>
    </section>
@endsection
