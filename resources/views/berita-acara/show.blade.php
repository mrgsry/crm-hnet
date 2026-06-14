<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Detail Berita Acara') }}: {{ $beritaAcara->nomor }}
            </h2>
            <div class="flex gap-2">
                <a href="{{ route('berita-acara.edit', $beritaAcara) }}"
                    class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700">
                    Edit
                </a>
                <a href="{{ route('berita-acara.pdf', $beritaAcara) }}"
                    class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700">
                    Export PDF
                </a>
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
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                                <div>
                                    <h3 class="text-lg font-medium text-gray-900 mb-4">Informasi Dokumen</h3>
                                    <table class="min-w-full">
                                        <tr>
                                            <td class="py-2 text-sm font-semibold text-gray-600 w-1/3">Nomor</td>
                                            <td class="py-2 text-sm text-gray-900">: {{ $beritaAcara->nomor }}</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 text-sm font-semibold text-gray-600">Tanggal</td>
                                            <td class="py-2 text-sm text-gray-900">:
                                                {{ $beritaAcara->tanggal->format('d F Y') }}</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 text-sm font-semibold text-gray-600">Jenis</td>
                                            <td class="py-2 text-sm text-gray-900">:
                                                <span
                                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                                    {{ $beritaAcara->jenis }}
                                                </span>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div>
                                    <h3 class="text-lg font-medium text-gray-900 mb-4">Informasi Customer</h3>
                                    <table class="min-w-full">
                                        <tr>
                                            <td class="py-2 text-sm font-semibold text-gray-600 w-1/3">Nama Perusahaan
                                            </td>
                                            <td class="py-2 text-sm text-gray-900">:
                                                {{ $beritaAcara->customer->company_name }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 text-sm font-semibold text-gray-600">PIC</td>
                                            <td class="py-2 text-sm text-gray-900">:
                                                {{ $beritaAcara->customer->pic_name }}</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 text-sm font-semibold text-gray-600">Alamat</td>
                                            <td class="py-2 text-sm text-gray-900">:
                                                {{ $beritaAcara->customer->address }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>

                            <div class="border-t border-gray-200 pt-6">
                                <h3 class="text-lg font-medium text-gray-900 mb-4">Isi / Deskripsi Pekerjaan</h3>
                                <div
                                    class="bg-gray-50 p-6 rounded-lg prose max-w-none text-gray-800 whitespace-pre-wrap">
                                    {{ $beritaAcara->isi }}</div>
                            </div>

                            @if($beritaAcara->attachments && $beritaAcara->attachments->count() > 0)
                            <div class="border-t border-gray-200 mt-6 pt-6">
                                <h3 class="text-lg font-medium text-gray-900 mb-4">Lampiran Bukti Pekerjaan (Foto)</h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    @foreach($beritaAcara->attachments as $attachment)
                                    <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
                                        <img src="{{ asset('storage/' . $attachment->file_path) }}"
                                            alt="{{ $attachment->caption }}"
                                            class="w-full h-48 object-cover rounded-lg shadow-sm mb-2">
                                        <div class="text-center font-medium text-gray-700 text-sm">
                                            {{ $attachment->caption ?? 'Tanpa Keterangan' }}
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endif

                            <div class="mt-8 pt-6 border-t border-gray-200">
                                <a href="{{ route('berita-acara.index') }}"
                                    class="text-sm text-gray-600 hover:text-gray-900">
                                    &larr; Kembali ke daftar
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="lg:col-span-1 space-y-6">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold mb-4 border-b pb-2">Actions</h3>
                            <div class="flex flex-col gap-3">
                                <a href="{{ route('berita-acara.pdf', $beritaAcara) }}"
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
                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $beritaAcara->customer->phone) }}?text={{ urlencode('Kepada Yth. ' . $beritaAcara->customer->pic_name . ', terlampir Berita Acara ' . $beritaAcara->jenis . ' nomor ' . $beritaAcara->nomor . '. Terima kasih.') }}"
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
                                    <p class="text-sm text-gray-800">{{ $beritaAcara->created_at->format('d M Y H:i') }}
                                    </p>
                                </div>
                                <div>
                                    <p class="text-xs font-bold text-gray-400 uppercase">Terakhir Diupdate</p>
                                    <p class="text-sm text-gray-800">{{ $beritaAcara->updated_at->format('d M Y H:i') }}
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
    <div id="emailModal" class="hidden fixed inset-0 z-50" aria-labelledby="modal-title" role="dialog"
        aria-modal="true">
        <div class="fixed inset-0 bg-black/10 backdrop-blur-sm transition-opacity" aria-hidden="true"
            onclick="closeEmailModal()"></div>
        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
                <div
                    class="relative transform overflow-hidden rounded-lg bg-white px-4 pt-5 pb-4 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-md sm:p-6">
                    <div class="flex justify-between items-center border-b pb-3 mb-4">
                        <h3 class="text-lg font-semibold text-gray-900">Kirim Email Berita Acara</h3>
                        <button onclick="closeEmailModal()" class="text-gray-400 hover:text-gray-600">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                    <form id="emailForm" action="{{ route('berita-acara.send-email', $beritaAcara) }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Tujuan</label>
                            <input type="email" name="email" id="email" value="{{ $beritaAcara->customer->email }}"
                                required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
                        </div>
                        <div class="mb-4">
                            <label for="subject" class="block text-sm font-medium text-gray-700 mb-2">Subject</label>
                            <input type="text" name="subject" id="subject"
                                value="Berita Acara {{ $beritaAcara->jenis }} - {{ $beritaAcara->nomor }}" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
                        </div>
                        <div class="mb-4">
                            <label for="message" class="block text-sm font-medium text-gray-700 mb-2">Pesan</label>
                            <textarea name="message" id="message" rows="4" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">Kepada Yth. {{ $beritaAcara->customer->pic_name }},

