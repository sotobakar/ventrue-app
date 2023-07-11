@extends('biroumum.layouts.app')

@section('content')
    <h1 class="text-2xl font-semibold text-gray-900">List Jadwal Bentrok</h1>
    <div class="mt-4 flex flex-col">
        <div class="mb-4">
            <form action="{{ route('biroumum.schedules.clash') }}" class="flex gap-x-4">
                <div>
                    <label for="name" class="block text-sm leading-6 text-gray-900">Nama Acara</label>
                    <div class="mt-0.5">
                        <input type="text" name="name" value="{{ request()->input('name') }}"
                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-pink-600 sm:text-sm sm:leading-6"
                            placeholder="Acara...">
                    </div>
                </div>
                <div>
                    <label for="from" class="block text-sm leading-6 text-gray-900">Tanggal Mulai</label>
                    <div class="mt-0.5">
                        <input type="datetime-local" name="from" value="{{ request()->input('from') }}"
                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-pink-600 sm:text-sm sm:leading-6">
                    </div>
                </div>
                <div>
                    <label for="to" class="block text-sm leading-6 text-gray-900">Tanggal Selesai</label>
                    <div class="mt-0.5">
                        <input type="datetime-local" name="to" value="{{ request()->input('to') }}"
                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-pink-600 sm:text-sm sm:leading-6">
                    </div>
                </div>
                <button type="submit"
                    class="self-end rounded-md bg-pink-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-pink-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-pink-600"><i
                        class="fas fa-search mr-3"></i>Cari</button>
                @if (request()->query->count() > 0)
                    <button type="button" onclick="window.location = window.location.pathname;"
                        class="self-end rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600">Reset</button>
                @endif
            </form>
        </div>
        <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-300">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">No.
                                </th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                    Nama Acara
                                </th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                    Bentrok dengan
                                </th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                    Lokasi
                                </th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                    Tanggal
                                </th>
                                <th scope="col" colspan="2" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                    <span class="sr-only">Ubah</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">
                            @foreach ($events as $event)
                                <tr x-data="{ showModal: false }">
                                    <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">
                                        {{ ++$loop->index }}</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                        {{ $event->name }}
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                        {{ $event->clash_name }}
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                        {{ $event->location }}
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                        {{ \Carbon\Carbon::parse($event->start)->translatedFormat('d F Y') }}
                                    </td>
                                    <td
                                        class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                        <div x-show="showModal" x-cloak class="relative z-10" aria-labelledby="modal-title"
                                            role="dialog" aria-modal="true">
                                            <div x-show="showModal" x-transition:enter="ease-out duration-300"
                                                x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                                                x-transition:leave="ease-in duration-200"
                                                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                                                class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity">
                                            </div>

                                            <div class="fixed inset-0 z-10 overflow-y-auto">
                                                <div
                                                    class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                                                    <div x-show="showModal" x-transition:enter="ease-out duration-300"
                                                        x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                                        x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                                                        x-transition:leave="ease-in duration-200"
                                                        x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                                        x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                                        @click.outside="showModal = false"
                                                        class="relative transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-xl sm:p-6">
                                                        <div class="sm:flex sm:items-start">
                                                            <div
                                                                class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                                                                <i
                                                                    class="far fa-exclamation-triangle text-xl text-red-600"></i>
                                                            </div>
                                                            <div
                                                                class="mt-3 w-full text-center sm:ml-4 sm:mt-0 sm:text-left">
                                                                <h3 class="text-base font-semibold leading-6 text-gray-900"
                                                                    id="modal-title">Informasi Jadwal Bentrok</h3>
                                                                <h2 class="text-lg text-pink-500">
                                                                    {{ \Carbon\Carbon::parse($event->start)->translatedFormat('d F Y') }}
                                                                </h2>
                                                                <h2 class="font-regular text-pink-500">
                                                                    {{ $event->location }}
                                                                </h2>
                                                                <div class="mt-2 flex w-full">
                                                                    <div class="w-1/2 mt-[20px]">
                                                                        <h4 class="text-lg text-pink-500 whitespace-normal">
                                                                            {{ $event->name }}</h4>
                                                                        <div class="text-xl">
                                                                            <h4>{{ \Carbon\Carbon::parse($event->start)->translatedFormat('H:i') }}
                                                                                -
                                                                                {{ \Carbon\Carbon::parse($event->end)->translatedFormat('H:i') }}
                                                                            </h4>
                                                                        </div>
                                                                        <div class="mt-2">
                                                                            <h4 class="text-xl">Penyelenggara</h4>
                                                                            <h4>{{ $event->organization_name }}</h4>
                                                                            <h4>{{ $event->tingkat }}</h4>
                                                                            <h4>{{ $event->email }}</h4>
                                                                        </div>
                                                                    </div>
                                                                    <div class="ml-4 w-1/2">
                                                                        <h5 class="text-red-600">Bentrok dengan:</h5>
                                                                        <h4 class="text-lg whitespace-normal">
                                                                            {{ $event->clash_name }}</h4>
                                                                        <div class="text-xl">
                                                                            <h4>{{ \Carbon\Carbon::parse($event->clash_start)->translatedFormat('H:i') }}
                                                                                -
                                                                                {{ \Carbon\Carbon::parse($event->clash_end)->translatedFormat('H:i') }}
                                                                            </h4>
                                                                        </div>
                                                                    </div>
                                                                    {{-- <p class="whitespace-normal text-sm text-gray-500">
                                                                        Yakin untuk menghapus lokasi
                                                                        {{ $event->name }}? Anda tidak bisa
                                                                        membatalkan tindakan ini.
                                                                    </p> --}}
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
                                                            <form id="{{ 'delete-' . $event->id }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                            </form>
                                                            {{-- <button @click="showModal= false"
                                                                form="{{ 'delete-' . $event->id }}" type="submit"
                                                                class="inline-flex w-full justify-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 sm:ml-3 sm:w-auto">Hapus</button> --}}
                                                            <button @click="showModal = false" type="button"
                                                                class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">Tutup</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <button @click="showModal = true"
                                            href="{{ route('biroumum.locations.edit', ['location' => $event->id]) }}"
                                            class="mr-4 text-pink-600 hover:text-pink-900">Detail</button>
                                        {{-- <button @click="showModal = true"
                                            class="text-red-600 hover:text-red-900">Hapus</button> --}}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @if ($events->hasPages())
            <div class="mt-4">
                {{ $events->links() }}
            </div>
        @endif
    </div>
@endsection
