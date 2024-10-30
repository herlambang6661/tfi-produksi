<?php

use Carbon\Carbon;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
date_default_timezone_set('Asia/Jakarta');
use Dompdf\Dompdf;
// echo DNS1D::getBarcodeSVG('4445645656', 'PHARMA2T');
// echo DNS1D::getBarcodeHTML('4445645656', 'PHARMA2T');
// echo '<img src="data:image/png,' . DNS1D::getBarcodePNG('4', 'C39+') . '" alt="barcode"   />';
// echo DNS1D::getBarcodePNGPath('4445645656', 'PHARMA2T');
// echo '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG('4', 'C39+') . '" alt="barcode"   />';
// echo DNS1D::getBarcodeJPGPath('4445645656', 'PHARMA2T');
// echo '<img src="data:image/jpeg;base64,' . DNS1D::getBarcodeJPG('4', 'C39+') . '" alt="barcode"   />';
// echo DNS1D::getBarcodeSVG('444564565', 'C39');
// echo DNS2D::getBarcodeHTML('4445645656', 'QRCODE');
// echo DNS2D::getBarcodePNGPath('4445645656', 'PDF417');
// echo DNS2D::getBarcodeSVG('4445645656', 'DATAMATRIX');
// echo '<img src="data:image/png;base64,' . DNS2D::getBarcodePNG('4', 'PDF417') . '" alt="barcode"   />';
// echo DNS1D::getBarcodeSVG('4445645656', 'PHARMA2T', 3, 33, 'green', true);
// echo DNS1D::getBarcodeHTML('4445645656', 'PHARMA2T', 3, 33, 'green', true);
// echo '<img src="' . DNS1D::getBarcodePNG('4', 'C39+', 3, 33, [1, 1, 1], true) . '" alt="barcode"   />';
// echo DNS1D::getBarcodePNGPath('4445645656', 'PHARMA2T', 3, 33, [255, 255, 0], true);
// echo '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG('4', 'C39+', 3, 33, [1, 1, 1], true) . '" alt="barcode"   />';
// echo DNS1D::getBarcodeJPGPath('4445645656', 'PHARMA2T', 3, 33, [255, 255, 0], true);
// echo '<img src="data:image/jpeg;base64,' . DNS1D::getBarcodeJPG('4', 'C39+', 3, 33, [1, 1, 1], true) . '" alt="barcode"   />';
?>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Barcode - PT TFI (Stand Alone).</title>
    <!-- CSS files -->
    <link href="{{ url('assets/dist/css/tabler.min.css?1684106062') }}" rel="stylesheet" />
    <link href="{{ url('assets/dist/css/tabler-flags.min.css?1684106062') }}" rel="stylesheet" />
    <link href="{{ url('assets/dist/css/tabler-payments.min.css?1684106062') }}" rel="stylesheet" />
    <link href="{{ url('assets/dist/css/tabler-vendors.min.css?1684106062') }}" rel="stylesheet" />
    <link href="{{ url('assets/dist/css/demo.min.css?1684106062') }}" rel="stylesheet" />
    <link href="{{ asset('assets/extentions/fontawesome/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/extentions/select2/css/select2.min.css') }}" rel="stylesheet">
    <style>
        /* @page {
            size 8.5in 11in;
            margin: 2cm
        } */
        @media print {
            @page {
                size: 150mm 100mm auto;
            }
        }

        div.page {
            transform: rotate(90deg);
            page-break-after: always;
        }
    </style>
</head>

<body>
    @foreach ($penerimaanItem as $item)
        <div class="page" style="margin-left: 50px;margin-right: 50px;">
            <div class="row">
                <div class="col" style="margin-top: 0px">
                    <b style="font-size: 40px;">
                        {{ $item->kodepenerimaan }}
                    </b>
                </div>
                <div class="col" style="margin-top: 0px; text-align: right">
                    <b style="font-size: 40px">
                        {{ Carbon::parse($item->tanggal_kedatangan)->format('d-m-Y') }}
                    </b>
                </div>
            </div>

            {{-- <img src="data:image/jpeg;base64,{{ DNS1D::getBarcodeJPG($item->subkode, 'C39', 4, 333) }}"
                alt="{{ $item->subkode }}" /> --}}
            {{-- {!! DNS1D::getBarcodeHTML('123njdksfnkdjfb', 'C39E+') !!} --}}
            <img src="data:image/jpeg;base64,{{ DNS1D::getBarcodeJPG($item->subkode, 'C39+', 4, 333, [1, 1, 1], true) }}"
                alt="barcode" />

            <div class="row">
                <div class="col" style="margin-top: 0px; text-align: center">
                    <b style="font-size: 60px;">
                        {{ $item->subkode }}
                    </b>
                </div>
            </div>

        </div>
    @endforeach
</body>

</html>
<script>
    window.print();
</script>
