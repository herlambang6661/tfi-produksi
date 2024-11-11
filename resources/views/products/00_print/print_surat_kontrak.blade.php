<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Surat Kontrak - PT TFI (Stand Alone).</title>
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
                <i>{{ $data->id }}</i>
            </div>
        </div>
    </div>
    <table class="table table-sm table-bordered text-nowrap mb-0" style="color: black; border-color: black;">
        <tr>
            <td>
                <center>
                    <h1>SURAT KONTRAK</h1>
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
                                <td>Noform</td>
                                <td>:</td>
                                <td>{{ $data->noform }}</td>
                            </tr>
                            <tr>
                                <td>Tanggal</td>
                                <td>:</td>
                                <td>{{ Carbon::parse($data->tanggal)->isoFormat('D MMMM Y') }}</td>
                            </tr>
                            <tr>
                                <td>Entitas</td>
                                <td>:</td>
                                <td>{{ $data->entitas }}</td>
                            </tr>
                            <tr>
                                <td>Dibeli</td>
                                <td>:</td>
                                <td>{{ $data->dibeli }}</td>
                            </tr>

                        </table>
                    </div>
                    <div class="col">
                        <table class="table-sm table-borderless text-nowrap text-start fw-bolder">
                            <tr>
                                <td>Supplier</td>
                                <td>:</td>
                                <td>{{ $data->supplier }}</td>
                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <td>:</td>
                                <td>{{ $dataSupp->alamat }}</td>
                            </tr>
                            <tr>
                                <td>Kota-Provinsi</td>
                                <td>:</td>
                                <td>{{ $dataSupp->kota }}, {{ $dataSupp->provinsi }}</td>
                            </tr>
                            <tr>
                                <td>Telp</td>
                                <td>:</td>
                                <td>{{ $dataSupp->telp }}</td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>:</td>
                                <td>{{ $dataSupp->email }}</td>
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
                            <th>No</th>
                            <th>Product</th>
                            <th>QNT (KG)</th>
                            <th>HARGA</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dataItm as $key => $value)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>
                                    <p class="strong mb-1">{{ $value->id_kontrak }}</p>
                                    <div class="text-secondary">{{ $value->tipe }}, {{ $value->kategori }},
                                        {{ $value->warna }}</div>
                                </td>
                                <td class="text-center">
                                    {{ $value->berat }}
                                </td>
                                <td class="text-end">{{ $value->harga }}</td>
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
                Catatan : {{ $data->keterangan }}
            </td>
        </tr>
    </table>
    <script>
        window.print();
    </script>
</body>

</html>
