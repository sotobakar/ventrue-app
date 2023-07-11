@extends('biroumum.layouts.guest')

@section('content')
<div class="bg-gray-900 flex min-h-full flex-col justify-center py-12 sm:px-6 lg:px-8">
  <div class="mb-4 sm:mx-auto sm:w-full sm:max-w-md">
    <img class="mx-auto h-auto w-64" src="{{ asset('img/logo.png')}}" alt="VENTRUE">
  </div>
  <p class="text-pink-600 uppercase font-bold text-center text-lg">Biro Umum</p>
  @if($errors->any())
  <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md rounded-md bg-red-50 p-4">
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
        <h3 class="text-sm font-medium text-red-800">Ada {{ $errors->count() }} kesalahan pada aplikasi.</h3>
        <div class="mt-2 text-sm text-red-700">
          <ul role="list" class="list-disc space-y-1 pl-5">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      </div>
    </div>
  </div>
  @endif

  <div class="mt-4 sm:mx-auto sm:w-full sm:max-w-md">
    <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
      <form class="space-y-6" action="{{ route('biroumum.login') }}" method="POST">
        @csrf
        <div>
          <label for="email" class="block text-sm font-medium text-gray-700">Alamat Email</label>
          <div class="mt-1">
            <input id="email" name="email" type="email" autocomplete="email" required
              class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus:border-pink-500 focus:outline-none focus:ring-pink-500 sm:text-sm">
          </div>
        </div>

        <div>
          <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
          <div class="mt-1">
            <input id="password" name="password" type="password" autocomplete="current-password" required
              class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus:border-pink-500 focus:outline-none focus:ring-pink-500 sm:text-sm">
          </div>
        </div>

        <div>
          <button type="submit"
            class="flex w-full justify-center rounded-md border border-transparent bg-pink-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-pink-700 focus:outline-none focus:ring-2 focus:ring-pink-500 focus:ring-offset-2">Masuk</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection