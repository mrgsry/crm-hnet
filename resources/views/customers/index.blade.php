<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-8 leading-tight">
                {{ __('Customer Management') }}
            </h2>
            <a href="{{ route('customers.create') }}"
                class="inline-flex items-center px-4 py-2 bg-blue-5 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-7 focus:bg-blue-7 active:bg-blue-9 focus:outline-none focus:ring-2 focus:ring-indigo-5 focus:ring-offset-2 transition ease-in-out duration-150">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Tambah Customer
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
            <div class="mb-4 bg-green-1 border border-green-4 text-green-7 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
            @endif

            @if(session('error'))
            <div class="mb-4 bg-red-1 border border-red-4 text-red-7 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <!-- Search Form -->
                    <div class="mb-4">
                        <form method="GET" action="{{ route('customers.index') }}" class="flex gap-2">
                            <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Cari customer..."
                                class="flex-1 rounded-md border-gray-3 shadow-sm focus:border-indigo-5 focus:ring-indigo-5">
                            <button type="submit"
                                class="inline-flex items-center px-4 py-2 bg-gray-8 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-7 focus:bg-gray-7 active:bg-gray-9 focus:outline-none focus:ring-2 focus:ring-gray-5 focus:ring-offset-2 transition ease-in-out duration-150">
                                Cari
                            </button>
                            @if($search)
                            <a href="{{ route('customers.index') }}"
                                class="inline-flex items-center px-4 py-2 bg-gray-5 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-6 focus:bg-gray-6 active:bg-gray-7 focus:outline-none focus:ring-2 focus:ring-gray-4 focus:ring-offset-2 transition ease-in-out duration-150">
                                Reset
                            </a>
                            @endif
                        </form>
                    </div>

                    <!-- Table -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-2">
                            <thead class="bg-gray-5">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-7 uppercase tracking-wider">
                                        Nama Perusahaan</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-7 uppercase tracking-wider">
                                        PIC</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-7 uppercase tracking-wider">
                                        Email</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-7 uppercase tracking-wider">
                                        No. WhatsApp</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-7 uppercase tracking-wider">
                                        Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-2">
                                @forelse($customers as $customer)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-9">
                                        {{ $customer->company_name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-5">
                                        {{ $customer->pic_name ?? '-' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-5">
                                        {{ $customer->email ?? '-' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-5">
                                        {{ $customer->phone ?? '-' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex gap-2">
                                            <a href="{{ route('customers.show', $customer) }}"
                                                class="text-blue-6 hover:text-blue-9">Lihat</a>
                                            <a href="{{ route('customers.edit', $customer) }}"
                                                class="text-yellow-6 hover:text-yellow-9">Edit</a>
                                            <form method="POST" action="{{ route('customers.destroy', $customer) }}"
                                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus customer ini?');"
                                                class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-6 hover:text-red-9">Hapus</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-5">
                                        Tidak ada data customer.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if($customers->hasPages())
                    <div class="mt-4">
                        {{ $customers->links() }}
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>