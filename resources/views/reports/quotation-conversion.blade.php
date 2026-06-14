<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Quotation Conversion Report') }}
            </h2>
            <a href="{{ route('reports.index') }}" class="text-sm text-gray-600 hover:text-gray-900">
                &larr; Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="text-sm text-gray-500 uppercase font-bold">Total Quotation</div>
                    <div class="text-3xl font-bold text-gray-900">{{ $totalQuotations }}</div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="text-sm text-gray-500 uppercase font-bold">Approved</div>
                    <div class="text-3xl font-bold text-green-600">{{ $approvedQuotations }}</div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="text-sm text-gray-500 uppercase font-bold">Conversion Rate</div>
                    <div class="text-3xl font-bold text-blue-600">{{ number_format($conversionRate, 2) }}%</div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-bold mb-4">Breakdown Status Penawaran</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Status</th>
                                    <th
                                        class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Jumlah</th>
                                    <th
                                        class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Persentase</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($statusData as $data)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                {{ $data->status == 'Approved' ? 'bg-green-100 text-green-800' : '' }}
                                                {{ $data->status == 'Draft' ? 'bg-gray-100 text-gray-800' : '' }}
                                                {{ $data->status == 'Sent' ? 'bg-blue-100 text-blue-800' : '' }}
                                                {{ $data->status == 'Rejected' ? 'bg-red-100 text-red-800' : '' }}
                                            ">
                                            {{ $data->status }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-right text-gray-900">
                                        {{ $data->count }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-right text-gray-500">
                                        {{ number_format(($data->count / max($totalQuotations, 1)) * 100, 2) }}%
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3"
                                        class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-500">Belum ada
                                        data penawaran.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>