<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>FILE PDF SURAT KONTRAK</title>
    <style>
        /* Reset and base styles */
        body,
        html {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            line-height: 1.5;
            font-size: 12px;
        }

        /* Page setup for A4 size */
        @page {
            size: A4;
            margin: 15mm;
        }

        .container {
            width: 90%;
            max-width: 90%;
            padding: 10mm;
        }

        /* Layout styles */
        .row {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            margin-bottom: 15px;
        }

        .row-noform-tanggal {
            display: flex;
            justify-content: space-between;
            width: 100%;
        }

        .col-6 {
            flex: 0 0 48%;
        }

        .text-end {
            text-align: right;
        }

        /* Custom styles for specific sections */
        h1 {
            font-size: 16px;
            margin: 0;
            line-height: 1.2;
        }

        .h3 {
            font-size: 14px;
            margin-bottom: 5px;
            font-weight: bold;
        }

        address {
            font-style: normal;
            margin-bottom: 10px;
        }

        /* Table styling */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            padding: 8px 12px;
            text-align: left;
            border: 1px solid #ddd;
            font-size: 12px;
        }

        th {
            background-color: #f4f4f4;
        }

        .text-center {
            text-align: center;
        }

        .strong {
            font-weight: bold;
        }

        /* Footer styling */
        .note {
            font-size: 10px;
            color: #777;
            margin-top: 20px;
        }

        /* Responsive design */
        @media (max-width: 768px) {
            .col-6 {
                flex: 0 0 100%;
                margin-bottom: 15px;
            }

            h1 {
                font-size: 14px;
            }

            .h3 {
                font-size: 12px;
            }

            table th,
            table td {
                font-size: 10px;
                padding: 6px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Row 1 - noform and tanggal -->
        <div class="row-noform-tanggal">
            <div>
                <h1>{{ $data->noform }}</h1>
            </div>
            <div class="text-end">
                <h1>{{ \Carbon\Carbon::parse($data->tanggal)->format('d/m/Y') }}</h1>
            </div>
        </div>

        <!-- Row 2 - entitas and dibeli -->
        <div class="row">
            <div class="col-6">
                <p class="h3">{{ $data->entitas }}</p>
                <address>Dibeli : {{ $data->dibeli }}</address>
            </div>

            <!-- Row 3 - supplier and address info -->
            <div class="col-6 text-end">
                <p class="h3">{{ $data->supplier }}</p>
                <address>
                    {{ $dataSupp->alamat }}<br>
                    {{ $dataSupp->kota }}, {{ $dataSupp->provinsi }}<br>
                    {{ $dataSupp->telp }}<br>
                    {{ $dataSupp->email }}
                </address>
            </div>
        </div>

        <!-- Table with products -->
        <table>
            <thead>
                <tr>
                    <th class="text-center" style="width: 1%"></th>
                    <th>Product</th>
                    <th class="text-center" style="width: 1%">Qnt (Kg)</th>
                    <th class="text-end" style="width: 1%">Harga</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dataItm as $key => $value)
                    <tr>
                        <td class="text-center">{{ $key + 1 }}</td>
                        <td>
                            <p class="strong mb-1">{{ $value->id_kontrak }}</p>
                            <div class="text-secondary">{{ $value->tipe }} {{ $value->kategori }}
                                {{ $value->warna }}</div>
                        </td>
                        <td class="text-center">{{ $value->berat }}</td>
                        <td class="text-end">{{ $value->harga }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Footer Note -->
        <p class="note">*Note: {{ $data->keterangan }}</p>
    </div>
</body>

</html>
