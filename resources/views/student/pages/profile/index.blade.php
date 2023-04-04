@extends('student.layouts.app')

@section('content')
    <div class="text-white mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        @if (session('success'))
            <div class="mb-4">
                @include('student.components.alerts.success')
            </div>
        @endif
        <h1 class="text-4xl font-bold">Profil Saya</h1>
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
        </dl>
    </div>
@endsection
