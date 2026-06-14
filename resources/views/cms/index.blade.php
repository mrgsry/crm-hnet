<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('CMS Landing Page') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($pages as $page)
                        <div
                            class="border rounded-lg p-6 flex flex-col justify-between hover:shadow-md transition-shadow">
                            <div>
                                <h3 class="text-lg font-bold text-indigo-600 mb-2">{{ $page->title }}</h3>
                                <p class="text-sm text-gray-500 mb-4">Slug: {{ $page->slug }}</p>
                                <div class="text-sm text-gray-700 line-clamp-3 italic">
                                    {{ $page->slug === 'hero-banner' ? 'Slide & Headline Konten' : 
                                       ($page->slug === 'services' ? 'Daftar Layanan' : 
                                       ($page->slug === 'packages' ? 'Paket Harga' : 
                                       ($page->slug === 'contact' ? 'Informasi Kontak' : 'Klik edit untuk melihat detail.'))) }}
                                </div>
                            </div>
                            <div class="mt-6">
                                <a href="{{ route('cms.edit', $page->slug) }}"
                                    class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700">
                                    Edit Konten
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>