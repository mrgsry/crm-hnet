<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Berita Acara') }}: {{ $beritaAcara->nomor }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('berita-acara.update', $beritaAcara) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="md:col-span-2">
                                <x-input-label for="customer_id" :value="__('Customer')" />
                                <select name="customer_id" id="customer_id"
                                    class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full"
                                    required>
                                    @foreach($customers as $customer)
                                    <option value="{{ $customer->id }}"
                                        {{ old('customer_id', $beritaAcara->customer_id) == $customer->id ? 'selected' : '' }}>
                                        {{ $customer->company_name }}
                                    </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('customer_id')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="nomor" :value="__('Nomor')" />
                                <x-text-input id="nomor" type="text" class="block mt-1 w-full bg-gray-100"
                                    :value="$beritaAcara->nomor" readonly />
                            </div>

                            <div>
                                <x-input-label for="tanggal" :value="__('Tanggal')" />
                                <x-text-input id="tanggal" name="tanggal" type="date" class="block mt-1 w-full"
                                    :value="old('tanggal', $beritaAcara->tanggal->format('Y-m-d'))" required />
                                <x-input-error :messages="$errors->get('tanggal')" class="mt-2" />
                            </div>

                            <div class="md:col-span-2">
                                <x-input-label for="jenis" :value="__('Jenis Berita Acara')" />
                                <select name="jenis" id="jenis"
                                    class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full"
                                    required>
                                    @php
                                    $jenisOptions = ['Serah Terima', 'Instalasi', 'Maintenance', 'Pekerjaan Selesai'];
                                    @endphp
                                    @foreach($jenisOptions as $jenis)
                                    <option value="{{ $jenis }}"
                                        {{ old('jenis', $beritaAcara->jenis) == $jenis ? 'selected' : '' }}>
                                        {{ $jenis }}
                                    </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('jenis')" class="mt-2" />
                            </div>

                            <div class="md:col-span-2">
                                <x-input-label for="isi" :value="__('Isi / Deskripsi Pekerjaan')" />
                                <textarea name="isi" id="isi" rows="10"
                                    class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full"
                                    required>{{ old('isi', $beritaAcara->isi) }}</textarea>
                                <x-input-error :messages="$errors->get('isi')" class="mt-2" />
                            </div>

                            <div class="md:col-span-2">
                                <x-input-label :value="__('Lampiran Bukti Pekerjaan (Foto) yang Ada')" />
                                @if($beritaAcara->attachments->count() > 0)
                                <div class="mt-2 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                    @foreach($beritaAcara->attachments as $attachment)
                                    <div class="border border-gray-300 rounded-md p-3 relative">
                                        <input type="hidden" name="existing_attachments[{{ $attachment->id }}][id]"
                                            value="{{ $attachment->id }}">
                                        <img src="{{ asset('storage/' . $attachment->file_path) }}"
                                            alt="{{ $attachment->caption }}"
                                            class="w-full h-48 object-cover rounded mb-2">
                                        <div class="mb-2">
                                            <label for="existing_caption_{{ $attachment->id }}"
                                                class="block text-sm font-medium text-gray-700 mb-1">Keterangan</label>
                                            <input type="text"
                                                name="existing_attachments[{{ $attachment->id }}][caption]"
                                                id="existing_caption_{{ $attachment->id }}"
                                                value="{{ old('existing_attachments.' . $attachment->id . '.caption', $attachment->caption) }}"
                                                placeholder="Contoh: Foto instalasi kabel"
                                                class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block w-full text-sm">
                                        </div>
                                        <label class="flex items-center">
                                            <input type="checkbox" name="delete_attachments[]"
                                                value="{{ $attachment->id }}"
                                                class="rounded border-gray-300 text-red-600 focus:ring-red-500">
                                            <span class="ml-2 text-sm text-red-600">Hapus foto ini</span>
                                        </label>
                                    </div>
                                    @endforeach
                                </div>
                                @else
                                <p class="text-sm text-gray-500 mt-2">Belum ada lampiran</p>
                                @endif
                            </div>

                            <div class="md:col-span-2">
                                <x-input-label for="attachments" :value="__('Tambah Lampiran Bukti Pekerjaan Baru')" />
                                <p class="text-sm text-gray-600 mb-2">Upload foto bukti pekerjaan baru beserta
                                    keterangan</p>
                                <div id="attachments-container">
                                    <div class="attachment-item mb-4 p-4 border border-gray-300 rounded-md">
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-1">Foto</label>
                                                <input type="file" name="attachments[]" accept="image/*"
                                                    class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block w-full">
                                            </div>
                                            <div>
                                                <label
                                                    class="block text-sm font-medium text-gray-700 mb-1">Keterangan</label>
                                                <input type="text" name="captions[]"
                                                    placeholder="Contoh: Foto instalasi kabel"
                                                    class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block w-full">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="button" id="add-attachment"
                                    class="mt-2 inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300">
                                    + Tambah Foto
                                </button>
                                <x-input-error :messages="$errors->get('attachments')" class="mt-2" />
                            </div>
                        </div>

                        <div class="mt-6 flex items-center gap-4">
                            <x-primary-button>
                                {{ __('Perbarui') }}
                            </x-primary-button>
                            <a href="{{ route('berita-acara.index') }}"
                                class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                                Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
    document.getElementById('add-attachment').addEventListener('click', function() {
        const container = document.getElementById('attachments-container');
        const newItem = document.createElement('div');
        newItem.className = 'attachment-item mb-4 p-4 border border-gray-300 rounded-md relative';
        newItem.innerHTML = `
                    <button type="button" class="remove-attachment absolute top-2 right-2 text-red-600 hover:text-red-800">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Foto</label>
                            <input type="file" name="attachments[]" accept="image/*"
                                class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block w-full">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Keterangan</label>
                            <input type="text" name="captions[]" placeholder="Contoh: Foto instalasi kabel"
                                class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block w-full">
                        </div>
                    </div>
                `;
        container.appendChild(newItem);
    });

    document.addEventListener('click', function(e) {
        if (e.target.closest('.remove-attachment')) {
            e.target.closest('.attachment-item').remove();
        }
    });
    </script>
</x-app-layout>