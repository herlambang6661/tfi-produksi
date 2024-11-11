<?php

use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Carbon\Carbon;
date_default_timezone_set('Asia/Jakarta');
?>

<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>QR Code - PT TFI (Stand Alone).</title>
    <style>
        @page {
            size: 80mm 100mm;
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
            width: 80mm;
            height: 80mm;
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
            height: auto;
            z-index: 1;
            opacity: 0.7;
        }

        .subkode {
            font-size: 24px;
            margin-top: 5px;
        }

        .qty {
            font-size: 18px;
            text-align: left;
            margin-top: 5px;
            width: 100%;
            position: relative;
            left: 0;
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
                    <b>{{ Carbon::parse($item->tanggal_kedatangan)->format('d-m-Y') }}</b>
                </div>
            </div>

            <?php
            $qrCode = new QrCode(Crypt::encryptString($item->subkode));
            $writer = new PngWriter();
            $result = $writer->write($qrCode);
            ?>

            <div class="qr-container">
                <img class="qr" src="data:image/png;base64,{{ base64_encode($result->getString()) }}"
                    alt="{{ Crypt::encryptString($item->subkode) }}" />
                {{-- <img class="logo" src="{{ asset('photo/icon/tantra.png') }}" alt="Logo" /> --}}
            </div>

            <div class="subkode">
                <b>{{ $item->subkode }}</b>
            </div>
            <div class="qty">
                <b>QTY: {{ $item->berat_satuan }} KG</b>
            </div>
        </div>
    @endforeach
</body>

</html>
<script>
    window.print();
</script>
