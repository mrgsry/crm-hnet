<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Quotation {{ $quotation->quotation_no }}</title>
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
                <strong>Kepada:</strong><br>
                {{ $quotation->customer->company_name }}<br>
                UP: {{ $quotation->customer->pic_name }}<br>
                {{ $quotation->customer->address }}
            </td>
            <td width="50%" style="text-align: right;">
                <strong>QUOTATION</strong><br>
                Nomor: {{ $quotation->quotation_no }}<br>
                Tanggal: {{ \Carbon\Carbon::parse($quotation->quotation_date)->format('d F Y') }}<br>
                Status: {{ $quotation->status }}
            </td>
        </tr>
    </table>

    <table class="items">
        <thead>
            <tr>
                <th>Deskripsi Pekerjaan / Barang</th>
                <th width="80px">Qty</th>
                <th width="120px">Harga Satuan</th>
                <th width="120px">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($quotation->items as $item)
            <tr>
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
                <td style="text-align: right;">{{ number_format($quotation->subtotal, 2) }}</td>
            </tr>
            <tr>
                <td>Discount</td>
                <td style="text-align: right;">-{{ number_format($quotation->discount, 2) }}</td>
            </tr>
            @if($quotation->is_taxable)
            <tr>
                <td>Tax (11%)</td>
                <td style="text-align: right;">{{ number_format($quotation->tax, 2) }}</td>
            </tr>
            @endif
            <tr style="font-weight: bold; font-size: 14px; border-top: 1px solid #333;">
                <td>Grand Total</td>
                <td style="text-align: right;">{{ number_format($quotation->total, 2) }}</td>
            </tr>
        </table>
    </div>

    <div style="margin-top: 100px;">
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