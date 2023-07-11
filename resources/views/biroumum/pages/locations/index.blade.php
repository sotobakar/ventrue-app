@extends('biroumum.layouts.app')

@section('content')
    <h1 class="text-2xl font-semibold text-gray-900">List Lokasi</h1>
    <div class="mt-8 sm:flex sm:items-center">
        <div class="mt-4 sm:mt-0 sm:flex-none">
            <a href="{{ route('biroumum.locations.create') }}"
                class="inline-flex items-center justify-center rounded-md border border-transparent bg-pink-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-pink-700 focus:outline-none focus:ring-2 focus:ring-pink-500 focus:ring-offset-2 sm:w-auto">Buat
                Lokasi</a>
        </div>
    </div>
    <div class="mt-4 flex flex-col">
        <div class="mb-4">
            <form action="{{ route('biroumum.locations') }}" class="flex gap-x-4">
                <div>
                    <label for="filter[name]" class="block text-sm leading-6 text-gray-900">Nama Lokasi</label>
                    <div class="mt-0.5">
                        <input type="text" name="filter[name]" value="{{ request()->input('filter.name') }}"
                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-pink-600 sm:text-sm sm:leading-6"
                            placeholder="Lokasi...">
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
                                    Nama
                                </th>
                                <th scope="col" colspan="2" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                    <span class="sr-only">Ubah</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">
                            @foreach ($locations as $location)
                                <tr x-data="{ showModal: false }">
                                    <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">
                                        {{ ++$loop->index }}</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                        {{ $location->name }}
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
                                                        class="relative transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg sm:p-6">
                                                        <div class="sm:flex sm:items-start">
                                                            <div
                                                                class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                                                                <i
                                                                    class="far fa-exclamation-triangle text-xl text-red-600"></i>
                                                            </div>
                                                            <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                                                                <h3 class="text-base font-semibold leading-6 text-gray-900"
                                                                    id="modal-title">Hapus Lokasi</h3>
                                                                <div class="mt-2">
                                                                    <p class="whitespace-normal text-sm text-gray-500">
                                                                        Yakin untuk menghapus lokasi
                                                                        {{ $location->name }}? Anda tidak bisa
                                                                        membatalkan tindakan ini.
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
                                                            <form id="{{ 'delete-' . $location->id }}"
                                                                action="{{ route('biroumum.locations.delete', ['location' => $location->id]) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                            </form>
                                                            <button @click="showModal= false"
                                                                form="{{ 'delete-' . $location->id }}" type="submit"
                                                                class="inline-flex w-full justify-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 sm:ml-3 sm:w-auto">Hapus</button>
                                                            <button @click="showModal = false" type="button"
                                                                class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">Cancel</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <a href="{{ route('biroumum.locations.edit', ['location' => $location->id]) }}"
                                            class="mr-4 text-pink-600 hover:text-pink-900">Ubah</a>
                                        <button @click="showModal = true"
                                            class="text-red-600 hover:text-red-900">Hapus</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @if ($locations->hasPages())
            <div class="mt-4">
                {{ $locations->links() }}
            </div>
        @endif
    </div>
@endsection
