@extends('admin.layouts.app')

@section('content')
    <h1 class="text-2xl font-semibold text-gray-900">Edit Acara</h1>
    <div class="overflow-hidden">
        <div class="relative mx-auto max-w-xl">
            <div class="mt-6">
                <form action="{{ route('admin.events.update', ['event' => $event->id]) }}" method="POST"
                    class="grid grid-cols-1 gap-y-6 sm:grid-cols-2 sm:gap-x-8" enctype="multipart/form-data"
                    x-data="{ type: '{{ $event->type }}' }">
                    @csrf
                    @method('PUT')
                    <div x-data="imageViewer('{{ asset('storage/' . $event->banner) }}')" class="sm:col-span-2">
                        <!-- Show the image -->
                        <template x-if="imageUrl">
                            <img :src="imageUrl" class="mb-2 mx-auto object-cover rounded border border-gray-200"
                                style="width: 500px; height: 281px;">
                        </template>
                        <label for="banner" class="block text-sm font-medium text-gray-700">Upload Banner Acara</label>
                        <div class="mt-1">
                            <input type="file" accept="image/*" @change="fileChosen" name="banner"
                                id="banner"
                                class="block w-full rounded-md border border-gray-300 py-3 px-4 shadow-sm focus:border-pink-500 focus:ring-pink-500">
                        </div>
                    </div>
                    <div class="sm:col-span-2">
                        <label for="name" class="block text-sm font-medium text-gray-700">Nama Acara</label>
                        <div class="mt-1">
                            <input type="text" required name="name" id="name" autocomplete="given-name" value="{{ $event->name }}"
                                class="block w-full rounded-md border border-gray-300 py-3 px-4 shadow-sm focus:border-pink-500 focus:ring-pink-500">
                        </div>
                    </div>
                    <div class="sm:col-span-2">
                        <label for="type" class="block text-sm font-medium text-gray-700">Jenis Acara</label>
                        <div class="mt-1">
                            <select x-model="type" id="type" name="type"
                                class="block w-full rounded-md border border-gray-300 py-3 px-4 shadow-sm focus:border-pink-500 focus:ring-pink-500">
                                @foreach ($types as $type)
                                    <option value="{{ $type }}" <?= $event->type == $type ? 'selected' : '' ?> >{{ ucfirst($type) }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="sm:col-span-2">
                        <label for="event_category" class="block text-sm font-medium text-gray-700">Kategori Acara</label>
                        <div class="mt-1">
                            <select id="event_category" name="event_category"
                                class="block w-full rounded-md border border-gray-300 py-3 px-4 shadow-sm focus:border-pink-500 focus:ring-pink-500">
                                @foreach ($event_categories as $event_category)
                                    <option value="{{ $event_category->id }}" <?= $event->event_category->id == $event_category->id ? 'selected' : '' ?> >{{ ucfirst($event_category->name) }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="sm:col-span-2">
                        <label for="location" class="block text-sm font-medium text-gray-700">Lokasi</label>
                        <div class="mt-1">
                            <input type="text" required name="location" id="location" autocomplete="location" value="{{ $event->location }}"
                                class="block w-full rounded-md border border-gray-300 py-3 px-4 shadow-sm focus:border-pink-500 focus:ring-pink-500">
                        </div>
                    </div>
                    <div class="sm:col-span-2" x-show="type != 'offline'">
                        <label for="meeting_link" class="block text-sm font-medium text-gray-700">Meeting Link</label>
                        <div class="mt-1">
                            <input type="text" name="meeting_link" id="meeting_link" value="{{ $event->meeting_link }}"
                                class="block w-full rounded-md border border-gray-300 py-3 px-4 shadow-sm focus:border-pink-500 focus:ring-pink-500">
                        </div>
                    </div>
                    <div class="sm:col-span-2">
                        <label for="start" class="block text-sm font-medium text-gray-700">Waktu Mulai Acara</label>
                        <div class="mt-1">
                            <input type="datetime-local" required id="start" name="start" value="{{ $event->start }}"
                                class="block w-full rounded-md border border-gray-300 py-3 px-4 shadow-sm focus:border-pink-500 focus:ring-pink-500" />
                        </div>
                    </div>
                    <div class="sm:col-span-2">
                        <label for="end" class="block text-sm font-medium text-gray-700">Waktu Selesai Acara</label>
                        <div class="mt-1">
                            <input type="datetime-local" required id="end" name="end" value="{{ $event->end }}"
                                class="block w-full rounded-md border border-gray-300 py-3 px-4 shadow-sm focus:border-pink-500 focus:ring-pink-500" />
                        </div>
                    </div>
                    <div class="sm:col-span-2">
                        <label for="registration_start" class="block text-sm font-medium text-gray-700">Pendaftaran
                            Dibuka</label>
                        <div class="mt-1">
                            <input type="datetime-local" required id="registration_start" name="registration_start" value="{{ $event->registration_start }}"
                                class="block w-full rounded-md border border-gray-300 py-3 px-4 shadow-sm focus:border-pink-500 focus:ring-pink-500" />
                        </div>
                    </div>
                    <div class="sm:col-span-2">
                        <label for="registration_end" class="block text-sm font-medium text-gray-700">Pendaftaran
                            Ditutup</label>
                        <div class="mt-1">
                            <input type="datetime-local" required id="registration_end" name="registration_end" value="{{ $event->registration_end }}"
                                class="block w-full rounded-md border border-gray-300 py-3 px-4 shadow-sm focus:border-pink-500 focus:ring-pink-500" />
                        </div>
                    </div>

                    <div class="sm:col-span-2">
                        <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi (min. 50
                            karakter)</label>
                        <div class="mt-1">
                            <textarea id="description" name="description" rows="4" required minlength="50"
                                class="block w-full rounded-md border border-gray-300 py-3 px-4 shadow-sm focus:border-pink-500 focus:ring-pink-500">{{ $event->description }}</textarea>
                        </div>
                    </div>
                    <div class="sm:col-span-2">
                        <button type="submit"
                            class="inline-flex w-full items-center justify-center rounded-md border border-transparent bg-pink-600 px-6 py-3 text-base font-medium text-white shadow-sm hover:bg-pink-700 focus:outline-none focus:ring-2 focus:ring-pink-500 focus:ring-offset-2">Update
                            Acara</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
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
