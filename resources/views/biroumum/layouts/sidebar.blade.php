<!-- Static sidebar for desktop -->
<div class="hidden md:fixed md:inset-y-0 md:flex md:w-64 md:flex-col">
    <!-- Sidebar component, swap this element with another sidebar if you like -->
    <div class="flex min-h-0 flex-1 flex-col bg-gray-800">
        <div class="flex flex-1 flex-col overflow-y-auto pt-5 pb-4">
            <div class="flex flex-shrink-0 items-center px-4">
                <img class="h-8 w-auto" src="{{ asset('img/logo.png') }}" alt="Your Company">
            </div>
            <nav class="mt-5 flex-1 space-y-1 px-2">
                @foreach(config('constants.MENU.BIROUMUM') as $menu)
                <a href="{{ route($menu['route']) }}"
                    @php
                        $isActive = request()->is($menu['path']);
                    @endphp
                    @class([
                        "bg-gray-900 text-white" => $isActive,
                        "text-gray-300 hover:bg-gray-700 hover:text-white" => !$isActive,
                        "group flex items-center px-2 py-2 text-sm font-medium rounded-md"])>
                    <i @class(["far fa-fw text-lg text-center align-middle text-gray-400 group-hover:text-gray-300 mr-3 flex-shrink-0", $menu['icon']])></i>
                    {{ $menu['name'] }}
                </a>
                @endforeach
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