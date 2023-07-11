@extends('biroumum.layouts.app')

@section('content')
    <h1 class="text-2xl font-semibold text-gray-900">Ubah Lokasi</h1>
    <form action="{{ route('biroumum.locations.update', ['location' => $location->id]) }}" method="POST"
        class="mt-8 grid grid-cols-1 gap-y-6 sm:grid-cols-2 sm:gap-x-8" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="sm:col-span-2">
            <label for="name" class="block text-sm font-medium text-gray-700">Nama Lokasi</label>
            <div class="mt-1">
                <input type="text" name="name" id="name" value="{{ $location->name }}"
                    class="block w-full rounded-md border border-gray-300 py-3 px-4 shadow-sm focus:border-pink-500 focus:ring-pink-500">
            </div>
        </div>
        <div class="sm:col-span-2">
            <button type="submit"
                class="inline-flex w-full items-center justify-center rounded-md border border-transparent bg-pink-600 px-6 py-3 text-base font-medium text-white shadow-sm hover:bg-pink-700 focus:outline-none focus:ring-2 focus:ring-pink-500 focus:ring-offset-2">Simpan
                Perubahan</button>
        </div>
    </form>
@endsection
