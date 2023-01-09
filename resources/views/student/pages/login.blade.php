@extends('student.layouts.app')

@section('content')
<div class="mx-auto max-w-7xl">
    <div class="px-2 mt-16 sm:mt-24 lg:col-span-6 lg:mt-0">
        @include('student.components.alerts.errors')
        <div class="bg-white sm:mx-auto sm:w-full sm:max-w-md overflow-hidden rounded-lg">
            <div class="px-4 py-8 sm:px-10">
                <div>
                    <p class="text-sm font-medium text-gray-700">Masuk dengan</p>

                    <div class="mt-4">
                        <a href="#"
                            class="inline-flex w-full justify-center rounded-md border border-gray-300 bg-white py-2 px-4 text-sm font-medium text-gray-500 shadow-sm hover:bg-gray-50">
                            <span class="sr-only">Masuk dengan</span>
                            <i class="fab fa-google text-lg"></i>
                        </a>
                    </div>
                </div>

                <div class="relative mt-6">
                    <div class="absolute inset-0 flex items-center" aria-hidden="true">
                        <div class="w-full border-t border-gray-300"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="bg-white px-2 text-gray-500">atau</span>
                    </div>
                </div>

                <div class="mt-6">
                    <form action="{{ route('student.login') }}" method="POST" class="space-y-6">
                        @csrf
                        <div>
                            <label for="email" class="sr-only">Alamat email</label>
                            <input type="text" name="email" id="email" autocomplete="email" placeholder="Email" required
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
                                Belum punya akun?
                                <a href="{{ route('student.register') }}" class="font-medium text-pink-600 hover:text-pink-500">Daftar disini.</a>
                            </label>
                        </div>

                        <div>
                            <button type="submit"
                                class="flex w-full justify-center rounded-md border border-transparent bg-pink-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-pink-700 focus:outline-none focus:ring-2 focus:ring-pink-500 focus:ring-offset-2">Masuk</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection