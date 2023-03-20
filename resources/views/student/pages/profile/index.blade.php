@extends('student.layouts.app')

@section('content')
    <div class="text-white mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        @if (session('success'))
            <div class="mb-4">
                @include('student.components.alerts.success')
            </div>
        @endif
        <h1 class="text-4xl font-bold">Profil Saya</h1>
        @if(!Auth::user()->student->verification)
        <div class="my-2 rounded-md bg-red-50 p-4">
            <div class="flex">
                <div class="flex-shrink-0">
                    <!-- Heroicon name: mini/x-circle -->
                    <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                        aria-hidden="true">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.28 7.22a.75.75 0 00-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 101.06 1.06L10 11.06l1.72 1.72a.75.75 0 101.06-1.06L11.06 10l1.72-1.72a.75.75 0 00-1.06-1.06L10 8.94 8.28 7.22z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-red-800">Anda belum verifikasi mahasiswa.</h3>
                    <div class="mt-4">
                        <div class="-mx-2 -my-1.5 flex">
                            <button type="button"
                                class="rounded-md bg-red-50 px-2 py-1.5 text-sm font-medium text-red-800 hover:bg-red-100 focus:outline-none focus:ring-2 focus:ring-red-600 focus:ring-offset-2 focus:ring-offset-red-50"><a href="{{ route('student.verify') }}">Verifikasi Sekarang</a></button>
                            <button type="button"
                                class="ml-3 rounded-md bg-red-50 px-2 py-1.5 text-sm font-medium text-red-800 hover:bg-red-100 focus:outline-none focus:ring-2 focus:ring-red-600 focus:ring-offset-2 focus:ring-offset-red-50">Tutup</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
        <div>
            <img class="mt-4 mx-auto rounded-md w-40 h-auto"
                src="{{ Auth::user()->student->image ? asset('storage/' . Auth::user()->student->image) : asset('img/placeholder.png') }}"
                alt="Foto Mahasiswa">
            <div class="mt-2 flex justify-center items-center text-pink-500  hover:underline hover:font-bold">
                <i class="fas fa-pencil"></i>
                <h2 class="ml-2 font-medium">Ubah Foto</h2>
            </div>
        </div>
        <dl class="mt-4 grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-2">
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
            @if(Auth::user()->student->verification)
            <div class="sm:col-span-1">
                <dt class="text-sm font-medium text-pink-500">Status Verifikasi</dt>
                <dd class="mt-1 text-sm text-white">{{ ucfirst(Auth::user()->student->verification->status) }}</dd>
            </div>
            @endif
        </dl>
    </div>
@endsection
