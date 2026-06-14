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
        text-align: center;
        margin-bottom: 20px;
        border-bottom: 2px solid #2563EB;
        padding-bottom: 10px;
    }

    .header h1 {
        color: #2563EB;
        margin: 0;
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
        <h1>HNet Solution</h1>
        <p>Solusi Jaringan & IT Terpercaya</p>
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
            <tr>
                <td>Tax (11%)</td>
                <td style="text-align: right;">{{ number_format($quotation->tax, 2) }}</td>
            </tr>
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
                <td width="30%" style="text-align: center;">
                    Hormat Kami,<br><br><br><br><br>
                    <strong>Admin HNet</strong>
                </td>
            </tr>
        </table>
    </div>

    <div class="footer">
        HNet Solution CRM - Penawaran Harga Otomatis
    </div>
</body>

</html>