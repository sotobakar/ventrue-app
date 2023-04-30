@extends('organization.layouts.app')

@section('content')
    <h1 class="text-2xl font-semibold text-gray-900">List Permohonan Persetujuan</h1>
    <div class="">
        <div class="mt-8 sm:flex sm:items-center">
            <div class="mt-4 sm:mt-0 sm:flex-none">
                <a href="{{ route('organization.approvals.create') }}"
                    class="inline-flex items-center justify-center rounded-md border border-transparent bg-pink-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-pink-700 focus:outline-none focus:ring-2 focus:ring-pink-500 focus:ring-offset-2 sm:w-auto">Buat
                    Permohonan</a>
            </div>
        </div>
        <div class="mt-8 flex flex-col">
            <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                    <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-300">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col"
                                        class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Acara
                                    </th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">ID
                                        Acara
                                    </th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                        Status Persetujuan
                                    </th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                        Waktu
                                        Persetujuan
                                    </th>
                                    <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                        <span class="sr-only">Detail</span>
                                    </th>
                                    <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                        <span class="sr-only">Ubah</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white">
                                @foreach ($approvals as $approval)
                                    <tr>
                                        <td
                                            class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-pink-600 hover:text-pink-500 sm:pl-6">
                                            <a
                                                href="{{ route('organization.events.detail', ['event' => $approval->event->id]) }}">{{ $approval->event->name }}</a>
                                        </td>
                                        <td
                                            class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">
                                            {{ $approval->event_id }}</td>
                                        <td @class([
                                            'whitespace-nowrap px-3 py-4 text-sm',
                                            'text-red-500' =>
                                                $approval->status == config('constants.EVENT.APPROVAL.STATUS.0'),
                                            'text-green-500' =>
                                                $approval->status == config('constants.EVENT.APPROVAL.STATUS.1'),
                                        ])
                                            class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                            {{ $approval->status }}
                                        </td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                            {{ $approval->approved_at ? \Carbon\Carbon::parse($approval->approved_at)->translatedFormat('l, j F Y H:i') : 'Belum' }}
                                        </td>
                                        <td
                                            class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                            <a href="{{ route('organization.approvals.detail', ['approval' => $approval->id]) }}"
                                                class="text-pink-600 hover:text-pink-900">Detail</a>
                                        </td>
                                        <td
                                            class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                            <form id="{{ 'send_approval_' . $approval->id }}" class="hidden"
                                                action="{{ route('organization.approvals.send', ['approval' => $approval->id]) }}"
                                                method="post">
                                                @csrf
                                            </form>
                                            <button {{ $approval->status == config('constants.EVENT.APPROVAL.STATUS.1') ? 'disabled' : '' }}
                                                form="{{ 'send_approval_' . $approval->id }}" type="submit"
                                                @class([
                                                    'text-pink-600 hover:text-pink-900' => $approval->status == config('constants.EVENT.APPROVAL.STATUS.0'),
                                                    'text-gray-300' => $approval->status == config('constants.EVENT.APPROVAL.STATUS.1'),
                                                ])>Kirim</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
