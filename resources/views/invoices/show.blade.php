<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Detail Invoice') }}: {{ $invoice->invoice_no }}
            </h2>
            <div class="flex gap-2">
                <a href="{{ route('invoices.index') }}"
                    class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                    Kembali
                </a>
                <a href="{{ route('invoices.edit', $invoice) }}"
                    class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700">
                    Edit
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Success/Error Messages -->
            @if(session('success'))
            <div id="successAlert"
                class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6"
                role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
                <button onclick="document.getElementById('successAlert').remove()"
                    class="absolute top-0 bottom-0 right-0 px-4 py-3">
                    <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20">
                        <path
                            d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
                    </svg>
                </button>
            </div>
            @endif

            @if(session('error'))
            <div id="errorAlert" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6"
                role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
                <button onclick="document.getElementById('errorAlert').remove()"
                    class="absolute top-0 bottom-0 right-0 px-4 py-3">
                    <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20">
                        <path
                            d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
                    </svg>
                </button>
            </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-8">
                    <!-- Invoice Header -->
                    <div class="flex justify-between mb-8">
                        <div>
                            <h1 class="text-3xl font-bold text-blue-600 mb-2">INVOICE</h1>
                            <p class="text-gray-600">Nomor: {{ $invoice->invoice_no }}</p>
                            @if($invoice->po_number)
                            <p class="text-gray-600">Nomor PO: {{ $invoice->po_number }}</p>
                            @endif

                            <p class="text-gray-600">Tanggal: {{ $invoice->invoice_date->format('d F Y') }}</p>
                            @if($invoice->due_date)
                            <p class="text-red-600 font-semibold">Jatuh Tempo: {{ $invoice->due_date->format('d F Y') }}
                            </p>
                            @endif
                        </div>
                        <div class="text-right">
                            <span @class([ 'px-4 py-2 inline-flex text-sm leading-5 font-bold rounded-full uppercase'
                                , 'bg-red-100 text-red-800'=> $invoice->status === 'Unpaid',
                                'bg-yellow-100 text-yellow-800' => $invoice->status === 'Partial',
                                'bg-green-100 text-green-800' => $invoice->status === 'Paid',
                                ])>
                                {{ $invoice->status }}
                            </span>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-8 mb-8">
                        <!-- Company Info -->
                        <div>
                            <h3 class="text-sm font-bold text-gray-400 uppercase tracking-widest mb-3">Dari</h3>
                            <p class="font-bold text-lg">HNET DIGITAL</p>
                            <p class="text-gray-600 text-sm">Penyedia layanan pembuatan Aplikasi Perusahaan, NAS,
                                pemasangan jaringan LAN, CCTV, Data Center dll.</p>
                            <p class="text-gray-600 text-sm">Email: muhamadhabib.work@gmail.com</p>
                        </div>
                        <!-- Customer Info -->
                        <div>
                            <h3 class="text-sm font-bold text-gray-400 uppercase tracking-widest mb-3">Ditujukan Kepada
                            </h3>
                            <p class="font-bold text-lg">{{ $invoice->customer->company_name }}</p>
                            <p class="text-gray-600 text-sm">{{ $invoice->customer->pic_name }}</p>
                            <p class="text-gray-600 text-sm">{{ $invoice->customer->address }}</p>
                            <p class="text-gray-600 text-sm">Email: {{ $invoice->customer->email }}</p>
                        </div>
                    </div>

                    <!-- Items Table -->
                    <div class="mb-8">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead>
                                <tr class="bg-gray-50">
                                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase w-32">
                                        Kode Barang</th>
                                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">
                                        Deskripsi</th>
                                    <th class="px-6 py-3 text-center text-xs font-bold text-gray-500 uppercase w-24">Qty
                                    </th>
                                    <th class="px-6 py-3 text-right text-xs font-bold text-gray-500 uppercase w-40">
                                        Harga</th>
                                    <th class="px-6 py-3 text-right text-xs font-bold text-gray-500 uppercase w-48">
                                        Total</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach($invoice->items as $item)
                                <tr>
                                    <td class="px-6 py-4 text-sm text-gray-900">{{ $item->item_code ?? '' }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-900">{{ $item->description }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-600 text-center">{{ $item->qty }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-600 text-right">
                                        {{ number_format($item->price, 0, ',', '.') }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-900 font-semibold text-right">
                                        {{ number_format($item->total, 0, ',', '.') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot class="bg-gray-50">
                                <tr>
                                    <td colspan="3" class="px-6 py-3 text-right text-sm font-bold text-gray-600">
                                        SUBTOTAL</td>
                                    <td class="px-6 py-3 text-right text-sm font-bold text-gray-900">
                                        {{ number_format($invoice->subtotal, 0, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <td colspan="3" class="px-6 py-3 text-right text-sm font-bold text-gray-600">PPN
                                        (11%)</td>
                                    <td class="px-6 py-3 text-right text-sm font-bold text-gray-900">
                                        {{ number_format($invoice->tax, 0, ',', '.') }}</td>
                                </tr>
                                <tr class="bg-blue-50">
                                    <td colspan="3"
                                        class="px-6 py-4 text-right text-base font-black text-blue-800 uppercase">Total
                                        Tagihan</td>
                                    <td class="px-6 py-4 text-right text-xl font-black text-blue-600">IDR
                                        {{ number_format($invoice->total, 0, ',', '.') }}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <!-- Footer / Signature -->
                    <div class="flex justify-end mt-12">
                        <div class="text-center w-64">
                            <p class="text-gray-600 mb-20">Hormat Kami,</p>
                            <p class="font-bold border-b border-gray-400 pb-1">Admin HNET DIGITAL</p>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="mt-12 pt-8 border-t flex gap-4 justify-center no-print">
                        <a href="{{ route('invoices.printPdf', $invoice) }}" target="_blank"
                            class="px-6 py-2 bg-blue-600 text-white font-bold rounded shadow hover:bg-blue-700 inline-flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10">
                                </path>
                            </svg>
                            Export PDF
                        </a>

                        <button type="button" onclick="openEmailModal()"
                            class="px-6 py-2 bg-green-600 text-white font-bold rounded shadow hover:bg-green-700 inline-flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                </path>
                            </svg>
                            Kirim Email
                        </button>

                        <form action="{{ route('invoices.sendWhatsApp', $invoice) }}" method="POST">
                            @csrf
                            <button type="submit"
                                class="px-6 py-2 bg-[#25D366] text-white font-bold rounded shadow hover:bg-[#128C7E] inline-flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.588-5.946 0-6.556 5.332-11.888 11.888-11.888 3.176 0 6.161 1.237 8.404 3.48s3.481 5.229 3.481 8.404c0 6.556-5.332 11.888-11.888 11.888-2.003 0-3.963-.505-5.705-1.465l-6.379 1.688zm6.114-3.814c1.554.921 3.41 1.408 5.274 1.408 5.645 0 10.243-4.598 10.243-10.243 0-2.733-1.064-5.303-2.997-7.235s-4.502-2.997-7.235-2.997c-5.645 0-10.24 4.598-10.24 10.243 0 1.902.525 3.753 1.517 5.36l-.991 3.621 3.729-.987zm11.332-6.843c-.302-.151-1.785-.881-2.057-.981-.272-.1-.469-.151-.667.151-.198.302-.766.981-.939 1.182-.172.201-.345.227-.647.076-.302-.151-1.276-.47-2.431-1.499-.899-.801-1.505-1.791-1.682-2.093-.177-.302-.019-.465.132-.615.136-.135.302-.352.453-.529.151-.176.201-.302.302-.503.101-.201.05-.378-.025-.529-.076-.151-.667-1.611-.913-2.206-.24-.579-.485-.5-.667-.509-.172-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.076.149.201 2.095 3.198 5.074 4.487.708.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.785-.73 2.039-1.436.255-.706.255-1.31.179-1.436-.076-.126-.272-.202-.573-.353z" />
                                </svg>
                                Kirim WhatsApp
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Email Modal -->
        <div id="emailModal" class="hidden fixed inset-0 overflow-y-auto h-full w-full z-50">
            <!-- Blurred overlay background -->
            <div class="fixed inset-0 bg-black/10 backdrop-blur-sm transition-opacity" aria-hidden="true"
                onclick="closeEmailModal()"></div>

            <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
                <div class="flex justify-between items-center border-b pb-3 mb-4">
                    <h3 class="text-lg font-semibold text-gray-900">Kirim Email Invoice {{ $invoice->invoice_no }}</h3>
                    <button onclick="closeEmailModal()" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12">
                            </path>
                        </svg>
                    </button>
                </div>
                <form action="{{ route('invoices.email', $invoice) }}" method="POST">
                    @csrf
                    <div class="space-y-4">
                        <div>
                            <label for="email_to" class="block text-sm font-medium text-gray-700 mb-1">Tujuan (To)
                                *</label>
                            <input type="email" id="email_to" name="to" value="{{ $invoice->customer->email }}" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label for="email_cc" class="block text-sm font-medium text-gray-700 mb-1">CC</label>
                            <input type="email" id="email_cc" name="cc" value=""
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label for="email_subject" class="block text-sm font-medium text-gray-700 mb-1">Subject
                                *</label>
                            <input type="text" id="email_subject" name="subject"
                                value="Invoice Tagihan {{ $invoice->invoice_no }}" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label for="email_body" class="block text-sm font-medium text-gray-700 mb-1">Isi Pesan
                                *</label>
                            <textarea id="email_body" name="body" rows="6" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">Kepada Yth. {{ $invoice->customer->pic_name }},

Terlampir invoice tagihan dari kami.

Hormat kami,
Muhamad Habib</textarea>
                        </div>
                    </div>
                    <div class="flex justify-end gap-2 mt-6">
                        <button type="button" onclick="closeEmailModal()"
                            class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 font-semibold text-sm">
                            Batal
                        </button>
                        <button type="submit"
                            class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 font-semibold text-sm">
                            Kirim Email
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <script>
        function openEmailModal() {
            document.getElementById('emailModal').classList.remove('hidden');
        }

        function closeEmailModal() {
            document.getElementById('emailModal').classList.add('hidden');
        }

        // Close modal when clicking outside
        document.getElementById('emailModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeEmailModal();
            }
        });
        </script>
</x-app-layout>