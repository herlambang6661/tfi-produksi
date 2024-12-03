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

        .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        /* Optional: Adjust table header and content for mobile */
        @media (max-width: 768px) {
            table {
                font-size: 12px;
            }

            table th,
            table td {
                padding: 8px;
            }

            /* Adjust icons for smaller screens */
            table svg {
                width: 18px;
                height: 18px;
            }
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
            <div class="Loadings">
                <div class="cv-spinner">
                    <span class="loader"></span>
                </div>
            </div> <!-- Page header -->
            <div class="page-header d-print-none">
                <div class="container-xl">
                    <div class="row g-2 align-items-center">
                        <div class="col">
                            <!-- Page pre-title -->
                            <h2 class="page-title">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-clipboard-plus">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path
                                        d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2" />
                                    <path
                                        d="M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z" />
                                    <path d="M10 14h4" />
                                    <path d="M12 12v4" />
                                </svg>
                                Tambah Surat Kontrak
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
                                            <i class="fa-solid fa-file-signature"></i>
                                            Kontrak
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item" aria-current="page">
                                        <a href="{{ url('kontrak/suratkontrak') }}">
                                            <i class="fa-solid fa-book"></i>
                                            Surat Kontrak
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        <a href="#">
                                            <i class="fa-solid fa-file-circle-plus"></i>
                                            Tambah Surat Kontrak
                                        </a>
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Page body -->
            <div class="page-body">
                <div class="container-xl">
                    <div class="row row-deck row-cards">
                        <div class="col-12">
                            <div class="card card-xl border-success shadow rounded">
                                <div class="card-stamp card-stamp-lg">
                                    <div class="card-stamp-icon bg-success">
                                        <i class="fa-solid fa-users"></i>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <form method="POST" name="formSuratkontrak" id="formSuratkontrak" class="form"
                                        enctype="multipart/form-data" accept-charset="utf-8"
                                        onkeydown="return event.key != 'Enter';" data-select2-id="add-form">
                                        @csrf
                                        <div class="hr-text text-success my-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="icon icon-tabler icons-tabler-outline icon-tabler-list-details text-success">
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
                                            Formulir Kontrak
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label class="form-label">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                height="24" viewBox="0 0 24 24" fill="none"
                                                                stroke="currentColor" stroke-width="2"
                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                class="icon icon-tabler icons-tabler-outline icon-tabler-flag">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                                <path
                                                                    d="M5 5a5 5 0 0 1 7 0a5 5 0 0 0 7 0v9a5 5 0 0 1 -7 0a5 5 0 0 0 -7 0v-9z" />
                                                                <path d="M5 21v-7" />
                                                            </svg>
                                                            Entitas
                                                        </label>
                                                        <input type="text"
                                                            class="form-control border border-dark bg-success-lt"
                                                            name="entitas" id="entitas" readonly value="TFI">
                                                        <label class="form-label mt-2">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                height="24" viewBox="0 0 24 24" fill="none"
                                                                stroke="currentColor" stroke-width="2"
                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                class="icon icon-tabler icons-tabler-outline icon-tabler-calendar-event">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                                <path
                                                                    d="M4 5m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z" />
                                                                <path d="M16 3l0 4" />
                                                                <path d="M8 3l0 4" />
                                                                <path d="M4 11l16 0" />
                                                                <path d="M8 15h2v2h-2z" />
                                                            </svg>
                                                            Tanggal Kontrak
                                                        </label>
                                                        <input type="date" class="form-control border border-dark"
                                                            name="tanggal" id="tanggal" value="{{ date('Y-m-d') }}">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-label">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                height="24" viewBox="0 0 24 24" fill="none"
                                                                stroke="currentColor" stroke-width="2"
                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                class="icon icon-tabler icons-tabler-outline icon-tabler-users">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                                <path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                                                                <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                                                                <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                                                                <path d="M21 21v-2a4 4 0 0 0 -3 -3.85" />
                                                            </svg>
                                                            Supplier
                                                        </label>
                                                        <style>
                                                            #select2-supplier-container {
                                                                border: 1px solid black;
                                                            }
                                                        </style>
                                                        <select name="supplier" id="supplier"
                                                            class="form-select select2kodesupplier"
                                                            data-select2-id="supplier" tabindex="-1" aria-hidden="true">
                                                        </select>
                                                        <label class="form-label mt-2">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                height="24" viewBox="0 0 24 24" fill="none"
                                                                stroke="currentColor" stroke-width="2"
                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                class="icon icon-tabler icons-tabler-outline icon-tabler-shopping-cart">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                                <path d="M6 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                                                <path d="M17 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                                                <path d="M17 17h-11v-14h-2" />
                                                                <path d="M6 5l14 1l-1 7h-13" />
                                                            </svg>
                                                            Dibeli Oleh
                                                        </label>
                                                        <input type="text" class="form-control border border-dark"
                                                            name="dibeli" id="dibeli"
                                                            placeholder="Masukkan Dibeli Oleh">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="icon icon-tabler icons-tabler-outline icon-tabler-pencil">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path d="M4 20h4l10.5 -10.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4" />
                                                        <path d="M13.5 6.5l4 4" />
                                                    </svg>
                                                    Keterangan Tambahan
                                                </label>
                                                <div class="col-lg-12">
                                                    <textarea name="keterangan" id="keterangan" cols="90" rows="5" class="form-control border border-dark"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="hr-text text-success my-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="icon icon-tabler icons-tabler-outline icon-tabler-list-numbers text-success">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M11 6h9" />
                                                <path d="M11 12h9" />
                                                <path d="M12 18h8" />
                                                <path d="M4 16a2 2 0 1 1 4 0c0 .591 -.5 1 -1 1.5l-3 2.5h4" />
                                                <path d="M6 10v-6l-2 2" />
                                            </svg>
                                            Item dalam Kontrak
                                        </div>
                                        <div class="btn-list mt-3">
                                            <button class="btn btn-pill btn-success mb-3" type="button"
                                                onclick="tambahItem(); return false;">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="icon icon-tabler icons-tabler-outline icon-tabler-cube-plus">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path
                                                        d="M21 12.5v-4.509a1.98 1.98 0 0 0 -1 -1.717l-7 -4.008a2.016 2.016 0 0 0 -2 0l-7 4.007c-.619 .355 -1 1.01 -1 1.718v8.018c0 .709 .381 1.363 1 1.717l7 4.008a2.016 2.016 0 0 0 2 0" />
                                                    <path d="M12 22v-10" />
                                                    <path d="M12 12l8.73 -5.04" />
                                                    <path d="M3.27 6.96l8.73 5.04" />
                                                    <path d="M16 19h6" />
                                                    <path d="M19 16v6" />
                                                </svg>
                                                Tambah Bahan Baku
                                            </button>
                                            <div class="dropdown">
                                                <a href="#" class="btn btn-pill btn-info dropdown-toggle"
                                                    data-bs-toggle="dropdown">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="icon icon-tabler icons-tabler-outline icon-tabler-database-plus">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path
                                                            d="M4 6c0 1.657 3.582 3 8 3s8 -1.343 8 -3s-3.582 -3 -8 -3s-8 1.343 -8 3" />
                                                        <path d="M4 6v6c0 1.657 3.582 3 8 3c1.075 0 2.1 -.08 3.037 -.224" />
                                                        <path d="M20 12v-6" />
                                                        <path
                                                            d="M4 12v6c0 1.657 3.582 3 8 3c.166 0 .331 -.002 .495 -.006" />
                                                        <path d="M16 19h6" />
                                                        <path d="M19 16v6" />
                                                    </svg>
                                                    Tambah Daftar
                                                </a>
                                                <div class="dropdown-menu">
                                                    <span class="dropdown-header">Pilih Opsi dibawah</span>
                                                    <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                        data-bs-target="#modal-add-daftar" data-id="bahan">
                                                        <svg xmlns="http://www.w3.org/2000/svg" style="margin-right: 5px"
                                                            width="24" height="24" viewBox="0 0 24 24"
                                                            fill="none" stroke="currentColor" stroke-width="2"
                                                            stroke-linecap="round" stroke-linejoin="round"
                                                            class="icon icon-tabler icons-tabler-outline icon-tabler-category-plus">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                            <path
                                                                d="M4 4h6v6h-6zm10 0h6v6h-6zm-10 10h6v6h-6zm10 3h6m-3 -3v6" />
                                                        </svg>
                                                        Bahan Baku
                                                    </a>
                                                    <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                        data-bs-target="#modal-add-daftar" data-id="kategori">
                                                        <svg xmlns="http://www.w3.org/2000/svg" style="margin-right: 5px"
                                                            width="24" height="24" viewBox="0 0 24 24"
                                                            fill="none" stroke="currentColor" stroke-width="2"
                                                            stroke-linecap="round" stroke-linejoin="round"
                                                            class="icon icon-tabler icons-tabler-outline icon-tabler-category-2">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                            <path d="M14 4h6v6h-6z" />
                                                            <path d="M4 14h6v6h-6z" />
                                                            <path d="M17 17m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                                                            <path d="M7 7m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                                                        </svg>
                                                        Kategori
                                                    </a>
                                                    <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                        data-bs-target="#modal-add-daftar" data-id="warna">
                                                        <svg xmlns="http://www.w3.org/2000/svg" style="margin-right: 5px"
                                                            width="24" height="24" viewBox="0 0 24 24"
                                                            fill="none" stroke="currentColor" stroke-width="2"
                                                            stroke-linecap="round" stroke-linejoin="round"
                                                            class="icon icon-tabler icons-tabler-outline icon-tabler-palette">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                            <path
                                                                d="M12 21a9 9 0 0 1 0 -18c4.97 0 9 3.582 9 8c0 1.06 -.474 2.078 -1.318 2.828c-.844 .75 -1.989 1.172 -3.182 1.172h-2.5a2 2 0 0 0 -1 3.75a1.3 1.3 0 0 1 -1 2.25" />
                                                            <path d="M8.5 10.5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                                                            <path d="M12.5 7.5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                                                            <path d="M16.5 10.5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                                                        </svg>
                                                        Warna
                                                    </a>
                                                    <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                        data-bs-target="#modal-add-daftar" data-id="supplier">
                                                        <svg xmlns="http://www.w3.org/2000/svg" style="margin-right: 5px"
                                                            width="24" height="24" viewBox="0 0 24 24"
                                                            fill="none" stroke="currentColor" stroke-width="2"
                                                            stroke-linecap="round" stroke-linejoin="round"
                                                            class="icon icon-tabler icons-tabler-outline icon-tabler-users">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                            <path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                                                            <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                                                            <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                                                            <path d="M21 21v-2a4 4 0 0 0 -3 -3.85" />
                                                        </svg>
                                                        Supplier
                                                    </a>
                                                </div>
                                            </div>

                                        </div>
                                        <input id="idf" value="1" type="hidden">
                                        <div class="mb-4 table-responsive">
                                            <table id="detail_transaksi" class="control-group text-nowrap" border="0"
                                                style="width: 100%;text-align:center;font-weight: bold;">
                                                <thead class="">
                                                    <tr>
                                                        <td class="bg-white text-white px-0 py-0"
                                                            style="border-left-color:#FFFFFF;border-top-color:#FFFFFF;border-bottom-color:#FFFFFF;width: 10px">
                                                        </td>
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
                                                            Kategori
                                                        </td>
                                                        <td style="width: 200px">
                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                style="margin-right: 5px" width="24" height="24"
                                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                                stroke-width="2" stroke-linecap="round"
                                                                stroke-linejoin="round"
                                                                class="icon icon-tabler icons-tabler-outline icon-tabler-palette">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                                <path
                                                                    d="M12 21a9 9 0 0 1 0 -18c4.97 0 9 3.582 9 8c0 1.06 -.474 2.078 -1.318 2.828c-.844 .75 -1.989 1.172 -3.182 1.172h-2.5a2 2 0 0 0 -1 3.75a1.3 1.3 0 0 1 -1 2.25" />
                                                                <path d="M8.5 10.5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                                                                <path d="M12.5 7.5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                                                                <path d="M16.5 10.5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                                                            </svg>
                                                            Warna
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
                                                            Harga
                                                        </td>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                        <hr>
                                        <div class="btn-list mt-3">
                                            <a href="#" class="btn me-auto" style="visibility:hidden">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="icon icon-tabler icons-tabler-outline icon-tabler-arrow-left">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M5 12l14 0" />
                                                    <path d="M5 12l6 6" />
                                                    <path d="M5 12l6 -6" />
                                                </svg>
                                                Kembali
                                            </a>
                                            <button type="submit" id="submitSuratkontrak" class="btn btn-primary">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="icon icon-tabler icon-tabler-device-floppy" width="24"
                                                    height="24" viewBox="0 0 24 24" stroke-width="2"
                                                    stroke="currentColor" fill="none" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path
                                                        d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" />
                                                    <path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                                    <path d="M14 4l0 4l-6 0l0 -4" />
                                                </svg>
                                                Simpan
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- modal daftar --}}
            <div class="modal modal-blur fade" id="modal-add-daftar" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="overlay">
                    <div class="cv-spinner">
                        <span class="loader"></span>
                    </div>
                </div>
                <div class="modal-dialog modal-lg " role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-primary text-white">
                            <h5 class="modal-title">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-contract">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M8 21h-2a3 3 0 0 1 -3 -3v-1h5.5" />
                                    <path d="M17 8.5v-3.5a2 2 0 1 1 2 2h-2" />
                                    <path d="M19 3h-11a3 3 0 0 0 -3 3v11" />
                                    <path d="M9 7h4" />
                                    <path d="M9 11h4" />
                                    <path d="M18.42 12.61a2.1 2.1 0 0 1 2.97 2.97l-6.39 6.42h-3v-3z" />
                                </svg>
                                Tambah Daftar
                            </h5>
                            <button type="button" class="btn-close text-white" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="fetched-data-daftar"></div>
                    </div>
                </div>
            </div>
            {{-- end modal daftar --}}
            @include('shared.footer')
            <script type="text/javascript">
                function tambahItem() {
                    var idf = document.getElementById("idf").value;
                    var detail_transaksi = document.getElementById("detail_transaksi");
                    var tr = document.createElement("tr");
                    tr.setAttribute("id", "btn-remove" + idf);

                    // Kolom 1 Hapus
                    var td = document.createElement("td");
                    td.setAttribute("align", "center");
                    td.setAttribute("style", "border-left-color:#FFFFFF;border-top-color:#FFFFFF;border-bottom-color:#FFFFFF;");
                    td.innerHTML += '<button class="btn btn-danger btn-icon remove" type="button" onclick="hapusElemen(' +
                        idf +
                        ');"><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-trash"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg> </button>';
                    tr.appendChild(td);

                    // Kolom 2 Tipe
                    var td = document.createElement("td");
                    td.innerHTML += "<select name='tipe[]' id='tipe_" + idf +
                        "' class='form-select border-danger' style='width:100%;text-transform: uppercase;'></select>";
                    tr.appendChild(td);

                    // Kolom 3 Kategori           
                    var td = document.createElement("td");
                    td.innerHTML += "<select name='kategori[]' id='kategori_" + idf +
                        "' class='form-select border-danger' style='width:100%;text-transform: uppercase;'></select>";
                    tr.appendChild(td);

                    // Kolom 4 Warna
                    var td = document.createElement("td");
                    td.innerHTML += "<select name='warna[]' id='warna_" + idf +
                        "' class='form-select border-danger' style='width:100%;text-transform: uppercase;'></select>";
                    tr.appendChild(td);

                    // Kolom 5 Berat
                    var td = document.createElement("td");
                    td.innerHTML += "<input type='number' name='berat[]' id='berat_" + idf +
                        "' class='form-control' step='0.01' placeholder='0.00'>";
                    tr.appendChild(td);

                    // Kolom 6 Harga
                    var td = document.createElement("td");
                    td.innerHTML += "<input type='number' step='0.01' placeholder='0.00' name='harga[]' id='harga_" +
                        idf +
                        "' class='form-control'>";
                    tr.appendChild(td);

                    detail_transaksi.appendChild(tr);

                    $("#tipe_" + idf).select2({
                        language: "id",
                        width: '250px',
                        placeholder: "Pilih Bahan Baku",
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
                    $("#kategori_" + idf).select2({
                        language: "id",
                        width: '250px',
                        placeholder: "Pilih Kategori",
                        ajax: {
                            url: "{{ route('getKT') }}",
                            dataType: 'json',
                            delay: 200,
                            processResults: function(response) {
                                return {
                                    results: $.map(response, function(item) {
                                        return {
                                            text: (!item.kode_kategori ? '' : item.kode_kategori + ' - ') + item
                                                .nama_kategori.toUpperCase(),
                                            id: item.id,
                                        }
                                    })
                                };
                            },
                            cache: true
                        },
                    });
                    $("#warna_" + idf).select2({
                        language: "id",
                        width: '250px',
                        placeholder: "Pilih Warna",
                        ajax: {
                            url: "{{ route('getWR') }}",
                            dataType: 'json',
                            delay: 200,
                            processResults: function(response) {
                                return {
                                    results: $.map(response, function(item) {
                                        return {
                                            text: (!item.kode_warna ? '' : item.kode_warna + ' - ') + item
                                                .warna.toUpperCase(),
                                            id: item.id,
                                        }
                                    })
                                };
                            },
                            cache: true
                        },
                    });

                    idf = (idf - 1) + 2;
                    document.getElementById("idf").value = idf;
                }

                function hapusElemen(idf) {
                    $("#btn-remove" + idf).remove();
                }

                $(function() {
                    $(".select2kodesupplier").select2({
                        language: "id",
                        width: '100%',
                        height: '100%',
                        placeholder: "Pilih Supplier",
                        ajax: {
                            url: "/getsupplierKontrak",
                            dataType: 'json',
                            // type: 'post',
                            // data: {
                            //     "_token": "{{ csrf_token() }}",
                            // },
                            // delay: 250,
                            processResults: function(response) {
                                return {
                                    results: $.map(response, function(item) {
                                        return {
                                            text: item.nama + (!item.kota ? '' : ' - ' + item
                                                .kota),
                                            id: item.nama,
                                        }
                                    })
                                };
                            },
                            cache: true
                        },
                    });
                    /*------------------------------------------==============================================================================================================================================================
                    --------------------------------------------==============================================================================================================================================================
                    Create Data
                    --------------------------------------------==============================================================================================================================================================
                    --------------------------------------------==============================================================================================================================================================*/
                    if ($("#formSuratkontrak").length > 0) {
                        $("#formSuratkontrak").validate({
                            rules: {
                                entitas: {
                                    required: true,
                                },
                                tanggal: {
                                    required: true,
                                },
                                supplier: {
                                    required: true,
                                },
                                dibeli: {
                                    required: true,
                                },
                            },
                            messages: {
                                entitas: {
                                    required: "Masukkan Entitas",
                                },
                                tanggal: {
                                    required: "Masukkan Tanggal Kontrak",
                                },
                                supplier: {
                                    required: "Masukkan Nama Supplier",
                                },
                                dibeli: {
                                    required: "Masukkan Dibeli",
                                },
                            },

                            submitHandler: function(form) {
                                $.ajaxSetup({
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    }
                                });
                                $('#submitSuratkontrak').html(
                                    '<i class="fa-solid fa-fw fa-spinner fa-spin"></i> Please Wait...');
                                $("#submitSuratkontrak").attr("disabled", true);
                                $.ajax({
                                    url: "{{ url('storedataSuratkontrak') }}",
                                    type: "POST",
                                    data: $('#formSuratkontrak').serialize(),
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
                                        $('#submitSuratkontrak').html(
                                            '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-floppy" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" /><path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M14 4l0 4l-6 0l0 -4" /></svg> Simpan'
                                        );
                                        $("#submitSuratkontrak").attr("disabled", false);
                                        Swal.fire({
                                            icon: 'success',
                                            title: 'Berhasil',
                                            html: response,
                                            showConfirmButton: true
                                        }).then((result) => {
                                            if (result.isConfirmed) {
                                                // location.reload();
                                                $(".Loadings").fadeIn(300);
                                                window.location.href =
                                                    "{{ route('kontrak/suratkontrak') }}";
                                            }
                                        });
                                        document.getElementById("formSuratkontrak").reset();
                                    },
                                    error: function(data) {
                                        tableKontrak.ajax.reload(null, false);
                                        console.log('Error:', data);
                                        // const obj = JSON.parse(data.responseJSON);
                                        console.log($('#formSuratkontrak').serialize());
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Gagal Input',
                                            html: data.responseJSON.message,
                                            showConfirmButton: true
                                        });
                                        $('#submitSuratkontrak').html(
                                            '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-floppy" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" /><path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M14 4l0 4l-6 0l0 -4" /></svg> Simpan'
                                        );
                                        $("#submitSuratkontrak").attr("disabled", false);
                                    }
                                });
                            }
                        })
                    }

                    $('#modal-add-daftar').on('show.bs.modal', function(e) {
                        var button = $(e.relatedTarget)
                        var id = button.data('id');
                        $(".overlay").fadeIn(300);
                        $.ajax({
                            type: 'POST',
                            url: "{{ route('daftar.add') }}",
                            data: {
                                "_token": "{{ csrf_token() }}",
                                id: id,
                            },
                            success: function(data) {
                                $('.fetched-data-daftar').html(data);
                            }
                        }).done(function() {
                            setTimeout(function() {
                                $(".overlay").fadeOut(300);
                            }, 500);
                        });
                    });

                    if ($("#formSupplier").length > 0) {
                        $("#formSupplier").validate({
                            rules: {
                                nama: {
                                    required: true,
                                },
                                noid: {
                                    required: true,
                                },
                                telp: {
                                    required: true,
                                },
                                kota: {
                                    required: true,
                                },
                                provinsi: {
                                    required: true,
                                },
                                mtuang: {
                                    required: true,
                                },
                                alamat: {
                                    required: true,
                                },
                            },
                            messages: {
                                nama: {
                                    required: "Masukkan Nama Supplier",
                                },
                                noid: {
                                    required: "Nomor ID tidak boleh kosong",
                                },
                                telp: {
                                    required: "Masukkan Telepon Supplier",
                                },
                                kota: {
                                    required: "Masukkan Kota Supplier",
                                },
                                provinsi: {
                                    required: "Masukkan Provinsi Supplier",
                                },
                                mtuang: {
                                    required: "Masukkan Mata Uang Supplier",
                                },
                                alamat: {
                                    required: "Masukkan Alamat Supplier",
                                },
                            },
                            submitHandler: function(form) {
                                let formData = new FormData(form);

                                $("#submitSupplier").html("Please Wait...");
                                $("#submitSupplier").attr("disabled", true);

                                $.ajax({
                                    url: "storedataSupplier",
                                    type: "POST",
                                    data: formData,
                                    contentType: false,
                                    processData: false,
                                    beforeSend: function() {
                                        Swal.fire({
                                            title: "Mohon Menunggu",
                                            html: "Sedang memproses data, Proses mungkin membutuhkan beberapa menit.",
                                            showConfirmButton: false,
                                            timerProgressBar: true,
                                            allowOutsideClick: false,
                                            allowEscapeKey: false,
                                        });
                                    },
                                    success: function(response) {
                                        tableSupplier.ajax.reload(null, false);
                                        $("#submitSupplier").html("Simpan");
                                        $("#submitSupplier").attr("disabled", false);
                                        Swal.fire({
                                            icon: "success",
                                            title: "Berhasil",
                                            html: response,
                                            showConfirmButton: true
                                        }).then((result) => {
                                            if (result.isConfirmed) {
                                                location.reload();
                                            }
                                        });
                                        document.getElementById("formSupplier").reset();
                                        $("#modal-supplier").modal("hide");
                                    },
                                    error: function(data) {
                                        tableSupplier.ajax.reload(null, false);
                                        Swal.fire({
                                            icon: "error",
                                            title: "Gagal Input",
                                            html: data.responseJSON.message,
                                            showConfirmButton: true
                                        });
                                        $("#submitSupplier").html(
                                            " Simpan"
                                        );
                                        $("#submitSupplier").attr("disabled", false);
                                    }
                                });
                            }
                        })
                    }
                });
            </script>
        </div>
    </div>
@endsection
