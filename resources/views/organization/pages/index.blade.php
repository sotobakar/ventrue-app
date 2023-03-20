@extends('organization.layouts.app')

@section('content')
<h1 class="text-2xl font-semibold text-gray-900">Dashboard</h1>
<div class="mt-8">
    <h2 class="text-lg font-medium leading-6 text-gray-900">Keseluruhan</h2>
    <div class="mt-2 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">
        <!-- Card -->

        <div class="overflow-hidden rounded-lg bg-white shadow">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <i class="fas fa-calendar text-gray-400"></i>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="truncate text-sm font-medium text-gray-500">Acara yang diselenggarakan</dt>
                            <dd>
                                <div class="text-lg font-medium text-gray-900">10 acara</div>
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-5 py-3">
                <div class="text-sm">
                    <a href="#" class="font-medium text-cyan-700 hover:text-cyan-900">Lihat semua</a>
                </div>
            </div>
        </div>

        <div class="overflow-hidden rounded-lg bg-white shadow">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <i class="fas fa-user-friends text-gray-400"></i>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="truncate text-sm font-medium text-gray-500">Jumlah peserta acara</dt>
                            <dd>
                                <div class="text-lg font-medium text-gray-900">500 orang</div>
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-5 py-3">
                <div class="text-sm">
                    <a href="#" class="font-medium text-cyan-700 hover:text-cyan-900">Lihat semua</a>
                </div>
            </div>
        </div>

        <div class="overflow-hidden rounded-lg bg-white shadow">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <i class="fas fa-user-friends text-gray-400"></i>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="truncate text-sm font-medium text-gray-500">Jumlah peserta acara</dt>
                            <dd>
                                <div class="text-lg font-medium text-gray-900">500 orang</div>
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-5 py-3">
                <div class="text-sm">
                    <a href="#" class="font-medium text-cyan-700 hover:text-cyan-900">Lihat semua</a>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection