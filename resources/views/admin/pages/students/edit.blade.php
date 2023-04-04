@extends('admin.layouts.app')

@section('content')
    <h1 class="text-2xl font-semibold text-gray-900">Ubah Mahasiswa</h1>
    <form action="{{ route('admin.students.update', ['student' => $student->id]) }}" method="POST"
        class="mt-8 grid grid-cols-1 gap-y-6 sm:grid-cols-2 sm:gap-x-8" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div x-data="imageViewer('{{ $student->image ? asset('storage/' . $student->image) : asset('img/placeholder.png') }}')" class="sm:col-span-2">
            <!-- Show the image -->
            <template x-if="imageUrl">
                <img :src="imageUrl" class="mb-2 mx-auto object-contain rounded border border-gray-200"
                    style="width: auto; height: 281px;">
            </template>
            <label for="image" class="block text-sm font-medium text-gray-700">Upload Foto Mahasiswa</label>
            <div class="mt-1">
                <input type="file" accept="image/*" @change="fileChosen" name="image" id="image"
                    class="block w-full rounded-md border border-gray-300 py-3 px-4 shadow-sm focus:border-pink-500 focus:ring-pink-500">
            </div>
        </div>
        <div class="sm:col-span-2">
            <label for="name" class="block text-sm font-medium text-gray-700">Nama Mahasiswa</label>
            <div class="mt-1">
                <input type="text" name="name" id="name" value="{{ $student->name }}"
                    class="block w-full rounded-md border border-gray-300 py-3 px-4 shadow-sm focus:border-pink-500 focus:ring-pink-500">
            </div>
        </div>
        <div class="sm:col-span-2">
            <label for="email" class="block text-sm font-medium text-gray-700">Email Mahasiswa</label>
            <div class="mt-1">
                <input type="text" name="email" value="{{ $student->user->email }}" id="email"
                    class="block w-full rounded-md border border-gray-300 py-3 px-4 shadow-sm focus:border-pink-500 focus:ring-pink-500">
            </div>
        </div>
        <div class="sm:col-span-2">
            <label for="sid" class="block text-sm font-medium text-gray-700">Nomor Induk Mahasiswa (NIM)</label>
            <div class="mt-1">
                <input type="text" name="sid" id="sid" value="{{ $student->sid }}"
                    class="block w-full rounded-md border border-gray-300 py-3 px-4 shadow-sm focus:border-pink-500 focus:ring-pink-500">
            </div>
        </div>
        <div class="sm:col-span-2">
            <label for="year" class="block text-sm font-medium text-gray-700">Tahun Angkatan</label>
            <div class="mt-1">
                <input type="text" name="year" id="year" value="{{ $student->year }}"
                    class="block w-full rounded-md border border-gray-300 py-3 px-4 shadow-sm focus:border-pink-500 focus:ring-pink-500">
            </div>
        </div>
        <div class="sm:col-span-2">
            <label for="phone" class="block text-sm font-medium text-gray-700">Nomor Telepon</label>
            <div class="mt-1">
                <input type="text" name="phone" id="phone" value="{{ $student->phone }}"
                    class="block w-full rounded-md border border-gray-300 py-3 px-4 shadow-sm focus:border-pink-500 focus:ring-pink-500">
            </div>
        </div>
        <div class="sm:col-span-2">
            <label for="faculty_id" class="block text-sm font-medium text-gray-700">Fakultas</label>
            <div class="mt-1">
                <select id="faculty_id" name="faculty_id"
                    class="block w-full rounded-md border border-gray-300 py-3 px-4 shadow-sm focus:border-pink-500 focus:ring-pink-500">
                    @foreach ($faculties as $faculty)
                        <option {{ $student->faculty_id == $faculty->id ? 'selected' : '' }} value="{{ $faculty->id }}">
                            {{ $faculty->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="sm:col-span-2">
            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
            <div class="mt-1">
                <input type="password" name="password" id="password" autocomplete="password"
                    class="block w-full rounded-md border border-gray-300 py-3 px-4 shadow-sm focus:border-pink-500 focus:ring-pink-500">
            </div>
        </div>
        <div class="sm:col-span-2">
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Ulangi Password</label>
            <div class="mt-1">
                <input type="password" name="password_confirmation" id="password_confirmation"
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
