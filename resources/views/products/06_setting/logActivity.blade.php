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
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-activity">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M3 12h4l3 8l4 -16l3 8h4" />
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
                                            <i class="fa-solid fa-gear"></i>
                                            Settings
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        <a href="#">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="icon icon-tabler icons-tabler-outline icon-tabler-activity">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M3 12h4l3 8l4 -16l3 8h4" />
                                            </svg>
                                            {{ $judul }}
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
                        <div class="col-lg-12">
                            <div class="card card-xl border-primary shadow rounded">
                                <div class="card-stamp card-stamp-lg">
                                    <div class="card-stamp-icon bg-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
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
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table style="width:100%; height: 100%;font-size:13px;"
                                        class="table table-sm table-bordered table-striped table-vcenter card-table table-hover text-nowrap datatable datatable-log">
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal modal-blur fade" id="modal-view-log" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="overlay">
                    <div class="cv-spinner">
                        <span class="loader"></span>
                    </div>
                </div>
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-primary text-white">
                            <h5 class="modal-title">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-activity">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M3 12h4l3 8l4 -16l3 8h4" />
                                </svg>
                                View {{ $judul }}
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="fetched-data-log"></div>
                    </div>
                </div>
            </div>
            @include('shared.footer')
            <script type="text/javascript">
                var tableLog;

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
                    /*------------------------------------------
                    --------------------------------------------
                    Render DataTable
                    --------------------------------------------
                    --------------------------------------------*/
                    tableLog = $('.datatable-log').DataTable({
                        "processing": true, //Feature control the processing indicator.
                        "serverSide": false, //Feature control DataTables' server-side processing mode.
                        "scrollX": false,
                        "scrollCollapse": false,
                        "pagingType": 'full_numbers',
                        "dom": "<'card-body border-bottom py-3' <'row'<'col-sm-6'l><'col-sm-6'f>> >" +
                            "<'table-responsive' <'col-sm-12'tr> >" +
                            "<'card-footer' <'row'<'col-sm-5'i><'col-sm-7'p> >>",
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
                        "lengthMenu": [
                            [10, 25, 50, -1],
                            ['10', '50', 'Semua']
                        ],
                        "language": {
                            "lengthMenu": "Menampilkan _MENU_",
                            "zeroRecords": "Data Tidak Ditemukan",
                            "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ total data",
                            "infoEmpty": "Data Tidak Ditemukan",
                            "infoFiltered": "(Difilter dari _MAX_ total records)",
                            "processing": '<div class="container container-slim py-4"><div class="text-center"><div class="mb-3"></div><div class="text-secondary mb-3">Loading Data...</div><div class="progress progress-sm"><div class="progress-bar progress-bar-indeterminate"></div></div></div></div>',
                            "search": '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-search" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0"></path><path d="M21 21l-6 -6"></path></svg>',
                            "paginate": {
                                "first": '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chevron-left-pipe" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M7 6v12"></path><path d="M18 6l-6 6l6 6"></path></svg>',
                                "last": '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chevron-right-pipe" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M6 6l6 6l-6 6"></path><path d="M17 5v13"></path></svg>',
                                "next": '<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M9 6l6 6l-6 6"></path></svg>',
                                "previous": '<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M15 6l-6 6l6 6"></path></svg>',
                            },
                        },
                        "ajax": {
                            "url": "{{ route('getLogActivity.index') }}",
                        },
                        columns: [{
                                title: 'Opsi',
                                data: 'action',
                                name: 'action',
                                className: "w-0",
                                orderable: false,
                                searchable: false,
                            },
                            {
                                title: 'Record',
                                data: 'created_at',
                                name: 'created_at',
                                className: "cuspad0 cuspad1 text-center"
                            },
                            {
                                title: 'username',
                                data: 'username',
                                name: 'username',
                                className: "cuspad0 cuspad1 text-center"
                            },
                            {
                                title: 'ip',
                                data: 'ip_address',
                                name: 'ip_address',
                                className: "cuspad0 cuspad1 text-center"
                            },
                            {
                                title: 'page',
                                data: 'description',
                                name: 'description',
                                className: "cuspad0 cuspad1 text-center"
                            },
                            {
                                title: 'method',
                                data: 'user_agent',
                                name: 'user_agent',
                                className: "cuspad0 cuspad1 text-center"
                            },
                            {
                                title: 'status',
                                data: null, // Menggunakan null karena kita akan merender kolom ini
                                name: 'status_code',
                                className: "cuspad0 cuspad1 text-center",
                                render: function(data, type, row) {
                                    return `${row.status_code} (${row.status_description})`;
                                }
                            }
                        ],
                    });
                    $('.datatable-log').on('click', '.remove', function() {
                        var id = $(this).data('id');
                        var user_id = $(this).data('user_id');
                        var token = $("meta[name='csrf-token']").attr("content");
                        let r = (Math.random() + 1).toString(36).substring(2);
                        swal.fire({
                            title: 'Hapus ' + user_id,
                            text: 'Apakah anda yakin ingin menghapus ' + user_id,
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
                                            user_id,
                                        html: '<div class="unselectable">' + r +
                                            '</div>',
                                        input: "text",
                                        inputPlaceholder: "Ketik untuk menghapus " +
                                            user_id,
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
                                            url: "{{ route('getLogActivity.store') }}" +
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
                                                tableLog.ajax.reload(null, false);
                                                Swal.fire({
                                                    icon: 'success',
                                                    title: 'Berhasil',
                                                    html: data,
                                                    showConfirmButton: true
                                                });
                                            },
                                            error: function(data) {
                                                tableLog.ajax.reload(null, false);
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
                                        tableLog.ajax.reload();
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

                    $('#modal-view-log').on('show.bs.modal', function(e) {
                        var button = $(e.relatedTarget)
                        var id = button.data('id');
                        console.log("Fetch Id Item: " + id + "...");
                        $(".overlay").fadeIn(300);
                        $.ajax({
                            type: 'POST',
                            url: "{{ url('settings/viewLog') }}",
                            data: {
                                "_token": "{{ csrf_token() }}",
                                id: id,
                            },
                            success: function(data) {
                                $('.fetched-data-log').html(data);
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
