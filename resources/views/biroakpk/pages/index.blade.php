@extends('biroakpk.layouts.app')

@section('content')
    <div class="flex flex-col gap-y-4">
        <div>
            <h1 class="text-center text-4xl font-bold text-gray-900">Statistik</h1>
            <form class="mt-4 flex flex-col items-center" action="{{ route('biroakpk.dashboard') }}" method="GET">
                <div>
                    <label for="timeframe" class="block text-center text-sm font-medium leading-6 text-gray-900">Filter
                        Waktu</label>
                    <select onchange="this.form.submit()" name="timeframe"
                        class="mt-2 block w-full rounded-md border-0 py-1.5 pl-3 pr-10 text-gray-900 ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-pink-600 sm:text-sm sm:leading-6">
                        <option <?= request()->query('timeframe') == 'week' ? 'selected' : '' ?> value="week">Seminggu
                            Terakhir</option>
                        <option <?= request()->query('timeframe') == 'month' ? 'selected' : '' ?> value="month">Sebulan
                            Terakhir</option>
                        <option <?= request()->query('timeframe') == null ? 'selected' : '' ?> value="">Seluruhnya
                        </option>
                    </select>
                </div>
            </form>
        </div>
        <div class="mt-2 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($statistics as $statistic)
                <div class="overflow-hidden rounded-lg bg-white shadow">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <i @class(['fas fa-calendar text-gray-400', $statistic['icon']])></i>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="truncate text-sm font-medium text-gray-500">{{ $statistic['name'] }}</dt>
                                    <dd>
                                        <div class="text-lg font-medium text-gray-900">{{ $statistic['value'] }}</div>
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-5 py-3">
                        @if (isset($statistic['link']))
                            <div class="text-sm">
                                <a href="{{ $statistic['link'] }}"
                                    class="font-medium text-cyan-700 hover:text-cyan-900">Lihat semua</a>
                            </div>
                        @else
                            <div class="text-sm select-none">
                                <a class="font-medium text-gray-500">Lihat semua</a>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
