@extends('layouts.app')
@section('content')
    <link href="{{ asset('assets/extentions/apexcharts/dist/apexcharts.css') }}" rel="stylesheet" />

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

        .overlay {
            position: fixed;
            top: 0;
            z-index: 100;
            width: 100%;
            height: 100%;
            display: none;
            background: rgba(0, 0, 0, 0.379);
        }

        .overlayModals {
            position: fixed;
            top: 0;
            z-index: 100;
            width: 100%;
            height: 100%;
            display: none;
            background: rgba(0, 0, 0, 0.379);
        }

        .cv-spinner {
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* Loader style */

        .loader {
            width: 48px;
            height: 48px;
            display: block;
            margin: 15px auto;
            position: relative;
            color: #ff0000c3;
            box-sizing: border-box;
            animation: rotation 1s linear infinite;
        }

        .loader::after,
        .loader::before {
            content: '';
            box-sizing: border-box;
            position: absolute;
            width: 24px;
            height: 24px;
            top: 50%;
            left: 50%;
            transform: scale(0.5) translate(0, 0);
            background-color: #ff0000c3;
            border-radius: 50%;
            animation: animloader 1s infinite ease-in-out;
        }

        .loader::before {
            background-color: #ffffffba;
            transform: scale(0.5) translate(-48px, -48px);
        }

        @keyframes rotation {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        @keyframes animloader {
            50% {
                transform: scale(1) translate(-50%, -50%);
            }
        }

        #flash-toggle {
            display: none;
        }
    </style>
    <div class="overlay">
        <div class="cv-spinner">
            <span class="loader"></span>
        </div>
    </div>
    <div class="page bg-success-lt">
        <!-- Sidebar -->
        @include('shared.sidebar')
        <!-- Navbar -->
        @include('shared.navbar')

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
                                    stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-apps">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path
                                        d="M4 4m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                                    <path
                                        d="M4 14m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                                    <path
                                        d="M14 14m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                                    <path d="M14 7l6 0" />
                                    <path d="M17 4l0 6" />
                                </svg>
                                {{ $judul }} {{ $pengebonan->formproduksi }}
                            </h2>
                            <div class="page-pretitle">
                                <ol class="breadcrumb" aria-label="breadcrumbs">
                                    <li class="breadcrumb-item">
                                        <a href="{{ url('dashboard') }}">
                                            <i class="fa-solid fa-house"></i>
                                            Dashboard
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a href="#">
                                            <i class="fa-solid fa-industry"></i>
                                            Produksi
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item" aria-current="page">
                                        <a href="{{ route('produksi.pengebonan') }}">
                                            <i class="fa-solid fa-people-carry-box"></i>
                                            Production Planning
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        <a href="#">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                            {{ $judul }}
                                        </a>
                                    </li>
                                </ol>
                            </div>
                        </div>

                        <!-- Page title actions -->
                        <div class="col-auto ms-auto d-print-none">
                            <div class="btn-list">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Page body -->
            <div class="page-body">
                <div class="container-xl">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card card-xl border-success shadow rounded mb-1 py-1 px-1">
                                <b class="text-center">Tulis Kode</b>
                                <input type="text" class="form-control border-success mb-2" name="qrText" id="qrText"
                                    onkeydown = "if (event.keyCode == 13)  fetchQr()"
                                    placeholder="Contoh : FBB0001-1-001 (Tekan Enter Jika Sudah)">
                                <a href="#modalTambahItem" class="btn btn-link bg-dark-lt border-primary text-dark"
                                    data-bs-toggle="modal" data-toggle="tooltip" data-placement="top"
                                    title="Lihat Detail Data Karyawan" data-item="' . $row->nama . '"
                                    data-id="' . $row->id . '">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-search">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                                        <path d="M21 21l-6 -6" />
                                    </svg>
                                    Cari Bahan Baku
                                </a>
                            </div>
                            <div class="card card-xl border-success shadow rounded mb-3 py-1 px-1">
                                <b class="text-center">Scan QR Code</b>
                                <div class="row" style="font-size: 10px">
                                    <div class="col">
                                        <b>Device has camera: </b>
                                        <span id="cam-has-camera"></span>
                                    </div>
                                    <div class="col text-end">
                                        <b>Camera has flash: </b>
                                        <span id="cam-has-flash"></span>
                                    </div>
                                </div>
                                <video class="mb-1 rounded" id="qr-video" style="width: 100%; height: 100%;" autoplay
                                    playsinline>
                                </video>
                                <div class="row">
                                    <div class="col">
                                        <button id="start-button" class="btn btn-success btn-sm">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="icon icon-tabler icons-tabler-outline icon-tabler-player-play">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M7 4v16l13 -8z" />
                                            </svg>
                                            Start
                                        </button>
                                        <button id="stop-button" class="btn btn-danger btn-sm">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="icon icon-tabler icons-tabler-outline icon-tabler-player-stop">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path
                                                    d="M5 5m0 2a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2z" />
                                            </svg>
                                            Stop
                                        </button>
                                        <div>
                                            <button id="flash-toggle" class="btn btn-warning btn-sm">
                                                📸 Flash:
                                                <span id="flash-state">off</span>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            {{-- <label class="col-3 col-form-label">
                                                <b>Camera:</b>
                                            </label> --}}
                                            <div class="col">
                                                <select id="cam-list" class="form-select form-select-sm border-success">
                                                    <option value="environment" selected>
                                                        Environment Facing (default)
                                                    </option>
                                                    <option value="user">User Facing</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card card-xl border-success shadow rounded">
                                <div id="chart"></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card card-xl border-success shadow rounded">
                                <div id="chart2"></div>
                            </div>
                        </div>
                        <div class="col-md-12" onkeydown="return event.key != 'Enter';">
                            <div class="card card-xl border-success shadow rounded mb-3">
                                <div class="table-responsive">
                                    <form id="formPengebonan" name="formPengebonan" method="post"
                                        action="javascript:void(0)">
                                        @csrf
                                        <input id="idf" value="1" type="hidden">
                                        <input name="nomorform" value="{{ $pengebonan->formproduksi }}" type="hidden">
                                        <div class="card-body px-1 py-1 my-1 mx-1">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label class="form-label">Tanggal Input</label>
                                                    <input type="date" class="form-control border-dark" name="tanggal"
                                                        id="tanggal" value="{{ $pengebonan->tanggal }}">
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">Operator</label>
                                                    <input type="text" class="form-control border-dark"
                                                        name="operator" id="operator"
                                                        value="{{ $pengebonan->operator }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body px-1 pt-2 pb-1 mt-1 mx-1">
                                            <button id="tambahItem" type="button"
                                                class="btn btn-link bg-dark-lt border-success text-dark">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="text-success icon icon-tabler icons-tabler-outline icon-tabler-file-spreadsheet">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                                                    <path
                                                        d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />
                                                    <path d="M8 11h8v7h-8z" />
                                                    <path d="M8 15h8" />
                                                    <path d="M11 11v7" />
                                                </svg>
                                                Import Dari Excel
                                            </button>
                                        </div>
                                        <div class="card-body px-1 py-1 my-1 mx-1 text-end">
                                            <table id="detail_transaksi" class="control-group text-nowrap table-bordered"
                                                border="0" style="width: 100%;text-align:center;">
                                                <thead class="" style="font-weight: bold;">
                                                    <tr>
                                                        <td class="px-0 py-0" style="width: 1%"></td>
                                                        <td style="width: 200px">
                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                style="margin-right: 5px" width="24" height="24"
                                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                                stroke-width="2" stroke-linecap="round"
                                                                stroke-linejoin="round"
                                                                class="icon icon-tabler icons-tabler-outline icon-tabler-category-plus">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                                <path
                                                                    d="M4 4h6v6h-6zm10 0h6v6h-6zm-10 10h6v6h-6zm10 3h6m-3 -3v6" />
                                                            </svg>
                                                            Kode Bahan Baku
                                                        </td>
                                                        <td style="width: 200px">
                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                style="margin-right: 5px" width="24" height="24"
                                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                                stroke-width="2" stroke-linecap="round"
                                                                stroke-linejoin="round"
                                                                class="icon icon-tabler icons-tabler-outline icon-tabler-category-2">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                                <path d="M14 4h6v6h-6z" />
                                                                <path d="M4 14h6v6h-6z" />
                                                                <path d="M17 17m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                                                                <path d="M7 7m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                                                            </svg>
                                                            Bahan Baku
                                                        </td>
                                                        <td style="width: 200px">
                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                style="margin-right: 5px" width="24" height="24"
                                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                                stroke-width="2" stroke-linecap="round"
                                                                stroke-linejoin="round"
                                                                class="icon icon-tabler icons-tabler-outline icon-tabler-category-2">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                                <path d="M14 4h6v6h-6z" />
                                                                <path d="M4 14h6v6h-6z" />
                                                                <path d="M17 17m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                                                                <path d="M7 7m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                                                            </svg>
                                                            Jenis
                                                        </td>
                                                        <td style="width: 200px">
                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                style="margin-right: 5px" width="24" height="24"
                                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                                stroke-width="2" stroke-linecap="round"
                                                                stroke-linejoin="round"
                                                                class="icon icon-tabler icons-tabler-outline icon-tabler-brand-speedtest">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                                <path d="M5.636 19.364a9 9 0 1 1 12.728 0" />
                                                                <path d="M16 9l-4 4" />
                                                            </svg>
                                                            Berat
                                                        </td>
                                                        <td style="width: 200px">
                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                style="margin-right: 5px" width="24" height="24"
                                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                                stroke-width="2" stroke-linecap="round"
                                                                stroke-linejoin="round"
                                                                class="icon icon-tabler icons-tabler-outline icon-tabler-coins">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                                <path
                                                                    d="M9 14c0 1.657 2.686 3 6 3s6 -1.343 6 -3s-2.686 -3 -6 -3s-6 1.343 -6 3z" />
                                                                <path d="M9 14v4c0 1.656 2.686 3 6 3s6 -1.344 6 -3v-4" />
                                                                <path
                                                                    d="M3 6c0 1.072 1.144 2.062 3 2.598s4.144 .536 6 0c1.856 -.536 3 -1.526 3 -2.598c0 -1.072 -1.144 -2.062 -3 -2.598s-4.144 -.536 -6 0c-1.856 .536 -3 1.526 -3 2.598z" />
                                                                <path d="M3 6v10c0 .888 .772 1.45 2 2" />
                                                                <path d="M3 11c0 .888 .772 1.45 2 2" />
                                                            </svg>
                                                            Supplier
                                                        </td>
                                                    </tr>
                                                </thead>
                                                @foreach ($pengebonanItem as $item)
                                                    <tr id="btn-remove{{ $item->kodeproduksi }}">
                                                        <td style="align: center">
                                                            <button class="btn btn-danger btn-icon remove btnHapusForm"
                                                                type="button" data-id="{{ $item->id }}"
                                                                data-noform="{{ $item->formproduksi }}"
                                                                data-kode="{{ $item->subkode }}"
                                                                data-kodeproduksi="{{ $item->kodeproduksi }}"
                                                                data-typehapus="item">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="24" viewBox="0 0 24 24" fill="none"
                                                                    stroke="currentColor" stroke-width="2"
                                                                    stroke-linecap="round" stroke-linejoin="round"
                                                                    class="icon icon-tabler icons-tabler-outline icon-tabler-trash">
                                                                    <path stroke="none" d="M0 0h24v24H0z"
                                                                        fill="none" />
                                                                    <path d="M4 7l16 0" />
                                                                    <path d="M10 11l0 6" />
                                                                    <path d="M14 11l0 6" />
                                                                    <path
                                                                        d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                                                    <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                                                </svg>
                                                            </button>
                                                        </td>
                                                        <td>
                                                            {{ $item->subkode }}
                                                            <div class="kode_{{ $item->idQR }}">
                                                                <input type="hidden" name="id_item[]"
                                                                    value="{{ $item->idQR }}">
                                                                <input type="hidden" name="oldKodeproduksi[]"
                                                                    value="{{ $item->kodeproduksi }}">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            {{ $item->type . ' ' . $item->kategori . ' ' . $item->warna }}
                                                        </td>
                                                        <td>
                                                            {{ $item->package }}
                                                        </td>
                                                        <td>
                                                            {{ $item->berat }}
                                                        </td>
                                                        <td>
                                                            {{ $item->supplier }}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </table>
                                        </div>
                                        <div class="card-footer px-1 py-1 my-1 mx-1 text-end">
                                            <button id="submitPengebonan" type="submit" class="btn btn-success">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="icon icon-tabler icons-tabler-outline icon-tabler-device-floppy">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path
                                                        d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" />
                                                    <path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                                    <path d="M14 4l0 4l-6 0l0 -4" />
                                                </svg>
                                                Simpan Perubahan
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div id="notifications"></div>
                        </div>
                    </div>
                    <div style="display: none">
                        <select id="inversion-mode-select">
                            <option value="original">Scan original (dark QR code on bright background)</option>
                            <option value="invert">Scan with inverted colors (bright QR code on dark background)
                            </option>
                            <option value="both">Scan both</option>
                        </select>
                        <br>
                    </div>
                    <b style="display: none">Detected QR code: </b>
                    <span id="cam-qr-result" style="display: none">None</span>
                    <b style="display: none">Last detected at: </b>
                    <span id="cam-qr-result-timestamp" style="display: none"></span>
                </div>
                {{-- Modals --}}
                {{-- ============== Modal add --}}
                <div class="modal modal-blur fade" id="modalTambahItem" tabindex="-1" role="dialog"
                    aria-hidden="true">
                    {{-- <div class="overlayModals">
                        <div class="cv-spinner">
                            <span class="loader">
                            </span>
                        </div>
                    </div> --}}
                    <div class="modal-dialog modal-xl text-dark" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-database-search">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M4 6c0 1.657 3.582 3 8 3s8 -1.343 8 -3s-3.582 -3 -8 -3s-8 1.343 -8 3" />
                                        <path d="M4 6v6c0 1.657 3.582 3 8 3m8 -3.5v-5.5" />
                                        <path d="M4 12v6c0 1.657 3.582 3 8 3" />
                                        <path d="M18 18m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                                        <path d="M20.2 20.2l1.8 1.8" />
                                    </svg>
                                    Cari Item Planning
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="formFilterPengebonan" name="formFilterPengebonan" method="post"
                                    action="javascript:void(0)">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-3 col-sm-12">
                                            <div class="mb-1">
                                                <label class="form-label">Nomor QR code</label>
                                                <input type="text" class="form-control" id="filter_noQR"
                                                    placeholder="Cth: FBB0001-1-001">
                                            </div>
                                            <div class="mb-1">
                                                <label class="form-label">ID Kontrak</label>
                                                <input type="text" class="form-control" id="filter_idKontrak"
                                                    placeholder="Cth: FBB0001">
                                            </div>
                                            <div class="mb-1">
                                                <label class="form-label">No. Penerimaan Barang</label>
                                                <input type="text" class="form-control" id="filter_npb"
                                                    placeholder="Cth: P240001">
                                            </div>
                                            <div class="mb-1">
                                                <label class="form-label">Supplier</label>
                                                <input type="text" class="form-control" id="filter_supplier"
                                                    placeholder="Cth: Tantra Fiber Industri. PT">
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-12">
                                            <div class="mb-1">
                                                <label class="form-label">Tanggal Kedatangan</label>
                                                <input type="date" class="form-control" id="filter_tanggal">
                                            </div>
                                            <div class="mb-1">
                                                <label class="form-label">Tipe Bahan Baku</label>
                                                <select name='tipe' class='form-select' id="filter_tipe"
                                                    style='width:100%;text-transform: uppercase;'></select>
                                            </div>
                                            <div class="mb-1">
                                                <label class="form-label">Kategori</label>
                                                <select name='kategori' class='form-select' id="filter_kategori"
                                                    style='width:100%;text-transform: uppercase;'></select>
                                            </div>
                                            <div class="mb-1">
                                                <label class="form-label">Warna</label>
                                                <select name='warna' class='form-select' id="filter_warna"
                                                    style='width:100%;text-transform: uppercase;'></select>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            <div class="card bg-success text-success-fg">
                                                <div class="card-stamp">
                                                    <div class="card-stamp-icon bg-white text-primary">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                            height="24" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            class="icon icon-tabler icons-tabler-outline icon-tabler-code">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                            <path d="M7 8l-4 4l4 4" />
                                                            <path d="M17 8l4 4l-4 4" />
                                                            <path d="M14 4l-4 16" />
                                                        </svg>
                                                    </div>
                                                </div>
                                                <div class="card-body py-2 px-2">
                                                    <div class="text-end">
                                                        <button type="button"
                                                            class="btn btn-icon bg-dark btn-sm text-success border-success mb-1"
                                                            id="btnClearHistory" style="opacity: 0.75;">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                height="24" viewBox="0 0 24 24" fill="none"
                                                                stroke="currentColor" stroke-width="2"
                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                class="icon icon-tabler icons-tabler-outline icon-tabler-trash">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                                <path d="M4 7l16 0" />
                                                                <path d="M10 11l0 6" />
                                                                <path d="M14 11l0 6" />
                                                                <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                                                <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                                            </svg>
                                                        </button>
                                                    </div>
                                                    <pre style="font-size: 12px; font-weight: bold; max-height: 260px;opacity: 0.75;" id="historyCommand"
                                                        class="text-green border shadow font-monospace">===================================================================
<svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-code"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 8l-4 4l4 4" /><path d="M17 8l4 4l-4 4" /><path d="M14 4l-4 16" /></svg> Command History : 
===================================================================
>> Accessed at {{ now()->format('d-m-Y H:i:s') }}</pre>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12 text-end mt-3">
                                            <button type="button" onclick="reloadTableResult()" class="btn btn-primary">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="icon icon-tabler icons-tabler-outline icon-tabler-search">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                                                    <path d="M21 21l-6 -6" />
                                                </svg>
                                                Cari
                                            </button>
                                        </div>
                                    </div>
                                </form>
                                <div class="hr-text mx-3">
                                    <span>Hasil</span>
                                </div>
                                <div id="hasil" class="text-center">
                                </div>
                                <table
                                    class="text-nowrap table card-table table-vcenter table-hover datatable datatable-listResult"
                                    style="width:100%;color:black;text-transform:uppercase;font-size: 12px">
                                    <tfoot>
                                        <tr>
                                            <th class="px-1 py-1 text-center" style="width: 1%">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="icon icon-tabler icons-tabler-outline icon-tabler-list-search">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M15 15m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                                                    <path d="M18.5 18.5l2.5 2.5" />
                                                    <path d="M4 6h16" />
                                                    <path d="M4 12h4" />
                                                    <path d="M4 18h4" />
                                                </svg>
                                            </th>
                                            <td class="px-1 th py-1" style="width: 1%">KodeBale</td>
                                            <td class="px-1 th py-1" style="width: 1%">KodeKontrak</td>
                                            <td class="px-1 th py-1" style="width: 1%">NPB</td>
                                            <td class="px-1 th py-1" style="width: 1%">Berat</td>
                                            <td class="px-1 th py-1" style="width: 1%">Package</td>
                                            <td class="px-1 th py-1" style="width: 1%">Tipe</td>
                                            <td class="px-1 th py-1" style="width: 1%">Kategori</td>
                                            <td class="px-1 th py-1" style="width: 1%">Warna</td>
                                            <td class="px-1 th py-1" style="width: 1%">supplier</td>
                                            <td class="px-1 th py-1" style="width: 1%">Tgl Kedatangan</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-link link-secondary ms-auto"
                                    data-bs-dismiss="modal">
                                    Kembali
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Modals --}}
                @include('shared.footer')
                <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
                <script>
                    window.Promise ||
                        document.write(
                            '<script src="https://cdn.jsdelivr.net/npm/promise-polyfill@8/dist/polyfill.min.js"><\/script>'
                        )
                    window.Promise ||
                        document.write(
                            '<script src="https://cdn.jsdelivr.net/npm/eligrey-classlist-js-polyfill@1.2.20171210/classList.min.js"><\/script>'
                        )
                    window.Promise ||
                        document.write(
                            '<script src="https://cdn.jsdelivr.net/npm/findindex_polyfill_mdn"><\/script>'
                        )
                </script>
                <script>
                    var options = {
                        title: {
                            text: "Warna"
                        },
                        theme: {
                            palette: 'palette2'
                        },
                        labels: [1, 2],
                        series: [1, 2],
                        // colors: [],
                        stroke: {
                            width: 4
                        },
                        dataLabels: {
                            enabled: true,
                            style: {
                                colors: ["#f2f3f4"]
                            },
                            background: {
                                enabled: true,
                                foreColor: "#2e4053",
                                borderWidth: 0
                            }
                        },
                        chart: {
                            width: 350,
                            type: "pie",
                        },
                        responsive: [{
                            breakpoint: 480,
                            options: {
                                chart: {
                                    width: 200
                                },
                                legend: {
                                    position: "bottom"
                                }
                            }
                        }]
                    };

                    var chart = new ApexCharts(document.querySelector("#chart"), options);
                    var chart2 = new ApexCharts(document.querySelector("#chart2"), options);
                    chart.render();
                    chart2.render();
                </script>
            </div>
        </div>

        <!--<script src="../qr-scanner.umd.min.js"></script>-->
        <!--<script src="../qr-scanner.legacy.min.js"></script>-->
        <script type="module">
            import QrScanner from "{{ asset('assets/extentions/qr-scanner.min.js') }}";
            const video = document.getElementById('qr-video');
            const camHasCamera = document.getElementById('cam-has-camera');
            const camList = document.getElementById('cam-list');
            const camHasFlash = document.getElementById('cam-has-flash');
            const flashToggle = document.getElementById('flash-toggle');
            const flashState = document.getElementById('flash-state');
            const camQrResult = document.getElementById('cam-qr-result');
            const camQrResultTimestamp = document.getElementById('cam-qr-result-timestamp');

            function setResult(label, result) {
                // console.log(result.data);
                // label.textContent = result.data;
                // camQrResultTimestamp.textContent = new Date().toString();
                // label.style.color = 'teal';
                // clearTimeout(label.highlightTimeout);
                // label.highlightTimeout = setTimeout(() => label.style.color = 'inherit', 100);

                $.ajax({
                    type: "POST",
                    url: "{{ route('getDecryptKode.decrypt') }}",
                    data: {
                        _token: "{{ csrf_token() }}",
                        keyword: result.data,
                        type: "scan",
                    },
                    beforeSend: function() {
                        scanner.stop();
                        $(".overlay").fadeIn(300);
                        // $("#inpt-qr").val("Memeriksa Data...");
                        // $("#inpt-qr").prop("disabled", true);
                        // $("#inpt-qr").addClass("cursor-not-allowed");
                        // Swal.fire({
                        //     title: "Sedang Memeriksa Data",
                        //     html: "Mohon menunggu, sedang mengambil data hasil scanning QR Code",
                        //     icon: "question",
                        //     timerProgressBar: true,
                        //     didOpen: () => {
                        //         Swal.showLoading();
                        //         const timer = Swal.getPopup().querySelector("b");
                        //         timerInterval = setInterval(() => {
                        //             timer.textContent = `${Swal.getTimerLeft()}`;
                        //         }, 100);
                        //     },
                        //     willClose: () => {
                        //         clearInterval(timerInterval);
                        //     }
                        // });
                        // Swal.showLoading()
                    },
                    success: function(response) {
                        // Swal.hideLoading({showDenyButton: false,});
                        var zippiSuccess = new Audio("{{ asset('sounds/scan-success.mp3') }}");
                        var zippiError = new Audio("{{ asset('sounds/scan-error.mp3') }}");

                        if (response.success == true) {
                            zippiSuccess.play();
                            $(".overlay").fadeOut(300);
                            // $("#inpt-qr").val(response.subkode);
                            // $("#inpt-qr").prop("disabled", false);
                            // $("#inpt-qr").removeClass("cursor-not-allowed");
                            if ($("#detail_transaksi").find(".kode_" + response.id).length) {
                                zippiError.play();
                                scanner.start();
                                $("#notifications").html(
                                    '<div class="alert alert-important alert-danger alert-dismissible" role="alert"><div class="d-flex"><div><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon alert-icon"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0"></path><path d="M12 8v4"></path><path d="M12 16h.01"></path></svg></div><div> Qr Code Sudah ditambahkan..</div></div></div>'
                                )
                                setTimeout(function() {
                                    $("#notifications").html('')
                                }, 3000);
                            } else {
                                var idf = document.getElementById("idf").value;
                                var detail_transaksi = document.getElementById("detail_transaksi");
                                var tr = document.createElement("tr");
                                tr.setAttribute("id", "btn-remove" + idf);
                                // Kolom 1 Hapus
                                var td = document.createElement("td");
                                td.setAttribute("align", "center");
                                td.setAttribute("style",
                                    ""
                                );
                                td.innerHTML +=
                                    '<button class="btn btn-danger btn-icon remove" type="button" onclick="hapusElemen(' +
                                    idf +
                                    ');"><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-trash"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg> </button>';
                                tr.appendChild(td);
                                // Kolom 2 Kode
                                var td = document.createElement("td");
                                td.innerHTML += response.subkode + '<div class="kode_' + response.id +
                                    '"><input type="hidden" name="id_item[]" value="' + response.id +
                                    '"><input type="hidden" name="oldKodeproduksi[]" value=""></div>';
                                tr.appendChild(td);
                                // Kolom 3 BB
                                var td = document.createElement("td");
                                td.innerHTML += response.tipe + " " + response.kategori + " " + response.warna;
                                tr.appendChild(td);
                                // Kolom 4 Jenis
                                var td = document.createElement("td");
                                td.innerHTML += response.package;
                                tr.appendChild(td);
                                // Kolom 5 Berat
                                var td = document.createElement("td");
                                td.innerHTML += response.beratsatuan;
                                tr.appendChild(td);
                                // Kolom 6 Supplier
                                var td = document.createElement("td");
                                td.innerHTML += response.supplier;
                                tr.appendChild(td);
                                detail_transaksi.appendChild(tr);
                                idf = (idf - 1) + 2;
                                document.getElementById("idf").value = idf;
                                scanner.start();
                            }
                        } else if (response.success == false) {
                            zippiError.play();
                            Swal.fire({
                                icon: "error",
                                title: response.message,
                                text: response.detail,
                                allowOutsideClick: false,
                                allowEscapeKey: false,
                            }).then((result) => {
                                /* Read more about isConfirmed, isDenied below */
                                if (result.isConfirmed) {
                                    scanner.start();
                                    $(".overlay").fadeOut(300);
                                }
                            });
                        }
                    },
                    error: function(data) {
                        zippiError.play();
                        scanner.start();
                        $(".overlay").fadeOut(300);
                        // $("#inpt-qr").val("");
                        // $("#inpt-qr").prop("disabled", false);
                    }
                });
            }
            // ####### Web Cam Scanning #######
            const scanner = new QrScanner(video, result => setResult(camQrResult, result), {
                onDecodeError: error => {
                    camQrResult.textContent = error;
                    camQrResult.style.color = 'inherit';
                },
                highlightScanRegion: true,
                highlightCodeOutline: true,
            });
            const updateFlashAvailability = () => {
                scanner.hasFlash().then(hasFlash => {
                    camHasFlash.textContent = hasFlash ? 'Yes' : 'No';
                    flashToggle.style.display = hasFlash ? 'inline-block' : 'none';
                });
            };
            QrScanner.hasCamera().then(hasCamera => camHasCamera.textContent = hasCamera ? 'Yes' : 'No');
            // for debugging
            window.scanner = scanner;
            document.getElementById('inversion-mode-select').addEventListener('change', event => {
                scanner.setInversionMode(event.target.value);
            });
            camList.addEventListener('change', event => {
                scanner.setCamera(event.target.value).then(updateFlashAvailability);
            });
            flashToggle.addEventListener('click', () => {
                scanner.toggleFlash().then(() => flashState.textContent = scanner.isFlashOn() ? 'on' : 'off');
            });
            document.getElementById('start-button').addEventListener('click', () => {
                // scanner.start();
                scanner.start().then(() => {
                    updateFlashAvailability();
                    // List cameras after the scanner started to avoid listCamera's stream and the scanner's stream being requested
                    // at the same time which can result in listCamera's unconstrained stream also being offered to the scanner.
                    // Note that we can also start the scanner after listCameras, we just have it this way around in the demo to
                    // start the scanner earlier.
                    QrScanner.listCameras(true).then(cameras => cameras.forEach(camera => {
                        const option = document.createElement('option');
                        option.value = camera.id;
                        option.text = camera.label;
                        camList.add(option);
                    }));
                });
            });
            document.getElementById('stop-button').addEventListener('click', () => {
                scanner.stop();
            });
            document.getElementById('tombolStart').addEventListener('click', () => {
                // scanner.start();
                scanner.start().then(() => {
                    updateFlashAvailability();
                    // List cameras after the scanner started to avoid listCamera's stream and the scanner's stream being requested
                    // at the same time which can result in listCamera's unconstrained stream also being offered to the scanner.
                    // Note that we can also start the scanner after listCameras, we just have it this way around in the demo to
                    // start the scanner earlier.
                    QrScanner.listCameras(true).then(cameras => cameras.forEach(camera => {
                        const option = document.createElement('option');
                        option.value = camera.id;
                        option.text = camera.label;
                        camList.add(option);
                    }));
                });
            });
            document.getElementById('tombolStop').addEventListener('click', () => {
                scanner.stop();
            });
        </script>

        <script type="text/javascript">
            var tableResult;

            function reloadTableResult() {
                var noQR = document.getElementById("filter_noQR").value;
                var idKontrak = document.getElementById("filter_idKontrak").value;
                var npb = document.getElementById("filter_npb").value;
                var supplier = document.getElementById("filter_supplier").value;
                var tanggal = document.getElementById("filter_tanggal").value;
                var tipe = document.getElementById("filter_tipe").value;
                var kategori = document.getElementById("filter_kategori").value;
                var warna = document.getElementById("filter_warna").value;
                var historyCommand = document.getElementById("historyCommand");
                var txtTipe = $('#filter_tipe :selected').text();
                var txtKategori = $('#filter_kategori :selected').text();
                var txtWarna = $('#filter_warna :selected').text();
                historyCommand.insertAdjacentHTML('beforeend', '<div id="two">>> Mencari : ' +
                    (noQR ? noQR + ' ' : '') +
                    (idKontrak ? idKontrak + ' ' : '') +
                    (npb ? npb + ' ' : '') +
                    (supplier ? supplier + ' ' : '') +
                    (tanggal ? tanggal + ' ' : '') +
                    (tipe ? txtTipe + ' ' : '') +
                    (kategori ? txtKategori + ' ' : '') +
                    (warna ? txtWarna + ' ' : '') + '</div>');

                $.ajax({
                    type: "POST",
                    url: "{{ route('pengebonan.getItemPengebonan') }}",
                    data: {
                        _token: "{{ csrf_token() }}",
                        // keyword: id,
                        noQR: noQR,
                        idKontrak: idKontrak,
                        npb: npb,
                        supplier: supplier,
                        tanggal: tanggal,
                        tipe: tipe,
                        kategori: kategori,
                        warna: warna,
                    },
                    beforeSend: function() {
                        $("#tunggu").fadeIn();
                        $("#hasil").fadeOut();
                    },
                    success: function(html) {
                        $("#tunggu").fadeOut();
                        $("#hasil").fadeIn();
                        $("#hasil").html(html);
                        historyCommand.insertAdjacentHTML('beforeend', "\n");
                        historyCommand.insertAdjacentHTML('beforeend', document.getElementById(
                            "resultCommand").value);
                        // document.getElementById("repeatOr").value = "";
                        // document.getElementById("repeatOr").focus();
                    }
                });

                tableResult.ajax.reload();
            }

            function hapusElemen(idf) {
                $("#btn-remove" + idf).remove();
            }

            if ($("#formPengebonan").length > 0) {
                $("#formPengebonan").validate({
                    rules: {
                        tanggal: {
                            required: true,
                        },
                        operator: {
                            required: true,
                        },
                        "id_item[]": "required",
                    },
                    messages: {
                        tanggal: {
                            required: 'Kolom ini tidak boleh kosong',
                        },
                        operator: {
                            required: 'Kolom ini tidak boleh kosong',
                        },
                        "id_item[]": "Kolom ini tidak boleh kosong",
                    },
                    highlight: function(element) {
                        // add a class "errorClass" to the element
                        $(element).addClass('border-danger');
                    },
                    unhighlight: function(element) {
                        // class "errorClass" remove from the element
                        $(element).removeClass('border-danger');
                    },

                    submitHandler: function(form) {
                        let formData = new FormData(form);
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $('#submitPengebonan').html(
                            '<i class="fa-solid fa-fw fa-spinner fa-spin"></i> Please Wait...');
                        $("#submitPengebonan").attr("disabled", true);
                        $.ajax({
                            url: "{{ url('storedataEditPengebonan') }}",
                            type: "POST",
                            data: formData,
                            contentType: false,
                            processData: false,
                            // data: $('#formPengebonan').serialize(),
                            beforeSend: function() {
                                Swal.fire({
                                    title: 'Mohon Menunggu',
                                    html: '<center><lottie-player src="https://lottie.host/9f0e9407-ad00-4a21-a698-e19bed2949f6/mM7VH432d9.json" background="transparent" speed="1" style="width: 300px; height: 300px;" loop autoplay></lottie-player></center><br><h1 class="h4">Sedang memproses data, Proses mungkin membutuhkan beberapa menit. </h1>',
                                    showConfirmButton: false,
                                    timerProgressBar: true,
                                    allowOutsideClick: false,
                                    allowEscapeKey: false,
                                })
                            },
                            success: function(response) {
                                $('#submitPengebonan').html('Proses');
                                $("#submitPengebonan").attr("disabled", false);
                                if (response.success == true) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Berhasil',
                                        html: response.message,
                                        showConfirmButton: true,
                                        showDenyButton: true,
                                        allowOutsideClick: false,
                                        allowEscapeKey: false,
                                        confirmButtonColor: '#3085d6',
                                        confirmButtonText: 'Ok',
                                        denyButtonText: '<i class="fa-solid fa-print"></i> Print Formulir',
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            // tablePengebonan.ajax.reload(null, false);
                                            // for (let index = 0; index < array.length; index++) {
                                            //     const element = array[index];
                                            //     $("#btn-remove" + idf).remove();
                                            // }
                                            $(".overlay").fadeIn(300);
                                            window.location.href =
                                                "{{ route('produksi.pengebonan') }}";
                                        } else if (result.isDenied) {
                                            // url ke print
                                            // window.location.href = "{{ route('gudang/penerimaan') }}";
                                        }
                                    });
                                    document.getElementById("formPengebonan").reset();
                                    // tablePengebonan.ajax.reload(null, false);
                                    $('#modal-penerimaan').modal('hide');
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Gagal Input',
                                        html: response.message,
                                        showConfirmButton: true
                                    });
                                }
                            },
                            error: function(data) {
                                // tablePengebonan.ajax.reload(null, false);
                                // console.log('Error:', data);
                                // const obj = JSON.parse(data.responseJSON);
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal Input',
                                    html: data,
                                    showConfirmButton: true
                                });
                                $('#submitPengebonan').html('Proses');
                                $("#submitPengebonan").attr("disabled", false);
                            }
                        });
                    }
                })
            }

            $(document).on('click', '.btnHapusForm', function() {
                var id = $(this).data('id');
                var noform = $(this).data('noform');
                var kode = $(this).data('kode');
                var typeHapus = $(this).data('typehapus');
                var kodeproduksi = $(this).data('kodeproduksi');
                var token = $("meta[name='csrf-token']").attr("content");
                nama = (typeHapus == "form") ? noform : kode;
                console.log("menghapus " + kodeproduksi);
                let r = (Math.random() + 1).toString(36).substring(2);
                swal.fire({
                    title: 'Hapus ' + nama,
                    html: 'Apakah anda yakin ingin menghapus <b class="text-red fw-bolder">' + nama +
                        '</b><br><br>Kode<br>' +
                        '<div class="alert alert-important alert-yellow text-dark" role="alert" style="font-size: 12px; max-height: 260px;">' +
                        '<div class="d-flex" ><b class="fw-bolder" > ' +
                        kode +
                        ' </b></div> </div> ',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: '<i class="fa-regular fa-trash-can"></i> Hapus',
                    cancelButtonText: 'Batal',
                }).then((result) => {
                    if (result.isConfirmed) {
                        (async () => {
                            const {
                                value: password
                            } = await Swal.fire({
                                title: "Ketik tulisan dibawah untuk menghapus " + nama,
                                html: '<div class="unselectable">' + r + '</div>',
                                input: "text",
                                // inputValue: r,
                                inputPlaceholder: r,
                                showCancelButton: true,
                                cancelButtonColor: '#3085d6',
                                cancelButtonText: 'Batal',
                                confirmButtonText: 'Ok',
                                inputAttributes: {
                                    autocapitalize: "off",
                                    autocorrect: "off"
                                },
                            });
                            if (password == r) {
                                $.ajax({
                                    type: "DELETE",
                                    url: "{{ route('delete.deleteExist') }}",
                                    data: {
                                        "_token": "{{ csrf_token() }}",
                                        "id": id,
                                        "noform": noform,
                                        "kodeproduksi": kodeproduksi,
                                        "tipeHapus": typeHapus,
                                    },
                                    beforeSend: function() {
                                        Swal.fire({
                                            title: 'Mohon Menunggu',
                                            html: '<center><lottie-player src="https://lottie.host/54b33864-47d1-4f30-b38c-bc2b9bdc3892/1xkjwmUkku.json"  background="transparent"  speed="1"  style="width: 400px; height: 400px;"  loop autoplay></lottie-player></center><br><h1 class="h4">Sedang menghapus data, Proses mungkin membutuhkan beberapa menit. <br><br><b class="text-danger">(Jangan menutup jendela ini, bisa mengakibatkan error)</b></h1>',
                                            timerProgressBar: true,
                                            showConfirmButton: false,
                                            allowOutsideClick: false,
                                            allowEscapeKey: false,
                                        })
                                    },
                                    success: function(data) {
                                        // tablePengebonan.ajax.reload(null,
                                        //     false);
                                        $('#modalViewItem').modal('hide');
                                        Swal.fire({
                                            icon: 'success',
                                            title: 'Berhasil',
                                            html: data,
                                            showConfirmButton: true
                                        });
                                        if (kodeproduksi) {
                                            $("#btn-remove" + kodeproduksi).remove();
                                        }
                                    },
                                    error: function(data) {
                                        // tablePengebonan.ajax.reload(null,
                                        //     false);
                                        // console.log('Error:', data
                                        //     .responseText);
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Gagal!',
                                            text: 'Error: ' + data.responseText,
                                            showConfirmButton: true,
                                        });
                                    }
                                });
                            } else {
                                // tablePengebonan.ajax.reload(null, false);
                                Swal.fire({
                                    icon: "error",
                                    title: "Batal",
                                    text: "Anda membatalkan proses hapus atau Teks yang diketik tidak sama",
                                });
                            }
                        })()
                    }
                })
            });

            $(function() {
                tableResult = $('.datatable-listResult').DataTable({
                    "processing": true, //Feature control the processing indicator.
                    "serverSide": true, //Feature control DataTables' server-side processing mode.
                    "scrollX": false,
                    "scrollCollapse": false,
                    "pagingType": 'full_numbers',
                    "dom": "<'card-header h3' B>" +
                        "<'card-body border-bottom py-3' <'row'<'col-sm-6'l><'col-sm-6'f>> >" +
                        "<'table-responsive' <'col-sm-12'tr> >" +
                        "<'card-footer' <'row'<'col-sm-7'i><'col-sm-5'p> >>",
                    "lengthMenu": [
                        [10, 25, 50, -1],
                        ['Default', '25', '50', 'Semua']
                    ],
                    "buttons": [{
                        className: 'btn btn-dark',
                        text: '<i class="fa-solid fa-arrows-rotate"></i> Refresh',
                        action: function(e, dt, node, config) {
                            dt.ajax.reload();
                        }
                    }, ],
                    "language": {
                        "lengthMenu": "Menampilkan _MENU_",
                        "zeroRecords": "Data Tidak Ditemukan",
                        "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ total data",
                        "infoEmpty": "Data Tidak Ditemukan",
                        "infoFiltered": "(Difilter dari _MAX_ total records)",
                        "processing": '<div class="container container-slim p-0"><div class="text-center"><div class="mb-3"></div><div class="text-secondary">Loading Data...</div></div></div>',
                        "search": '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-search" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0"></path><path d="M21 21l-6 -6"></path></svg>',
                        "paginate": {
                            "first": '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chevron-left-pipe" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M7 6v12"></path><path d="M18 6l-6 6l6 6"></path></svg>',
                            "last": '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chevron-right-pipe" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M6 6l6 6l-6 6"></path><path d="M17 5v13"></path></svg>',
                            "next": '<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M9 6l6 6l-6 6"></path></svg>',
                            "previous": '<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M15 6l-6 6l6 6"></path></svg>',
                        },
                    },
                    "ajax": {
                        "url": "{{ route('getResultPengebonan.index') }}",
                        "data": function(data) {
                            data._token = "{{ csrf_token() }}";
                            data.noQR = $('#filter_noQR').val();
                            data.idKontrak = $("#filter_idKontrak").val();
                            data.npb = $("#filter_npb").val();
                            data.supplier = $("#filter_supplier").val();
                            data.tanggal = $("#filter_tanggal").val();
                            data.tipe = $("#filter_tipe").val();
                            data.kategori = $("#filter_kategori").val();
                            data.warna = $("#filter_warna").val();
                            data.historyCommand = $("#historyCommand").val();
                            data.txtTipe = $('#filter_tipe :selected').text();
                            data.txtKategori = $('#filter_kategori :selected').text();
                            data.txtWarna = $('#filter_warna :selected').text();
                            data.editForm = 1;
                        }
                    },
                    columns: [{
                            title: '<svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-list-details"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M13 5h8" /><path d="M13 9h5" /><path d="M13 15h8" /><path d="M13 19h5" /><path d="M3 4m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" /><path d="M3 14m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" /></svg>',
                            data: 'action',
                            name: 'action',
                            className: "text-center cursor-pointer",
                            orderable: false,
                            searchable: false,
                        },
                        {
                            title: 'Kodebale',
                            data: 'subkode',
                            name: 'subkode',
                            className: "cuspad0 cuspad1 text-center"
                        },
                        {
                            title: 'Kodekontrak',
                            data: 'kodekontrak',
                            name: 'kodekontrak',
                            className: "cuspad0 cuspad1 text-center"
                        },
                        {
                            title: 'NPB',
                            data: 'npb',
                            name: 'npb',
                            className: "cuspad0 cuspad1 text-center"
                        },
                        {
                            title: 'Berat',
                            data: 'berat_satuan',
                            name: 'berat_satuan',
                            className: "cuspad0 cuspad1 text-start"
                        },
                        {
                            title: 'Package',
                            data: 'package',
                            name: 'package',
                            className: "cuspad0 cuspad1 text-start"
                        },
                        {
                            title: 'Tipe',
                            data: 'type',
                            name: 'type',
                            className: "cuspad0 cuspad1 text-start"
                        },
                        {
                            title: 'Kategori',
                            data: 'kategori',
                            name: 'kategori',
                            className: "cuspad0 cuspad1 text-start"
                        },
                        {
                            title: 'Warna',
                            data: 'warna',
                            name: 'warna',
                            className: "cuspad0 cuspad1 text-start"
                        },
                        {
                            title: 'Supplier',
                            data: 'supplier',
                            name: 'supplier',
                            className: "cuspad0 cuspad1 text-start"
                        },
                        {
                            title: 'Tgl Kedatangan',
                            data: 'tanggal',
                            name: 'tanggal',
                            className: "cuspad0 cuspad1 text-start"
                        },
                    ],
                    "initComplete": function() {
                        this.api()
                            .columns()
                            .every(function() {
                                var that = this;
                                $('input', this.footer()).on('keyup change clear', function() {
                                    if (that.search() !== this.value) {
                                        that.search(this.value).draw();
                                    }
                                });
                            });
                        this.api().columns([5]).every(function() {
                            var column = this;
                            var select = $(
                                    '<select class="form-select form-select-sm"><option value="">Semua</option></select>'
                                )
                                .appendTo($(column.footer()).empty())
                                .on('change', function() {
                                    var val = $.fn.dataTable.util.escapeRegex(
                                        $(this).val()
                                    );
                                    column
                                        .search(val ? '^' + val + '$' : '', true, false)
                                        .draw();
                                });
                            column.data().unique().sort().each(function(d, j) {
                                select.append('<option value="' + d + '">' + d +
                                    '</option>');
                            });
                        });
                    }
                });
                $('.datatable-listResult tfoot .th').each(function() {
                    var title = $(this).text();
                    $(this).html(
                        '<input type="text" class="form-control form-control-sm my-0 border" placeholder="' +
                        $(this).text().toUpperCase() + '" />'
                    );
                });
                $('.datatable-listResult').on('click', '.remove', function() {
                    // var id = $(this).data('id');
                    // var nama = $(this).data('nama');
                    // var kode = $(this).data('kode');
                    // var token = $("meta[name='csrf-token']").attr("content");
                    // let r = (Math.random() + 1).toString(36).substring(2);
                    // swal.fire({
                    //     title: 'Hapus ' + nama,
                    //     text: 'Apakah anda yakin ingin menghapus ' + nama + ', Tanggal : ' + kode +
                    //         ' ?',
                    //     icon: 'warning',
                    //     showCancelButton: true,
                    //     confirmButtonColor: '#d33',
                    //     cancelButtonColor: '#3085d6',
                    //     confirmButtonText: '<i class="fa-regular fa-trash-can"></i> Hapus',
                    //     cancelButtonText: 'Batal',
                    // }).then((result) => {
                    //     if (result.isConfirmed) {
                    //         (async () => {
                    //             const {
                    //                 value: password
                    //             } = await Swal.fire({
                    //                 title: "Ketik tulisan dibawah untuk menghapus " +
                    //                     nama,
                    //                 html: '<div class="unselectable">' + r +
                    //                     '</div>',
                    //                 input: "text",
                    //                 inputPlaceholder: "Ketik untuk menghapus " +
                    //                     nama,
                    //                 showCancelButton: true,
                    //                 cancelButtonColor: '#3085d6',
                    //                 cancelButtonText: 'Batal',
                    //                 confirmButtonText: 'Ok',
                    //                 inputAttributes: {
                    //                     autocapitalize: "off",
                    //                     autocorrect: "off"
                    //                 },
                    //             });
                    //             if (password == r) {
                    //                 $.ajax({
                    //                     type: "DELETE",
                    //                     url: "{{ route('getPenerimaan.store') }}" +
                    //                         '/' + id,
                    //                     data: {
                    //                         "_token": "{{ csrf_token() }}",
                    //                     },
                    //                     beforeSend: function() {
                    //                         Swal.fire({
                    //                             title: 'Mohon Menunggu',
                    //                             html: '<center><lottie-player src="https://lottie.host/54b33864-47d1-4f30-b38c-bc2b9bdc3892/1xkjwmUkku.json"  background="transparent"  speed="1"  style="width: 400px; height: 400px;"  loop autoplay></lottie-player></center><br><h1 class="h4">Sedang menghapus data, Proses mungkin membutuhkan beberapa menit. <br><br><b class="text-danger">(Jangan menutup jendela ini, bisa mengakibatkan error)</b></h1>',
                    //                             timerProgressBar: true,
                    //                             showConfirmButton: false,
                    //                             allowOutsideClick: false,
                    //                             allowEscapeKey: false,
                    //                         })
                    //                     },
                    //                     success: function(data) {
                    //                         tablePengebonan.ajax.reload(null,
                    //                             false);
                    //                         Swal.fire({
                    //                             icon: 'success',
                    //                             title: 'Berhasil',
                    //                             html: data,
                    //                             showConfirmButton: true
                    //                         });
                    //                     },
                    //                     error: function(data) {
                    //                         tablePengebonan.ajax.reload(null,
                    //                             false);
                    //                         console.log('Error:', data
                    //                             .responseText);
                    //                         Swal.fire({
                    //                             icon: 'error',
                    //                             title: 'Gagal!',
                    //                             text: 'Error: ' + data
                    //                                 .responseText,
                    //                             showConfirmButton: true,
                    //                         });
                    //                     }
                    //                 });
                    //             } else {
                    //                 tablePengebonan.ajax.reload(null, false);
                    //                 Swal.fire({
                    //                     icon: "error",
                    //                     title: "Batal",
                    //                     text: "Anda membatalkan proses hapus atau Teks yang diketik tidak sama",
                    //                 });
                    //             }
                    //         })()
                    //     }
                    // })
                });

                $("#filter_tipe").select2({
                    dropdownParent: $("#modalTambahItem"),
                    language: "id",
                    width: '100%',
                    height: '100%',
                    allowClear: true,
                    placeholder: "Pilih Tipe Bahan Baku",
                    ajax: {
                        url: "{{ route('getBB') }}",
                        dataType: 'json',
                        delay: 200,
                        processResults: function(response) {
                            return {
                                results: $.map(response, function(item) {
                                    return {
                                        text: (!item.kode ? '' : item.kode + ' - ') + item.nama
                                            .toUpperCase(),
                                        id: item.id,
                                    }
                                })
                            };
                        },
                        cache: true
                    },
                });
                $("#filter_kategori").select2({
                    dropdownParent: $("#modalTambahItem"),
                    language: "id",
                    width: '100%',
                    height: '100%',
                    allowClear: true,
                    placeholder: "Pilih Kategori",
                    ajax: {
                        url: "{{ route('getKT') }}",
                        dataType: 'json',
                        delay: 200,
                        processResults: function(response) {
                            return {
                                results: $.map(response, function(item) {
                                    return {
                                        text: (!item.kode_kategori ? '' : item.kode_kategori +
                                                ' - ') + item
                                            .nama_kategori.toUpperCase(),
                                        id: item.id,
                                    }
                                })
                            };
                        },
                        cache: true
                    },
                });
                $("#filter_warna").select2({
                    dropdownParent: $("#modalTambahItem"),
                    language: "id",
                    width: '100%',
                    height: '100%',
                    allowClear: true,
                    placeholder: "Pilih Warna",
                    ajax: {
                        url: "{{ route('getWR') }}",
                        dataType: 'json',
                        delay: 200,
                        processResults: function(response) {
                            return {
                                results: $.map(response, function(item) {
                                    return {
                                        text: (!item.kode_warna ? '' : item.kode_warna + ' - ') +
                                            item
                                            .warna.toUpperCase(),
                                        id: item.id,
                                    }
                                })
                            };
                        },
                        cache: true
                    },
                });

                $("#btnClearHistory").click(function() {
                    historyCommand.innerHTML = "";
                    historyCommand.insertAdjacentHTML('beforeend',
                        '===================================================================');
                    historyCommand.insertAdjacentHTML('beforeend', "\n");
                    historyCommand.insertAdjacentHTML('beforeend',
                        '<svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-code"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 8l-4 4l4 4" /><path d="M17 8l4 4l-4 4" /><path d="M14 4l-4 16" /></svg> Command History : '
                    );
                    historyCommand.insertAdjacentHTML('beforeend', "\n");
                    historyCommand.insertAdjacentHTML('beforeend',
                        '===================================================================');
                    historyCommand.insertAdjacentHTML('beforeend', "\n");
                    historyCommand.insertAdjacentHTML('beforeend',
                        '>> Accessed at {{ now()->format('d-m-Y H:i:s') }}');
                });

            });

            function fetchQr() {
                var qrcode = $("#qrText").val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    url: "{{ route('getDecryptKode.decrypt') }}",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        keyword: qrcode,
                        type: "text",
                    },
                    beforeSend: function() {
                        scanner.stop();
                        $(".overlay").fadeIn(300);
                    },
                    success: function(response) {
                        // Swal.hideLoading({showDenyButton: false,});
                        var zippiSuccess = new Audio("{{ asset('sounds/scan-success.mp3') }}");
                        var zippiError = new Audio("{{ asset('sounds/scan-error.mp3') }}");

                        if (response.success == true) {
                            zippiSuccess.play();
                            $(".overlay").fadeOut(300);
                            // $("#inpt-qr").val(response.subkode);
                            // $("#inpt-qr").prop("disabled", false);
                            // $("#inpt-qr").removeClass("cursor-not-allowed");
                            if ($("#detail_transaksi").find(".kode_" + response.id).length) {
                                zippiError.play();
                                // scanner.start();
                                $("#notifications").html(
                                    '<div class="alert alert-important alert-danger alert-dismissible" role="alert">' +
                                    '<div class="d-flex"><div><svg xmlns="http://www.w3.org/2000/svg" width="24" ' +
                                    'height="24"viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" ' +
                                    'stroke-linecap="round" stroke-linejoin="round" class="icon alert-icon"><path stroke="none" ' +
                                    'd="M0 0h24v24H0z" fill="none"></path><path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0"></path>' +
                                    '<path d="M12 8v4"></path><path d="M12 16h.01"></path></svg></div><div> Qr Code Sudah ditambahkan..</div></div></div>'
                                )
                                setTimeout(function() {
                                    $("#notifications").html('')
                                }, 3000);
                            } else {
                                var idf = document.getElementById("idf").value;
                                var detail_transaksi = document.getElementById("detail_transaksi");
                                var tr = document.createElement("tr");
                                tr.setAttribute("id", "btn-remove" + idf);
                                // Kolom 1 Hapus
                                var td = document.createElement("td");
                                td.setAttribute("align", "center");
                                td.setAttribute("style",
                                    ""
                                );
                                td.innerHTML +=
                                    '<button class="btn btn-danger btn-icon remove" type="button" onclick="hapusElemen(' +
                                    idf +
                                    ');"><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round" ' +
                                    ' class="icon icon-tabler icons-tabler-outline icon-tabler-trash"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" />' +
                                    '<path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg> </button>';
                                tr.appendChild(td);
                                // Kolom 2 Kode
                                var td = document.createElement("td");
                                td.innerHTML += response.subkode + '<div class="kode_' + response.id +
                                    '"><input type="hidden" name="id_item[]" value="' + response.id +
                                    '"><input type="hidden" name="oldKodeproduksi[]" value=""></div>';
                                tr.appendChild(td);
                                // Kolom 3 BB
                                var td = document.createElement("td");
                                td.innerHTML += response.tipe + " " + response.kategori + " " + response.warna;
                                tr.appendChild(td);
                                // Kolom 4 Jenis
                                var td = document.createElement("td");
                                td.innerHTML += response.package;
                                tr.appendChild(td);
                                // Kolom 5 Berat
                                var td = document.createElement("td");
                                td.innerHTML += response.beratsatuan;
                                tr.appendChild(td);
                                // Kolom 6 Supplier
                                var td = document.createElement("td");
                                td.innerHTML += response.supplier;
                                tr.appendChild(td);
                                detail_transaksi.appendChild(tr);
                                idf = (idf - 1) + 2;
                                document.getElementById("idf").value = idf;
                                // scanner.start();
                            }
                        } else if (response.success == false) {
                            zippiError.play();
                            Swal.fire({
                                icon: "error",
                                title: response.message,
                                text: response.detail,
                                allowOutsideClick: false,
                                allowEscapeKey: false,
                            }).then((result) => {
                                /* Read more about isConfirmed, isDenied below */
                                if (result.isConfirmed) {
                                    // scanner.start();
                                    $(".overlay").fadeOut(300);
                                }
                            });
                        }
                    },
                    error: function(data) {
                        zippiError.play();
                        // scanner.start();
                        $(".overlay").fadeOut(300);
                        // $("#inpt-qr").val("");
                        // $("#inpt-qr").prop("disabled", false);
                    }
                });
            }

            $(document).on('click', '.tambahkebawah', function() {
                var id = $(this).data('id');
                var subkode = $(this).data('subkode');
                if ($("#detail_transaksi").find(".kode_" + id).length) {
                    historyCommand.insertAdjacentHTML('beforeend', "\n");
                    historyCommand.insertAdjacentHTML('beforeend',
                        '<b class="text-danger">>></b> <b class="text-yellow">' + subkode +
                        '</b> <b class="text-danger">sudah ditambahkan ke pengebonan</b>');
                    $("#notifications").html(
                        '<div class="alert alert-important alert-danger alert-dismissible" role="alert"><div class="d-flex"><div><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon alert-icon"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0"></path><path d="M12 8v4"></path><path d="M12 16h.01"></path></svg></div><div> Qr Code Sudah ditambahkan..</div></div></div>'
                    )
                    setTimeout(function() {
                        $("#notifications").html('')
                    }, 3000);
                } else {
                    var tipe = $(this).data('tipe');
                    var kategori = $(this).data('kategori');
                    var warna = $(this).data('warna');
                    var package = $(this).data('package');
                    var beratsatuan = $(this).data('beratsatuan');
                    var supplier = $(this).data('supplier');

                    var idf = document.getElementById("idf").value;
                    var detail_transaksi = document.getElementById("detail_transaksi");
                    var tr = document.createElement("tr");
                    tr.setAttribute("id", "btn-remove" + idf);
                    // Kolom 1 Hapus
                    var td = document.createElement("td");
                    td.setAttribute("align", "center");
                    td.setAttribute("style",
                        ""
                    );
                    td.innerHTML +=
                        '<button class="btn btn-danger btn-icon remove" type="button" onclick="hapusElemen(' +
                        idf +
                        ');"><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round" ' +
                        ' class="icon icon-tabler icons-tabler-outline icon-tabler-trash"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" />' +
                        '<path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg> </button>';
                    tr.appendChild(td);
                    // Kolom 2 Kode
                    var td = document.createElement("td");
                    td.innerHTML += subkode + '<div class="kode_' + id +
                        '"><input type="hidden" name="id_item[]" value="' + id +
                        '"><input type="hidden" name="oldKodeproduksi[]" value=""></div>';
                    tr.appendChild(td);
                    // Kolom 3 BB
                    var td = document.createElement("td");
                    td.innerHTML += tipe + " " + kategori + " " + warna;
                    tr.appendChild(td);
                    // Kolom 4 Jenis
                    var td = document.createElement("td");
                    td.innerHTML += package;
                    tr.appendChild(td);
                    // Kolom 5 Berat
                    var td = document.createElement("td");
                    td.innerHTML += beratsatuan;
                    tr.appendChild(td);
                    // Kolom 6 Supplier
                    var td = document.createElement("td");
                    td.innerHTML += supplier;
                    tr.appendChild(td);
                    detail_transaksi.appendChild(tr);
                    idf = (idf - 1) + 2;
                    document.getElementById("idf").value = idf;

                    historyCommand.insertAdjacentHTML('beforeend', "\n");
                    historyCommand.insertAdjacentHTML('beforeend',
                        '<b class="text-blue">>></b> <b class="text-yellow">' + subkode + '</b>' +
                        ' ' + package + tipe + ' ' + kategori +
                        ' ' + warna + ' <b class="text-blue">Berhasil</b> ditambahkan ke pengebonan');
                }
            });
        </script>
    </div>
@endsection
