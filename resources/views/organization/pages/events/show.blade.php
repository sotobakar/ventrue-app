@extends('organization.layouts.app')

@section('content')
    <section id="detail">
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
                            @if ($event->meeting_link)
                                <a href="{{ $event->meeting_link }}" target="_blank"
                                    class="mt-1 text-sm text-pink-500">{{ $event->meeting_link }}</a>
                            @else
                                <p class="mt-1 text-sm text-gray-500">-</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="mt-8" id="actions">
        <div x-data="{ tab: window.location.hash ? window.location.hash.substring(1) : 'pendaftaran' }">
            <div class="sm:hidden">
                <label for="tabs" class="sr-only">Select a tab</label>
                <!-- Use an "onChange" listener to redirect the user to the selected tab URL. -->
                <select id="tabs" name="tabs"
                    class="block w-full rounded-md border-gray-300 py-2 pl-3 pr-10 text-base focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                    <option>My Account</option>

                    <option>Company</option>

                    <option selected>Team Members</option>

                    <option>Billing</option>
                </select>
            </div>
            @include('organization.components.alerts.errors')
            <div class="hidden sm:block">
                <div class="border-b border-gray-200">
                    <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                        <a :class="tab === 'pendaftaran' ? 'border-pink-500 text-pink-600' :
                            'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                            @click.prevent="tab = 'pendaftaran'; window.location.hash = 'pendaftaran'" href="#"
                            class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">Pendaftaran</a>

                        <a :class="tab === 'absensi' ? 'border-pink-500 text-pink-600' :
                            'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                            @click.prevent="tab = 'absensi'; window.location.hash = 'absensi'" href="#"
                            class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">Absensi</a>

                        <a :class="tab === 'materi' ? 'border-pink-500 text-pink-600' :
                            'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                            @click.prevent="tab = 'materi'; window.location.hash = 'materi'" href="#"
                            class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm"
                            aria-current="page">Materi</a>

                        <a :class="tab === 'sertifikat' ? 'border-pink-500 text-pink-600' :
                            'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                            @click.prevent="tab = 'sertifikat'; window.location.hash = 'sertifikat'" href="#"
                            class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">Sertifikat</a>
                    </nav>
                </div>
            </div>
            <div class="bg-white p-4 rounded-b-lg shadow-sm">
                <div x-show="tab === 'pendaftaran'" x-cloak>
                    <div class="flex gap-x-6">
                        <div>
                            <h2 class="text-pink-500 text-3xl">{{ $event->participants()->count() }}</h2>
                            <h3 class="font-medium text-gray-900">pendaftar</h3>
                        </div>
                        <div>
                            <h2 class="text-pink-500 text-3xl">
                                {{ \Carbon\Carbon::parse($event->registration_end)->diffForHumans() ?? 'Tidak ada batas' }}
                            </h2>
                            <h3 class="font-medium text-gray-900">batas pendaftaran</h3>
                        </div>
                    </div>
                    <div class="mt-4 flex gap-x-4">
                        @if (\Carbon\Carbon::parse($event->registration_end)->lessThan(\Carbon\Carbon::now()))
                            <form class="hidden" id="open_registration"
                                action="{{ route('organization.events.open_registration', ['event' => $event->id]) }}"
                                method="POST">
                                @csrf
                            </form>
                            <button form="open_registration" type="submit"
                                class="inline-flex items-center rounded-md border border-transparent bg-green-600 px-3 py-2 text-sm font-medium leading-4 text-white shadow-sm hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2"><i
                                    class="fas fa-lock-open mr-2"></i>Buka Pendaftaran</button>
                        @else
                            <form class="hidden" id="close_registration"
                                action="{{ route('organization.events.close_registration', ['event' => $event->id]) }}"
                                method="POST">
                                @csrf
                            </form>
                            <button form="close_registration" type="submit"
                                class="inline-flex items-center rounded-md border border-transparent bg-red-600 px-3 py-2 text-sm font-medium leading-4 text-white shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2"><i
                                    class="fas fa-lock mr-2"></i>Tutup Pendaftaran</button>
                        @endif
                        <button type="button"
                            class="inline-flex items-center rounded-md border border-transparent bg-green-600 px-3 py-2 text-sm font-medium leading-4 text-white shadow-sm hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2"><i
                                class="fas fa-download mr-2"></i>Download Data Partisipan</button>
                    </div>
                </div>
                <div x-show="tab === 'absensi'" x-cloak>
                    <div class="flex gap-x-6">
                        <div>
                            <h2 class="text-pink-500 text-3xl">{{ $event->participants()->count() }}</h2>
                            <h3 class="font-medium text-gray-900">absensi</h3>
                        </div>
                        <div>
                            @if ($event->attendance_open)
                                <h2 class="text-green-500 text-3xl">dibuka
                                </h2>
                            @else
                                <h2 class="text-red-500 text-3xl">ditutup
                                </h2>
                            @endif
                            <h3 class="font-medium text-gray-900">status absen</h3>
                        </div>
                    </div>
                    <div class="mt-4 flex gap-x-4">
                        @if (!$event->attendance_open)
                            <form class="hidden" id="open_attendance"
                                action="{{ route('organization.events.open_attendance', ['event' => $event->id]) }}"
                                method="POST">
                                @csrf
                            </form>
                            <button form="open_attendance" type="submit"
                                class="inline-flex items-center rounded-md border border-transparent bg-green-600 px-3 py-2 text-sm font-medium leading-4 text-white shadow-sm hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2"><i
                                    class="fas fa-lock-open mr-2"></i>Buka Absensi</button>
                        @else
                            <form class="hidden" id="close_attendance"
                                action="{{ route('organization.events.close_attendance', ['event' => $event->id]) }}"
                                method="POST">
                                @csrf
                            </form>
                            <button form="close_attendance" type="submit"
                                class="inline-flex items-center rounded-md border border-transparent bg-red-600 px-3 py-2 text-sm font-medium leading-4 text-white shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2"><i
                                    class="fas fa-lock mr-2"></i>Tutup Absensi</button>
                        @endif
                        <button type="button"
                            class="inline-flex items-center rounded-md border border-transparent bg-green-600 px-3 py-2 text-sm font-medium leading-4 text-white shadow-sm hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2"><i
                                class="fas fa-download mr-2"></i>Download Data Absen</button>
                    </div>
                </div>
                <div x-data="{ modal: false }" x-show="tab === 'materi'" x-cloak>
                    <h1 class="font-bold text-lg">Daftar Materi</h1>
                    @if ($event->materials->count() > 0)
                        <div class="overflow-x-auto">
                            <div class="inline-block min-w-full py-2 align-middle">
                                <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                                    <table class="min-w-full divide-y divide-gray-300">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th scope="col"
                                                    class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                                                    Nama Materi</th>
                                                <th scope="col"
                                                    class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                                    Download
                                                    File</th>
                                                <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-200 bg-white">
                                            @foreach ($event->materials as $material)
                                                <tr>
                                                    <td
                                                        class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">
                                                        {{ $material->name }}</td>
                                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-pink-500"><a
                                                            href="{{ asset('storage/' . $material->path) }}">Link</a></td>
                                                    <td
                                                        class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                                        <form id="{{ 'delete_material' . $material->id }}" class="hidden"
                                                            action="{{ route('organization.events.materials.delete', ['event' => $event->id, 'material' => $material->id]) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')

                                                        </form>
                                                        <button form="{{ 'delete_material' . $material->id }}"
                                                            type="submit"
                                                            class="text-red-600 hover:text-red-900">Hapus</button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="mt-4 flex flex-col items-center">
                            <i class="far fa-folder-open text-5xl"></i>
                            <h2>Belum ada materi</h2>
                        </div>
                    @endif
                    <div class="mt-4">
                        <button @click="modal = true" type="button"
                            class="inline-flex items-center rounded-md border border-transparent bg-indigo-600 px-3 py-2 text-sm font-medium leading-4 text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"><i
                                class="fas fa-plus mr-2"></i>Tambah Materi</button>
                        <div x-show="modal" class="relative z-10" aria-labelledby="modal-title" role="dialog"
                            aria-modal="true">
                            <!--
                                      Background backdrop, show/hide based on modal state.
                                  
                                      Entering: "ease-out duration-300"
                                        From: "opacity-0"
                                        To: "opacity-100"
                                      Leaving: "ease-in duration-200"
                                        From: "opacity-100"
                                        To: "opacity-0"
                                    -->
                            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

                            <div class="fixed inset-0 z-10 overflow-y-auto">
                                <div
                                    class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                                    <!--
                                          Modal panel, show/hide based on modal state.
                                  
                                          Entering: "ease-out duration-300"
                                            From: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                            To: "opacity-100 translate-y-0 sm:scale-100"
                                          Leaving: "ease-in duration-200"
                                            From: "opacity-100 translate-y-0 sm:scale-100"
                                            To: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                        -->
                                    <div @click.outside="modal = false"
                                        class="relative transform overflow-hidden rounded-lg bg-white px-4 pt-5 pb-4 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-sm sm:p-6">
                                        <div>
                                            <div
                                                class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-green-100">
                                                <!-- Heroicon name: outline/check -->
                                                <i class="fal fa-upload text-green-600 text-lg"></i>
                                            </div>
                                            <div class="mt-3 text-center sm:mt-5">
                                                <h3 class="text-lg font-medium leading-6 text-gray-900" id="modal-title">
                                                    Unggah Materi
                                                </h3>
                                                <div class="mt-2">
                                                    <p class="text-sm text-gray-500">File harus berupa .pdf atau .ppt
                                                        dengan
                                                        ukuran maks 10MB.</p>
                                                </div>
                                            </div>
                                            <form class="mt-2"
                                                action="{{ route('organization.events.materials.add', ['event' => $event->id]) }}"
                                                method="post" enctype="multipart/form-data">
                                                @csrf
                                                @method('POST')
                                                <div>
                                                    <label for="name"
                                                        class="block text-sm font-medium text-gray-700">Nama
                                                        File</label>
                                                    <div class="mt-1">
                                                        <input type="text" name="name" id="name"
                                                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                                            placeholder="PPT Materi" required>
                                                    </div>
                                                </div>
                                                <div class="mt-2">
                                                    <div class="flex justify-between">
                                                        <label for="material"
                                                            class="block text-sm font-medium text-gray-700">File</label>
                                                        <span class="text-sm text-gray-500">jenis file .pdf, .pptx</span>
                                                    </div>
                                                    <div class="mt-1">
                                                        <input type="file" name="material" id="material"
                                                            class="block w-full border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                                            required>
                                                    </div>
                                                </div>

                                                <div class="mt-5 sm:mt-6">
                                                    <button type="submit"
                                                        class="inline-flex w-full justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:text-sm">Unggah</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div x-show="tab === 'sertifikat'" x-cloak>
                    <form action="{{ route('organization.events.certificate', ['event' => $event->id]) }}" method="POST">
                        @csrf
                        <div>
                            <label for="certificate_link" class="block text-sm font-medium text-gray-700">Link Sertifikat</label>
                            <div class="mt-2">
                                <input type="text" name="certificate_link" id="certificate_link" value="{{ $event->certificate_link }}"
                                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500 sm:text-sm"
                                    placeholder="https://drive.google.com" required>
                            </div>
                            <div class="mt-4">
                                <button type="submit"
                                    class="rounded bg-pink-600 py-2 px-4 text-sm font-semibold text-white shadow-sm hover:bg-pink-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-pink-600">Update Link</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="mt-4 grid grid-cols-3">
            <div>
                <h1 class="text-2xl font-semibold text-gray-900">Partisipan Acara</h1>
                <h2 class="text-lg font-medium">Jumlah Pendaftar: {{ $event->participants()->count() }}</h2>
                <a class="text-pink-500 hover:font-medium hover:underline"
                    href="{{ route('organization.events.participants.csv', ['event' => $event->id]) }}">Download Data
                    Partisipan</a>
            </div>
            <div>
                <h1 class="text-2xl font-semibold text-gray-900">Absensi Acara</h1>
                <h2 class="text-lg font-medium">Jumlah Absensi: {{ $event->attendees()->count() }}</h2>
                <a class="text-pink-500 hover:font-medium hover:underline"
                    href="{{ route('organization.events.attendees.csv', ['event' => $event->id]) }}">Download Data
                    Absensi</a>
            </div>
            <div>
                <h1 class="text-2xl font-semibold text-gray-900">Feedback Acara</h1>
                <h2 class="text-lg font-medium">Jumlah Feedback: {{ $event->feedbacks()->count() }}</h2>
                <a class="text-pink-500 hover:font-medium hover:underline"
                    href="{{ route('organization.events.feedbacks.csv', ['event' => $event->id]) }}">Download Data
                    Feedback</a>
            </div>
        </div>
    </section>
@endsection
