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

                    <h1>Scan from WebCam:</h1>
                    <div id="video-container">
                        <video id="qr-video"></video>
                    </div>
                    <div>
                        <label>
                            Highlight Style
                            <select id="scan-region-highlight-style-select">
                                <option value="default-style">Default style</option>
                                <option value="example-style-1">Example custom style 1</option>
                                <option value="example-style-2">Example custom style 2</option>
                            </select>
                        </label>
                        <label>
                            <input id="show-scan-region" type="checkbox">
                            Show scan region canvas
                        </label>
                    </div>
                    <div>
                        <select id="inversion-mode-select">
                            <option value="original">Scan original (dark QR code on bright background)</option>
                            <option value="invert">Scan with inverted colors (bright QR code on dark background)</option>
                            <option value="both">Scan both</option>
                        </select>
                        <br>
                    </div>
                    <b>Device has camera: </b>
                    <span id="cam-has-camera"></span>
                    <br>
                    <div>
                        <b>Preferred camera:</b>
                        <select id="cam-list">
                            <option value="environment" selected>Environment Facing (default)</option>
                            <option value="user">User Facing</option>
                        </select>
                    </div>
                    <b>Camera has flash: </b>
                    <span id="cam-has-flash"></span>
                    <div>
                        <button id="flash-toggle">📸 Flash: <span id="flash-state">off</span></button>
                    </div>
                    <br>
                    <b>Detected QR code: </b>
                    <span id="cam-qr-result">None</span>
                    <br>
                    <b>Last detected at: </b>
                    <span id="cam-qr-result-timestamp"></span>
                    <br>
                    <button id="start-button">Start</button>
                    <button id="stop-button">Stop</button>
                </div>
                @include('shared.footer')
            </div>
        </div>

        <!--<script src="../qr-scanner.umd.min.js"></script>-->
        <!--<script src="../qr-scanner.legacy.min.js"></script>-->
        <script type="module">
            import QrScanner from "{{ asset('assets/extentions/qr-scanner.min.js') }}";

            const video = document.getElementById('qr-video');
            const videoContainer = document.getElementById('video-container');
            const camHasCamera = document.getElementById('cam-has-camera');
            const camList = document.getElementById('cam-list');
            const camHasFlash = document.getElementById('cam-has-flash');
            const flashToggle = document.getElementById('flash-toggle');
            const flashState = document.getElementById('flash-state');
            const camQrResult = document.getElementById('cam-qr-result');
            const camQrResultTimestamp = document.getElementById('cam-qr-result-timestamp');

            function setResult(label, result) {
                console.log(result.data);
                label.textContent = result.data;
                camQrResultTimestamp.textContent = new Date().toString();
                label.style.color = 'teal';
                clearTimeout(label.highlightTimeout);
                label.highlightTimeout = setTimeout(() => label.style.color = 'inherit', 100);
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
                    camHasFlash.textContent = hasFlash;
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

            QrScanner.hasCamera().then(hasCamera => camHasCamera.textContent = hasCamera);

            // for debugging
            window.scanner = scanner;

            document.getElementById('scan-region-highlight-style-select').addEventListener('change', (e) => {
                videoContainer.className = e.target.value;
                scanner._updateOverlay(); // reposition the highlight because style 2 sets position: relative
            });

            document.getElementById('show-scan-region').addEventListener('change', (e) => {
                const input = e.target;
                const label = input.parentNode;
                label.parentNode.insertBefore(scanner.$canvas, label.nextSibling);
                scanner.$canvas.style.display = input.checked ? 'block' : 'none';
            });

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
