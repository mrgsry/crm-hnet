@php
$content = json_decode($page->content, true) ?? [];
$slug = $page->slug;
@endphp

<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Edit Konten') }}: {{ $page->title }}
            </h2>
            <a href="{{ route('cms.index') }}"
                class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600 transition text-sm">
                Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('cms.update', $page->slug) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-8">
                            <x-input-label for="title" :value="__('Judul Halaman')" />
                            <x-text-input id="title" name="title" type="text" class="block mt-1 w-full"
                                :value="old('title', $page->title)" required />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>

                        <div class="space-y-8">
                            {{-- Specific UI for Hero Banner --}}
                            @if($slug === 'hero-banner')
                            <div class="bg-gray-50 p-6 rounded-xl border">
                                <h3 class="font-bold text-lg mb-4">Informasi Utama</h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div class="md:col-span-2">
                                        <x-input-label :value="__('Subheading')" />
                                        <x-text-input name="subheading" type="text" class="block mt-1 w-full"
                                            :value="$content['subheading'] ?? ''" />
                                    </div>
                                    <div class="md:col-span-2">
                                        <x-input-label :value="__('Heading')" />
                                        <x-text-input name="heading" type="text" class="block mt-1 w-full"
                                            :value="$content['heading'] ?? ''" />
                                    </div>
                                    <div class="md:col-span-2">
                                        <x-input-label :value="__('Deskripsi')" />
                                        <textarea name="description" rows="3"
                                            class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full">{{ $content['description'] ?? '' }}</textarea>
                                    </div>
                                    <div>
                                        <x-input-label :value="__('Text Tombol Utama')" />
                                        <x-text-input name="button_primary_text" type="text" class="block mt-1 w-full"
                                            :value="$content['button_primary_text'] ?? ''" />
                                    </div>
                                    <div>
                                        <x-input-label :value="__('Link Tombol Utama')" />
                                        <x-text-input name="button_primary_link" type="text" class="block mt-1 w-full"
                                            :value="$content['button_primary_link'] ?? ''" />
                                    </div>
                                    <div>
                                        <x-input-label :value="__('Text Tombol Sekunder')" />
                                        <x-text-input name="button_secondary_text" type="text" class="block mt-1 w-full"
                                            :value="$content['button_secondary_text'] ?? ''" />
                                    </div>
                                    <div>
                                        <x-input-label :value="__('Link Tombol Sekunder')" />
                                        <x-text-input name="button_secondary_link" type="text" class="block mt-1 w-full"
                                            :value="$content['button_secondary_link'] ?? ''" />
                                    </div>
                                </div>
                            </div>

                            <div class="bg-gray-50 p-6 rounded-xl border">
                                <div class="flex justify-between items-center mb-4">
                                    <h3 class="font-bold text-lg">Slider Images</h3>
                                    <button type="button" onclick="addSlide()"
                                        class="px-3 py-1 bg-green-600 text-white text-xs rounded hover:bg-green-700">
                                        + Tambah Slide
                                    </button>
                                </div>
                                <div id="slides-container" class="space-y-4">
                                    @foreach($content['slides'] ?? [] as $index => $slide)
                                    <div class="p-4 bg-white border rounded-lg relative slide-row">
                                        <button type="button" onclick="this.parentElement.remove()"
                                            class="absolute top-2 right-2 text-red-500">
                                            <i class="fas fa-times-circle"></i>
                                        </button>
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                            <div>
                                                <x-input-label :value="__('Slide Image')" />
                                                @if(isset($slide['image']))
                                                <img src="{{ asset('storage/' . $slide['image']) }}"
                                                    class="h-20 mb-2 rounded">
                                                @endif
                                                <input type="file" name="slide_images[{{ $index }}]"
                                                    class="block w-full text-xs">
                                            </div>
                                            <div>
                                                <x-input-label :value="__('Overlay Color (RGBA)')" />
                                                <x-text-input name="slides[{{ $index }}][overlay]" type="text"
                                                    class="block mt-1 w-full"
                                                    :value="$slide['overlay'] ?? 'rgba(0,0,0,0.5)'" />
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>

                            {{-- UI for Sections with Items --}}
                            @elseif(in_array($slug, ['clients', 'services', 'packages', 'gallery']))
                            <div class="bg-gray-50 p-6 rounded-xl border">
                                <h3 class="font-bold text-lg mb-4">Header Section</h3>
                                <div class="grid grid-cols-1 gap-4">
                                    <div>
                                        <x-input-label :value="__('Heading Section')" />
                                        <x-text-input name="heading" type="text" class="block mt-1 w-full"
                                            :value="$content['heading'] ?? ''" />
                                    </div>
                                    @if($slug !== 'clients' && $slug !== 'gallery')
                                    <div>
                                        <x-input-label :value="__('Subheading / Deskripsi')" />
                                        <textarea name="subheading" rows="2"
                                            class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full">{{ $content['subheading'] ?? ($content['description'] ?? '') }}</textarea>
                                    </div>
                                    @endif
                                </div>
                            </div>

                            <div class="bg-gray-50 p-6 rounded-xl border">
                                <div class="flex justify-between items-center mb-4">
                                    <h3 class="font-bold text-lg">Daftar Item</h3>
                                    <button type="button" onclick="addItem()"
                                        class="px-3 py-1 bg-green-600 text-white text-xs rounded hover:bg-green-700">
                                        + Tambah Item
                                    </button>
                                </div>
                                <div id="items-container" class="space-y-4">
                                    @foreach($content['items'] ?? [] as $index => $item)
                                    <div class="p-4 bg-white border rounded-lg relative item-row">
                                        <button type="button" onclick="this.parentElement.remove()"
                                            class="absolute top-2 right-2 text-red-500">
                                            <i class="fas fa-times-circle"></i>
                                        </button>
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                            @foreach($item as $key => $value)
                                            @if($key === 'image')
                                            <div class="md:col-span-2">
                                                <x-input-label :value="__('Gambar')" />
                                                @if($value)
                                                <img src="{{ asset('storage/' . $value) }}" class="h-20 mb-2 rounded">
                                                @endif
                                                <input type="file" name="item_images[{{ $index }}]"
                                                    class="block w-full text-xs">
                                            </div>
                                            @elseif($key === 'features')
                                            <div class="md:col-span-2">
                                                <x-input-label :value="__('Fitur (Satu per baris)')" />
                                                <textarea name="items[{{ $index }}][{{ $key }}]" rows="4"
                                                    class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full">{{ is_array($value) ? implode("\n", $value) : $value }}</textarea>
                                            </div>
                                            @elseif($key === 'description')
                                            <div class="md:col-span-2">
                                                <x-input-label :value="__(ucwords($key))" />
                                                <textarea name="items[{{ $index }}][{{ $key }}]" rows="2"
                                                    class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full">{{ $value }}</textarea>
                                            </div>
                                            @else
                                            <div>
                                                <x-input-label :value="__(ucwords(str_replace('_', ' ', $key)))" />
                                                <x-text-input name="items[{{ $index }}][{{ $key }}]" type="text"
                                                    class="block mt-1 w-full" :value="$value" />
                                            </div>
                                            @endif
                                            @endforeach
                                        </div>
                                        <input type="hidden" name="items[{{ $index }}][_exists]" value="1">
                                    </div>
                                    @endforeach
                                </div>
                            </div>

                            {{-- UI for Contact Section --}}
                            @elseif($slug === 'contact')
                            <div class="bg-gray-50 p-6 rounded-xl border">
                                <h3 class="font-bold text-lg mb-4">Informasi Kontak</h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div class="md:col-span-2">
                                        <x-input-label :value="__('Heading')" />
                                        <x-text-input name="heading" type="text" class="block mt-1 w-full"
                                            :value="$content['heading'] ?? ''" />
                                    </div>
                                    <div class="md:col-span-2">
                                        <x-input-label :value="__('Deskripsi')" />
                                        <textarea name="description" rows="3"
                                            class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full">{{ $content['description'] ?? '' }}</textarea>
                                    </div>
                                    <div>
                                        <x-input-label :value="__('Email')" />
                                        <x-text-input name="email" type="email" class="block mt-1 w-full"
                                            :value="$content['email'] ?? ''" />
                                    </div>
                                    <div>
                                        <x-input-label :value="__('Telepon')" />
                                        <x-text-input name="phone" type="text" class="block mt-1 w-full"
                                            :value="$content['phone'] ?? ''" />
                                    </div>
                                    <div class="md:col-span-2">
                                        <x-input-label :value="__('Alamat')" />
                                        <x-text-input name="address" type="text" class="block mt-1 w-full"
                                            :value="$content['address'] ?? ''" />
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>

                        <div class="mt-8 flex items-center gap-4">
                            <x-primary-button>
                                {{ __('Simpan Perubahan') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
    function addItem() {
        const container = document.getElementById('items-container');
        const index = container.querySelectorAll('.item-row').length;
        const slug = '{{ $slug }}';
        let fields = '';

        if (slug === 'services') {
            fields = `
                <div class="md:col-span-2">
                    <x-input-label :value="__('Icon (FontAwesome class)')" />
                    <x-text-input name="items[${index}][icon]" type="text" class="block mt-1 w-full" value="fas fa-code" />
                </div>
                <div>
                    <x-input-label :value="__('Title')" />
                    <x-text-input name="items[${index}][title]" type="text" class="block mt-1 w-full" value="" />
                </div>
                <div class="md:col-span-2">
                    <x-input-label :value="__('Description')" />
                    <textarea name="items[${index}][description]" rows="2" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full"></textarea>
                </div>
            `;
        } else if (slug === 'clients') {
            fields = `
                <div class="md:col-span-2">
                    <x-input-label :value="__('Gambar Client')" />
                    <input type="file" name="item_images[${index}]" class="block w-full text-xs" required>
                </div>
                <div class="md:col-span-2">
                    <x-input-label :value="__('Nama Client (Alternatif)')" />
                    <x-text-input name="items[${index}][name]" type="text" class="block mt-1 w-full" value="" />
                </div>
            `;
        } else if (slug === 'gallery') {
            fields = `
                <div class="md:col-span-2">
                    <x-input-label :value="__('Gambar')" />
                    <input type="file" name="item_images[${index}]" class="block w-full text-xs" required>
                </div>
            `;
        } else if (slug === 'packages') {
            fields = `
                <div>
                    <x-input-label :value="__('Package Title')" />
                    <x-text-input name="items[${index}][title]" type="text" class="block mt-1 w-full" value="" />
                </div>
                <div>
                    <x-input-label :value="__('Popular? (1=Ya, 0=Tidak)')" />
                    <x-text-input name="items[${index}][is_popular]" type="text" class="block mt-1 w-full" value="0" />
                </div>
                <div class="md:col-span-2">
                    <x-input-label :value="__('Features (One per line)')" />
                    <textarea name="items[${index}][features]" rows="4" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full"></textarea>
                </div>
                <div>
                    <x-input-label :value="__('Button Text')" />
                    <x-text-input name="items[${index}][button_text]" type="text" class="block mt-1 w-full" value="Pilih Paket" />
                </div>
                <div>
                    <x-input-label :value="__('Button Link')" />
                    <x-text-input name="items[${index}][button_link]" type="text" class="block mt-1 w-full" value="#contact" />
                </div>
            `;
        }

        const row = document.createElement('div');
        row.className = 'p-4 bg-white border rounded-lg relative item-row';
        row.innerHTML = `
                <button type="button" onclick="this.parentElement.remove()" class="absolute top-2 right-2 text-red-500">
                    <i class="fas fa-times-circle"></i>
                </button>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    ${fields}
                </div>
                <input type="hidden" name="items[${index}][_exists]" value="1">
            `;
        container.appendChild(row);
    }

    function addSlide() {
        const container = document.getElementById('slides-container');
        const index = container.querySelectorAll('.slide-row').length;
        const row = document.createElement('div');
        row.className = 'p-4 bg-white border rounded-lg relative slide-row';
        row.innerHTML = `
                <button type="button" onclick="this.parentElement.remove()" class="absolute top-2 right-2 text-red-500">
                    <i class="fas fa-times-circle"></i>
                </button>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <x-input-label :value="__('Slide Image')" />
                        <input type="file" name="slide_images[${index}]" class="block w-full text-xs" required>
                    </div>
                    <div>
                        <x-input-label :value="__('Overlay Color (RGBA)')" />
                        <x-text-input name="slides[${index}][overlay]" type="text" class="block mt-1 w-full" value="rgba(0,0,0,0.5)" />
                    </div>
                </div>
            `;
        container.appendChild(row);
    }
    </script>
</x-app-layout>