@extends('organization.layouts.app')

@section('content')
    <h1 class="text-2xl font-semibold text-gray-900">Buat Permohonan Persetujuan</h1>
    <div class="overflow-hidden">
        <div class="relative mx-auto max-w-xl">
            <div class="mt-6">
                <form action="{{ route('organization.approvals') }}" method="POST"
                    class="mt-4 grid grid-cols-1 gap-y-6 sm:grid-cols-2 sm:gap-x-8" enctype="multipart/form-data">
                    @csrf
                    <div class="sm:col-span-2">
                        <label for="id" class="block text-sm font-medium leading-6 text-gray-900">Pilih Acara</label>
                        <select name="id"
                            class="mt-2 block w-full rounded-md border-0 py-1.5 pl-3 pr-10 text-gray-900 ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-pink-600 sm:text-sm sm:leading-6" required>
                                <option disabled selected>-- Pilih Acara --</option>
                            @foreach ($events as $event)
                                <option value="{{ $event->id }}">
                                    {{ 'ID ' . $event->id . ' - ' . $event->name . ' - ' . \Carbon\Carbon::parse($event->start)->translatedFormat('d F Y') }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="sm:col-span-2">
                        <label for="file_pendukung" class="block text-sm font-medium text-gray-700">File Pendukung</label>
                        <div class="mt-1">
                            <input type="file" name="file_pendukung[]" required multiple="multiple"
                                class="block w-full rounded-md border border-gray-300 py-3 px-4 shadow-sm focus:border-pink-500 focus:ring-pink-500" />
                        </div>
                    </div>
                    <div class="sm:col-span-2">
                        <button type="submit"
                            class="inline-flex w-full items-center justify-center rounded-md border border-transparent bg-pink-600 px-6 py-3 text-base font-medium text-white shadow-sm hover:bg-pink-700 focus:outline-none focus:ring-2 focus:ring-pink-500 focus:ring-offset-2">Buat
                            Permohonan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
@endpush
