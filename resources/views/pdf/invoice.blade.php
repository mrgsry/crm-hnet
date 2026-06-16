<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Invoice {{ $invoice->invoice_no }}</title>
    <style>
    body {
        font-family: sans-serif;
        font-size: 12px;
        color: #333;
    }

    .header {
        margin-bottom: 20px;
    }

    .info {
        width: 100%;
        margin-bottom: 20px;
    }

    .info td {
        vertical-align: top;
    }

    .items {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    .items th {
        background: #2563EB;
        color: #fff;
        padding: 8px;
        text-align: left;
    }

    .items td {
        padding: 8px;
        border-bottom: 1px solid #ddd;
    }

    .totals {
        float: right;
        width: 300px;
    }

    .totals table {
        width: 100%;
    }

    .totals td {
        padding: 5px;
    }

    .footer {
        position: fixed;
        bottom: 0;
        width: 100%;
        text-align: center;
        font-size: 10px;
        color: #777;
    }
    </style>
</head>

<body>
    <div class="header">
        @php
        $logoPath = public_path('storage/img/hnetlogo.png');
        $logoData = file_exists($logoPath) ? base64_encode(file_get_contents($logoPath)) : '';
        $stampPath = public_path('storage/img/stamphnet.png');
        $stampData = file_exists($stampPath) ? base64_encode(file_get_contents($stampPath)) : '';
        @endphp
        <table width="100%">
            <tr>
                <td width="20%" style="vertical-align: top;">
                    @if($logoData)
                    <img src="data:image/png;base64,{{ $logoData }}" style="height: 80px;">
                    @endif
                </td>
                <td width="80%" style="vertical-align: top; text-align: left; padding-left: 10px;">
                    <div style="font-size: 22px; font-weight: bold; margin-bottom: 5px;">
                        <span style="color: #2563EB;">Hnet</span> Solution
                    </div>
                    <div style="font-size: 12px; margin-bottom: 5px;">
                        Penyedia layanan pembuatan Aplikasi Perusahaan, NAS, pemasangan jaringan LAN, CCTV, Data Center
                        dll.
                    </div>
                    <div style="font-size: 12px; font-weight: bold;">
                        Email: <span style="color: #2563EB;">muhamadhabib.work@gmail.com</span><br>
                        Telp: <span style="color: #2563EB;">+62 877-8146-6447</span><br>
                        www.hnet-digital.biz.id
                    </div>
                </td>
            </tr>
        </table>
        <div style="border-bottom: 3px solid #000; margin-top: 10px;"></div>
    </div>

    <table class="info">
        <tr>
            <td width="50%">
                <strong>Ditagihkan Kepada:</strong><br>
                {{ $invoice->customer->company_name }}<br>
                UP: {{ $invoice->customer->pic_name }}<br>
                {{ $invoice->customer->address }}
            </td>
            <td width="50%" style="text-align: right;">
                <strong>INVOICE</strong><br>
                Nomor: {{ $invoice->invoice_no }}<br>
                @if($invoice->po_number)
                <p style="margin: 0;">Nomor PO: {{ $invoice->po_number }}</p>
                @endif
                Tanggal: {{ \Carbon\Carbon::parse($invoice->invoice_date)->format('d F Y') }}<br>
                Jatuh Tempo:
                {{ $invoice->due_date ? \Carbon\Carbon::parse($invoice->due_date)->format('d F Y') : '-' }}<br>
                Status: {{ $invoice->status }}
            </td>
        </tr>
    </table>

    <table class="items">
        <thead>
            <tr>
                <th width="120px">Kode Barang</th>
                <th>Deskripsi Pekerjaan / Barang</th>
                <th width="80px">Qty</th>
                <th width="120px">Harga Satuan</th>
                <th width="120px">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($invoice->items as $item)
            <tr>
                <td>{{ $item->item_code ?? '' }}</td>
                <td>{{ $item->description }}</td>
                <td>{{ $item->qty }}</td>
                <td>{{ number_format($item->price, 2) }}</td>
                <td>{{ number_format($item->total, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="totals">
        <table>
            <tr>
                <td>Subtotal</td>
                <td style="text-align: right;">{{ number_format($invoice->subtotal, 2) }}</td>
            </tr>
            @if($invoice->is_taxable)
            <tr>
                <td>Tax (11%)</td>
                <td style="text-align: right;">{{ number_format($invoice->tax, 2) }}</td>
            </tr>
            @endif
            <tr style="font-weight: bold; font-size: 14px; border-top: 1px solid #333;">
                <td>Grand Total</td>
                <td style="text-align: right;">{{ number_format($invoice->total, 2) }}</td>
            </tr>
        </table>
    </div>

    <div style="clear: both;"></div>

    <div style="margin-top: 20px; border: 1px solid #000; padding: 10px;">
        <strong>Note :</strong>
        <ol style="margin: 5px 0 0 20px; padding: 0; list-style-type: decimal;">
            <li style="margin-bottom: 5px;">
                Pembayaran dapat dilakukan melalui rekening berikut:<br>
                <table style="border: none; margin-top: 5px;">
                    <tr>
                        <td style="padding: 0; width: 100px;"><strong>Bank</strong></td>
                        <td style="padding: 0; width: 10px;">:</td>
                        <td style="padding: 0;"><strong>Mandiri</strong></td>
                    </tr>
                    <tr>
                        <td style="padding: 0;"><strong>No. Rekening</strong></td>
                        <td>:</td>
                        <td><strong>1190009928761</strong></td>
                    </tr>
                    <tr>
                        <td style="padding: 0;"><strong>Atas Nama</strong></td>
                        <td>:</td>
                        <td><strong>Muhamad Habib Gusti Rayana</strong></td>
                    </tr>
                </table>
            </li>
            <li style="margin-bottom: 5px;">Jatuh tempo pembayaran (Due Date) adalah 7 (tujuh) hari kalender sejak
                tanggal invoice diterbitkan.</li>
            <li style="margin-bottom: 5px;">Mohon untuk mengirimkan bukti pembayaran setelah transaksi dilakukan guna
                keperluan verifikasi dan administrasi.</li>
            <li>Pembayaran dianggap sah setelah dana diterima dan terverifikasi pada rekening yang tercantum di atas.
            </li>
        </ol>
    </div>

    <div style="margin-top: 50px;">
        <table width="100%">
            <tr>
                <td width="70%"></td>
                <td width="30%" style="text-align: center; position: relative;">
                    Hormat Kami,<br><br>
                    <div style="position: relative; height: 60px;">
                        @if($stampData)
                        <img src="data:image/png;base64,{{ $stampData }}"
                            style="position: absolute; width: 180px; left: 50%; margin-left: -60px; top: -30px; opacity: 0.8; z-index: 10;">
                        @endif
                    </div>
                    <strong>Muhamad Habib</strong>
                </td>
            </tr>
        </table>
    </div>

    <div class="footer">
        Generated otomatically by HNet Solution App
    </div>
</body>

</html>