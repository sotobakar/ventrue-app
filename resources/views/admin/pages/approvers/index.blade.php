@extends('admin.layouts.app')

@section('content')
    <h1 class="text-2xl font-semibold text-gray-900">List Penyetuju Acara</h1>
    @include('admin.components.alerts.errors')
    <div class="mt-8 flex flex-col">
        <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-300">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">No
                                </th>
                                <th scope="col"
                                    class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Tingkat
                                </th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Nama
                                    Penyetuju
                                </th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Email
                                </th>
                                <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                    <span class="sr-only">Ubah</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">
                            @foreach ($approvers as $approver)
                                <tr>
                                    <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">
                                        {{ $approver->id }}</td>
                                    <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">
                                        {{ $approver->faculty->name ?? 'Universitas' }}</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                        {{ $approver->name }}
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                        {{ $approver->email }}
                                    </td>
                                    <td x-data="{ showModal: false }"
                                        class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                        <a @click=" showModal = !showModal" href="#"
                                            class="text-pink-600 hover:text-pink-900">Ubah</a>
                                        <div x-show="showModal" x-cloak class="relative z-10" aria-labelledby="modal-title"
                                            role="dialog" aria-modal="true">
                                            <div x-show="showModal" x-transition:enter="ease-out duration-300"
                                                x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                                                x-transition:leave="ease-in duration-200"
                                                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                                                class="fixed inset-0 bg-gray-500 bg-opacity-40 transition-opacity"></div>

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
                                                        class="relative transform overflow-hidden rounded-lg bg-white px-4 pt-5 pb-4 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg sm:p-6">
                                                        <div class="absolute top-0 right-0 hidden pt-4 pr-4 sm:block">
                                                            <button @click="showModal = false" type="button"
                                                                class="rounded-md bg-white text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-pink-500 focus:ring-offset-2">
                                                                <span class="sr-only">Close</span>
                                                                <!-- Heroicon name: outline/x-mark -->
                                                                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg"
                                                                    fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                                    stroke="currentColor" aria-hidden="true">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        d="M6 18L18 6M6 6l12 12" />
                                                                </svg>
                                                            </button>
                                                        </div>
                                                        <div>
                                                            <h3 class="text-xl whitespace-normal mr-3">{{ $approver->faculty->name ?? 'Universitas' }}
                                                            </h3>
                                                            <form id="{{ 'update_approver_' . $approver->id }}"
                                                                class="mt-2"
                                                                action="{{ route('admin.approvers.update', ['approver' => $approver->id]) }}"
                                                                method="POST">
                                                                @method('PUT')
                                                                @csrf
                                                                <div>
                                                                    <label for="name"
                                                                        class="block text-sm font-medium text-gray-700">
                                                                        Nama Penyetuju</label>
                                                                    <div class="mt-1">
                                                                        <input type="text" name="name" id="name"
                                                                            value="{{ $approver->name }}"
                                                                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500 font-normal sm:text-sm"
                                                                            placeholder="123"
                                                                            aria-describedby="email-description">
                                                                    </div>
                                                                </div>
                                                                <div class="mt-2">
                                                                    <label for="email"
                                                                        class="block text-sm font-medium text-gray-700">Email
                                                                        Penyetuju</label>
                                                                    <div class="mt-1">
                                                                        <input type="text" name="email" id="email"
                                                                            value="{{ $approver->email }}"
                                                                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500 font-normal sm:text-sm"
                                                                            placeholder="123"
                                                                            aria-describedby="email-description">
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
                                                            <button form="{{ 'update_approver_' . $approver->id }}"
                                                                type="submit"
                                                                class="inline-flex w-full justify-center rounded-md border border-transparent bg-green-600 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 sm:ml-3 sm:w-auto sm:text-sm">Ubah</button>
                                                            <button @click="showModal = false" type="button"
                                                                class="mt-3 inline-flex w-full justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-base font-medium text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-pink-500 focus:ring-offset-2 sm:mt-0 sm:w-auto sm:text-sm">Cancel</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
