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

            @media print {
                div#headerPrint {
                    display: block
                }
            }

            :root {
                --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
            }

            body {
                font-feature-settings: "cv03", "cv04", "cv11";
            }
        </style>
    </head>

    <body class="ms-1 me-0 mr-0 ml-0">
        <div id="headerPrint">
            <div class="row">
                <div class="col">
                    <i>Tanggal Print : {{ date('H:i:s d/m/Y') }}</i>
                </div>
                <div class="col" style="text-align: right;">
                    <i>{{ $penerimaan->id }}</i>
                </div>
            </div>
        </div>
        <table class="table table-sm table-bordered text-nowrap mb-0" style="color: black; border-color: black;">
            <tr>
                <td>
                    <center>
                        <h1>BUKTI PENERIMAAN BARANG</h1>
                    </center>
                </td>
            </tr>
        </table>
        <table class="table table-sm table-borderless text-nowrap text-center mb-0"
            style="color: black; border-color: black;">
            <tr>
                <td>
                    <div class="row">
                        <div class="col">
                            <table class="table-sm table-borderless text-nowrap text-start fw-bolder">
                                <tr>
                                    <td>Tanggal</td>
                                    <td>:</td>
                                    <td>{{ Carbon::parse($penerimaan->tanggal)->isoFormat('D MMMM Y') }}</td>
                                </tr>
                                <tr>
                                    <td>No. Penerimaan</td>
                                    <td>:</td>
                                    <td>{{ $penerimaan->npb }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col">
                            <table class="table-sm table-borderless text-nowrap text-start fw-bolder">
                                <tr>
                                    <td>Pengemudi</td>
                                    <td>:</td>
                                    <td>{{ $penerimaan->driver }}</td>
                                </tr>
                                <tr>
                                    <td>Diterima Oleh</td>
                                    <td>:</td>
                                    <td>{{ $penerimaan->operator }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </td>
            </tr>
            <tr style="padding: 0px;margin: 0px">
                <td style="padding: 0px;margin: 0px">
                    <table class="table table-sm table-bordered text-nowrap text-center"
                        style="color: black; border-color: black;">
                        <thead>
                            <tr>
                                <th>Kode Kontrak</th>
                                <th>Produk</th>
                                <th>Qty</th>
                                <th>Timbangan Kendaraan</th>
                                <th>Nopol</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($penerimaanItem as $item)
                                <tr>
                                    <td>{{ $item->kodekontrak }}</td>
                                    <td>{{ $item->tipe . ' ' . $item->kategori . ' ' . $item->warna }}</td>
                                    <td>{{ $item->qty . ' ' . $item->package }}</td>
                                    <td>
                                        Penuh: {{ $item->berat_trukpenuh }} Kosong: {{ $item->berat_trukkosong }}
                                    </td>
                                    <td>{{ $penerimaan->nopol }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </td>
            </tr>
        </table>
        <table class="table table-sm table-borderless text-nowrap mb-0 mt-0" style="color: black; border-color: black;">
            <tr>
                <td>
                    Catatan : {{ $penerimaan->keterangan }}
                </td>
            </tr>
        </table>
        <table class="table table-sm table-bordered text-nowrap"
            style="color: rgb(0, 0, 0); border-color: rgb(0, 0, 0);">
            <tr style="padding: 0px;margin: 0px">
                <td style="padding: 0px;margin: 0px">
                    <table class="table table-sm table-borderless text-nowrap text-center"
                        style="color: black; border-color: black;">
                        <tr>
                            <td style="width: 30%;">
                                <b>Diserahkan Oleh</b><br>
                                <img src="{{ asset('sign/driver/' . $penerimaan->signDriver) }}" alt=""
                                    width="150px"><br>
                                {{ $penerimaan->driver }}
                            </td>
                            <td style="width: 30%;">
                                <b>Diterima Oleh</b><br>
                                <img src="{{ asset('sign/operator/' . $penerimaan->signOp) }}" alt=""
                                    width="150px"><br>
                                {{ $penerimaan->operator }}
                            </td>
                            <td style="width: 40%;height: 100px">
                                <b>Mengetahui</b><br>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <script>
            window.print();
        </script>
    </body>
