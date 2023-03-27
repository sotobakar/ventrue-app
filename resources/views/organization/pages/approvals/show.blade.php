@extends('organization.layouts.app')

@section('content')
    <h1 class="text-2xl font-semibold text-gray-900">Detail Pengajuan Persetujuan</h1>
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
                        <h3 class="text-lg font-medium leading-6 text-gray-900">Waktu Mulai</h3>
                        <p class="mt-1 text-sm text-gray-500">{{ \Carbon\Carbon::parse($event->start)->translatedFormat("d F Y H:i") }}</p>
                    </div>
                    <div>
                        <h3 class="text-lg font-medium leading-6 text-gray-900">Status Pengajuan</h3>
                        <p class="mt-1 text-sm text-gray-500">{{ $approval->status }}</p>
                    </div>
                    <div>
                        <h3 class="text-lg font-medium leading-6 text-gray-900">Email Penyetuju</h3>
                        <p class="mt-1 text-sm text-gray-500">{{ $approver->email }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-4">
            <h1 class="font-bold text-lg">Daftar File Pendukung</h1>
            @if ($approval->files->count() > 0)
                <div class="overflow-x-auto">
                    <div class="inline-block min-w-full py-2 align-middle">
                        <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-300">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col"
                                            class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                                            Nama File</th>
                                        <th scope="col"
                                            class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                            Download
                                            File</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 bg-white">
                                    @foreach ($approval->files as $file)
                                        <tr>
                                            <td
                                                class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">
                                                {{ $file->name }}</td>
                                            <td class="whitespace-nowrap px-3 py-4 text-sm text-pink-500"><a
                                                    href="{{ asset('storage/' . $file->path) }}">Link</a></td>
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
                    <h2>Belum ada file</h2>
                </div>
            @endif
        </div>
    </div>
@endsection

@push('scripts')
@endpush
