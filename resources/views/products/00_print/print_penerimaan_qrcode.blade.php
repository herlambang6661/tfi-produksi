<?php

use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;

date_default_timezone_set('Asia/Jakarta');
?>

<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>QR Code - PT TFI (Stand Alone).</title>
    <style>
        @page {
            size: 80mm 100mm;
            /* Mengubah ukuran halaman menjadi 80mm x 100mm */
            margin: 5mm;
        }

        div.page {
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            align-items: center;
            text-align: center;
            page-break-after: always;
            position: relative;
        }

        .header {
            display: flex;
            justify-content: space-between;
            width: 100%;
            padding: 5px 10px;
            margin-bottom: 5px;
        }

        .barcode-text {
            font-size: 24px;
            margin: 0 5px;
        }

        .qr-container {
            position: relative;
            /* Untuk posisi absolut gambar di dalamnya */
            width: 80mm;
            /* Ukuran QR Code */
            height: 80mm;
            /* Ukuran QR Code */
            display: flex;
            justify-content: center;
            align-items: center;
        }

        img.qr {
            max-width: 100%;
            height: auto;
        }

        img.logo {
            position: absolute;
            width: 30%;
            /* Ukuran logo, sesuaikan sesuai kebutuhan */
            height: auto;
            /* Menjaga proporsi */
            z-index: 1;
            /* Pastikan gambar logo di atas QR Code */
            opacity: 0.7;
            /* Mengatur transparansi logo */
        }

        .subkode {
            font-size: 24px;
            /* Ukuran font subkode */
            margin-top: 5px;
            /* Jarak atas subkode */
        }

        .qty {
            font-size: 18px;
            /* Ukuran font qty */
            text-align: left;
            /* Rata kiri */
            margin-top: 5px;
            /* Jarak atas qty */
            width: 100%;
            /* Lebar penuh untuk qty */
            position: relative;
            /* Untuk mengatur posisi */
            left: 0;
            /* Mengatur posisi ke kiri */
        }
    </style>
</head>

<body>
    @foreach ($penerimaanItem as $item)
        <div class="page">
            <div class="header">
                <div class="barcode-text" style="flex: 1; text-align: left;">
                    <b>{{ $item->kodepenerimaan }}</b>
                </div>
                <div class="barcode-text" style="flex: 1; text-align: right;">
                    <b>{{ $item->tanggal_kedatangan }}</b>
                </div>
            </div>

            <?php
            // Generate QR Code
            $qrCode = new QrCode($item->subkode);
            $writer = new PngWriter();
            $result = $writer->write($qrCode);
            ?>

            <div class="qr-container">
                <img class="qr" src="data:image/png;base64,{{ base64_encode($result->getString()) }}"
                    alt="{{ $item->subkode }}" />
                <img class="logo" src="{{ asset('photo/icon/tantra.png') }}" alt="Logo" />
            </div>

            <div class="subkode">
                <b>{{ $item->subkode }}</b>
            </div>
            <div class="qty">
                <b>QTY: 10 KG</b>
            </div>
        </div>
    @endforeach
</body>

</html>
<script>
    window.print();
</script>
