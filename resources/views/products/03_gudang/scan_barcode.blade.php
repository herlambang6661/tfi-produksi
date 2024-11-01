@extends('layouts.app')
@section('content')
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
                                    <li class="breadcrumb-item active" aria-current="page">
                                        <a href="#">
                                            <i class="fa-solid fa-barcode"></i>
                                            {{ $judul }}
                                        </a>
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="page-body">
                <div class="container-xl">
                    <div class="row row-deck row-cards">
                        <div class="col-lg-6">
                            <div class="card card-xl border-primary shadow rounded">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <button type="button" id="switchCameraButton"
                                                class="btn btn-primary mt-2 d-inline-block me-2" onclick="switchCamera()">
                                                Switch Camera
                                            </button>
                                            <button type="button" id="toggleCameraButton"
                                                class="btn btn-danger mt-2 d-inline-block" onclick="toggleCamera()">
                                                Stop Camera
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="mb-3">
                                    <video id="video" style="width: 100%; height: auto;" autoplay playsinline></video>
                                    <canvas id="canvas"
                                        style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; pointer-events: none;"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card card-xl border-success shadow rounded">
                                <div class="card-stamp card-stamp-lg">
                                    <div class="card-stamp-icon bg-success">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
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
                                    <table style="width:100%; height: 100%;font-size:13px;"
                                        class="table table-sm table-bordered table-striped table-vcenter card-table table-hover text-nowrap datatable datatable-penerimaan">
                                        <tfoot>
                                            <tr>
                                                <th class="px-1 py-1 text-center">
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
                                                <th class="px-1 th py-1"></th>
                                                <th class="px-1 th py-1">Tanggal</th>
                                                <th class="px-1 th py-1">Kode Kontrak</th>
                                                <th class="px-1 th py-1">Tipe</th>
                                                <th class="px-1 th py-1">Qty</th>
                                                <th class="px-1 th py-1">Package</th>
                                                <th class="px-1 th py-1">Berat Penuh</th>
                                                <th class="px-1 th py-1">Berat Kosong</th>
                                                <th class="px-1 th py-1">Nopol</th>
                                                <th class="px-1 th py-1">Pengemudi</th>
                                                <th class="px-1 th py-1">KTP</th>
                                                <th class="px-1 th py-1">Keterangan</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('shared.footer')
            <script src="https://cdn.jsdelivr.net/npm/jsqr/dist/jsQR.min.js"></script>
            <script>
                let stream;
                let isUsingFrontCamera = true;
                let isCameraActive = false;
                let qrDetectionInterval;

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

                            // Tunggu video siap sebelum memulai deteksi
                            video.onloadedmetadata = () => {
                                startQRCodeDetection();
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
                    clearInterval(qrDetectionInterval);
                    isCameraActive = false;
                    document.getElementById('toggleCameraButton').innerText = 'Start Camera';
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

                function startQRCodeDetection() {
                    const video = document.getElementById('video');
                    const canvas = document.getElementById('canvas');
                    const context = canvas.getContext('2d');

                    // Set ukuran canvas sama dengan ukuran video
                    canvas.width = video.videoWidth;
                    canvas.height = video.videoHeight;

                    qrDetectionInterval = setInterval(() => {
                        if (!isCameraActive) return;

                        // Periksa jika video siap
                        if (video.videoWidth === 0 || video.videoHeight === 0) return;

                        context.drawImage(video, 0, 0, canvas.width, canvas.height);
                        const imageData = context.getImageData(0, 0, canvas.width, canvas.height);
                        const code = jsQR(imageData.data, imageData.width, imageData.height);

                        if (code) {
                            alert("QR Code Detected: " + code.data);
                            clearInterval(qrDetectionInterval); // Hentikan deteksi setelah QR code ditemukan
                            stopCamera();
                        } else {
                            // Tampilkan kotak deteksi QR code
                            context.beginPath();
                            context.strokeStyle = "green";
                            context.lineWidth = 4;
                            context.strokeRect(canvas.width * 0.3, canvas.height * 0.3, canvas.width * 0.4, canvas.height *
                                0.4);
                            context.stroke();
                        }
                    }, 100); // Interval deteksi setiap 300ms untuk mengurangi delay
                }
            </script>
            <script type="text/javascript">
                var tablePenerimaan;

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

                tablePenerimaan = $('.datatable-penerimaan').DataTable({
                    "processing": true, //Feature control the processing indicator.
                    "serverSide": false, //Feature control DataTables' server-side processing mode.
                    "scrollX": false,
                    "scrollCollapse": false,
                    "pagingType": 'full_numbers',
                    "dom": "<'card-header h3' B>" +
                        "<'card-body border-bottom py-3' <'row'<'col-sm-6'l><'col-sm-6'f>> >" +
                        "<'table-responsive' <'col-sm-12'tr> >" +
                        "<'card-footer' <'row'<'col-sm-5'i><'col-sm-7'p> >>",
                    "lengthMenu": [
                        [25, 50, -1],
                        ['Default', '50', 'Semua']
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
                            text: '<i class="fa-solid fa-arrows-rotate"></i> Refresh Tabel',
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
                        "url": "{{ route('getScanner.index') }}",
                        // "data": function(data) {
                        //     data._token = "{{ csrf_token() }}";
                        //     data.dari = $('#idfilter_dari').val();
                        //     data.sampai = $('#idfilter_sampai').val();
                        //     data.dibuat = $('#dibuat').val();
                        //     data.unit = $('#unit').val();
                        //     data.status = $('#status').val();
                        // }
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
                            data: 'tanggal_kedatangan',
                            name: 'tanggal_kedatangan',
                            className: "cuspad0 cuspad1 text-center"
                        },
                        {
                            title: 'Kode Penerimaan',
                            data: 'kodepenerimaan',
                            name: 'kodepenerimaan',
                            className: "cuspad0 cuspad1 text-center"
                        },
                        {
                            title: 'Tipe',
                            data: 'tipe',
                            name: 'tipe',
                            className: "cuspad0 cuspad1 text-center"
                        },
                        {
                            title: 'Qty',
                            data: 'qty',
                            name: 'qty',
                            className: "cuspad0 cuspad1 text-center"
                        },
                        {
                            title: 'Package',
                            data: 'package',
                            name: 'package',
                            className: "cuspad0 cuspad1 text-center"
                        },
                        {
                            title: 'Berat Penuh',
                            data: 'berat_trukpenuh',
                            name: 'berat_trukpenuh',
                            className: "cuspad0 cuspad1 text-center"
                        },
                        {
                            title: 'Berat Kosong',
                            data: 'berat_trukkosong',
                            name: 'berat_trukkosong',
                            className: "cuspad0 cuspad1 text-center"
                        },
                        {
                            title: 'Nopol',
                            data: 'nopol',
                            name: 'nopol',
                            className: "cuspad0 cuspad1 text-center"
                        },
                        {
                            title: 'Pengemudi',
                            data: 'driver',
                            name: 'driver',
                            className: "cuspad0 cuspad1 text-center"
                        },
                        {
                            title: 'KTP',
                            data: 'ktp',
                            name: 'ktp',
                            className: "cuspad0 cuspad1 text-center"
                        },
                        {
                            title: 'Keterangan',
                            data: 'keterangan',
                            name: 'keterangan',
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
                        this.api().columns([4, 6, 10]).every(function() {
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
                $('.datatable-penerimaan tfoot .th').each(function() {
                    var title = $(this).text();
                    $(this).html(
                        '<input type="text" class="form-control form-control-sm my-0 border" placeholder="' +
                        $(this).text().toUpperCase() + '" />'
                    );
                });
            </script>

        </div>
    </div>
@endsection
