@extends('organization.layouts.app')

@section('content')
<h1 class="text-2xl font-semibold text-gray-900">Profile</h1>
<div class="overflow-hidden px-4 sm:px-6 lg:px-8">
    <div class="relative mx-auto max-w-xl">
        <div class="mt-12">
            <div class="mb-4">
                @include('organization.components.alerts.success')
                @include('organization.components.alerts.errors', ['activity' => 'update profile'])
            </div>
            <form action="{{ route('organization.profile') }}" method="POST" class="grid grid-cols-1 gap-y-6 sm:grid-cols-2 sm:gap-x-8"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="sm:col-span-2">
                    <img class="block mx-auto rounded-full" style="height: 200px; width: auto;" src="{{ $user->organization->image ? asset('storage/' . $user->organization->image) : asset('img/placeholder.png') }}" alt="Gambar tidak ada">
                </div>
                <div class="sm:col-span-2">
                    <label for="image" class="block text-sm font-medium text-gray-700">Upload Foto Profil</label>
                    <div class="mt-1">
                        <input type="file" name="image" id="image" autocomplete="given-name"
                            class="block w-full rounded-md border border-gray-300 py-3 px-4 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>
                </div>
                <div class="sm:col-span-2">
                    <label for="name" class="block text-sm font-medium text-gray-700">Nama</label>
                    <div class="mt-1">
                        <input type="text" name="name" id="name" autocomplete="given-name"
                            value="{{ $user->organization->name }}"
                            class="block w-full rounded-md border border-gray-300 py-3 px-4 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>
                </div>
                <div class="sm:col-span-2">
                    <label for="level" class="block text-sm font-medium text-gray-700">Tingkat Organisasi</label>
                    <div class="mt-1">
                        <select disabled id="level" name="level"
                            class="block w-full rounded-md border border-gray-300 py-3 px-4 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @foreach($levels as $level)
                            <option {{ $user->organization->level == $level ? 'selected' : '' }}>{{ $level }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="sm:col-span-2">
                    <label for="faculty_id" class="block text-sm font-medium text-gray-700">Fakultas</label>
                    <div class="mt-1">
                        <select disabled id="faculty_id" name="faculty_id"
                            class="block w-full rounded-md border border-gray-300 py-3 px-4 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @foreach($faculties as $faculty)
                            <option {{ $user->organization->faculty_id == $faculty->id ? 'selected' : '' }} value="{{ $faculty->id }}">{{ $faculty->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="sm:col-span-2">
                    <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                    <div class="mt-1">
                        <textarea id="description" name="description" rows="4"
                            class="block w-full rounded-md border border-gray-300 py-3 px-4 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ $user->organization->description }}</textarea>
                    </div>
                </div>
                <div class="sm:col-span-2">
                    <button type="submit"
                        class="inline-flex w-full items-center justify-center rounded-md border border-transparent bg-indigo-600 px-6 py-3 text-base font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Ubah</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection