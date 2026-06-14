<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Buat Quotation Baru') }}
        </h2>
    </x-slot>

    <div class="py-12" x-data="quotationForm()">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form action="{{ route('quotations.store') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <!-- Left Side: Main Info -->
                    <div class="lg:col-span-2 space-y-6">
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6">
                                <h3 class="text-lg font-semibold mb-4 border-b pb-2">Informasi Quotation</h3>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div class="md:col-span-2">
                                        <x-input-label for="customer_id" :value="__('Customer')" />
                                        <select name="customer_id" id="customer_id"
                                            class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full"
                                            required>
                                            <option value="">-- Pilih Customer --</option>
                                            @foreach($customers as $customer)
                                            <option value="{{ $customer->id }}"
                                                {{ (old('customer_id', $selectedCustomerId) == $customer->id) ? 'selected' : '' }}>
                                                {{ $customer->company_name }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <x-input-error :messages="$errors->get('customer_id')" class="mt-2" />
                                    </div>

                                    <div>
                                        <x-input-label for="quotation_no" :value="__('Nomor Quotation')" />
                                        <x-text-input id="quotation_no" type="text"
                                            class="block mt-1 w-full bg-gray-100" :value="$quotationNo" readonly />
                                    </div>

                                    <div>
                                        <x-input-label for="quotation_date" :value="__('Tanggal')" />
                                        <x-text-input id="quotation_date" name="quotation_date" type="date"
                                            class="block mt-1 w-full" :value="old('quotation_date', date('Y-m-d'))"
                                            required />
                                        <x-input-error :messages="$errors->get('quotation_date')" class="mt-2" />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Items Section -->
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6">
                                <div class="flex justify-between items-center mb-4">
                                    <h3 class="text-lg font-semibold border-b pb-2 flex-grow">Item Pekerjaan</h3>
                                    <button type="button" @click="addItem()"
                                        class="ml-4 inline-flex items-center px-3 py-1 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700">
                                        Tambah Item
                                    </button>
                                </div>

                                <div class="overflow-x-auto">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead>
                                            <tr>
                                                <th
                                                    class="px-2 py-2 text-left text-xs font-medium text-gray-500 uppercase">
                                                    Deskripsi</th>
                                                <th
                                                    class="px-2 py-2 text-left text-xs font-medium text-gray-500 uppercase w-20">
                                                    Qty</th>
                                                <th
                                                    class="px-2 py-2 text-left text-xs font-medium text-gray-500 uppercase w-32">
                                                    Harga Satuan</th>
                                                <th
                                                    class="px-2 py-2 text-left text-xs font-medium text-gray-500 uppercase w-32">
                                                    Total</th>
                                                <th class="px-2 py-2 w-10"></th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-200">
                                            <template x-for="(item, index) in items" :key="index">
                                                <tr>
                                                    <td class="px-2 py-2">
                                                        <input :name="'items['+index+'][description]'"
                                                            x-model="item.description" type="text"
                                                            class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm text-sm"
                                                            required>
                                                    </td>
                                                    <td class="px-2 py-2">
                                                        <input :name="'items['+index+'][qty]'" x-model.number="item.qty"
                                                            @input="calculateTotal()" type="number" min="1"
                                                            class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm text-sm text-center"
                                                            required>
                                                    </td>
                                                    <td class="px-2 py-2">
                                                        <input :name="'items['+index+'][price]'"
                                                            x-model.number="item.price" @input="calculateTotal()"
                                                            type="number" min="0"
                                                            class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm text-sm text-right"
                                                            required>
                                                    </td>
                                                    <td class="px-2 py-2 text-right text-sm">
                                                        <span x-text="formatCurrency(item.qty * item.price)"></span>
                                                    </td>
                                                    <td class="px-2 py-2 text-center">
                                                        <button type="button" @click="removeItem(index)"
                                                            class="text-red-600 hover:text-red-900"
                                                            x-show="items.length > 1">
                                                            <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                                viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                                </path>
                                                            </svg>
                                                        </button>
                                                    </td>
                                                </tr>
                                            </template>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Side: Summary & Action -->
                    <div class="lg:col-span-1">
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg sticky top-6">
                            <div class="p-6">
                                <h3 class="text-lg font-semibold mb-4 border-b pb-2">Ringkasan Biaya</h3>

                                <div class="space-y-3">
                                    <div class="flex justify-between">
                                        <span class="text-sm text-gray-600">Subtotal</span>
                                        <span class="text-sm font-semibold" x-text="formatCurrency(subtotal)"></span>
                                    </div>
                                    <div class="space-y-1">
                                        <x-input-label for="discount" :value="__('Potongan Harga (Discount)')"
                                            class="text-xs" />
                                        <x-text-input id="discount" name="discount" type="number"
                                            x-model.number="discount" @input="calculateTotal()"
                                            class="block w-full text-sm text-right" placeholder="0" />
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-sm text-gray-600">PPN (11%)</span>
                                        <span class="text-sm font-semibold" x-text="formatCurrency(tax)"></span>
                                    </div>
                                    <div class="pt-3 border-t flex justify-between">
                                        <span class="text-base font-bold">Total</span>
                                        <span class="text-lg font-bold text-blue-600"
                                            x-text="formatCurrency(total)"></span>
                                    </div>
                                </div>

                                <div class="mt-6 flex flex-col gap-3">
                                    <x-primary-button class="justify-center w-full">
                                        {{ __('Simpan Quotation') }}
                                    </x-primary-button>
                                    <a href="{{ route('quotations.index') }}"
                                        class="inline-flex justify-center items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 w-full">
                                        Batal
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
    function quotationForm() {
        return {
            items: [{
                description: '',
                qty: 1,
                price: 0
            }],
            discount: 0,
            subtotal: 0,
            tax: 0,
            total: 0,
            addItem() {
                this.items.push({
                    description: '',
                    qty: 1,
                    price: 0
                });
            },
            removeItem(index) {
                this.items.splice(index, 1);
                this.calculateTotal();
            },
            calculateTotal() {
                this.subtotal = this.items.reduce((sum, item) => sum + (item.qty * item.price), 0);
                this.tax = (this.subtotal - this.discount) * 0.11;
                if (this.tax < 0) this.tax = 0;
                this.total = this.subtotal - this.discount + this.tax;
            },
            formatCurrency(value) {
                return new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                    minimumFractionDigits: 0
                }).format(value);
            }
        }
    }
    </script>
</x-app-layout>