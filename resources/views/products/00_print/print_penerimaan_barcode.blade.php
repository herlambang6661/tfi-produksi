<?php

use Carbon\Carbon;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
date_default_timezone_set('Asia/Jakarta');
use Dompdf\Dompdf;
?>

<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Barcode - PT TFI (Stand Alone).</title>
    <!-- CSS files -->
    <link href="{{ url('assets/dist/css/tabler.min.css?1684106062') }}" rel="stylesheet" />
    <link href="{{ url('assets/dist/css/demo.min.css?1684106062') }}" rel="stylesheet" />
    <link href="{{ asset('assets/extentions/fontawesome/css/all.min.css') }}" rel="stylesheet">
    <style>
        @page {
            size: 150mm 100mm;
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

        img {
            max-width: 90%;
            height: 50%;
            margin-top: 5px;
        }

        .subkode {
            font-size: 50px;
            margin-top: 5px;
        }

        .qty {
            position: absolute;
            left: 10px;
            bottom: 5px;
            font-size: 18px;
            text-align: left;
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
            <img src="data:image/jpeg;base64,{{ DNS1D::getBarcodeJPG($item->subkode, 'C39', 4, 333) }}"
                alt="{{ $item->subkode }}" />
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
