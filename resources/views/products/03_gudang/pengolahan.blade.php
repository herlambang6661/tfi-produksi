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
    <div class="page">
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
                                    stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-qrcode">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path
                                        d="M4 4m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                                    <path d="M7 17l0 .01" />
                                    <path
                                        d="M14 4m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                                    <path d="M7 7l0 .01" />
                                    <path
                                        d="M4 14m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                                    <path d="M17 7l0 .01" />
                                    <path d="M14 14l3 0" />
                                    <path d="M20 14l0 .01" />
                                    <path d="M14 14l0 3" />
                                    <path d="M14 20l3 0" />
                                    <path d="M17 17l3 0" />
                                    <path d="M20 17l0 3" />
                                </svg>
                                {{ $judul }}
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
                                            <i class="fa-solid fa-warehouse"></i>
                                            Gudang
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        <a href="#">
                                            <i class="fa-solid fa-qrcode"></i>
                                            {{ $judul }}
                                        </a>
                                    </li>
                                </ol>
                            </div>
                        </div>

                        <!-- Page title actions -->
                        <div class="col-auto ms-auto d-print-none">
                            <div class="btn-list">
                                <ul class="nav">
                                    <a href="#tabs-input"
                                        class="btn btn-outline-dark d-none d-sm-inline-block border border-dark"
                                        data-bs-toggle="tab" aria-selected="false" role="tab" tabindex="-1"
                                        style="margin-right: 10px" id="tombolStart">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-list-details">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M13 5h8" />
                                            <path d="M13 9h5" />
                                            <path d="M13 15h8" />
                                            <path d="M13 19h5" />
                                            <path
                                                d="M3 4m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                                            <path
                                                d="M3 14m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                                        </svg>
                                        Input Pengolahan BB
                                    </a>
                                    <a href="#tabs-listBB"
                                        class="active btn btn-outline-dark d-none d-sm-inline-block border border-dark"
                                        data-bs-toggle="tab" aria-selected="false" role="tab" tabindex="-1"
                                        style="margin-right: 10px" id="tombolStop">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-list-check text-primary">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M3.5 5.5l1.5 1.5l2.5 -2.5" />
                                            <path d="M3.5 11.5l1.5 1.5l2.5 -2.5" />
                                            <path d="M3.5 17.5l1.5 1.5l2.5 -2.5" />
                                            <path d="M11 6l9 0" />
                                            <path d="M11 12l9 0" />
                                            <path d="M11 18l9 0" />
                                        </svg>
                                        List Pengolahan BB
                                    </a>
                                </ul>
                                <ul class="nav">
                                    <a href="#tabs-input" class="btn btn-outline-dark d-sm-none btn-icon border border-dark"
                                        data-bs-toggle="tab" aria-selected="true" role="tab"
                                        aria-label="List Item Permintaan" style="margin-right: 10px">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-list-details">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M13 5h8" />
                                            <path d="M13 9h5" />
                                            <path d="M13 15h8" />
                                            <path d="M13 19h5" />
                                            <path
                                                d="M3 4m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                                            <path
                                                d="M3 14m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                                        </svg>
                                    </a>
                                    <a href="#tabs-listBB"
                                        class="active btn btn-outline-dark d-sm-none btn-icon border border-dark"
                                        data-bs-toggle="tab" aria-selected="true" role="tab"
                                        aria-label="List Item Permintaan" style="margin-right: 10px">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-list-check">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M3.5 5.5l1.5 1.5l2.5 -2.5" />
                                            <path d="M3.5 11.5l1.5 1.5l2.5 -2.5" />
                                            <path d="M3.5 17.5l1.5 1.5l2.5 -2.5" />
                                            <path d="M11 6l9 0" />
                                            <path d="M11 12l9 0" />
                                            <path d="M11 18l9 0" />
                                        </svg>
                                    </a>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Page body -->
            <div class="page-body">
                <div class="container-xl">
                    <div class="tab-content">
                        <div class="tab-pane fade" id="tabs-input" role="tabpanel">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="card card-xl border-primary shadow rounded mb-3 py-1 px-1">
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
                                        <video class="mb-1 rounded" id="qr-video" style="width: 100%; height: 100%;"
                                            autoplay playsinline>
                                        </video>
                                        <div class="row">
                                            <div class="col">
                                                <button id="start-button" class="btn btn-success btn-sm">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
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
                                                        <select id="cam-list"
                                                            class="form-select form-select-sm border-primary">
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
                                <div class="col-lg-8" onkeydown="return event.key != 'Enter';">
                                    <div class="card card-xl border-primary shadow rounded mb-3">
                                        <div class="table-responsive">
                                            <form id="formPengolahan" name="formPengolahan" method="post"
                                                action="javascript:void(0)">
                                                @csrf
                                                <input id="idf" value="1" type="hidden">
                                                <div class="card-body px-1 py-1 my-1 mx-1">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <label class="form-label">Tanggal Input</label>
                                                            <input type="date" class="form-control border-dark"
                                                                name="tanggal" id="tanggal"
                                                                value="{{ date('Y-m-d') }}">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label">Operator</label>
                                                            <input type="text" class="form-control border-dark"
                                                                name="operator" id="operator"
                                                                value="{{ Auth::user()->nickname }}">
                                                        </div>
                                                        <div class="col-md-12">
                                                            <label class="form-label">Kode</label>
                                                            <input type="text" class="form-control border-dark"
                                                                name="qrText" id="qrText"
                                                                onkeydown = "if (event.keyCode == 13)  fetchQr()">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-body px-1 py-1 my-1 mx-1 text-end">
                                                    <table id="detail_transaksi"
                                                        class="control-group text-nowrap table-bordered" border="0"
                                                        style="width: 100%;text-align:center;">
                                                        <thead class="" style="font-weight: bold;">
                                                            <tr>
                                                                <td class="px-0 py-0"></td>
                                                                <td style="width: 200px">
                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                        style="margin-right: 5px" width="24"
                                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                                        stroke="currentColor" stroke-width="2"
                                                                        stroke-linecap="round" stroke-linejoin="round"
                                                                        class="icon icon-tabler icons-tabler-outline icon-tabler-category-plus">
                                                                        <path stroke="none" d="M0 0h24v24H0z"
                                                                            fill="none" />
                                                                        <path
                                                                            d="M4 4h6v6h-6zm10 0h6v6h-6zm-10 10h6v6h-6zm10 3h6m-3 -3v6" />
                                                                    </svg>
                                                                    Kode Bahan Baku
                                                                </td>
                                                                <td style="width: 200px">
                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                        style="margin-right: 5px" width="24"
                                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                                        stroke="currentColor" stroke-width="2"
                                                                        stroke-linecap="round" stroke-linejoin="round"
                                                                        class="icon icon-tabler icons-tabler-outline icon-tabler-category-2">
                                                                        <path stroke="none" d="M0 0h24v24H0z"
                                                                            fill="none" />
                                                                        <path d="M14 4h6v6h-6z" />
                                                                        <path d="M4 14h6v6h-6z" />
                                                                        <path
                                                                            d="M17 17m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                                                                        <path d="M7 7m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                                                                    </svg>
                                                                    Bahan Baku
                                                                </td>
                                                                <td style="width: 200px">
                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                        style="margin-right: 5px" width="24"
                                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                                        stroke="currentColor" stroke-width="2"
                                                                        stroke-linecap="round" stroke-linejoin="round"
                                                                        class="icon icon-tabler icons-tabler-outline icon-tabler-category-2">
                                                                        <path stroke="none" d="M0 0h24v24H0z"
                                                                            fill="none" />
                                                                        <path d="M14 4h6v6h-6z" />
                                                                        <path d="M4 14h6v6h-6z" />
                                                                        <path
                                                                            d="M17 17m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                                                                        <path d="M7 7m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                                                                    </svg>
                                                                    Jenis
                                                                </td>
                                                                <td style="width: 200px">
                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                        style="margin-right: 5px" width="24"
                                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                                        stroke="currentColor" stroke-width="2"
                                                                        stroke-linecap="round" stroke-linejoin="round"
                                                                        class="icon icon-tabler icons-tabler-outline icon-tabler-brand-speedtest">
                                                                        <path stroke="none" d="M0 0h24v24H0z"
                                                                            fill="none" />
                                                                        <path d="M5.636 19.364a9 9 0 1 1 12.728 0" />
                                                                        <path d="M16 9l-4 4" />
                                                                    </svg>
                                                                    Berat
                                                                </td>
                                                                <td style="width: 200px">
                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                        style="margin-right: 5px" width="24"
                                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                                        stroke="currentColor" stroke-width="2"
                                                                        stroke-linecap="round" stroke-linejoin="round"
                                                                        class="icon icon-tabler icons-tabler-outline icon-tabler-coins">
                                                                        <path stroke="none" d="M0 0h24v24H0z"
                                                                            fill="none" />
                                                                        <path
                                                                            d="M9 14c0 1.657 2.686 3 6 3s6 -1.343 6 -3s-2.686 -3 -6 -3s-6 1.343 -6 3z" />
                                                                        <path
                                                                            d="M9 14v4c0 1.656 2.686 3 6 3s6 -1.344 6 -3v-4" />
                                                                        <path
                                                                            d="M3 6c0 1.072 1.144 2.062 3 2.598s4.144 .536 6 0c1.856 -.536 3 -1.526 3 -2.598c0 -1.072 -1.144 -2.062 -3 -2.598s-4.144 -.536 -6 0c-1.856 .536 -3 1.526 -3 2.598z" />
                                                                        <path d="M3 6v10c0 .888 .772 1.45 2 2" />
                                                                        <path d="M3 11c0 .888 .772 1.45 2 2" />
                                                                    </svg>
                                                                    Supplier
                                                                </td>
                                                            </tr>
                                                        </thead>
                                                    </table>
                                                </div>
                                                <div class="card-footer px-1 py-1 my-1 mx-1 text-end">
                                                    <button id="submitPengolahan" type="submit"
                                                        class="btn btn-primary">Proses</button>
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
                        <div class="tab-pane fade active show" id="tabs-listBB" role="tabpanel">
                            <div class="card card-xl border-primary shadow rounded">
                                <div class="card-stamp card-stamp-lg">
                                    <div class="card-stamp-icon bg-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-shield-check">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path
                                                d="M11.46 20.846a12 12 0 0 1 -7.96 -14.846a12 12 0 0 0 8.5 -3a12 12 0 0 0 8.5 3a12 12 0 0 1 -.09 7.06" />
                                            <path d="M15 19l2 2l4 -4" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="card-header">
                                    <form action="#" id="form-filter" method="get" autocomplete="off"
                                        novalidate="" class="">
                                        <div class="row">
                                            <div class="col-md-5 mb-1">
                                                <input type="date" id="filterStart-listBB"
                                                    class="form-control border-dark" value="{{ date('Y-01-01') }}">
                                            </div>
                                            <div class="col-md-5 mb-1">
                                                <input type="date" id="filterEnd-listBB"
                                                    class="form-control border-dark" value="{{ date('Y-m-d') }}">
                                            </div>
                                            <div class="col-auto mb-1">
                                                <button type="button" class="btn btn-primary btn-icon"
                                                    onclick="synApproved()">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="icon">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                        <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0"></path>
                                                        <path d="M21 21l-6 -6"></path>
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="table-responsive">
                                    <table style="width:100%; height: 100%;font-size:13px;"
                                        class="table table-sm table-bordered table-vcenter card-table table-hover datatable datatable-listBB">
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
                                                <th class="px-1 th py-1" style="width: 1%"></th>
                                                <th class="px-1 th py-1" style="width: 1%">Tanggal</th>
                                                <th class="px-1 th py-1" style="width: 1%">Kode Olah</th>
                                                <th class="px-1 th py-1">List Produk</th>
                                                <th class="px-1 th py-1" style="width: 1%">Operator</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @include('shared.footer')
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
                    url: "/getDecryptKode",
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
                                    '"><input type="hidden" name="id_item[]" value="' + response.id + '"></div>';
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
            var tablePengolahan;

            function newexportaction(e, dt, button, config) {
                var self = this;
                var oldStart = dt.settings()[0]._iDisplayStart;
                dt.one('preXhr', function(e, s, data) {
                    // Just this once, load all data from the server...
                    data.start = 0;
                    data.length = 2147483647;
                    dt.one('preDraw', function(e, settings) {
                        // Call the original action function
                        if (button[0].className.indexOf('buttons-copy') >= 0) {
                            $.fn.dataTable.ext.buttons.copyHtml5.action.call(self, e, dt, button, config);
                        } else if (button[0].className.indexOf('buttons-excel') >= 0) {
                            $.fn.dataTable.ext.buttons.excelHtml5.available(dt, config) ?
                                $.fn.dataTable.ext.buttons.excelHtml5.action.call(self, e, dt, button, config) :
                                $.fn.dataTable.ext.buttons.excelFlash.action.call(self, e, dt, button, config);
                        } else if (button[0].className.indexOf('buttons-csv') >= 0) {
                            $.fn.dataTable.ext.buttons.csvHtml5.available(dt, config) ?
                                $.fn.dataTable.ext.buttons.csvHtml5.action.call(self, e, dt, button, config) :
                                $.fn.dataTable.ext.buttons.csvFlash.action.call(self, e, dt, button, config);
                        } else if (button[0].className.indexOf('buttons-pdf') >= 0) {
                            $.fn.dataTable.ext.buttons.pdfHtml5.available(dt, config) ?
                                $.fn.dataTable.ext.buttons.pdfHtml5.action.call(self, e, dt, button, config) :
                                $.fn.dataTable.ext.buttons.pdfFlash.action.call(self, e, dt, button, config);
                        } else if (button[0].className.indexOf('buttons-print') >= 0) {
                            $.fn.dataTable.ext.buttons.print.action(e, dt, button, config);
                        }
                        dt.one('preXhr', function(e, s, data) {
                            // DataTables thinks the first item displayed is index 0, but we're not drawing that.
                            // Set the property to what it was before exporting.
                            settings._iDisplayStart = oldStart;
                            data.start = oldStart;
                        });
                        // Reload the grid with the original page. Otherwise, API functions like table.cell(this) don't work properly.
                        setTimeout(dt.ajax.reload, 0);
                        // Prevent rendering of the full data to the DOM
                        return false;
                    });
                });
                // Requery the server with the new one-time export settings
                dt.ajax.reload();
            }

            function hapusElemen(idf) {
                $("#btn-remove" + idf).remove();
            }
            if ($("#formPengolahan").length > 0) {
                $("#formPengolahan").validate({
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
                        $('#submitPengolahan').html(
                            '<i class="fa-solid fa-fw fa-spinner fa-spin"></i> Please Wait...');
                        $("#submitPengolahan").attr("disabled", true);
                        $.ajax({
                            url: "{{ url('storedataPengolahan') }}",
                            type: "POST",
                            data: formData,
                            contentType: false,
                            processData: false,
                            // data: $('#formPengolahan').serialize(),
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
                                $('#submitPengolahan').html('Proses');
                                $("#submitPengolahan").attr("disabled", false);
                                // const Toast = Swal.mixin({
                                //     toast: true,
                                //     position: "top-end",
                                //     showConfirmButton: false,
                                //     timer: 4000,
                                //     timerProgressBar: true,
                                //     didOpen: (toast) => {
                                //         toast.onmouseenter = Swal.stopTimer;
                                //         toast.onmouseleave = Swal.resumeTimer;
                                //     }
                                // });
                                // Toast.fire({
                                //     icon: "success",
                                //     title: response.msg,
                                // });
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil',
                                    html: response.msg,
                                    showConfirmButton: true,
                                    showDenyButton: true,
                                    allowOutsideClick: false,
                                    allowEscapeKey: false,
                                    confirmButtonColor: '#3085d6',
                                    confirmButtonText: 'Ok',
                                    denyButtonText: '<i class="fa-solid fa-print"></i> Print Formulir',
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        tablePengolahan.ajax.reload(null, false);
                                        // for (let index = 0; index < array.length; index++) {
                                        //     const element = array[index];
                                        //     $("#btn-remove" + idf).remove();
                                        // }

                                        // window.location.href =
                                        //     "{{ route('gudang/penerimaan') }}";
                                    } else if (result.isDenied) {
                                        // url ke print
                                        // window.location.href = "{{ route('gudang/penerimaan') }}";
                                    }
                                });
                                document.getElementById("formPengolahan").reset();
                                tablePengolahan.ajax.reload(null, false);
                                $('#modal-penerimaan').modal('hide');
                            },
                            error: function(data) {
                                tablePengolahan.ajax.reload(null, false);
                                // console.log('Error:', data);
                                // const obj = JSON.parse(data.responseJSON);
                                console.log($('#formPengolahan').serialize());
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal Input',
                                    html: data.responseJSON.message,
                                    showConfirmButton: true
                                });
                                $('#submitPengolahan').html('Proses');
                                $("#submitPengolahan").attr("disabled", false);
                            }
                        });
                    }
                })
            }

            $(function() {
                tablePengolahan = $('.datatable-listBB').DataTable({
                    "processing": true, //Feature control the processing indicator.
                    "serverSide": false, //Feature control DataTables' server-side processing mode.
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
                            extend: 'copyHtml5',
                            className: 'btn btn-teal',
                            text: '<i class="fa fa-copy text-white"></i> Salin',
                            action: newexportaction,
                        },
                        {
                            extend: 'excelHtml5',
                            autoFilter: true,
                            className: 'btn btn-success',
                            text: '<i class="fa fa-file-excel text-white"></i> Excel',
                            action: newexportaction,
                        },
                        {
                            extend: 'pdfHtml5',
                            className: 'btn btn-danger',
                            text: '<i class="fa fa-file-pdf text-white"></i> Pdf',
                        },
                        {
                            className: 'btn btn-dark',
                            text: '<i class="fa-solid fa-arrows-rotate"></i> Refresh',
                            action: function(e, dt, node, config) {
                                dt.ajax.reload();
                            }
                        },
                    ],
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
                        "url": "{{ route('getPengolahan.index') }}",
                        "data": function(data) {
                            data._token = "{{ csrf_token() }}";
                            data.dari = $('#filterStart-listBB').val();
                            data.sampai = $('#filterEnd-listBB').val();
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
                            title: 'Status',
                            data: 'status',
                            name: 'status',
                            className: "cuspad0 cuspad1 text-center"
                        },
                        {
                            title: 'Tanggal',
                            data: 'tanggal',
                            name: 'tanggal',
                            className: "cuspad0 cuspad1 text-center"
                        },
                        {
                            title: 'Kode Olah',
                            data: 'kodeolah',
                            name: 'kodeolah',
                            className: "cuspad0 cuspad1 text-center"
                        },
                        {
                            title: 'List Produk',
                            data: 'subkode',
                            name: 'subkode',
                            className: "cuspad0 cuspad1 text-start"
                        },
                        {
                            title: 'Operator',
                            data: 'operator',
                            name: 'operator',
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
                $('.datatable-listBB tfoot .th').each(function() {
                    var title = $(this).text();
                    $(this).html(
                        '<input type="text" class="form-control form-control-sm my-0 border" placeholder="' +
                        $(this).text().toUpperCase() + '" />'
                    );
                });
                $('.datatable-listBB').on('click', '.remove', function() {
                    var id = $(this).data('id');
                    var nama = $(this).data('nama');
                    var kode = $(this).data('kode');
                    var token = $("meta[name='csrf-token']").attr("content");
                    let r = (Math.random() + 1).toString(36).substring(2);
                    swal.fire({
                        title: 'Hapus ' + nama,
                        text: 'Apakah anda yakin ingin menghapus ' + nama + ', Tanggal : ' + kode +
                            ' ?',
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
                                    title: "Ketik tulisan dibawah untuk menghapus " +
                                        nama,
                                    html: '<div class="unselectable">' + r +
                                        '</div>',
                                    input: "text",
                                    inputPlaceholder: "Ketik untuk menghapus " +
                                        nama,
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
                                        url: "{{ route('getPenerimaan.store') }}" +
                                            '/' + id,
                                        data: {
                                            "_token": "{{ csrf_token() }}",
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
                                            tablePengolahan.ajax.reload(null,
                                                false);
                                            Swal.fire({
                                                icon: 'success',
                                                title: 'Berhasil',
                                                html: data,
                                                showConfirmButton: true
                                            });
                                        },
                                        error: function(data) {
                                            tablePengolahan.ajax.reload(null,
                                                false);
                                            console.log('Error:', data
                                                .responseText);
                                            Swal.fire({
                                                icon: 'error',
                                                title: 'Gagal!',
                                                text: 'Error: ' + data
                                                    .responseText,
                                                showConfirmButton: true,
                                            });
                                        }
                                    });
                                } else {
                                    tablePengolahan.ajax.reload(null, false);
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
                    url: "/getDecryptKode",
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
                                    '"><input type="hidden" name="id_item[]" value="' + response.id + '"></div>';
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
        </script>
    </div>
@endsection
