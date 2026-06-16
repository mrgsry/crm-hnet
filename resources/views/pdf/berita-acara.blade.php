<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Berita Acara {{ $beritaAcara->nomor }}</title>
    <style>
    body {
        font-family: sans-serif;
        font-size: 12px;
        color: #333;
        line-height: 1.6;
    }

    .header {
        margin-bottom: 20px;
    }

    .title {
        text-align: center;
        margin-bottom: 30px;
    }

    .title h2 {
        text-decoration: underline;
        margin-bottom: 5px;
    }

    .content {
        margin-bottom: 30px;
    }

    .signature {
        width: 100%;
        margin-top: 50px;
    }

    .signature td {
        text-align: center;
        vertical-align: bottom;
    }

    .footer {
        position: fixed;
        bottom: 0;
        width: 100%;
        text-align: center;
        font-size: 10px;
        color: #777;
    }

    .page-break {
        page-break-before: always;
    }

    .attachments {
        page-break-before: always;
        padding-top: 20px;
    }

    .attachments h3 {
        text-align: center;
        margin-bottom: 15px;
        margin-top: 0;
        font-size: 14px;
        text-decoration: underline;
    }

    .attachment-grid {
        display: table;
        width: 100%;
        border-collapse: collapse;
    }

    .attachment-row {
        display: table-row;
    }

    .attachment-cell {
        display: table-cell;
        width: 50%;
        padding: 5px;
        vertical-align: top;
        text-align: center;
    }

    .attachment-item {
        margin-bottom: 10px;
        text-align: center;
    }

    .attachment-item img {
        max-width: 100%;
        max-height: 220px;
        height: auto;
        border: 1px solid #ddd;
        padding: 3px;
    }

    .attachment-caption {
        margin-top: 3px;
        font-size: 10px;
        color: #555;
        font-style: italic;
    }

    .attachment-label {
        font-weight: bold;
        margin: 0 0 3px 0;
        font-size: 11px;
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

    <div class="title">
        <h2>BERITA ACARA {{ strtoupper($beritaAcara->jenis) }}</h2>
        <p>Nomor: {{ $beritaAcara->nomor }}</p>
    </div>

    <div class="content">
        <p>Pada hari ini,
            <strong>{{ \Carbon\Carbon::parse($beritaAcara->tanggal)->locale('id')->translatedFormat('l') }}</strong>
            tanggal <strong>{{ \Carbon\Carbon::parse($beritaAcara->tanggal)->translatedFormat('d') }}</strong>
            bulan
            <strong>{{ \Carbon\Carbon::parse($beritaAcara->tanggal)->locale('id')->translatedFormat('F') }}</strong>
            tahun <strong>{{ \Carbon\Carbon::parse($beritaAcara->tanggal)->translatedFormat('Y') }}</strong>,
            kami yang bertanda tangan di bawah ini:
        </p>

        <p><strong>Pihak Pertama (Pelaksana):</strong></p>
        <table width="100%" style="margin-left: 20px; margin-bottom: 20px;">
            <tr>
                <td width="30%">Nama Perusahaan</td>
                <td width="5%">:</td>
                <td>Hnet Solution</td>
            </tr>
            <tr>
                <td width="30%">Nama PIC</td>
                <td width="5%">:</td>
                <td>Muhamad Habib</td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>:</td>
                <td>Jl. Al Huda Rt02/rw 09 No.107, Kp. Rawasapi, Kel Jatimulya, Tambun Selatan, Bekasi</td>
            </tr>
        </table>

        <p><strong>Pihak Kedua (Klien):</strong></p>
        <table width="100%" style="margin-left: 20px; margin-bottom: 20px;">
            <tr>
                <td width="30%">Nama Instansi / Perusahaan</td>
                <td width="5%">:</td>
                <td>{{ $beritaAcara->customer->company_name }}</td>
            </tr>
            <tr>
                <td>Nama PIC</td>
                <td>:</td>
                <td>{{ $beritaAcara->customer->pic_name }}</td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>:</td>
                <td>{{ $beritaAcara->customer->address }}</td>
            </tr>
        </table>

        <p>Telah dilakukan pekerjaan <strong>{{ $beritaAcara->jenis }}</strong> dengan rincian sebagai berikut:</p>

        <div style="border: 1px solid #ddd; padding: 15px; background: #f9f9f9; min-height: 200px;">
            {!! nl2br(e($beritaAcara->isi)) !!}
        </div>

        <p style="margin-top: 20px;">Demikian Berita Acara ini dibuat dengan sebenarnya untuk dapat dipergunakan
            sebagaimana mestinya.</p>
    </div>

    <table class="signature">
        <tr>
            <td width="50%" style="position: relative;">
                Pihak Pertama,<br>
                <strong>Hnet Solution</strong><br>
                <div style="position: relative; height: 60px;">
                    @if($stampData)
                    <img src="data:image/png;base64,{{ $stampData }}"
                        style="position: absolute; width: 180px; left: 50%; margin-left: -60px; top: -30px; opacity: 0.8; z-index: 10;">
                    @endif
                </div>
                ( Muhamad Habib )
            </td>
            <td width="50%">
                Pihak Kedua,<br>
                <strong>{{ $beritaAcara->customer->company_name }}</strong><br><br><br><br><br>
                ( {{ $beritaAcara->customer->pic_name }} )
            </td>
        </tr>
    </table>

    @if($beritaAcara->attachments && $beritaAcara->attachments->count() > 0)
    <div class="attachments">
        <h3>LAMPIRAN BUKTI PEKERJAAN</h3>
        <div class="attachment-grid">
            @foreach($beritaAcara->attachments->chunk(2) as $rowIndex => $row)
            <div class="attachment-row">
                @foreach($row as $attachment)
                <div class="attachment-cell">
                    <div class="attachment-item">
                        <p class="attachment-label">Foto {{ $loop->parent->index * 2 + $loop->index + 1 }}</p>
                        @php
                        $imagePath = storage_path('app/public/' . $attachment->file_path);
                        $base64 = '';
                        if (file_exists($imagePath)) {
                        $type = pathinfo($imagePath, PATHINFO_EXTENSION);

                        // Compress image to reduce PDF size
                        try {
                        $imageInfo = getimagesize($imagePath);
                        $mime = $imageInfo['mime'];

                        // Create image resource based on type
                        if ($mime === 'image/jpeg' || $mime === 'image/jpg') {
                        $image = imagecreatefromjpeg($imagePath);
                        } elseif ($mime === 'image/png') {
                        $image = imagecreatefrompng($imagePath);
                        } elseif ($mime === 'image/gif') {
                        $image = imagecreatefromgif($imagePath);
                        } else {
                        // Unsupported format, use original
                        $data = file_get_contents($imagePath);
                        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
                        throw new Exception('Skip compression');
                        }

                        // Get original dimensions
                        $width = imagesx($image);
                        $height = imagesy($image);

                        // Calculate new dimensions (max 800px width/height)
                        $maxDimension = 800;
                        if ($width > $maxDimension || $height > $maxDimension) {
                        if ($width > $height) {
                        $newWidth = $maxDimension;
                        $newHeight = intval($height * ($maxDimension / $width));
                        } else {
                        $newHeight = $maxDimension;
                        $newWidth = intval($width * ($maxDimension / $height));
                        }
                        } else {
                        $newWidth = $width;
                        $newHeight = $height;
                        }

                        // Create resized image
                        $resizedImage = imagecreatetruecolor($newWidth, $newHeight);

                        // Preserve transparency for PNG
                        if ($mime === 'image/png') {
                        imagealphablending($resizedImage, false);
                        imagesavealpha($resizedImage, true);
                        $transparent = imagecolorallocatealpha($resizedImage, 255, 255, 255, 127);
                        imagefilledrectangle($resizedImage, 0, 0, $newWidth, $newHeight, $transparent);
                        }

                        // Resize
                        imagecopyresampled($resizedImage, $image, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

                        // Output to buffer
                        ob_start();
                        imagejpeg($resizedImage, null, 75); // 75% quality
                        $data = ob_get_clean();

                        // Clean up
                        imagedestroy($image);
                        imagedestroy($resizedImage);

                        $base64 = 'data:image/jpeg;base64,' . base64_encode($data);
                        } catch (Exception $e) {
                        // If compression fails, use original (already set above or fallback)
                        if (empty($base64)) {
                        $data = file_get_contents($imagePath);
                        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
                        }
                        }
                        }
                        @endphp
                        @if($base64)
                        <img src="{{ $base64 }}" alt="{{ $attachment->caption }}">
                        @else
                        <p style="color: #999;">[Gambar tidak tersedia]</p>
                        @endif
                        <div class="attachment-caption">
                            {{ $attachment->caption ?? 'Tanpa Keterangan' }}
                        </div>
                    </div>
                </div>
                @endforeach
                {{-- Fill empty cell if odd number of images in row --}}
                @if($row->count() == 1)
                <div class="attachment-cell"></div>
                @endif
            </div>
            {{-- Page break after every 3 rows (6 images) --}}
            @if(($rowIndex + 1) % 3 == 0 && !$loop->last)
            <div style="page-break-after: always;"></div>
            @endif
            @endforeach
        </div>
    </div>
    @endif

    <div class="footer">
        Generated otomatically by HNet Solution App
    </div>
</body>

</html>