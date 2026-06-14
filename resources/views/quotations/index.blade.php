<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Daftar Quotation') }}
            </h2>
            <a href="{{ route('quotations.create') }}"
                class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700">
                Tambah Quotation
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <!-- Filter & Search -->
                    <div class="mb-6 flex flex-col md:flex-row gap-4 justify-between">
                        <form method="GET" action="{{ route('quotations.index') }}" class="flex gap-2 w-full md:w-1/2">
                            <x-text-input name="search" placeholder="Cari nomor atau customer..." class="w-full"
                                :value="request('search')" />
                            <x-primary-button>Cari</x-primary-button>
                        </form>
                        <div class="flex gap-2">
                            <a href="{{ route('quotations.index', ['status' => 'Draft']) }}"
                                class="px-3 py-1 bg-gray-100 text-gray-700 rounded text-sm hover:bg-gray-200">Draft</a>
                            <a href="{{ route('quotations.index', ['status' => 'Sent']) }}"
                                class="px-3 py-1 bg-blue-100 text-blue-700 rounded text-sm hover:bg-blue-200">Sent</a>
                            <a href="{{ route('quotations.index', ['status' => 'Approved']) }}"
                                class="px-3 py-1 bg-green-100 text-green-700 rounded text-sm hover:bg-green-200">Approved</a>
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        No. Quotation</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Customer</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Tanggal</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Total</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Status</th>
                                    <th
                                        class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($quotations as $quotation)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{ $quotation->quotation_no }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $quotation->customer->company_name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $quotation->quotation_date->format('d/m/Y') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-semibold">Rp
                                        {{ number_format($quotation->total, 0, ',', '.') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ 
                                                $quotation->status == 'Approved' ? 'bg-green-100 text-green-800' : 
                                                ($quotation->status == 'Sent' ? 'bg-blue-100 text-blue-800' : 
                                                ($quotation->status == 'Rejected' ? 'bg-red-100 text-red-800' : 'bg-gray-100 text-gray-800'))
                                            }}">
                                            {{ $quotation->status }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <div class="flex justify-end gap-2">
                                            <a href="{{ route('quotations.show', $quotation) }}"
                                                class="text-blue-600 hover:text-blue-900">Detail</a>
                                            <a href="{{ route('quotations.edit', $quotation) }}"
                                                class="text-yellow-600 hover:text-yellow-900">Edit</a>
                                            <form action="{{ route('quotations.destroy', $quotation) }}" method="POST"
                                                onsubmit="return confirm('Yakin ingin menghapus?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="text-red-600 hover:text-red-900">Hapus</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-4 text-center text-gray-500">Tidak ada data
                                        quotation.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $quotations->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>