@extends('student.layouts.app')

@section('content')
    <div class="mx-auto max-w-7xl">
        <div class="px-2 mt-16 sm:mt-24 lg:col-span-6 lg:mt-0">
            <div class="mb-2 sm:mx-auto sm:w-full sm:max-w-md">
                @include('student.components.alerts.errors')
            </div>
            <div class="bg-white sm:mx-auto sm:w-full sm:max-w-md overflow-hidden rounded-lg">
                <div class="px-4 py-8 sm:px-10">
                    <div>
                        <p class="text-sm font-medium text-gray-700">Registrasi Mahasiswa</p>
                    </div>
                    <div class="mt-6">
                        <form action="{{ route('student.register') }}" method="POST" class="space-y-6">
                            @csrf
                            <div>
                                <label for="email" class="sr-only">Alamat email</label>
                                <input type="text" name="email" id="email" autocomplete="email" placeholder="Email"
                                    value="{{ old('email') }}" required
                                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500 sm:text-sm">
                            </div>

                            <div>
                                <label for="name" class="sr-only">Nama Lengkap</label>
                                <input type="text" name="name" id="name" autocomplete="name"
                                    placeholder="Nama Lengkap" required value="{{ old('name') }}"
                                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500 sm:text-sm">
                            </div>

                            <div>
                                <label for="phone" class="sr-only">Nomor Telepon</label>
                                <input type="text" name="phone" id="phone" autocomplete="phone"
                                    placeholder="Nomor Telepon (08xx)" required value="{{ old('phone') }}"
                                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500 sm:text-sm">
                            </div>

                            <div>
                                <label for="sid" class="sr-only">NIM</label>
                                <input type="text" name="sid" id="sid" autocomplete="sid"
                                    placeholder="Nomor Induk Mahasiswa (NIM)" required value="{{ old('sid') }}"
                                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500 sm:text-sm">
                            </div>

                            <div>
                                <label for="faculty_id" class="sr-only">Fakultas</label>
                                <select name="faculty_id" id="faculty_id" autocomplete="faculty_id" placeholder="Fakultas"
                                    required
                                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500 sm:text-sm">
                                    @foreach ($faculties as $faculty)
                                        <option value="{{ $faculty->id }}"
                                            {{ old('faculty_id') == $faculty->id ? 'selected' : '' }}>{{ $faculty->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label for="year" class="sr-only">Tahun Angkatan</label>
                                <input type="number" name="year" min="1900" max="2099" step="1"
                                    placeholder="Tahun Angkatan" required value="{{ old('year') }}"
                                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500 sm:text-sm">
                            </div>

                            <div>
                                <label for="password" class="sr-only">Password</label>
                                <input id="password" name="password" type="password" placeholder="Password"
                                    autocomplete="current-password" required
                                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500 sm:text-sm">
                            </div>

                            <div>
                                <label class="mt-2 text-center text-sm text-gray-600">
                                    Sudah punya akun?
                                    <a href="{{ route('student.login') }}"
                                        class="font-medium text-pink-600 hover:text-pink-500">Login</a>
                                </label>
                            </div>

                            <div>
                                <button type="submit"
                                    class="flex w-full justify-center rounded-md border border-transparent bg-pink-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-pink-700 focus:outline-none focus:ring-2 focus:ring-pink-500 focus:ring-offset-2">Daftar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection