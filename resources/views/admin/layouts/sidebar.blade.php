<!-- Static sidebar for desktop -->
<div class="hidden md:fixed md:inset-y-0 md:flex md:w-64 md:flex-col">
    <!-- Sidebar component, swap this element with another sidebar if you like -->
    <div class="flex min-h-0 flex-1 flex-col bg-gray-800">
        <div class="flex flex-1 flex-col overflow-y-auto pt-5 pb-4">
            <div class="flex flex-shrink-0 items-center px-4">
                <img class="h-8 w-auto" src="{{ asset('img/logo.png') }}" alt="Your Company">
            </div>
            <nav class="mt-5 flex-1 space-y-1 px-2">
                <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                <a href="{{ route('organization.dashboard') }}"
                    class="bg-gray-900 text-white group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                    <svg class="text-gray-300 mr-3 flex-shrink-0 h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                    </svg>
                    Dashboard
                </a>

                <a href="{{ route('admin.students') }}"
                    class="text-gray-300 hover:bg-gray-700 hover:text-white group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                    <i class="text-center far fa-users-class w-6 text-gray-400 group-hover:text-gray-300 mr-3 flex-shrink-0"></i>
                    Mahasiswa
                </a>

                <a href="{{ route('admin.organizations') }}"
                    class="text-gray-300 hover:bg-gray-700 hover:text-white group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                    <i class="text-center far fa-sitemap w-6 text-gray-400 group-hover:text-gray-300 mr-3 flex-shrink-0"></i>
                    Ormawa
                </a>

                <a href="{{ route('organization.events') }}"
                    class="text-gray-300 hover:bg-gray-700 hover:text-white group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                    <!-- Heroicon name: outline/calendar -->
                    <svg class="text-gray-400 group-hover:text-gray-300 mr-3 flex-shrink-0 h-6 w-6"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                    </svg>
                    Acara
                </a>

                <a href="{{ route('admin.content') }}"
                    class="text-gray-300 hover:bg-gray-700 hover:text-white group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                    <i
                        class="far fa-ad fa-fw text-lg text-center align-middle text-gray-400 group-hover:text-gray-300 mr-3 flex-shrink-0"></i>
                    Konten
                </a>

                <a href="{{ route('admin.approvers') }}"
                    class="text-gray-300 hover:bg-gray-700 hover:text-white group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                    <i
                        class="far fa-check fa-fw text-lg text-center align-middle text-gray-400 group-hover:text-gray-300 mr-3 flex-shrink-0"></i>
                    Penyetuju
                </a>

                <a href="{{ route('admin.logout') }}"
                    class="text-gray-300 hover:bg-gray-700 hover:text-white group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                    <i
                        class="far fa-sign-out fa-fw text-lg text-center align-middle text-gray-400 group-hover:text-gray-300 mr-3 flex-shrink-0"></i>
                    Logout
                </a>
            </nav>
        </div>
        <div class="flex flex-shrink-0 bg-gray-700 p-4">
            <div class="group block w-full flex-shrink-0">
                <div class="flex items-center">
                    <div>
                        <img class="inline-block h-9 w-9 rounded-full" src="{{ asset('img/placeholder.png') }}" alt="">
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-white">{{ Auth::user()->email }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>