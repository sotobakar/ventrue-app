<div>
    <nav class="relative mx-auto flex max-w-7xl items-center justify-between px-4 sm:px-6" aria-label="Global">
        <div class="flex flex-1 items-center">
            <div class="flex w-full items-center justify-between md:w-auto">
                <a href="{{ route('student.home') }}">
                    <span class="sr-only">Ventrue</span>
                    <img class="h-8 w-auto sm:h-10" src="{{ asset('img/logo.png') }}" alt="">
                </a>
                <div class="-mr-2 flex items-center md:hidden">
                    <button @click="open = !open" type="button"
                        class="focus-ring-inset inline-flex items-center justify-center rounded-md bg-gray-800 p-2 text-gray-400 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-white"
                        aria-expanded="false">
                        <span class="sr-only">Open main menu</span>
                        <!-- Heroicon name: outline/bars-3 -->
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>
                    </button>
                </div>
            </div>
            <div class="hidden space-x-10 md:ml-10 md:flex">
                <a href="{{ route('student.home') }}" class="font-medium text-white hover:text-gray-300">Beranda</a>

                <a href="{{ route('student.events') }}" class="font-medium text-white hover:text-gray-300">Acara</a>

                <a href="{{ route('organization.login') }}"
                    class="font-medium text-white hover:text-gray-300">Ormawa</a>
            </div>
        </div>
        @if(!Auth::user())
        <div class="hidden md:flex">
            <a href="{{ route('student.login') }}"
                class="inline-flex items-center rounded-md border border-transparent bg-gray-600 px-4 py-2 text-sm font-medium text-white hover:bg-gray-700">Masuk</a>
        </div>
        @else
        <div x-data="{ open: false}" class="relative hidden md:block">
            <a @click="open = !open" href="#"
                class="hover:bg-gray-700 rounded-md px-4 py-2 text-sm font-medium text-white">{{
                Auth::user()->student->name }}</a>
            <div x-cloak x-transition x-show="open" @click.outside="open = false"
                class="absolute right-0 left-auto z-20 -ml-4 mt-3 w-screen max-w-md transform px-2 sm:px-0  lg:ml-0">
                <div class="overflow-hidden rounded-lg shadow-lg ring-1 ring-black ring-opacity-5">
                    <div class="relative grid gap-6 bg-white px-5 py-6 sm:gap-8 sm:p-8">
                        <a href="{{ route('student.profile') }}" class="-m-3 flex items-start rounded-lg p-3 hover:bg-gray-100">
                            <i class="self-center flex-shrink-0 far fa-user text-pink-600 text-2xl"></i>
                            <div class="ml-4">
                                <p class="text-base font-medium text-gray-900">Profil Saya</p>
                                <p class="mt-1 text-sm text-gray-500">Update informasi dan preferensi Anda.</p>
                            </div>
                        </a>

                        <a href="{{ route('student.my_events') }}" class="-m-3 flex items-start rounded-lg p-3 hover:bg-gray-100">
                            <i class="self-center flex-shrink-0 far fa-calendar text-pink-600 text-2xl"></i>
                            <div class="ml-4">
                                <p class="text-base font-medium text-gray-900">Acara Saya</p>
                                <p class="mt-1 text-sm text-gray-500">Acara yang sedang dan sudah Anda ikuti.</p>
                            </div>
                        </a>

                        <a href="#" class="-m-3 flex items-start rounded-lg p-3 hover:bg-gray-100">
                            <i class="self-center flex-shrink-0 far fa-file-certificate text-pink-600 text-2xl"></i>
                            <div class="ml-4">
                                <p class="text-base font-medium text-gray-900">Sertifikat Saya</p>
                                <p class="mt-1 text-sm text-gray-500">Seluruh sertifikat acara yang diberikan oleh
                                    Ormawa.
                                </p>
                            </div>
                        </a>

                        <a href="{{ route('student.logout') }}"
                            class="-m-3 flex items-start rounded-lg p-3 hover:bg-gray-100">
                            <i class="self-center flex-shrink-0 far fa-sign-out text-pink-600 text-2xl"></i>
                            <div class="ml-4">
                                <p class="text-base font-medium text-gray-900">Keluar</p>
                                <p class="mt-1 text-sm text-gray-500">Log out dari akun Anda.</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endif
</div>
</nav>

<!--
    Mobile menu, show/hide based on menu open state.

    Entering: "duration-150 ease-out"
        From: "opacity-0 scale-95"
        To: "opacity-100 scale-100"
    Leaving: "duration-100 ease-in"
        From: "opacity-100 scale-100"
        To: "opacity-0 scale-95"
    -->
<div x-show="open" @click.outside="open = false" x-cloak x-transition
    class="absolute inset-x-0 top-0 z-10 origin-top-right transform p-2 transition md:hidden">
    <div class="overflow-hidden rounded-lg bg-white shadow-md ring-1 ring-black ring-opacity-5">
        <div class="flex items-center justify-between px-5 pt-4">
            <div>
                <img class="bg-black h-8 w-auto" src="{{ asset('img/logo.png') }}" alt="Ventrue Logo">
            </div>
            <div class="-mr-2">
                <button @click="open = !open" type="button"
                    class="inline-flex items-center justify-center rounded-md bg-white p-2 text-gray-400 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500">
                    <span class="sr-only">Close menu</span>
                    <!-- Heroicon name: outline/x-mark -->
                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
        <div class="space-y-1 px-2 pt-2 pb-3">
            <a href="{{ route('student.home') }}"
                class="block rounded-md px-3 py-2 text-base font-medium text-gray-700 hover:bg-gray-100 hover:text-gray-900">Beranda</a>

            <a href="{{ route('student.events') }}"
                class="block rounded-md px-3 py-2 text-base font-medium text-gray-700 hover:bg-gray-100 hover:text-gray-900">Acara</a>

            <a href="{{ route('organization.login') }}"
                class="block rounded-md px-3 py-2 text-base font-medium text-gray-700 hover:bg-gray-100 hover:text-gray-900">Ormawa</a>
            @if(Auth::user())
            <div x-data="{ open: false}">
                <a @click="open = !open"
                    class="block rounded-md px-3 py-2 text-base font-medium text-gray-700 hover:bg-gray-100 hover:text-gray-900">{{
                    Auth::user()->student->name }}</a>
                <div x-show="open" x-transition>
                    <a href="{{ route('student.profile') }}"
                        class="block rounded-md px-3 py-2 text-base font-medium text-gray-700 hover:bg-gray-100 hover:text-gray-900">Profil Saya</a>

                    <a href="{{ route('student.my_events') }}"
                        class="block rounded-md px-3 py-2 text-base font-medium text-gray-700 hover:bg-gray-100 hover:text-gray-900">Acara
                        Saya</a>


                    <a
                        class="block rounded-md px-3 py-2 text-base font-medium text-gray-700 hover:bg-gray-100 hover:text-gray-900">Sertifikat
                        Saya</a>

                    <a href="{{ route('student.logout') }}"
                        class="block rounded-md px-3 py-2 text-base font-medium text-gray-700 hover:bg-gray-100 hover:text-gray-900">Keluar</a>
                </div>
            </div>
            @endif
        </div>
        @if(!Auth::user())
        <a href="{{ route('student.login') }}"
            class="block w-full bg-gray-50 px-5 py-3 text-center font-medium text-pink-600 hover:bg-gray-100">Masuk</a>
        @endif
    </div>
</div>
</div>