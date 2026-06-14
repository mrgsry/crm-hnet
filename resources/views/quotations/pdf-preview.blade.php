<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Preview PDF - {{ $quotation->quotation_no }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
    @media print {
        .no-print {
            display: none !important;
        }

        .pdf-content {
            box-shadow: none !important;
            margin: 0 !important;
            padding: 20px !important;
        }
    }
    </style>
</head>

<body class="bg-gray-100 min-h-screen">
    <!-- Action Buttons -->
    <div class="no-print bg-white shadow-md fixed top-0 left-0 right-0 z-50">
        <div class="max-w-4xl mx-auto px-4 py-3 flex justify-between items-center">
            <div class="flex items-center gap-2">
                <a href="{{ route('quotations.show', $quotation) }}"
                    class="inline-flex items-center px-3 py-2 text-gray-600 hover:text-gray-800">
                    <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Kembali
                </a>
                <span class="text-gray-300">|</span>
                <h1 class="text-lg font-semibold text-gray-800">Preview: {{ $quotation->quotation_no }}</h1>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('quotations.pdf.download', $quotation) }}"
                    class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 font-medium text-sm">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                    </svg>
                    Download PDF
                </a>
                <button onclick="window.print()"
                    class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 font-medium text-sm">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                    </svg>
                    Print PDF
                </button>
            </div>
        </div>
    </div>

    <!-- PDF Content Preview -->
    <div class="pt-20 pb-8 px-4">
        <div class="pdf-content max-w-4xl mx-auto bg-white shadow-lg rounded-lg overflow-hidden">
            @include('pdf.quotation', ['quotation' => $quotation])
        </div>
    </div>
</body>

</html>