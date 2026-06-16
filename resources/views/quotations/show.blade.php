<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Detail Quotation') }}: {{ $quotation->quotation_no }}
            </h2>
            <div class="flex gap-2">
                <a href="{{ route('quotations.edit', $quotation) }}"
                    class="inline-flex items-center px-4 py-2 bg-yellow-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-600">
                    Edit
                </a>
                <form action="{{ route('quotations.destroy', $quotation) }}" method="POST"
                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus quotation ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700">
                        Hapus
                    </button>
                </form>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Success/Error Messages -->
            @if(session('success'))
            <div id="successAlert"
                class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
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
            <div id="errorAlert" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative"
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

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Main Info Card -->
                <div class="lg:col-span-2 space-y-6">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <div class="flex justify-between items-start border-b pb-4 mb-4">
                                <div>
                                    <h3 class="text-lg font-bold text-gray-800">{{ $quotation->quotation_no }}</h3>
                                    <p class="text-sm text-gray-600">{{ $quotation->quotation_date->format('d M Y') }}
                                    </p>
                                </div>
                                <div class="text-right">
                                    <span @class([ 'px-3 py-1 rounded-full text-xs font-semibold uppercase'
                                        , 'bg-gray-100 text-gray-800'=> $quotation->status === 'Draft',
                                        'bg-blue-100 text-blue-800' => $quotation->status === 'Sent',
                                        'bg-green-100 text-green-800' => $quotation->status === 'Approved',
                                        'bg-red-100 text-red-800' => $quotation->status === 'Rejected',
                                        ])>
                                        {{ $quotation->status }}
                                    </span>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                                <div>
                                    <h4 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Customer
                                    </h4>
                                    <p class="font-semibold text-gray-900">{{ $quotation->customer->company_name }}</p>
                                    <p class="text-sm text-gray-600">{{ $quotation->customer->pic_name }}</p>
                                    <p class="text-sm text-gray-600">{{ $quotation->customer->email }}</p>
                                    <p class="text-sm text-gray-600">{{ $quotation->customer->phone }}</p>
                                </div>
                                <div>
                                    <h4 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Alamat
                                        Pengiriman</h4>
                                    <p class="text-sm text-gray-600 whitespace-pre-line">
                                        {{ $quotation->customer->address }}</p>
                                </div>
                            </div>

                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead>
                                        <tr class="bg-gray-50">
                                            <th
                                                class="px-4 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                                                Deskripsi Pekerjaan</th>
                                            <th
                                                class="px-4 py-3 text-center text-xs font-bold text-gray-500 uppercase tracking-wider w-20">
                                                Qty</th>
                                            <th
                                                class="px-4 py-3 text-right text-xs font-bold text-gray-500 uppercase tracking-wider w-32">
                                                Harga Satuan</th>
                                            <th
                                                class="px-4 py-3 text-right text-xs font-bold text-gray-500 uppercase tracking-wider w-32">
                                                Total</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach($quotation->items as $item)
                                        <tr>
                                            <td class="px-4 py-4 text-sm text-gray-900">{{ $item->description }}</td>
                                            <td class="px-4 py-4 text-sm text-gray-900 text-center">{{ $item->qty }}
                                            </td>
                                            <td class="px-4 py-4 text-sm text-gray-900 text-right">
                                                {{ number_format($item->price, 0, ',', '.') }}</td>
                                            <td class="px-4 py-4 text-sm text-gray-900 text-right font-semibold">
                                                {{ number_format($item->total, 0, ',', '.') }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot class="bg-gray-50">
                                        <tr>
                                            <td colspan="3"
                                                class="px-4 py-2 text-sm font-medium text-gray-600 text-right">Subtotal
                                            </td>
                                            <td class="px-4 py-2 text-sm font-bold text-gray-900 text-right">
                                                {{ number_format($quotation->subtotal, 0, ',', '.') }}</td>
                                        </tr>
                                        @if($quotation->discount > 0)
                                        <tr>
                                            <td colspan="3"
                                                class="px-4 py-2 text-sm font-medium text-gray-600 text-right">Potongan
                                                (Discount)</td>
                                            <td class="px-4 py-2 text-sm font-bold text-red-600 text-right">
                                                -{{ number_format($quotation->discount, 0, ',', '.') }}</td>
                                        </tr>
                                        @endif
                                        <tr>
                                            <td colspan="3"
                                                class="px-4 py-2 text-sm font-medium text-gray-600 text-right">PPN (11%)
                                            </td>
                                            <td class="px-4 py-2 text-sm font-bold text-gray-900 text-right">
                                                {{ number_format($quotation->tax, 0, ',', '.') }}</td>
                                        </tr>
                                        <tr class="bg-blue-50">
                                            <td colspan="3"
                                                class="px-4 py-3 text-base font-bold text-blue-800 text-right">TOTAL
                                            </td>
                                            <td class="px-4 py-3 text-base font-bold text-blue-800 text-right">IDR
                                                {{ number_format($quotation->total, 0, ',', '.') }}</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Actions & Timeline Card -->
                <div class="lg:col-span-1 space-y-6">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold mb-4 border-b pb-2">Actions</h3>
                            <div class="flex flex-col gap-3">
                                <a href="{{ route('quotations.pdf', $quotation) }}"
                                    class="w-full inline-flex justify-center items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                    Export PDF
                                </a>
                                <button type="button" onclick="openEmailModal()"
                                    class="w-full inline-flex justify-center items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                    Kirim Email
                                </button>
                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $quotation->customer->phone) }}?text={{ urlencode('Kepada Yth. ' . $quotation->customer->pic_name . ', berikut penawaran harga dari kami untuk ' . $quotation->quotation_no . '. Terima kasih.') }}"
                                    target="_blank"
                                    class="w-full inline-flex justify-center items-center px-4 py-2 bg-emerald-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-emerald-600">
                                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.414 0 .004 5.411.002 12.048c0 2.12.54 4.19 1.566 6.02L0 24l6.135-1.61a11.81 11.81 0 005.911 1.577h.005c6.637 0 12.046-5.411 12.048-12.047a11.82 11.82 0 00-3.48-8.52z" />
                                    </svg>
                                    Kirim WhatsApp
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold mb-4 border-b pb-2">Informasi Lainnya</h3>
                            <div class="space-y-4">
                                <div>
                                    <p class="text-xs font-bold text-gray-400 uppercase">Dibuat Pada</p>
                                    <p class="text-sm text-gray-800">{{ $quotation->created_at->format('d M Y H:i') }}
                                    </p>
                                </div>
                                <div>
                                    <p class="text-xs font-bold text-gray-400 uppercase">Terakhir Diupdate</p>
                                    <p class="text-sm text-gray-800">{{ $quotation->updated_at->format('d M Y H:i') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
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
                <h3 class="text-lg font-semibold text-gray-900">Kirim Email Quotation {{ $quotation->quotation_no }}
                </h3>
                <button onclick="closeEmailModal()" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>
            <form action="{{ route('quotations.email', $quotation) }}" method="POST">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label for="email_to" class="block text-sm font-medium text-gray-700 mb-1">Tujuan (To) *</label>
                        <input type="email" id="email_to" name="to" value="{{ $quotation->customer->email }}" required
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
                            value="Penawaran Harga {{ $quotation->quotation_no }}" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label for="email_body" class="block text-sm font-medium text-gray-700 mb-1">Isi Pesan *</label>
                        <textarea id="email_body" name="body" rows="6" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">Kepada Yth. {{ $quotation->customer->pic_name }},

Terlampir penawaran harga dari kami.

Hormat kami,
Admin HNET DIGITAL</textarea>
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