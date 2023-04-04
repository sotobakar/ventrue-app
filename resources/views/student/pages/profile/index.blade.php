@extends('student.layouts.app')

@section('content')
    <div class="text-white mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        @if (session('success'))
            <div class="mb-4">
                @include('student.components.alerts.success')
            </div>
        @endif
        <div class="flex flex-col lg:flex-row">
            <div class="lg:w-1/2">
                <div x-data="imageViewer('{{ Auth::user()->student->image ? asset('storage/' . Auth::user()->student->image) : asset('img/placeholder.png') }}')">
                    <template x-if="imageUrl">
                        <img class="mt-4 mx-auto rounded-md w-40 h-auto" :src="imageUrl" alt="Foto Mahasiswa">
                    </template>
                    <form class="flex flex-col items-center" action="{{ route('student.profile.update_image') }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mt-4">
                            <input required type="file" accept="image/*" @change="fileChosen" name="image" id="image"
                                class="rounded-md shadow-sm focus:border-pink-500 focus:ring-pink-500">
                        </div>
                        <button type="submit"
                            class="mt-4 rounded-md bg-pink-600 px-2.5 py-1.5 text-sm font-semibold text-white shadow-sm hover:bg-pink-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-pink-600">Ubah Foto</button>
                    </form>
                </div>
                <dl class="mt-4 lg:mt-8 grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-2">
                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-pink-500">Nama</dt>
                        <dd class="mt-1 text-sm text-white">{{ Auth::user()->student->name }}</dd>
                    </div>
                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-pink-500">Email</dt>
                        <dd class="mt-1 text-sm text-white">{{ Auth::user()->email }}</dd>
                    </div>
                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-pink-500">Nomor Induk Mahasiswa (NIM)</dt>
                        <dd class="mt-1 text-sm text-white">{{ Auth::user()->student->sid }}</dd>
                    </div>
                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-pink-500">Tahun Angkatan</dt>
                        <dd class="mt-1 text-sm text-white">{{ Auth::user()->student->year }}</dd>
                    </div>
                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-pink-500">Fakultas</dt>
                        <dd class="mt-1 text-sm text-white">{{ Auth::user()->student->faculty->name }}</dd>
                    </div>
                </dl>
            </div>
            <div class="mt-6 lg:mt-0 lg:w-1/2">
                <div>
                    <h3 class="text-xl font-semibold leading-6 text-pink-500">Keseluruhan</h3>
                    <dl class="mt-5 grid grid-cols-1 gap-5 sm:grid-cols-3">
                        <div class="overflow-hidden rounded-lg bg-white px-4 py-5 shadow sm:p-6">
                            <dt class="truncate text-sm font-medium text-gray-500">Acara Terdaftar</dt>
                            <dd class="mt-1 text-3xl font-semibold tracking-tight text-gray-900">
                                {{ $statistics['eventsRegistered'] }}</dd>
                        </div>

                        <div class="overflow-hidden rounded-lg bg-white px-4 py-5 shadow sm:p-6">
                            <dt class="truncate text-sm font-medium text-gray-500">Acara Hadir</dt>
                            <dd class="mt-1 text-3xl font-semibold tracking-tight text-gray-900">
                                {{ $statistics['eventsAttended'] }}</dd>
                        </div>

                        <div class="overflow-hidden rounded-lg bg-white px-4 py-5 shadow sm:p-6">
                            <dt class="truncate text-sm font-medium text-gray-500">Feedback Dikumpul</dt>
                            <dd class="mt-1 text-3xl font-semibold tracking-tight text-gray-900">
                                {{ $statistics['feedbacksSubmitted'] }}</dd>
                        </div>
                    </dl>
                </div>
                <div class="mt-4">
                    <h3 class="text-xl font-semibold leading-6 text-pink-500">Sejarah Kegiatan</h3>
                    @if (count($lastThreeEvents) > 0)
                        <div class="overflow-hidden mt-5 bg-white shadow sm:rounded-md">
                            <ul role="list" class="divide-y divide-gray-200">
                                @foreach ($lastThreeEvents as $event)
                                    <li>
                                        <a href="{{ route('student.my_events.detail', ['event' => $event->id]) }}"
                                            class="block hover:bg-gray-50">
                                            <div class="flex items-center px-4 py-4 sm:px-6">
                                                <div class="flex min-w-0 flex-1 items-center">
                                                    <div class="flex-shrink-0">
                                                        <img class="h-12 w-12 rounded-full"
                                                            src="{{ asset('storage/' . $event->banner) }}" alt="">
                                                    </div>
                                                    <div class="min-w-0 flex-1 px-4 md:grid md:grid-cols-2 md:gap-4">
                                                        <div>
                                                            <p class="truncate text-sm font-medium text-pink-600">
                                                                {{ $event->name }}
                                                            </p>
                                                            <p class="mt-2 flex items-center text-sm text-gray-500">
                                                                <i
                                                                    class="far fa-clock mr-1.5 h-5 w-5 text-xl flex-shrink-0 text-gray-400"></i>
                                                                <span
                                                                    class="truncate">{{ \Carbon\Carbon::parse($event->start)->translatedFormat('d F Y H:i') }}</span>
                                                            </p>
                                                        </div>
                                                        <div class="hidden md:block">
                                                            <div>
                                                                <p class="text-sm text-gray-900">
                                                                    Daftar pada
                                                                    {{ \Carbon\Carbon::parse($event->registered_at)->translatedFormat('d F Y') }}
                                                                </p>
                                                                <p class="mt-2 flex items-center text-sm text-gray-500">
                                                                    <i @class([
                                                                        'far fa-check text-green-400' =>
                                                                            $event->status == config('constants.EVENT.STATUS.2'),
                                                                        'far fa-spinner text-amber-400' =>
                                                                            $event->status == config('constants.EVENT.STATUS.1'),
                                                                        'far fa-hourglass-start text-red-400' =>
                                                                            $event->status == config('constants.EVENT.STATUS.0'),
                                                                        'mr-1.5 flex-shrink-0',
                                                                    ])></i>
                                                                    {{ $event->status }}
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div>
                                                    <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20"
                                                        fill="currentColor" aria-hidden="true">
                                                        <path fill-rule="evenodd"
                                                            d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @else
                        <div class="mt-5 flex flex-col items-center text-white">
                            <i class="far fa-empty-set text-7xl"></i>
                            <h3 class="mt-2">Belum ada kegiatan yang diikuti</h3>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function imageViewer(src = null) {
            return {
                imageUrl: src,

                fileChosen(event) {
                    this.fileToDataUrl(event, src => this.imageUrl = src)
                },

                fileToDataUrl(event, callback) {
                    if (!event.target.files.length) return

                    let file = event.target.files[0],
                        reader = new FileReader()

                    reader.readAsDataURL(file)
                    reader.onload = e => callback(e.target.result)
                },
            }
        }
    </script>
@endpush
