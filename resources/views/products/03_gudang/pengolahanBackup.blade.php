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
            /* display: none; */
            background: rgba(0, 0, 0, 0.6);
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
    </style>
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
                                        class="active btn btn-outline-dark d-none d-sm-inline-block border border-dark"
                                        data-bs-toggle="tab" aria-selected="false" role="tab" tabindex="-1"
                                        style="margin-right: 10px">
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
                                        class="btn btn-outline-dark d-none d-sm-inline-block border border-dark"
                                        data-bs-toggle="tab" aria-selected="false" role="tab" tabindex="-1"
                                        style="margin-right: 10px">
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
                                    <a href="#tabs-input"
                                        class="active btn btn-outline-dark d-sm-none btn-icon border border-dark"
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
                                        class="btn btn-outline-dark d-sm-none btn-icon border border-dark"
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
                    <div class="row row-deck row-cards">
                        <div class="tab-content">
                            {{-- input --}}
                            <div class="tab-pane fade active show" id="tabs-input" role="tabpanel">
                                <div class="card card-xl border-danger shadow rounded">
                                    <div class="card-stamp card-stamp-lg">
                                        <div class="card-stamp-icon bg-danger">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="icon icon-tabler icons-tabler-outline icon-tabler-alert-triangle">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M12 9v4" />
                                                <path
                                                    d="M10.363 3.591l-8.106 13.534a1.914 1.914 0 0 0 1.636 2.871h16.214a1.914 1.914 0 0 0 1.636 -2.87l-8.106 -13.536a1.914 1.914 0 0 0 -3.274 0z" />
                                                <path d="M12 16h.01" />
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col-md-12 col-md-auto mb-2 mb-md-0">
                                                <button type="button" id="switchCameraButton"
                                                    class="btn btn-primary mt-2 d-inline-block me-2"
                                                    onclick="switchCamera()">
                                                    <i class="fa-solid fa-camera"></i> Switch Camera
                                                </button>
                                                <button type="button" id="toggleCameraButton"
                                                    class="btn btn-danger mt-2 d-inline-block" onclick="toggleCamera()">
                                                    <i class="fa-solid fa-stop"></i> Stop Camera
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row row-deck row-cards">
                                            <div class="col-lg-6">
                                                <div class="card card-xl border-primary shadow rounded">
                                                    <div class="mb-3">
                                                        <video id="video" style="width: 100%; height: auto;" autoplay
                                                            playsinline></video>
                                                        <canvas id="canvas"
                                                            style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; pointer-events: none;"></canvas>
                                                        <div id="cameraOverlay"
                                                            style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; 
                                                                    display: flex; align-items: center; justify-content: center;
                                                                    background-color: rgba(0, 0, 0, 0.7); color: white;">
                                                            <div style="text-align: center;">
                                                                <i class="fa-solid fa-camera"
                                                                    style="font-size: 48px; margin-bottom: 10px;"></i>
                                                                <p>Camera is off</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="card card-xl border-success shadow rounded">
                                                    <div class="card-stamp card-stamp-lg">
                                                        <div class="card-stamp-icon bg-success">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                height="24" viewBox="0 0 24 24" fill="none"
                                                                stroke="currentColor" stroke-width="2"
                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                class="icon icon-tabler icons-tabler-outline icon-tabler-cube">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                                <path
                                                                    d="M21 16.008v-8.018a1.98 1.98 0 0 0 -1 -1.717l-7 -4.008a2.016 2.016 0 0 0 -2 0l-7 4.008c-.619 .355 -1 1.01 -1 1.718v8.018c0 .709 .381 1.363 1 1.717l7 4.008a2.016 2.016 0 0 0 2 0l7 -4.008c.619 -.355 1 -1.01 1 -1.718z" />
                                                                <path d="M12 22v-10" />
                                                                <path d="M12 12l8.73 -5.04" />
                                                                <path d="M3.27 6.96l8.73 5.04" />
                                                            </svg>
                                                        </div>
                                                    </div>
                                                    <div class="table-responsive">
                                                        <div class="card-body">
                                                            <div class="input-group mb-2">
                                                                <input type="text" class="form-control"
                                                                    id="resScanning" placeholder="Hasil Scanning...">
                                                                <button class="btn" type="button">Go!</button>
                                                            </div>
                                                        </div>
                                                        <div class="card-body">
                                                            <input id="idf" value="1" type="hidden">
                                                            <table id="detail_transaksi" class="control-group text-nowrap"
                                                                border="0"
                                                                style="width: 100%;text-align:center;font-weight: bold;">
                                                                <thead class="">
                                                                    <tr>
                                                                        <td class="bg-white text-white px-0 py-0"
                                                                            style="border-left-color:#FFFFFF;border-top-color:#FFFFFF;border-bottom-color:#FFFFFF;width: 10px">
                                                                        </td>
                                                                        <td style="width: 200px">
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                style="margin-right: 5px" width="24"
                                                                                height="24" viewBox="0 0 24 24"
                                                                                fill="none" stroke="currentColor"
                                                                                stroke-width="2" stroke-linecap="round"
                                                                                stroke-linejoin="round"
                                                                                class="icon icon-tabler icons-tabler-outline icon-tabler-qrcode">
                                                                                <path stroke="none" d="M0 0h24v24H0z"
                                                                                    fill="none" />
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
                                                                            Kode BB
                                                                        </td>
                                                                        <td style="width: 200px">
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                style="margin-right: 5px" width="24"
                                                                                height="24" viewBox="0 0 24 24"
                                                                                fill="none" stroke="currentColor"
                                                                                stroke-width="2" stroke-linecap="round"
                                                                                stroke-linejoin="round"
                                                                                class="icon icon-tabler icons-tabler-outline icon-tabler-category-plus">
                                                                                <path stroke="none" d="M0 0h24v24H0z"
                                                                                    fill="none" />
                                                                                <path
                                                                                    d="M4 4h6v6h-6zm10 0h6v6h-6zm-10 10h6v6h-6zm10 3h6m-3 -3v6" />
                                                                            </svg>
                                                                            Tipe
                                                                        </td>
                                                                        <td style="width: 200px">
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                style="margin-right: 5px" width="24"
                                                                                height="24" viewBox="0 0 24 24"
                                                                                fill="none" stroke="currentColor"
                                                                                stroke-width="2" stroke-linecap="round"
                                                                                stroke-linejoin="round"
                                                                                class="icon icon-tabler icons-tabler-outline icon-tabler-category-2">
                                                                                <path stroke="none" d="M0 0h24v24H0z"
                                                                                    fill="none" />
                                                                                <path d="M14 4h6v6h-6z" />
                                                                                <path d="M4 14h6v6h-6z" />
                                                                                <path
                                                                                    d="M17 17m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                                                                                <path
                                                                                    d="M7 7m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                                                                            </svg>
                                                                            Kategori
                                                                        </td>
                                                                        <td style="width: 200px">
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                style="margin-right: 5px" width="24"
                                                                                height="24" viewBox="0 0 24 24"
                                                                                fill="none" stroke="currentColor"
                                                                                stroke-width="2" stroke-linecap="round"
                                                                                stroke-linejoin="round"
                                                                                class="icon icon-tabler icons-tabler-outline icon-tabler-palette">
                                                                                <path stroke="none" d="M0 0h24v24H0z"
                                                                                    fill="none" />
                                                                                <path
                                                                                    d="M12 21a9 9 0 0 1 0 -18c4.97 0 9 3.582 9 8c0 1.06 -.474 2.078 -1.318 2.828c-.844 .75 -1.989 1.172 -3.182 1.172h-2.5a2 2 0 0 0 -1 3.75a1.3 1.3 0 0 1 -1 2.25" />
                                                                                <path
                                                                                    d="M8.5 10.5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                                                                                <path
                                                                                    d="M12.5 7.5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                                                                                <path
                                                                                    d="M16.5 10.5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                                                                            </svg>
                                                                            Warna
                                                                        </td>
                                                                        <td style="width: 200px">
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                style="margin-right: 5px" width="24"
                                                                                height="24" viewBox="0 0 24 24"
                                                                                fill="none" stroke="currentColor"
                                                                                stroke-width="2" stroke-linecap="round"
                                                                                stroke-linejoin="round"
                                                                                class="icon icon-tabler icons-tabler-outline icon-tabler-brand-speedtest">
                                                                                <path stroke="none" d="M0 0h24v24H0z"
                                                                                    fill="none" />
                                                                                <path
                                                                                    d="M5.636 19.364a9 9 0 1 1 12.728 0" />
                                                                                <path d="M16 9l-4 4" />
                                                                            </svg>
                                                                            Berat
                                                                        </td>
                                                                        <td style="width: 200px">
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                style="margin-right: 5px" width="24"
                                                                                height="24" viewBox="0 0 24 24"
                                                                                fill="none" stroke="currentColor"
                                                                                stroke-width="2" stroke-linecap="round"
                                                                                stroke-linejoin="round"
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
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- listBB --}}
                            <div class="tab-pane fade" id="tabs-listBB" role="tabpanel">
                                <div class="card card-xl border-primary shadow rounded">
                                    <div class="card-stamp card-stamp-lg">
                                        <div class="card-stamp-icon bg-primary">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
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
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                            height="24" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round" class="icon">
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
                                            class="table table-sm table-bordered table-striped table-vcenter card-table table-hover text-nowrap datatable datatable-listBB">
                                            <tfoot>
                                                <tr>
                                                    <th class="px-1 py-1 text-center" style="width: 1%">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                            height="24" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round"
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
                                                    <th class="px-1 th py-1" style="width: 1%">No. Form</th>
                                                    <th class="px-1 th py-1">ID Kontrak</th>
                                                    <th class="px-1 th py-1">Tipe</th>
                                                    <th class="px-1 th py-1" style="width: 1%">Kategori</th>
                                                    <th class="px-1 th py-1" style="width: 1%">Warna</th>
                                                    <th class="px-1 th py-1" style="width: 1%">Berat</th>
                                                    <th class="px-1 th py-1" style="width: 1%">Berat Truk Penuh</th>
                                                    <th class="px-1 th py-1" style="width: 1%">Berat Truk Kosong</th>
                                                    <th class="px-1 th py-1" style="width: 1%">Supplier</th>
                                                    <th class="px-1 th py-1" style="width: 1%">Pengemudi</th>
                                                    <th class="px-1 th py-1" style="width: 1%">No.Pol</th>
                                                    <th class="px-1 th py-1" style="width: 1%">Operator</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @include('shared.footer')

            {{-- CDN DETEKSI QRCODE --}}
            <script src="https://cdn.jsdelivr.net/npm/jsqr/dist/jsQR.js"></script>
            <script>
                let stream;
                let isUsingFrontCamera = true;
                let isCameraActive = false;
                let barcodeDetectionInterval;

                document.addEventListener('DOMContentLoaded', function() {
                    startCamera();
                });

                function startCamera() {
                    const constraints = {
                        video: {
                            facingMode: isUsingFrontCamera ? 'user' : 'environment'
                        }
                    };
                    navigator.mediaDevices.getUserMedia(constraints)
                        .then(function(s) {
                            stream = s;
                            const video = document.getElementById('video');
                            video.srcObject = stream;
                            video.play();
                            isCameraActive = true;
                            document.getElementById('toggleCameraButton').innerText = 'Stop Camera';
                            document.getElementById('cameraOverlay').style.display = 'none';
                            video.onloadedmetadata = () => {
                                startBarcodeDetection();
                            };
                        })
                        .catch(function(err) {
                            console.error("Error accessing camera: ", err);
                        });
                }

                function stopCamera() {
                    if (stream) {
                        stream.getTracks().forEach(track => track.stop());
                    }
                    clearInterval(barcodeDetectionInterval);
                    isCameraActive = false;
                    document.getElementById('toggleCameraButton').innerText = 'Start Camera';
                    document.getElementById('cameraOverlay').style.display = 'flex';
                }

                function toggleCamera() {
                    if (isCameraActive) {
                        stopCamera();
                    } else {
                        startCamera();
                    }
                }

                function switchCamera() {
                    stopCamera();
                    isUsingFrontCamera = !isUsingFrontCamera;
                    startCamera();
                }

                function startBarcodeDetection() {
                    const video = document.getElementById('video');
                    const canvas = document.getElementById('canvas');
                    const context = canvas.getContext('2d');
                    canvas.width = video.videoWidth;
                    canvas.height = video.videoHeight;
                    const targetArea = {
                        x: canvas.width * 0.3,
                        y: canvas.height * 0.3,
                        width: canvas.width * 0.4,
                        height: canvas.height * 0.4
                    };
                    barcodeDetectionInterval = setInterval(() => {
                        if (!isCameraActive) return;
                        if (video.videoWidth === 0 || video.videoHeight === 0) return;
                        context.drawImage(video, 0, 0, canvas.width, canvas.height);
                        const imageData = context.getImageData(0, 0, canvas.width, canvas.height);
                        const code = jsQR(imageData.data, imageData.width, imageData.height);
                        if (code) {
                            const centerX = (code.location.topLeftCorner.x + code.location.bottomRightCorner.x) / 2;
                            const centerY = (code.location.topLeftCorner.y + code.location.bottomRightCorner.y) / 2;
                            let color;
                            if (
                                centerX > targetArea.x &&
                                centerX < targetArea.x + targetArea.width &&
                                centerY > targetArea.y &&
                                centerY < targetArea.y + targetArea.height
                            ) {
                                color = "green";
                            } else if (
                                Math.abs(centerX - (targetArea.x + targetArea.width / 2)) < targetArea.width / 2 + 50 &&
                                Math.abs(centerY - (targetArea.y + targetArea.height / 2)) < targetArea.height / 2 + 50
                            ) {
                                color = "yellow";
                            } else {
                                color = "red";
                            }

                            context.beginPath();
                            context.strokeStyle = color;
                            context.lineWidth = 4;
                            context.strokeRect(targetArea.x, targetArea.y, targetArea.width, targetArea.height);
                            context.stroke();

                            if (color === "green") {
                                $.ajax({
                                    type: "POST",
                                    url: "/getDecryptKode",
                                    data: {
                                        _token: "{{ csrf_token() }}",
                                        keyword: code.data,
                                    },
                                    beforeSend: function() {
                                        $("#resScanning").val("Memeriksa Data...");
                                        $("#resScanning").prop("disabled", true);
                                        $("#resScanning").addClass("cursor-not-allowed");
                                    },
                                    success: function(response) {
                                        $("#resScanning").val(response);
                                        $("#resScanning").prop("disabled", false);
                                        $("#resScanning").removeClass("cursor-not-allowed");
                                    },
                                    error: function(data) {
                                        $("#resScanning").val("");
                                        $("#resScanning").prop("disabled", false);
                                    }
                                });
                                // Swal.fire({
                                //     title: 'Barcode Detected!',
                                //     text: `Data: ${code.data}`,
                                //     icon: 'success',
                                //     confirmButtonText: 'OK'
                                // }).then(() => {
                                //     startCamera();
                                //     // location.reload();
                                // });

                                // clearInterval(barcodeDetectionInterval);
                                // // stopCamera();
                            }
                        } else {
                            context.beginPath();
                            context.strokeStyle = "red";
                            context.lineWidth = 4;
                            context.strokeRect(targetArea.x, targetArea.y, targetArea.width, targetArea.height);
                            context.stroke();
                        }
                    }, 100);
                }
            </script>
            <script type="text/javascript">
                var tablePenerimaan, unApprovedTable, approvedTable, allTable;

                function synAll() {
                    allTable.ajax.reload();
                }

                function syn() {
                    tablePenerimaan.ajax.reload();
                }

                function synUnapproved() {
                    unApprovedTable.ajax.reload();
                }

                function synApproved() {
                    approvedTable.ajax.reload();
                }

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
                $(function() {
                    $(".select2kodekodekontrak").select2({
                        dropdownParent: $("#modal-penerimaan"),
                        language: "id",
                        width: '100%',
                        height: '100%',
                        placeholder: "Pilih KodeKontrak",
                        ajax: {
                            url: "/getkodeKontrak",
                            dataType: 'json',
                            processResults: function(response) {
                                return {
                                    results: $.map(response, function(item) {
                                        return {
                                            text: item.kode_kontrak.toUpperCase() + ' ' + item.tipe +
                                                ' ' + item
                                                .kategori + ' ' + item.warna,
                                            id: item.id,
                                        }
                                    })
                                };
                            },
                            cache: true
                        },
                    });

                    $('#package').select2({
                        dropdownParent: $("#modal-penerimaan"),
                        language: "id",
                        width: '100%',
                        height: '100%',
                        placeholder: 'Masukkan Package',
                        ajax: {
                            url: "{{ route('getjeniss') }}",
                            dataType: 'json',
                            processResults: function(data) {
                                return {
                                    results: $.map(data, function(item) {
                                        return {
                                            id: item.nama_jenis,
                                            text: item.nama_jenis
                                        };
                                    })
                                };
                            }
                        }
                    });
                    /*------------------------------------------
                    --------------------------------------------
                    Render DataTable
                    --------------------------------------------
                    --------------------------------------------*/
                    allTable = $('.datatable-all').DataTable({
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
                            "url": "{{ route('getPenerimaan.index') }}",
                            "data": function(data) {
                                data._token = "{{ csrf_token() }}";
                                data.dari = $('#filterStart-all').val();
                                data.sampai = $('#filterEnd-all').val();
                                data.status = '*';
                            }
                        },
                        columns: [{
                                title: '<svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-list-details"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M13 5h8" /><path d="M13 9h5" /><path d="M13 15h8" /><path d="M13 19h5" /><path d="M3 4m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" /><path d="M3 14m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" /></svg>',
                                data: 'action',
                                name: 'action',
                                className: "text-center",
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
                                title: 'NPB',
                                data: 'npb',
                                name: 'npb',
                                className: "cuspad0 cuspad1 text-center"
                            },
                            {
                                title: 'ID Kontrak',
                                data: 'kodekontrak',
                                name: 'kodekontrak',
                                className: "cuspad0 cuspad1 text-start"
                            },
                            {
                                title: 'Tipe',
                                data: 'tipe',
                                name: 'tipe',
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
                                title: 'Berat',
                                data: 'berat',
                                name: 'berat',
                                className: "cuspad0 cuspad1 text-center"
                            },
                            {
                                title: 'Berat Truck Penuh',
                                data: 'berat_trukpenuh',
                                name: 'berat_trukpenuh',
                                className: "cuspad0 cuspad1 text-center"
                            },
                            {
                                title: 'Berat Truck Kosong',
                                data: 'berat_trukkosong',
                                name: 'berat_trukkosong',
                                className: "cuspad0 cuspad1 text-center"
                            },
                            {
                                title: 'Supplier',
                                data: 'supplier',
                                name: 'supplier',
                                className: "cuspad0 cuspad1 text-center"
                            },
                            {
                                title: 'Pengemudi',
                                data: 'pengemudi',
                                name: 'pengemudi',
                                className: "cuspad0 cuspad1 text-center"
                            },
                            {
                                title: 'No.Pol',
                                data: 'nopol',
                                name: 'nopol',
                                className: "cuspad0 cuspad1 text-center"
                            },
                            {
                                title: 'Operator',
                                data: 'operator',
                                name: 'operator',
                                className: "cuspad0 cuspad1 text-center"
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
                            this.api().columns([5, 6, 7]).every(function() {
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
                    $('.datatable-all tfoot .th').each(function() {
                        var title = $(this).text();
                        $(this).html(
                            '<input type="text" class="form-control form-control-sm my-0 border" placeholder="' +
                            $(this).text().toUpperCase() + '" />'
                        );
                    });
                    $('.datatable-all').on('click', '.remove', function() {
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
                                                tablePenerimaan.ajax.reload(null,
                                                    false);
                                                unApprovedTable.ajax.reload(null,
                                                    false);
                                                approvedTable.ajax.reload(null, false);
                                                allTable.ajax.reload(null, false);

                                                Swal.fire({
                                                    icon: 'success',
                                                    title: 'Berhasil',
                                                    html: data,
                                                    showConfirmButton: true
                                                });
                                            },
                                            error: function(data) {
                                                tablePenerimaan.ajax.reload(null,
                                                    false);
                                                unApprovedTable.ajax.reload(null,
                                                    false);
                                                approvedTable.ajax.reload(null, false);
                                                allTable.ajax.reload(null, false);
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
                                        tablePenerimaan.ajax.reload(null, false);
                                        unApprovedTable.ajax.reload(null, false);
                                        approvedTable.ajax.reload(null, false);
                                        allTable.ajax.reload(null, false);
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
                    tablePenerimaan = $('.datatable-suratkontrak').DataTable({
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
                            {
                                className: 'btn btn-blue',
                                text: '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-cube-plus"><path stroke="none" d="M0 0h24v24H0z" fill="none" /><path d="M21 12.5v-4.509a1.98 1.98 0 0 0 -1 -1.717l-7 -4.008a2.016 2.016 0 0 0 -2 0l-7 4.007c-.619 .355 -1 1.01 -1 1.718v8.018c0 .709 .381 1.363 1 1.717l7 4.008a2.016 2.016 0 0 0 2 0" /><path d="M12 22v-10" /><path d="M12 12l8.73 -5.04" /><path d="M3.27 6.96l8.73 5.04" /><path d="M16 19h6" /><path d="M19 16v6" /></svg> Proses Penerimaan',
                                "action": function(e, node, config) {
                                    $('#modal-penerimaan').modal('show')
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
                            "select": {
                                rows: {
                                    _: "%d item dipilih ",
                                    0: "Pilih item dan tekan tombol Proses data untuk memproses",
                                }
                            },
                        },
                        "ajax": {
                            "url": "{{ route('getKontrak.index') }}",
                            "data": function(data) {
                                data._token = "{{ csrf_token() }}";
                                data.dari = $('#filterStart-input').val();
                                data.sampai = $('#filterEnd-input').val();
                                data.status = 1;
                            }
                        },
                        columnDefs: [{
                            'targets': 0,
                            "orderable": true,
                            'className': 'select-checkbox',
                            'checkboxes': {
                                'selectRow': true
                            },
                        }],
                        select: {
                            'style': 'multi',
                            // "selector": 'td:not(:nth-child(2))',
                        },
                        columns: [{
                                title: '<svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-list-details"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M13 5h8" /><path d="M13 9h5" /><path d="M13 15h8" /><path d="M13 19h5" /><path d="M3 4m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" /><path d="M3 14m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" /></svg>',
                                data: 'select_orders',
                                name: 'select_orders',
                                className: "text-center cursor-pointer",
                                orderable: false,
                                searchable: false,
                            },
                            {
                                title: 'Status',
                                data: 'status',
                                name: 'status',
                                className: "cuspad0 cuspad1 text-center cursor-pointer"
                            },
                            {
                                title: 'Tanggal',
                                data: 'tanggal',
                                name: 'tanggal',
                                className: "cuspad0 cuspad1 text-center cursor-pointer"
                            },
                            {
                                title: 'No. Form',
                                data: 'noform',
                                name: 'noform',
                                className: "cuspad0 cuspad1 text-center cursor-pointer"
                            },
                            {
                                title: 'ID Kontrak',
                                data: 'id_kontrak',
                                name: 'id_kontrak',
                                className: "cuspad0 cuspad1 text-start cursor-pointer"
                            },
                            {
                                title: 'Tipe',
                                data: 'tipe',
                                name: 'tipe',
                                className: "cuspad0 cuspad1 text-start cursor-pointer"
                            },
                            {
                                title: 'Kategori',
                                data: 'kategori',
                                name: 'kategori',
                                className: "cuspad0 cuspad1 text-start cursor-pointer"
                            },
                            {
                                title: 'Warna',
                                data: 'warna',
                                name: 'warna',
                                className: "cuspad0 cuspad1 text-start cursor-pointer"
                            },
                            {
                                title: 'Berat',
                                data: 'berat',
                                name: 'berat',
                                className: "cuspad0 cuspad1 text-center cursor-pointer"
                            },
                            {
                                title: 'Supplier',
                                data: 'supplier',
                                name: 'supplier',
                                className: "cuspad0 cuspad1 text-center cursor-pointer"
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
                            this.api().columns([5, 6, 7]).every(function() {
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
                    $('.datatable-suratkontrak tfoot .th').each(function() {
                        var title = $(this).text();
                        $(this).html(
                            '<input type="text" class="form-control form-control-sm my-0 border" placeholder="' +
                            $(this).text().toUpperCase() + '" />'
                        );
                    });
                    $('.datatable-suratkontrak').on('click', '.remove', function() {
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
                                                tablePenerimaan.ajax.reload(null,
                                                    false);
                                                unApprovedTable.ajax.reload(null,
                                                    false);
                                                approvedTable.ajax.reload(null, false);
                                                allTable.ajax.reload(null, false);
                                                Swal.fire({
                                                    icon: 'success',
                                                    title: 'Berhasil',
                                                    html: data,
                                                    showConfirmButton: true
                                                });
                                            },
                                            error: function(data) {
                                                tablePenerimaan.ajax.reload(null,
                                                    false);
                                                unApprovedTable.ajax.reload(null,
                                                    false);
                                                approvedTable.ajax.reload(null, false);
                                                allTable.ajax.reload(null, false);
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
                                        tablePenerimaan.ajax.reload(null, false);
                                        unApprovedTable.ajax.reload(null, false);
                                        approvedTable.ajax.reload(null, false);
                                        allTable.ajax.reload(null, false);
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
                    // $('#modal-edit-penerimaan').on('show.bs.modal', function(e) {
                    //     var button = $(e.relatedTarget)
                    //     var id = button.data('id');
                    //     console.log("Fetch Id Item: " + id + "...");
                    //     $(".overlay").fadeIn(300);
                    //     $.ajax({
                    //         type: 'POST',
                    //         url: "{{ url('viewEditsupplier') }}",
                    //         data: {
                    //             "_token": "{{ csrf_token() }}",
                    //             id: id,
                    //         },
                    //         success: function(data) {
                    //             $('.fetched-data-edit-penerimaan').html(data);
                    //         }
                    //     }).done(function() {
                    //         setTimeout(function() {
                    //             $(".overlay").fadeOut(300);
                    //         }, 500);
                    //     });
                    // });

                    unApprovedTable = $('.datatable-input').DataTable({
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
                            "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ total data yang harus di setujui",
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
                            "url": "{{ route('getPenerimaan.index') }}",
                            "data": function(data) {
                                data._token = "{{ csrf_token() }}";
                                data.dari = $('#filterStart-input').val();
                                data.sampai = $('#filterEnd-input').val();
                                data.status = 2;
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
                                className: "cuspad0 cuspad1 text-center cursor-pointer"
                            },
                            {
                                title: 'Tanggal',
                                data: 'tanggal',
                                name: 'tanggal',
                                className: "cuspad0 cuspad1 text-center cursor-pointer"
                            },
                            {
                                title: 'NPB',
                                data: 'npb',
                                name: 'npb',
                                className: "cuspad0 cuspad1 text-center"
                            },
                            {
                                title: 'ID Kontrak',
                                data: 'kodekontrak',
                                name: 'kodekontrak',
                                className: "cuspad0 cuspad1 text-start"
                            },
                            {
                                title: 'Tipe',
                                data: 'tipe',
                                name: 'tipe',
                                className: "cuspad0 cuspad1 text-start cursor-pointer"
                            },
                            {
                                title: 'Kategori',
                                data: 'kategori',
                                name: 'kategori',
                                className: "cuspad0 cuspad1 text-start cursor-pointer"
                            },
                            {
                                title: 'Warna',
                                data: 'warna',
                                name: 'warna',
                                className: "cuspad0 cuspad1 text-start cursor-pointer"
                            },
                            {
                                title: 'Berat',
                                data: 'berat',
                                name: 'berat',
                                className: "cuspad0 cuspad1 text-center cursor-pointer"
                            },
                            {
                                title: 'Supplier',
                                data: 'supplier',
                                name: 'supplier',
                                className: "cuspad0 cuspad1 text-center cursor-pointer"
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
                            this.api().columns([5, 6, 7]).every(function() {
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
                    $('.datatable-input tfoot .th').each(function() {
                        var title = $(this).text();
                        $(this).html(
                            '<input type="text" class="form-control form-control-sm my-0 border" placeholder="' +
                            $(this).text().toUpperCase() + '" />'
                        );
                    });
                    $('.datatable-input').on('click', '.remove', function() {
                        var id = $(this).data('id');
                        var nama = $(this).data('nama');
                        var kode = $(this).data('kode');
                        var token = $("meta[name='csrf-token']").attr("content");
                        let r = (Math.random() + 1).toString(36).substring(2);
                        swal.fire({
                            title: 'Membatalkan Proses ' + nama,
                            text: 'Apakah anda yakin ingin membatalkan inputan ' + nama + ', Tanggal : ' +
                                kode +
                                ' ?',
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#d33',
                            cancelButtonColor: '#3085d6',
                            confirmButtonText: '<i class="fa-regular fa-trash-can"></i> Ya',
                            cancelButtonText: 'Tidak',
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
                                            type: "POST",
                                            url: "{{ route('gudang.cancelOrder') }}",
                                            data: {
                                                "_token": "{{ csrf_token() }}",
                                                'id': id,
                                                'status': 1,
                                            },
                                            beforeSend: function() {
                                                Swal.fire({
                                                    title: 'Mohon Menunggu',
                                                    html: '<center><lottie-player src="https://lottie.host/9f0e9407-ad00-4a21-a698-e19bed2949f6/mM7VH432d9.json" background="transparent" speed="1" style="width: 300px; height: 300px;" loop autoplay></lottie-player></center><br><h1 class="h4">Sedang memproses data, Proses mungkin membutuhkan beberapa menit. </h1>',
                                                    timerProgressBar: true,
                                                    showConfirmButton: false,
                                                    allowOutsideClick: false,
                                                    allowEscapeKey: false,
                                                })
                                            },
                                            success: function(data) {
                                                tablePenerimaan.ajax.reload(null,
                                                    false);
                                                unApprovedTable.ajax.reload(null,
                                                    false);
                                                approvedTable.ajax.reload(null, false);
                                                allTable.ajax.reload(null, false);
                                                Swal.fire({
                                                    icon: 'success',
                                                    title: 'Berhasil',
                                                    html: data,
                                                    showConfirmButton: true
                                                });
                                            },
                                            error: function(data) {
                                                tablePenerimaan.ajax.reload(null,
                                                    false);
                                                unApprovedTable.ajax.reload(null,
                                                    false);
                                                approvedTable.ajax.reload(null, false);
                                                allTable.ajax.reload(null, false);
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
                                        tablePenerimaan.ajax.reload(null, false);
                                        unApprovedTable.ajax.reload(null, false);
                                        approvedTable.ajax.reload(null, false);
                                        allTable.ajax.reload(null, false);
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
                    approvedTable = $('.datatable-listBB').DataTable({
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
                            "url": "{{ route('getPenerimaan.index') }}",
                            "data": function(data) {
                                data._token = "{{ csrf_token() }}";
                                data.dari = $('#filterStart-listBB').val();
                                data.sampai = $('#filterEnd-listBB').val();
                                data.status = 3;
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
                                title: 'NPB',
                                data: 'npb',
                                name: 'npb',
                                className: "cuspad0 cuspad1 text-center"
                            },
                            {
                                title: 'ID Kontrak',
                                data: 'kodekontrak',
                                name: 'kodekontrak',
                                className: "cuspad0 cuspad1 text-start"
                            },
                            {
                                title: 'Tipe',
                                data: 'tipe',
                                name: 'tipe',
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
                                title: 'Berat',
                                data: 'berat',
                                name: 'berat',
                                className: "cuspad0 cuspad1 text-center"
                            },
                            {
                                title: 'Berat Truck Penuh',
                                data: 'berat_trukpenuh',
                                name: 'berat_trukpenuh',
                                className: "cuspad0 cuspad1 text-center"
                            },
                            {
                                title: 'Berat Truck Kosong',
                                data: 'berat_trukkosong',
                                name: 'berat_trukkosong',
                                className: "cuspad0 cuspad1 text-center"
                            },
                            {
                                title: 'Supplier',
                                data: 'supplier',
                                name: 'supplier',
                                className: "cuspad0 cuspad1 text-center"
                            },
                            {
                                title: 'Pengemudi',
                                data: 'pengemudi',
                                name: 'pengemudi',
                                className: "cuspad0 cuspad1 text-center"
                            },
                            {
                                title: 'No.Pol',
                                data: 'nopol',
                                name: 'nopol',
                                className: "cuspad0 cuspad1 text-center"
                            },
                            {
                                title: 'Operator',
                                data: 'operator',
                                name: 'operator',
                                className: "cuspad0 cuspad1 text-center"
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
                            this.api().columns([5, 6, 7]).every(function() {
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
                                                tablePenerimaan.ajax.reload(null,
                                                    false);
                                                unApprovedTable.ajax.reload(null,
                                                    false);
                                                approvedTable.ajax.reload(null, false);
                                                allTable.ajax.reload(null, false);
                                                Swal.fire({
                                                    icon: 'success',
                                                    title: 'Berhasil',
                                                    html: data,
                                                    showConfirmButton: true
                                                });
                                            },
                                            error: function(data) {
                                                tablePenerimaan.ajax.reload(null,
                                                    false);
                                                unApprovedTable.ajax.reload(null,
                                                    false);
                                                approvedTable.ajax.reload(null, false);
                                                allTable.ajax.reload(null, false);
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
                                        tablePenerimaan.ajax.reload(null, false);
                                        unApprovedTable.ajax.reload(null, false);
                                        approvedTable.ajax.reload(null, false);
                                        allTable.ajax.reload(null, false);
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
                    /*------------------------------------------==============================================================================================================================================================
                    --------------------------------------------==============================================================================================================================================================
                    Create Data
                    --------------------------------------------==============================================================================================================================================================
                    --------------------------------------------==============================================================================================================================================================*/
                    if ($("#formPenerimaan").length > 0) {
                        $("#formPenerimaan").validate({
                            rules: {
                                tanggal: {
                                    required: true,
                                },
                                nopol: {
                                    required: true,
                                },
                                nik: {
                                    required: true,
                                },
                                driver: {
                                    required: true,
                                },
                            },
                            messages: {
                                tanggal: {
                                    required: 'Kolom ini tidak boleh kosong',
                                },
                                nopol: {
                                    required: 'Kolom ini tidak boleh kosong',
                                },
                                nik: {
                                    required: 'Kolom ini tidak boleh kosong',
                                },
                                driver: {
                                    required: 'Kolom ini tidak boleh kosong',
                                },
                            },

                            submitHandler: function(form) {
                                $.ajaxSetup({
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    }
                                });
                                $('#submitPenerimaan').html(
                                    '<i class="fa-solid fa-fw fa-spinner fa-spin"></i> Please Wait...');
                                $("#submitPenerimaan").attr("disabled", true);
                                $.ajax({
                                    url: "{{ url('storedataPenerimaan') }}",
                                    type: "POST",
                                    data: $('#formPenerimaan').serialize(),
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
                                        console.log('Completed.');
                                        $('#submitPenerimaan').html(
                                            '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-floppy" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" /><path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M14 4l0 4l-6 0l0 -4" /></svg> Proses'
                                        );
                                        $("#submitPenerimaan").attr("disabled", false);
                                        const Toast = Swal.mixin({
                                            toast: true,
                                            position: "top-end",
                                            showConfirmButton: false,
                                            timer: 4000,
                                            timerProgressBar: true,
                                            didOpen: (toast) => {
                                                toast.onmouseenter = Swal.stopTimer;
                                                toast.onmouseleave = Swal.resumeTimer;
                                            }
                                        });
                                        Toast.fire({
                                            icon: "success",
                                            title: response.msg,
                                        });
                                        // document.getElementById("tipe").value = '';
                                        document.getElementById("formPenerimaan").reset();
                                        tablePenerimaan.ajax.reload(null, false);
                                        unApprovedTable.ajax.reload(null, false);
                                        approvedTable.ajax.reload(null, false);
                                        allTable.ajax.reload(null, false);
                                        $('#modal-penerimaan').modal('hide');
                                    },
                                    error: function(data) {
                                        tablePenerimaan.ajax.reload(null, false);
                                        unApprovedTable.ajax.reload(null, false);
                                        approvedTable.ajax.reload(null, false);
                                        allTable.ajax.reload(null, false);
                                        // console.log('Error:', data);
                                        // const obj = JSON.parse(data.responseJSON);
                                        console.log($('#formPenerimaan').serialize());
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Gagal Input',
                                            html: data.responseJSON.message,
                                            showConfirmButton: true
                                        });
                                        $('#submitPenerimaan').html(
                                            '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-floppy" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" /><path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M14 4l0 4l-6 0l0 -4" /></svg> Simpan'
                                        );
                                        $("#submitPenerimaan").attr("disabled", false);
                                    }
                                });
                            }
                        })
                    }

                    // MODAL ---------------------------------------------------------//
                    $('#modal-penerimaan').on('show.bs.modal', function(e) {
                        $(".overlay").fadeIn(300);
                        itemTables = [];
                        $.each(tablePenerimaan.rows('.selected').nodes(), function(index, rowId) {
                            var rows_selected = tablePenerimaan.rows('.selected').data();
                            itemTables.push(rows_selected[index]['id_kontrak']);
                        });
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        //menggunakan fungsi ajax untuk pengambilan data
                        $.ajax({
                            type: 'POST',
                            url: '{{ url('checkPenerimaan') }}',
                            data: {
                                "_token": "{{ csrf_token() }}",
                                id: itemTables,
                                jml: itemTables.length,
                            },
                            success: function(data) {
                                //menampilkan data ke dalam modal
                                $('.fetched-data-penerimaan').html(data);
                            }
                        }).done(function() {
                            setTimeout(function() {
                                $(".overlay").fadeOut(300);
                            }, 500);
                        });
                    });
                    // MODAL ---------------------------------------------------------//
                    $('#modal-detail-penerimaan').on('show.bs.modal', function(e) {
                        var button = $(e.relatedTarget)
                        var id = button.data('id');
                        console.log("Fetch Id Item: " + id + "...");
                        $(".overlay").fadeIn(300);
                        $.ajax({
                            type: 'POST',
                            url: "{{ url('detail/penerimaan') }}",
                            data: {
                                "_token": "{{ csrf_token() }}",
                                id: id,
                            },
                            success: function(data) {
                                $('.fetched-detail-penerimaan').html(data);
                            }
                        }).done(function() {
                            setTimeout(function() {
                                $(".overlay").fadeOut(300);
                            }, 500);
                        });
                    });
                });
            </script>
        </div>
    </div>
@endsection
