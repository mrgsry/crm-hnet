<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Summary Reports') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Revenue Report -->
                <a href="{{ route('reports.revenue') }}"
                    class="block p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-50 transition-colors">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-green-100 text-green-600 mr-4">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">Revenue Report</h5>
                            <p class="font-normal text-gray-700">Laporan pendapatan bulanan berdasarkan invoice yang
                                telah dibayar.</p>
                        </div>
                    </div>
                </a>

                <!-- Quotation Conversion -->
                <a href="{{ route('reports.quotation-conversion') }}"
                    class="block p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-50 transition-colors">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-blue-100 text-blue-600 mr-4">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">Quotation Conversion</h5>
                            <p class="font-normal text-gray-700">Analisis konversi penawaran harga menjadi
                                proyek/invoice.</p>
                        </div>
                    </div>
                </a>

                <!-- Outstanding Invoice -->
                <a href="{{ route('reports.outstanding-invoice') }}"
                    class="block p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-50 transition-colors">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-red-100 text-red-600 mr-4">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">Outstanding Invoice</h5>
                            <p class="font-normal text-gray-700">Daftar invoice yang belum lunas atau masih menunggak.
                            </p>
                        </div>
                    </div>
                </a>

                <!-- Customer Growth -->
                <a href="{{ route('reports.customer-growth') }}"
                    class="block p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-50 transition-colors">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-indigo-100 text-indigo-600 mr-4">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">Customer Growth</h5>
                            <p class="font-normal text-gray-700">Statistik pertumbuhan jumlah customer baru setiap
                                bulan.</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>