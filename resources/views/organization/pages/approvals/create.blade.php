@extends('organization.layouts.app')

@section('content')
<h1 class="text-2xl font-semibold text-gray-900">Buat Pengajuan</h1>
<div class="overflow-hidden">
    <div class="relative mx-auto max-w-xl">
        <div class="mt-6">
            <div class="mb-4">
                @include('organization.components.alerts.success')
                @include('organization.components.alerts.errors')
            </div>
            <form action="{{ route('organization.approvals.create') }}" method="GET">
                <div class="sm:col-span-2">
                    <label for="id" class="block text-sm font-medium text-gray-700">Masukkan ID Acara</label>
                    <div class="mt-1 flex">
                        <input type="text" required name="id"
                            class="block w-full rounded-md border border-gray-300 py-1 px-2 shadow-sm focus:border-pink-500 focus:ring-pink-500">
                            <button type="submit" class="ml-2 rounded bg-pink-600 py-1 px-2 text-sm font-semibold text-white shadow-sm hover:bg-pink-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-pink-600">Cari</button>
                    </div>
                </div>
            </form>
            <form action="{{ route('organization.approvals') }}" method="POST"
                class="mt-4 grid grid-cols-1 gap-y-6 sm:grid-cols-2 sm:gap-x-8" enctype="multipart/form-data">
                @csrf
                @isset($event)
                <div class="sm:col-span-2">
                    <label for="name" class="block text-sm font-medium text-gray-700">Acara</label>
                    <div class="mt-1">
                        <input type="hidden" name="id" value="{{ $event->id }}">
                        <input type="text" required name="name"
                            value="{{ $event->name }} ({{ \Carbon\Carbon::parse($event->start)->translatedFormat('d F Y') }})"
                            class="block w-full rounded-md border border-gray-300 py-1 px-2 shadow-sm focus:border-pink-500 focus:ring-pink-500" readonly>
                    </div>
                </div>
                @endisset
                <div class="sm:col-span-2">
                    <label for="file_pendukung" class="block text-sm font-medium text-gray-700">File Pendukung</label>
                    <div class="mt-1">
                        <input type="file" name="file_pendukung[]" required multiple="multiple"
                            class="block w-full rounded-md border border-gray-300 py-3 px-4 shadow-sm focus:border-pink-500 focus:ring-pink-500"/>
                    </div>
                </div>
                <div class="sm:col-span-2">
                    <button type="submit"
                        class="inline-flex w-full items-center justify-center rounded-md border border-transparent bg-pink-600 px-6 py-3 text-base font-medium text-white shadow-sm hover:bg-pink-700 focus:outline-none focus:ring-2 focus:ring-pink-500 focus:ring-offset-2">Buat
                        Acara</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
@endpush