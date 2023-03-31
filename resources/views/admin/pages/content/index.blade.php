@extends('admin.layouts.app')

@section('content')
    <h1 class="text-2xl font-semibold text-gray-900">Konten Acara</h1>
    <div class="mt-8 flex flex-col">
        <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-300">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Urutan
                                </th>
                                <th scope="col"
                                    class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Name
                                </th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Waktu
                                    Mulai
                                </th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Waktu
                                    Selesai
                                </th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Status
                                </th>
                                <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                    <span class="sr-only">Ubah</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">
                            @foreach ($contents as $content)
                                <tr>
                                    <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">
                                        {{ $content->id }}</td>
                                    <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">
                                        {{ $content->event->name }}</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                        {{ \Carbon\Carbon::parse($content->event->start)->translatedFormat('l, j F Y H:i') }}
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                        {{ \Carbon\Carbon::parse($content->event->end)->translatedFormat('l, j F Y H:i') }}
                                    </td>
                                    @if ($content->event->status == config('constants.EVENT.STATUS.0'))
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-red-500">
                                            {{ $content->event->status }}
                                        </td>
                                    @elseif($content->event->status == config('constants.EVENT.STATUS.1'))
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-amber-500">
                                            {{ $content->event->status }}
                                        </td>
                                    @else
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-green-500">
                                            {{ $content->event->status }}
                                        </td>
                                    @endif
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
                                                    <div x-data="searchEvent()" x-show="showModal"
                                                        x-transition:enter="ease-out duration-300"
                                                        x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                                        x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                                                        x-transition:leave="ease-in duration-200"
                                                        x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                                        x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
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
                                                        <div class="whitespace-normal">
                                                            <h3 class="text-xl">Urutan {{ $content->id }}
                                                            </h3>
                                                            <form id="{{ 'update_content_' . $content->id }}" class="mt-2"
                                                                action="{{ route('admin.content.update', ['content' => $content->id]) }}"
                                                                method="POST">
                                                                @method('PUT')
                                                                @csrf
                                                                <div>
                                                                    <label for="event_id"
                                                                        class="block text-sm font-medium text-gray-700">ID
                                                                        Acara</label>
                                                                    <div class="mt-1 flex gap-x-2">
                                                                        <input type="text" name="event_id" id="event_id"
                                                                            x-model="id"
                                                                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500 sm:text-sm"
                                                                            placeholder="123"
                                                                            aria-describedby="email-description">
                                                                        <button :disabled="isLoading" @click="fetchEvent()"
                                                                            type="button"
                                                                            class="rounded-md bg-pink-600 px-2.5 py-1.5 text-sm font-semibold text-white shadow-sm hover:bg-pink-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-pink-600">Periksa</button>
                                                                    </div>
                                                                    <p class="mt-2 text-xs font-normal text-gray-500"
                                                                        id="event-description">ID Acara bisa ditemukan pada
                                                                        url acara/{id acara}.
                                                                    </p>
                                                                </div>
                                                                <h2 x-show="event" x-transition x-text="eventMessage"
                                                                    class="mt-2 text-lg text-green-500"></h2>
                                                                <h2 x-show="error" x-transition x-text="error"
                                                                    class="mt-2 text-lg text-red-500">
                                                                </h2>
                                                            </form>
                                                        </div>
                                                        <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
                                                            <button :disabled="!event"
                                                                :class="event ? 'bg-green-600 hover:bg-green-700' :
                                                                    'bg-gray-400'"
                                                                form="{{ 'update_content_' . $content->id }}"
                                                                type="submit"
                                                                class="inline-flex w-full justify-center rounded-md border border-transparent  px-4 py-2 text-base font-medium text-white shadow-sm 
                                                             focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 sm:ml-3 sm:w-auto sm:text-sm">Ubah</button>
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

@push('scripts')
    <script>
        function searchEvent() {
            const fetchURL = "{{ route('admin.events.find') }}"
            return {
                id: null,
                isLoading: false,
                error: null,
                event: null,
                eventMessage: null,
                fetchEvent() {
                    this.isLoading = true
                    this.error = null
                    this.event = null
                    fetch(fetchURL + '?' + new URLSearchParams({
                            id: this.id
                        }), {
                            headers: {
                                'Accept': 'application/json',
                            },
                        })
                        .then(res => {
                            if (!res.ok) {
                                throw new Error("Acara tidak ditemukan")
                            }

                            return res.json()
                        })
                        .then(data => {
                            this.event = data.data
                            this.eventMessage = `Acara dengan nama "${data.data.name}" ditemukan`
                        })
                        .catch(err => {
                            this.error = err.message
                        })
                        .finally(() => {
                            this.isLoading = false
                        })
                }
            }
        }
    </script>
@endpush