Terlampir Berita Acara {{ $beritaAcara->jenis }} untuk pekerjaan yang telah dilaksanakan.

Terima kasih atas kerjasamanya.

Hormat kami,
HNet Solution</textarea>
                        </div>
                        <div class="flex justify-end gap-2">
                            <button type="button" onclick="closeEmailModal()"
                                class="px-4 py-2 bg-gray-100 text-gray-700 border border-gray-300 rounded-md hover:bg-gray-200">Batal</button>
                            <button type="submit" id="submitBtn"
                                class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 font-semibold text-sm inline-flex items-center">
                                <span id="btnText">Kirim Email</span>
                                <svg id="loadingIcon" class="hidden animate-spin ml-2 h-4 w-4 text-white"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                        stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor"
                                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                    </path>
                                </svg>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Notification Modal (Centered with single action) -->
    <div id="notificationModal" class="hidden fixed inset-0 z-[60]" aria-labelledby="modal-title" role="dialog"
        aria-modal="true">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
                <div
                    class="relative transform overflow-hidden rounded-lg bg-white px-4 pt-5 pb-4 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-sm sm:p-6">
                    <div>
                        <div id="notificationSuccessIcon"
                            class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-green-100">
                            <svg class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                            </svg>
                        </div>
                        <div id="notificationErrorIcon"
                            class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-red-100 hidden">
                            <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                            </svg>
                        </div>
                        <div class="mt-3 text-center sm:mt-5">
                            <h3 id="notificationTitle" class="text-base font-semibold leading-6 text-gray-900">Email
                                Terkirim</h3>
                            <div class="mt-2">
                                <p id="notificationMessage" class="text-sm text-gray-500"></p>
                            </div>
                        </div>
                    </div>
                    <div class="mt-5 sm:mt-6">
                        <button type="button" onclick="closeNotificationModal()"
                            class="inline-flex w-full justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                            OK
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
    function openEmailModal() {
        document.getElementById('emailModal').classList.remove('hidden');
    }

    function closeEmailModal() {
        document.getElementById('emailModal').classList.add('hidden');
    }

    function openNotificationModal(type, title, message) {
        const modal = document.getElementById('notificationModal');
        const successIcon = document.getElementById('notificationSuccessIcon');
        const errorIcon = document.getElementById('notificationErrorIcon');
        const titleEl = document.getElementById('notificationTitle');
        const messageEl = document.getElementById('notificationMessage');

        if (type === 'success') {
            successIcon.classList.remove('hidden');
            errorIcon.classList.add('hidden');
        } else {
            successIcon.classList.add('hidden');
            errorIcon.classList.remove('hidden');
        }

        titleEl.textContent = title;
        messageEl.textContent = message;
        modal.classList.remove('hidden');
    }

    function closeNotificationModal() {
        document.getElementById('notificationModal').classList.add('hidden');
    }

    // Close email modal when clicking outside
    document.getElementById('emailModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeEmailModal();
        }
    });

    // AJAX Form Submission
    document.getElementById('emailForm').addEventListener('submit', function(e) {
        e.preventDefault();

        const form = this;
        const submitBtn = document.getElementById('submitBtn');
        const btnText = document.getElementById('btnText');
        const loadingIcon = document.getElementById('loadingIcon');
        const formData = new FormData(form);

        // UI Loading State
        submitBtn.disabled = true;
        btnText.textContent = 'Mengirim...';
        loadingIcon.classList.remove('hidden');

        fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                }
            })
            .then(response => response.json())
            .then(data => {
                closeEmailModal();
                if (data.success) {
                    // Use the message returned from the controller (e.g., “Email berhasil dikirim ke …”)
                    openNotificationModal('success', 'Email Terkirim',
                        data.message
                    );
                } else {
                    openNotificationModal('error', 'Gagal', data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                closeEmailModal();
                openNotificationModal('error', 'Kesalahan',
                    'Terjadi kesalahan sistem saat mengirim email.');
            })
            .finally(() => {
                // Restore UI State
                submitBtn.disabled = false;
                btnText.textContent = 'Kirim Email';
                loadingIcon.classList.add('hidden');
            });
    });
    </script>
</x-app-layout>