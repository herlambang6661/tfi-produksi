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
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="card card-xl border-primary shadow rounded mb-3 py-1 px-1">
                                <div class="row">
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
                                                <select id="cam-list" class="form-select form-select-sm border-primary">
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
                        <div class="col-lg-8">
                            <div class="card card-xl border-primary shadow rounded mb-3">
                                {{-- <div class="card-body px-2 py-2">
                                    <input type="text" id="inpt-qr" class="form-control">
                                </div> --}}
                                <div class="table-responsive">
                                    <input id="idf" value="1" type="hidden">
                                    <table id="detail_transaksi" class="control-group text-nowrap table-bordered"
                                        border="0" style="width: 100%;text-align:center;">
                                        <thead class="" style="font-weight: bold;">
                                            <tr>
                                                <td class="px-0 py-0"></td>
                                                <td style="width: 200px">
                                                    <svg xmlns="http://www.w3.org/2000/svg" style="margin-right: 5px"
                                                        width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        class="icon icon-tabler icons-tabler-outline icon-tabler-category-plus">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path d="M4 4h6v6h-6zm10 0h6v6h-6zm-10 10h6v6h-6zm10 3h6m-3 -3v6" />
                                                    </svg>
                                                    Kode Bahan Baku
                                                </td>
                                                <td style="width: 200px">
                                                    <svg xmlns="http://www.w3.org/2000/svg" style="margin-right: 5px"
                                                        width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
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
                                                    <svg xmlns="http://www.w3.org/2000/svg" style="margin-right: 5px"
                                                        width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
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
                                                    <svg xmlns="http://www.w3.org/2000/svg" style="margin-right: 5px"
                                                        width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        class="icon icon-tabler icons-tabler-outline icon-tabler-brand-speedtest">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path d="M5.636 19.364a9 9 0 1 1 12.728 0" />
                                                        <path d="M16 9l-4 4" />
                                                    </svg>
                                                    Berat
                                                </td>
                                                <td style="width: 200px">
                                                    <svg xmlns="http://www.w3.org/2000/svg" style="margin-right: 5px"
                                                        width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
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
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div style="display: none">
                        <select id="inversion-mode-select">
                            <option value="original">Scan original (dark QR code on bright background)</option>
                            <option value="invert">Scan with inverted colors (bright QR code on dark background)</option>
                            <option value="both">Scan both</option>
                        </select>
                        <br>
                    </div>

                    <b style="display: none">Detected QR code: </b>
                    <span id="cam-qr-result" style="display: none">None</span>

                    <b style="display: none">Last detected at: </b>
                    <span id="cam-qr-result-timestamp" style="display: none"></span>
                </div>
                @include('shared.footer')
            </div>
        </div>

        <!--<script src="../qr-scanner.umd.min.js"></script>-->
        <!--<script src="../qr-scanner.legacy.min.js"></script>-->
        <script type="text/javascript">
            function hapusElemen(idf) {
                $("#btn-remove" + idf).remove();
            }
        </script>
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
                                td.innerHTML += response.subkode + '<div class="kode_' + response.id + '">';
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
                scanner.start();
            });

            document.getElementById('stop-button').addEventListener('click', () => {
                scanner.stop();
            });
        </script>

    </div>
@endsection
