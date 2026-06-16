<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-8 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 px-4 sm:px-6 lg:px-8">
        <div class="mx-auto">
            <!-- Summary Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-6 gap-4 mb-8">
                <!-- Total Customers -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border-l-4 border-blue-5">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-blue-5/10">
                                <svg class="w-6 h-6 text-blue-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z">
                                    </path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-5">Total Customer</p>
                                <p class="text-2xl font-bold text-gray-8">{{ number_format($totalCustomer ?? 0) }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Quotations -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border-l-4 border-blue-5">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-blue-5/10">
                                <svg class="w-6 h-6 text-blue-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                    </path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-5">Total Quotation</p>
                                <p class="text-2xl font-bold text-gray-8">{{ number_format($totalQuotation ?? 0) }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Invoices -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border-l-4 border-blue-5">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-blue-5/10">
                                <svg class="w-6 h-6 text-blue-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 14l6-6m-5.5.5h.01m4.99 5h.01M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16l3.5-2 3.5 2 3.5-2 3.5 2z">
                                    </path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-5">Total Invoice</p>
                                <p class="text-2xl font-bold text-gray-8">{{ number_format($totalInvoice ?? 0) }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Revenue -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border-l-4 border-green-5">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-green-5/10">
                                <svg class="w-6 h-6 text-green-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                    </path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-5">Total Revenue</p>
                                <p class="text-2xl font-bold text-gray-8">Rp
                                    {{ number_format($totalRevenue ?? 0, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Outstanding Invoice -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border-l-4 border-warning">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-warning/10">
                                <svg class="w-6 h-6 text-warning" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-5">Outstanding Invoice</p>
                                <p class="text-2xl font-bold text-gray-8 text-lg">Rp
                                    {{ number_format($outstandingInvoice ?? 0, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Email Sent -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border-l-4 border-purple-500">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-purple-100">
                                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                    </path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-5">Email Terkirim</p>
                                <p class="text-2xl font-bold text-gray-8">{{ number_format($totalEmailSent ?? 0) }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts Section -->
            <div class="grid grid-cols-1 lg:grid-cols-5 gap-4 mb-8">
                <!-- Bar Chart: Revenue per Month -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4 lg:col-span-2">
                    <h3 class="text-sm font-semibold text-gray-5 mb-4 text-center uppercase">Pendapatan per Bulan</h3>
                    <div class="relative h-[250px] w-full">
                        <canvas id="revenueChart"></canvas>
                    </div>
                </div>
                <!-- Donut Chart: Invoice Count per Customer -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">
                    <h3 class="text-sm font-semibold text-gray-5 mb-4 text-center uppercase">Top Customer</h3>
                    <div class="relative h-[250px] w-full">
                        <canvas id="customerInvoiceChart"></canvas>
                    </div>
                </div>
                <!-- Donut Chart: Aktivitas Landing Page -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">
                    <h3 class="text-sm font-semibold text-gray-5 mb-4 text-center uppercase">Activity Device</h3>
                    <div class="relative h-[250px] w-full">
                        <canvas id="landingActivityChart"></canvas>
                    </div>
                </div>
                <!-- Donut Chart: Visitor Source -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">
                    <h3 class="text-sm font-semibold text-gray-5 mb-4 text-center uppercase">Visitor Source</h3>
                    <div class="relative h-[250px] w-full">
                        <canvas id="visitorSourceChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Recent Activities -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Recent Quotations -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-semibold text-gray-8">Quotation Terbaru</h3>
                            <a href="{{ route('quotations.index') }}"
                                class="text-sm text-blue-5 hover:text-blue-7">Lihat Semua</a </div>

                            @if(isset($recentQuotations) && count($recentQuotations) > 0)
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-2">
                                    <thead class="bg-gray-5">
                                        <tr>
                                            <th
                                                class="px-4 py-3 text-left text-xs font-medium text-gray-7 uppercase tracking-wider">
                                                No</th>
                                            <th
                                                class="px-4 py-3 text-left text-xs font-medium text-gray-7 uppercase tracking-wider">
                                                Customer</th>
                                            <th
                                                class="px-4 py-3 text-left text-xs font-medium text-gray-7 uppercase tracking-wider">
                                                Total</th>
                                            <th
                                                class="px-4 py-3 text-left text-xs font-medium text-gray-7 uppercase tracking-wider">
                                                Status</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-2">
                                        @foreach($recentQuotations as $quotation)
                                        <tr>
                                            <td class="px-4 py-3 text-sm text-gray-9">{{ $quotation->quotation_no }}
                                            </td>
                                            <td class="px-4 py-3 text-sm text-gray-9">
                                                {{ $quotation->customer->company_name }}</td>
                                            <td class="px-4 py-3 text-sm text-gray-9">Rp
                                                {{ number_format($quotation->total, 0, ',', '.') }}</td>
                                            <td class="px-4 py-3 text-sm">
                                                <span class="px-2 py-1 text-xs rounded-full {{ 
                                                        $quotation->status === 'Approved' ? 'bg-green-1 text-green-7' : 
                                                        ($quotation->status === 'Rejected' ? 'bg-red-1 text-red-7' : 
                                                        ($quotation->status === 'Sent' ? 'bg-blue-1 text-blue-7' : 'bg-gray-1 text-gray-7')) 
                                                    }}">
                                                    {{ $quotation->status }}
                                                </span>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @else
                            <div class="text-center py-8 text-gray-5">
                                <p>Belum ada quotation</p>
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Recent Invoices -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-lg font-semibold text-gray-8">Invoice Terbaru</h3>
                                <a href="{{ route('invoices.index') }}"
                                    class="text-sm text-blue-5 hover:text-blue-7">Lihat
                                    Semua</a>
                            </div>

                            @if(isset($recentInvoices) && count($recentInvoices) > 0)
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th
                                                class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                No</th>
                                            <th
                                                class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Customer</th>
                                            <th
                                                class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Total</th>
                                            <th
                                                class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Status</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach($recentInvoices as $invoice)
                                        <tr>
                                            <td class="px-4 py-3 text-sm text-gray-900">{{ $invoice->invoice_no }}</td>
                                            <td class="px-4 py-3 text-sm text-gray-900">
                                                {{ $invoice->customer->company_name }}
                                            </td>
                                            <td class="px-4 py-3 text-sm text-gray-900">Rp
                                                {{ number_format($invoice->total, 0, ',', '.') }}</td>
                                            <td class="px-4 py-3 text-sm">
                                                <span class="px-2 py-1 text-xs rounded-full {{ 
                                                $invoice->status === 'Paid' ? 'bg-green-100 text-green-800' : 
                                                ($invoice->status === 'Partial' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') 
                                            }}">
                                                    {{ $invoice->status }}
                                                </span>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @else
                            <div class="text-center py-8 text-gray-500">
                                <p>Belum ada invoice</p>
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Email Sending Log Table -->

                </div>

                <!-- Quick Actions -->
                <div class="mt-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-8 mb-4">Aksi Cepat</h3>
                            <div class="flex flex-wrap gap-4">
                                <a href="{{ route('customers.create') }}"
                                    class="inline-flex items-center px-4 py-2 bg-blue-5 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-7 focus:bg-blue-7 active:bg-blue-9 focus:outline-none focus:ring-2 focus:ring-indigo-5 focus:ring-offset-2 transition ease-in-out duration-150">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 4v16m8-8H4"></path>
                                    </svg>
                                    Tambah Customer
                                </a>

                                <a href="{{ route('quotations.create') }}"
                                    class="inline-flex items-center px-4 py-2 bg-green-5 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-7 focus:bg-green-7 active:bg-green-9 focus:outline-none focus:ring-2 focus:ring-green-5 focus:ring-offset-2 transition ease-in-out duration-150">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 4v16m8-8H4"></path>
                                    </svg>
                                    Buat Quotation
                                </a>

                                <a href="{{ route('invoices.create') }}"
                                    class="inline-flex items-center px-4 py-2 bg-warning border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-7 focus:bg-yellow-7 active:bg-yellow-9 focus:outline-none focus:ring-2 focus:ring-indigo-5 focus:ring-offset-2 transition ease-in-out duration-150">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 4v16m8-8H4"></path>
                                    </svg>
                                    Buat Invoice
                                </a>

                                <a href="{{ route('berita-acara.create') }}"
                                    class="inline-flex items-center px-4 py-2 bg-gray-6 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-8 focus:bg-gray-8 active:bg-gray-9 focus:outline-none focus:ring-2 focus:ring-indigo-5 focus:ring-offset-2 transition ease-in-out duration-150">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 4v16m8-8H4"></path>
                                    </svg>
                                    Buat Berita Acara
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
        // Revenue Chart (Adjusted for smaller size)
        const revenueCtx = document.getElementById('revenueChart').getContext('2d');
        const revenueData = JSON.parse('{!! json_encode($revenueData) !!}');
        new Chart(revenueCtx, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
                datasets: [{
                    label: 'Pendapatan',
                    data: revenueData,
                    backgroundColor: 'rgba(59, 130, 246, 0.5)',
                    borderColor: 'rgba(59, 130, 246, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return 'Rp ' + value.toLocaleString('id-ID');
                            }
                        }
                    }
                }
            }
        });

        // Customer Invoice Chart (Donut Chart for Activity Monitoring)
        const customerCtx = document.getElementById('customerInvoiceChart').getContext('2d');
        const customerData = JSON.parse('{!! json_encode($customerInvoices) !!}');
        new Chart(customerCtx, {
            type: 'doughnut',
            data: {
                labels: customerData.map(item => item.customer ? item.customer.company_name : 'Unknown'),
                datasets: [{
                    data: customerData.map(item => item.count),
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.8)',
                        'rgba(54, 162, 235, 0.8)',
                        'rgba(255, 206, 86, 0.8)',
                        'rgba(75, 192, 192, 0.8)',
                        'rgba(153, 102, 255, 0.8)',
                        'rgba(255, 159, 64, 0.8)'
                    ],
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                    }
                }
            }
        });
        // Landing Activity Chart (Donut)
        const landingCtx = document.getElementById('landingActivityChart').getContext('2d');
        const landingData = JSON.parse('{!! json_encode($landingActivity) !!}');
        new Chart(landingCtx, {
            type: 'doughnut',
            data: {
                labels: landingData.map(item => item.label),
                datasets: [{
                    data: landingData.map(item => item.count),
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.8)',
                        'rgba(54, 162, 235, 0.8)',
                        'rgba(255, 206, 86, 0.8)',
                        'rgba(75, 192, 192, 0.8)',
                        'rgba(153, 102, 255, 0.8)',
                        'rgba(255, 159, 64, 0.8)'
                    ],
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                    }
                }
            }
        });

        // Visitor Source Chart (Donut)
        const sourceCtx = document.getElementById('visitorSourceChart').getContext('2d');
        const sourceData = JSON.parse('{!! json_encode($visitorSource) !!}');
        new Chart(sourceCtx, {
            type: 'doughnut',
            data: {
                labels: sourceData.map(item => item.label),
                datasets: [{
                    data: sourceData.map(item => item.count),
                    backgroundColor: [
                        'rgba(59, 130, 246, 0.8)',
                        'rgba(16, 185, 129, 0.8)',
                        'rgba(245, 158, 11, 0.8)',
                        'rgba(239, 68, 68, 0.8)'
                    ],
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                    }
                }
            }
        });
        </script>
</x-app-layout>