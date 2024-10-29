    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <title>Penerimaan - PT TFI (Stand Alone).</title>
        <!-- CSS files -->
        <link href="{{ url('assets/dist/css/tabler.min.css?1684106062') }}" rel="stylesheet" />
        <link href="{{ url('assets/dist/css/tabler-flags.min.css?1684106062') }}" rel="stylesheet" />
        <link href="{{ url('assets/dist/css/tabler-payments.min.css?1684106062') }}" rel="stylesheet" />
        <link href="{{ url('assets/dist/css/tabler-vendors.min.css?1684106062') }}" rel="stylesheet" />
        <link href="{{ url('assets/dist/css/demo.min.css?1684106062') }}" rel="stylesheet" />
        <link href="{{ asset('assets/extentions/fontawesome/css/all.min.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/extentions/select2/css/select2.min.css') }}" rel="stylesheet">

        <link href="{{ asset('assets/extentions/datatables/Select-1.6.0/css/select.bulma.min.css') }}" rel="stylesheet">
        <style>
            :root {
                --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
            }

            body {
                font-feature-settings: "cv03", "cv04", "cv11";
            }
        </style>
    </head>

    <?php
    
    use Carbon\Carbon;
    date_default_timezone_set('Asia/Jakarta');
    ?>
    <style type="text/css">
        @media screen {
            div#headerPrint {
                display: none
            }
        }
    </style>
    <style type="text/css">
        @media print {
            div#headerPrint {
                display: block
            }
        }
    </style>

    <div id="headerPrint">
        <?php
        echo '<i>Tanggal Print : ' . date('H:i:s d/m/Y') . '</i>';
        ?>
    </div>
    <table class="table table-sm table-bordered text-nowrap" style="color: black; border-color: black;">
        <tr>
            <td>
                <center>
                    <h1>BUKTI PENERIMAAN BARANG</h1>
                </center>
            </td>
        </tr>
        <tr>
            <td>
                <div class="row">
                    <div class="col">
                        <b>Tanggal : {{ Carbon::parse($penerimaan->tanggal_kedatangan)->format('d/m/Y') }}</b><br>
                        <b>No. Penerimaan : {{ $penerimaan->kodekontrak }}</b>
                    </div>
                    <div class="col">
                        <b>Terima Dari : </b><br>
                        <b>Referensi : </b>
                    </div>
                </div>
            </td>
        </tr>
        <tr style="padding: 0px;margin: 0px">
            <td style="padding: 0px;margin: 0px">
                <table class="table table-sm table-bordered text-nowrap text-center"
                    style="color: black; border-color: black;">
                    <tr>
                        <td>Kode Penerimaan</td>
                        <td>Tipe</td>
                        <td>Qty</td>
                        <td>Timbangan Kendaraan</td>
                        <td>Nopol</td>
                    </tr>
                    <tr>
                        <td>{{ $penerimaan->kodepenerimaan }}</td>
                        <td>{{ $penerimaan->tipe }}</td>
                        <td>{{ $penerimaan->qty . ' ' . $penerimaan->package }}</td>
                        <td>Penuh: {{ $penerimaan->berat_trukpenuh }} Kosong: {{ $penerimaan->berat_trukkosong }}
                        </td>
                        <td>{{ $penerimaan->nopol }}</td>
                    </tr>
                    <tr>
                        <td style="height: 25px"></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td style="height: 25px"></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                Catatan:
            </td>
        </tr>
        <tr style="padding: 0px;margin: 0px">
            <td style="padding: 0px;margin: 0px">
                <table class="table table-sm table-bordered text-nowrap text-center"
                    style="color: black; border-color: black;">
                    <tr>
                        <td style="width: 30%;">
                            <b>Diserahkan Oleh</b><br>
                            <img src="{{ asset('sign/driver/' . $penerimaan->signDriver) }}" alt=""><br>
                            {{ $penerimaan->driver }}
                        </td>
                        <td style="width: 30%;">
                            <b>Diterima Oleh</b><br>
                            <img src="{{ asset('sign/operator/' . $penerimaan->signOp) }}" alt=""><br>
                            {{ $penerimaan->operator }}
                        </td>
                        <td style="width: 40%;height: 100px">
                            <b>Mengetahui</b><br>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td style="text-align: right;">
                <i>{{ $penerimaan->id }}</i>
            </td>
        </tr>
    </table>
    <script>
        window.print();
    </script>
