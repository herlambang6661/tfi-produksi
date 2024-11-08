@extends('layouts.app')
@section('content')
    <style>
        td.cuspad0 {
            padding-top: 3px;
            padding-bottom: 3px;
            padding-right: 13px;
            padding-left: 13px;
        }

        td.cuspad1 {
            text-transform: uppercase;
        }

        td.cuspad2 {
            /* padding-top: 0.5px;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                padding-bottom: 0.5px;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                padding-right: 0.5px;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                padding-left: 0.5px;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                margin-top: 5px;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                margin-bottom: 5px;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                margin-right: 5px;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                margin-left: 5px; */
        }

        .unselectable {
            -webkit-user-select: none;
            -webkit-touch-callout: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            color: #cc0000;
            font-weight: bolder;
        }

        .small-swal {
            width: 300px !important;
            /* Sesuaikan ukuran modal */
        }
    </style>
    <div class="page">
        <!-- Sidebar -->
        @include('shared.sidebar')
        <!-- Navbar -->
        @include('shared.navbar')

        <style>
            .kbw-signature {
                width: 100%;
                height: 200px;
                border-radius: 5px;
            }

            #sigOperator canvas {
                width: 100% !important;
                height: auto;
                border-radius: 5px;
            }

            #sigPengemudi canvas {
                width: 100% !important;
                height: auto;
                border-radius: 5px;
            }
        </style>
        <div class="page-wrapper">
            <!-- Page header -->
            <div class="page-header d-print-none">
                <div class="container-xl">
                    <div class="row g-2 align-items-center">
                        <div class="col">
                            <!-- Page pre-title -->
                            <h2 class="page-title">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-truck">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M7 17m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                    <path d="M17 17m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                    <path d="M5 17h-2v-11a1 1 0 0 1 1 -1h9v12m-4 0h6m4 0h2v-6h-8m0 -5h5l3 5" />
                                </svg>
                                {{ $judul }}
                            </h2>
                            <div class="page-pretitle">
                                <ol class="breadcrumb breadcrumb-arrows" aria-label="breadcrumbs">
                                    <li class="breadcrumb-item">
                                        <a href="{{ url('dashboard') }}">
                                            <i class="fa-solid fa-house"></i>
                                            Dashboard
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a href="#">
                                            <i class="fa-solid fa-warehouse"></i>
                                            Gudang
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item" aria-current="page">
                                        <a href="{{ route('gudang/penerimaan') }}">
                                            <i class="fa-solid fa-truck-ramp-box"></i>
                                            Penerimaan
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        <a href="#">
                                            <i class="fa-solid fa-circle-check"></i>
                                            {{ $judul }}
                                        </a>
                                    </li>
                                </ol>
                            </div>
                        </div>

                        <!-- Page title actions -->
                        <div class="col-auto ms-auto d-print-none">
                            <div class="btn-list">
                                <div class="d-none d-sm-inline-block">
                                    <h1 style="font-size: 50px;">{{ $verifikasi->npb }}</h1>
                                </div>
                                <div class="d-sm-none btn-icon">
                                    <h1 style="font-size: 15px;">{{ $verifikasi->npb }}</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Page body -->
            <div class="page-body">
                <div class="container-xl">
                    <form method="post" id="formVerifikasi" name="formVerifikasi" method="post"
                        action="javascript:void(0)" enctype="multipart/form-data" accept-charset="utf-8">
                        <div class="row row-deck row-cards">
                            <div class="col-md-9">
                                <div class="card card-xl border-success shadow rounded">
                                    <div class="card-stamp card-stamp-lg">
                                        <div class="card-stamp-icon bg-success">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="icon icon-tabler icons-tabler-outline icon-tabler-rosette-discount-check">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path
                                                    d="M5 7.2a2.2 2.2 0 0 1 2.2 -2.2h1a2.2 2.2 0 0 0 1.55 -.64l.7 -.7a2.2 2.2 0 0 1 3.12 0l.7 .7c.412 .41 .97 .64 1.55 .64h1a2.2 2.2 0 0 1 2.2 2.2v1c0 .58 .23 1.138 .64 1.55l.7 .7a2.2 2.2 0 0 1 0 3.12l-.7 .7a2.2 2.2 0 0 0 -.64 1.55v1a2.2 2.2 0 0 1 -2.2 2.2h-1a2.2 2.2 0 0 0 -1.55 .64l-.7 .7a2.2 2.2 0 0 1 -3.12 0l-.7 -.7a2.2 2.2 0 0 0 -1.55 -.64h-1a2.2 2.2 0 0 1 -2.2 -2.2v-1a2.2 2.2 0 0 0 -.64 -1.55l-.7 -.7a2.2 2.2 0 0 1 0 -3.12l.7 -.7a2.2 2.2 0 0 0 .64 -1.55v-1" />
                                                <path d="M9 12l2 2l4 -4" />
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <div class="card-header">
                                            <h3 class="card-title">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="icon icon-tabler icons-tabler-outline icon-tabler-arrow-narrow-right-dashed">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M5 12h.5m3 0h1.5m3 0h6" />
                                                    <path d="M15 16l4 -4" />
                                                    <path d="M15 8l4 4" />
                                                </svg>
                                                Nomor Penerimaan Barang : {{ $verifikasi->npb }}
                                            </h3>
                                        </div>
                                        <div class="card-header">
                                            <div class="row row-cards">
                                                <div class="col-md-6">
                                                    <label class="form-label">Tanggal Kedatangan</label>
                                                    <input type="hidden" name="idkontrak" id="idkontrak"
                                                        value="{{ Crypt::encryptString($verifikasi->npb) }}">
                                                    <input type="hidden" name="npb" id="npb"
                                                        value="{{ $verifikasi->npb }}">
                                                    <input type="date" name="tanggal" id="tanggal" class="form-control"
                                                        value="{{ $verifikasi->tanggal }}">
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">Nopol</label>
                                                    <input type="text" class="form-control" name="nopol"
                                                        value="{{ $verifikasi->nopol }}">
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="form-label">NIK KTP</label>
                                                    <input type="text" class="form-control" name="ktp"
                                                        value="{{ $verifikasi->ktp }}">
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="form-label">Pengemudi</label>
                                                    <input type="text" class="form-control" name="driver"
                                                        value="{{ $verifikasi->driver }}">
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="form-label">Operator</label>
                                                    <input type="text" class="form-control" name="operator"
                                                        value="{{ $verifikasi->operator }}">
                                                </div>
                                                <div class="col-md-12">
                                                    <label class="form-label">Catatan</label>
                                                    <textarea name="keterangan" class="form-control" cols="3" rows="3">
                                                        {{ $verifikasi->keterangan }}
                                                    </textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-header">
                                            <div class="col card-title h3">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="icon icon-tabler icons-tabler-outline icon-tabler-arrow-narrow-right-dashed">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M5 12h.5m3 0h1.5m3 0h6" />
                                                    <path d="M15 16l4 -4" />
                                                    <path d="M15 8l4 4" />
                                                </svg>
                                                Data Produk
                                            </div>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table table-transparent table-nowrap table-hover">
                                                @foreach ($verifikasiItm as $no => $data)
                                                    <tbody>
                                                        <tr class="my-0 py-1 bg-dark">
                                                            <td colspan="7" class="my-0 py-1">
                                                            </td>
                                                        </tr>
                                                        <tr class="trBarangHead_{{ $no }}">
                                                            <td colspan="7">
                                                                <div class="row">
                                                                    <div class="col">
                                                                        <input type="hidden" name="statusDel[]"
                                                                            id="statusDel_{{ $no }}"
                                                                            value="0">
                                                                        <input type="hidden" name="idItm[]"
                                                                            value="{{ $data->id }}">
                                                                        <p
                                                                            class="strong mb-1 textBarang_{{ $no }} h2">
                                                                            {{ substr($data->kodekontrak, 0, 3) }}-{{ substr($data->kodekontrak, 3, 5) }}
                                                                        </p>
                                                                        <div
                                                                            class="text-secondary textBarang_{{ $no }}">
                                                                            {{ strtoupper($data->tipe) . ' ' . strtoupper($data->kategori) . ' ' . strtoupper($data->warna) }}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr class="trBarang_{{ $no }} bg-success-lt">
                                                            <th class="text-center text-dark" style="width: 15%">Berat
                                                                (Kontrak)
                                                            </th>
                                                            <th class="text-center text-dark" style="width: 15%">Berat
                                                                Truk
                                                                Penuh</th>
                                                            <th class="text-center text-dark" style="width: 15%">Berat
                                                                Truk
                                                                Kosong</th>
                                                            <th class="text-center text-dark" style="width: 15%">Qty</th>
                                                            <th class="text-center text-dark" style="width: 1%">kedatangan
                                                                ke-
                                                            </th>
                                                            <th class="text-center text-dark thJenis">Jenis Satuan</th>
                                                        </tr>
                                                        <tr class="trBarang_{{ $no }}">
                                                            <td class="text-center" style="vertical-align: baseline;">
                                                                <input type="number" min="1" name="berat[]"
                                                                    id="berat_{{ $no }}"
                                                                    class="form-control formBarang_{{ $no }}"
                                                                    value="{{ $data->berat }}">
                                                            </td>
                                                            <td class="text-center" style="vertical-align: baseline;">
                                                                <input type="number" min="1" name="berat_penuh[]"
                                                                    id="berat_penuh_{{ $no }}"
                                                                    class="form-control formBarang_{{ $no }}"
                                                                    value="{{ $data->berat }}">
                                                            </td>
                                                            <td class="text-center" style="vertical-align: baseline;">
                                                                <input type="number" min="1"
                                                                    name="berat_kosong[]"
                                                                    id="berat_kosong_{{ $no }}"
                                                                    class="form-control formBarang_{{ $no }}"
                                                                    value="{{ $data->berat }}">
                                                            </td>
                                                            <td class="text-center">
                                                                <input type="number" min="1" name="qty[]"
                                                                    id="qty_{{ $no }}"
                                                                    class="form-control formBarang_{{ $no }}"
                                                                    value="{{ $data->qty }}">
                                                            </td>
                                                            <td class="text-center">
                                                                <input type="number" min="1"
                                                                    name="kedatangan_ke[]"
                                                                    id="kedatangan_ke_{{ $no }}"
                                                                    class="form-control formBarang_{{ $no }}">
                                                            </td>
                                                            <td class="text-center">
                                                                <select name="jenis[]"
                                                                    class="form-select formBarang_{{ $no }} select2Jenis">
                                                                </select>
                                                            </td>
                                                        </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                            <script>
                                                function deleteItem(no) {
                                                    $('#btnRestore' + no).show();
                                                    $('#btnDelete' + no).hide();
                                                    $('.textBarang_' + no).css("text-decoration", "line-through");
                                                    $('.textBarang_' + no).addClass('cursor-not-allowed');
                                                    $('.formBarang_' + no).prop('disabled', true);
                                                    $('.formBarang_' + no).addClass('cursor-not-allowed');
                                                    $('.trBarangHead_' + no).addClass('bg-danger-lt');
                                                    $('.trBarang_' + no).addClass('bg-danger-lt');
                                                    $('.trBarang_' + no).hide();
                                                    $('#statusDel_' + no).val(1);
                                                }

                                                function restoreItem(no) {
                                                    $('#btnRestore' + no).hide();
                                                    $('#btnDelete' + no).show();
                                                    $('.textBarang_' + no).css("text-decoration", "");
                                                    $('.textBarang_' + no).removeClass('cursor-not-allowed');
                                                    $('.formBarang_' + no).prop('disabled', false);
                                                    $('.formBarang_' + no).removeClass('cursor-not-allowed');
                                                    $('.trBarangHead_' + no).removeClass('bg-danger-lt');
                                                    $('.trBarang_' + no).removeClass('bg-danger-lt');
                                                    $('.trBarang_' + no).show();
                                                    $('#statusDel_' + no).val(0);
                                                }
                                            </script>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="row row-deck row-cards">
                                    <div class="col-md-12">
                                        <div class="alert alert-success shadow rounded" role="alert">
                                            <h4 class="alert-title">Informasi</h4>
                                            <div class="text-secondary"
                                                style="text-align: justify;text-justify: inter-word;">Cek kembali inputan
                                                anda, jika sudah yakin benar
                                                silahkan klik tombol Simpan</div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="card card-xl border-success shadow rounded">
                                            <div class="card-stamp card-stamp-lg">
                                                <div class="card-stamp-icon bg-success">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="icon icon-tabler icons-tabler-outline icon-tabler-truck">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path d="M7 17m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                                        <path d="M17 17m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                                        <path
                                                            d="M5 17h-2v-11a1 1 0 0 1 1 -1h9v12m-4 0h6m4 0h2v-6h-8m0 -5h5l3 5" />
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="table-responsive">
                                                <div class="card-body">
                                                    <h3 class="card-title h3">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                            height="24" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            class="icon icon-tabler icons-tabler-outline icon-tabler-arrow-narrow-right-dashed">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                            <path d="M5 12h.5m3 0h1.5m3 0h6" />
                                                            <path d="M15 16l4 -4" />
                                                            <path d="M15 8l4 4" />
                                                        </svg>
                                                        Paraf
                                                    </h3>
                                                    <div class="row row-cards">
                                                        <div class="col-md-12">
                                                            <label class="form-label">
                                                                <div class="row">
                                                                    <div class="col">
                                                                        Paraf Operator
                                                                    </div>
                                                                    <div class="col-auto ms-auto">
                                                                        <button id="clearOperator"
                                                                            class="btn btn-danger btn-sm">
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                width="24" height="24"
                                                                                viewBox="0 0 24 24" fill="none"
                                                                                stroke="currentColor" stroke-width="2"
                                                                                stroke-linecap="round"
                                                                                stroke-linejoin="round"
                                                                                class="icon icon-tabler icons-tabler-outline icon-tabler-rotate">
                                                                                <path stroke="none" d="M0 0h24v24H0z"
                                                                                    fill="none" />
                                                                                <path
                                                                                    d="M19.95 11a8 8 0 1 0 -.5 4m.5 5v-5h-5" />
                                                                            </svg>
                                                                            Hapus
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </label>
                                                            <div class="col-md-12">
                                                                <div id="sigOperator"></div>
                                                                <textarea id="signature64Operator" name="signedOperator" style="display: none"></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <label class="form-label">
                                                                <div class="row">
                                                                    <div class="col">
                                                                        Paraf Pengemudi
                                                                    </div>
                                                                    <div class="col-auto ms-auto">
                                                                        <button id="clearPengemudi"
                                                                            class="btn btn-danger btn-sm">
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                width="24" height="24"
                                                                                viewBox="0 0 24 24" fill="none"
                                                                                stroke="currentColor" stroke-width="2"
                                                                                stroke-linecap="round"
                                                                                stroke-linejoin="round"
                                                                                class="icon icon-tabler icons-tabler-outline icon-tabler-rotate">
                                                                                <path stroke="none" d="M0 0h24v24H0z"
                                                                                    fill="none" />
                                                                                <path
                                                                                    d="M19.95 11a8 8 0 1 0 -.5 4m.5 5v-5h-5" />
                                                                            </svg>
                                                                            Hapus
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </label>
                                                            <div class="col-md-12">
                                                                <div id="sigPengemudi"></div>
                                                                <textarea id="signature64Pengemudi" name="signedPengemudi" style="display: none"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <script type="text/javascript">
                                                        var sigOperator = $('#sigOperator').signature({
                                                            syncField: '#signature64Operator',
                                                            syncFormat: 'PNG'
                                                        });
                                                        var sigPengemudi = $('#sigPengemudi').signature({
                                                            syncField: '#signature64Pengemudi',
                                                            syncFormat: 'PNG'
                                                        });
                                                        $('#clearOperator').click(function(e) {
                                                            e.preventDefault();
                                                            sigOperator.signature('clear');
                                                            $("#signature64Operator").val('');
                                                        });
                                                        $('#clearPengemudi').click(function(e) {
                                                            e.preventDefault();
                                                            sigPengemudi.signature('clear');
                                                            $("#signature64Pengemudi").val('');
                                                        });
                                                    </script>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary" id="submitVerifikasi">
                                    <svg style="margin-ridht: 5px" xmlns="http://www.w3.org/2000/svg" width="24"
                                        height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-device-floppy">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" />
                                        <path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                        <path d="M14 4l0 4l-6 0l0 -4" />
                                    </svg>
                                    Simpan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                @include('shared.footer')

            </div>
        </div>
    @endsection
