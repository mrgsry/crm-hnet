<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Detail Customer') }}: {{ $customer->company_name }}
            </h2>
            <div class="flex gap-2">
                <a href="{{ route('customers.edit', $customer) }}"
                    class="inline-flex items-center px-4 py-2 bg-yellow-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-700">
                    Edit
                </a>
                <a href="{{ route('customers.index') }}"
                    class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                    Kembali
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Customer Info Card -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4 border-b pb-2">Informasi Dasar</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Nama Perusahaan</p>
                            <p class="text-base text-gray-900">{{ $customer->company_name }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">PIC</p>
                            <p class="text-base text-gray-900">{{ $customer->pic_name ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Email</p>
                            <p class="text-base text-gray-900">{{ $customer->email ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Nomor WA</p>
                            <p class="text-base text-gray-900">{{ $customer->phone ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">NPWP</p>
                            <p class="text-base text-gray-900">{{ $customer->npwp ?? '-' }}</p>
                        </div>
                        <div class="md:col-span-2">
                            <p class="text-sm font-medium text-gray-500">Alamat</p>
                            <p class="text-base text-gray-900">{{ $customer->address ?? '-' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Quotations Section -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-semibold">Daftar Quotation</h3>
                            <a href="{{ route('quotations.create', ['customer_id' => $customer->id]) }}"
                                class="text-sm text-blue-600 hover:underline">Tambah Baru</a>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">No.
                                        </th>
                                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">
                                            Tanggal</th>
                                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">
                                            Total</th>
                                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">
                                            Status</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    @forelse($customer->quotations as $quotation)
                                    <tr>
                                        <td class="px-4 py-2 text-sm">{{ $quotation->quotation_no }}</td>
                                        <td class="px-4 py-2 text-sm">{{ $quotation->quotation_date }}</td>
                                        <td class="px-4 py-2 text-sm">Rp
                                            {{ number_format($quotation->total, 0, ',', '.') }}</td>
                                        <td class="px-4 py-2 text-sm">
                                            <span class="px-2 py-1 rounded text-xs {{ 
                                                $quotation->status == 'Approved' ? 'bg-green-100 text-green-800' : 
                                                ($quotation->status == 'Rejected' ? 'bg-red-100 text-red-800' : 'bg-gray-100 text-gray-800')
                                            }}">
                                                {{ $quotation->status }}
                                            </span>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="4" class="px-4 py-2 text-center text-sm text-gray-500">Tidak ada
                                            data.</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Invoices Section -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-semibold">Daftar Invoice</h3>
                            <a href="{{ route('invoices.create', ['customer_id' => $customer->id]) }}"
                                class="text-sm text-blue-600 hover:underline">Tambah Baru</a>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">No.
                                        </th>
                                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">
                                            Tanggal</th>
                                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">
                                            Total</th>
                                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">
                                            Status</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    @forelse($customer->invoices as $invoice)
                                    <tr>
                                        <td class="px-4 py-2 text-sm">{{ $invoice->invoice_no }}</td>
                                        <td class="px-4 py-2 text-sm">{{ $invoice->invoice_date }}</td>
                                        <td class="px-4 py-2 text-sm">Rp
                                            {{ number_format($invoice->total, 0, ',', '.') }}</td>
                                        <td class="px-4 py-2 text-sm">
                                            <span class="px-2 py-1 rounded text-xs {{ 
                                                $invoice->status == 'Paid' ? 'bg-green-100 text-green-800' : 
                                                ($invoice->status == 'Unpaid' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800')
                                            }}">
                                                {{ $invoice->status }}
                                            </span>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="4" class="px-4 py-2 text-center text-sm text-gray-500">Tidak ada
                                            data.</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>