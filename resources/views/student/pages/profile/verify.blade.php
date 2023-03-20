@extends('student.layouts.app')

@section('content')
    <div class="text-white mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        @if (session('success'))
            <div class="mb-4">
                @include('student.components.alerts.success')
            </div>
        @endif
        <h1 class="text-4xl font-bold">Verifikasi Status Mahasiswa</h1>
        <h2 class="mt-2 text-2xl font-bold">Unggah Dokumen Verifikasi</h2>
        <p class="text-gray-300 text-sm">Silahkan unggah dokumen-dokumen wajib yang diperlukan untuk verifikasi status
            mahasiswa oleh admin.</p>
        <form class="space-y-4" action="{{ route('student.verify') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div>
                <div class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                    <div class="sm:col-span-6">
                        <label for="selfie" class="block text-sm font-medium text-pink-500">Foto Selfie dengan KTM</label>
                        <div class="mt-1 flex rounded-md shadow-sm">
                            <input type="file" name="selfie"
                                class="block w-full rounded-none rounded-r-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        </div>
                    </div>
                    <div class="sm:col-span-6">
                        <label for="student_card" class="block text-sm font-medium text-pink-500">Foto KTM</label>
                        <div class="mt-1 flex rounded-md shadow-sm">
                            <input type="file" name="student_card"
                                class="block w-full rounded-none rounded-r-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        </div>
                    </div>
                </div>
            </div>

            <div class="pt-3">
                <button type="submit"
                    class="inline-flex justify-center rounded-md border border-transparent bg-pink-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-pink-700 focus:outline-none focus:ring-2 focus:ring-pink-500 focus:ring-offset-2">Submit Permohonan</button>
            </div>
        </form>
        <h2 class="mt-4 text-2xl font-bold">Status Permohonan Verifikasi</h2>
        <p class="text-gray-300 text-sm">Silahkan unggah dokumen-dokumen wajib yang diperlukan untuk verifikasi status
            mahasiswa oleh admin.</p>
    </div>
@endsection
