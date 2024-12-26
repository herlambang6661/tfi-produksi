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
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-clipboard-text"
                                    width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path
                                        d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2" />
                                    <path
                                        d="M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z" />
                                    <path d="M9 12h6" />
                                    <path d="M9 16h6" />
                                </svg>
                                Surat Kontrak
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
                                    <li class="breadcrumb-item active" aria-current="page">
                                        <a href="#">
                                            <i class="fa-solid fa-book"></i>
                                            Surat Kontrak
                                        </a>
                                    </li>
                                </ol>
                            </div>
                        </div>

                        <!-- Page title actions -->
                        <div class="col-auto ms-auto d-print-none">
                            <div class="btn-list">
                                <a href="{{ route('kontrakAdd') }}" class="btn btn-primary d-none d-sm-inline-block">
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
                                    Tambah Suratkontrak
                                </a>
                                <a href="{{ route('kontrakAdd') }}" class="btn btn-primary d-sm-none btn-icon">
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
                                </a>
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
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-writing-sign">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path
                                                d="M3 19c3.333 -2 5 -4 5 -6c0 -3 -1 -3 -2 -3s-2.032 1.085 -2 3c.034 2.048 1.658 2.877 2.5 4c1.5 2 2.5 2.5 3.5 1c.667 -1 1.167 -1.833 1.5 -2.5c1 2.333 2.333 3.5 4 3.5h2.5" />
                                            <path d="M20 17v-12c0 -1.121 -.879 -2 -2 -2s-2 .879 -2 2v12l2 2l2 -2z" />
                                            <path d="M16 7h4" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="card-header">
                                    <form action="#" id="form-filter" method="get" autocomplete="off" novalidate=""
                                        class="">
                                        <label class="form-label">Tanggal Surat</label>
                                        <div class="input-group">
                                            <input type="date" class="form-control" name="" id="filterStart"
                                                value="{{ date('Y-01-01') }}">
                                            <span class="input-group-text">
                                                s/d
                                            </span>
                                            <input type="date" class="form-control" name="" id="filterEnd"
                                                value="{{ date('Y-m-d') }}">
                                            <button type="button" class="btn btn-primary btn-icon" onclick="syn()">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="icon icon-tabler icons-tabler-outline icon-tabler-search">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                                                    <path d="M21 21l-6 -6" />
                                                </svg>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                <div class="table-responsive">
                                    <table style="width:100%; height: 100%;font-size:13px;"
                                        class="table table-sm table-bordered table-striped table-vcenter card-table table-hover text-nowrap datatable datatable-kontrak">
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
                                                <th class="px-1 th py-1">Tanggal</th>
                                                <th class="px-1 th py-1">ID Kontrak</th>
                                                <th class="px-1 th py-1">Bahan Baku</th>
                                                <th class="px-1 th py-1">Kategori</th>
                                                <th class="px-1 th py-1">Warna</th>
                                                <th class="px-1 th py-1">Berat</th>
                                                <th class="px-1 th py-1">Supplier</th>
                                                <th class="px-1 th py-1">Status</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- modal detail --}}
            <div class="modal modal-blur fade" id="modal-detail-kontrak" tabindex="-1" role="dialog"
                aria-hidden="true">
                <div class="overlay">
                    <div class="cv-spinner">
                        <span class="loader"></span>
                    </div>
                </div>
                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
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
                                Detail Surat Kontrak
                            </h5>
                            <button type="button" class="btn-close text-white" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="fetched-data-detail"></div>
                    </div>
                </div>
            </div>
            {{-- end modal detail --}}
            @include('shared.footer')
            <script type="text/javascript">
                var tableKontrak;

                function syn() {
                    tableKontrak.ajax.reload();
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

                    /*------------------------------------------
                    --------------------------------------------
                    Render DataTable
                    --------------------------------------------
                    --------------------------------------------*/
                    tableKontrak = $('.datatable-kontrak').DataTable({
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
                                // action: newexportaction,
                            },
                            {
                                extend: 'excelHtml5',
                                autoFilter: true,
                                className: 'btn btn-success',
                                text: '<i class="fa fa-file-excel text-white"></i> Excel',
                                // action: newexportaction,
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
                            "url": "{{ route('getSuratkontrak.index') }}",
                            "data": function(data) {
                                data._token = "{{ csrf_token() }}";
                                data.dari = $('#filterStart').val();
                                data.sampai = $('#filterEnd').val();
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
                                title: 'Tanggal',
                                data: 'tanggal',
                                name: 'tanggal',
                                className: "cuspad0 cuspad1 text-center"
                            },
                            {
                                title: 'ID Kontrak',
                                data: 'id_kontrak',
                                name: 'id_kontrak',
                                className: "cuspad0 cuspad1 text-center"
                            },
                            {
                                title: 'Bahan Baku',
                                data: 'tipe',
                                name: 'tipe',
                                className: "cuspad0 cuspad1 text-center"
                            },
                            {
                                title: 'Kategori',
                                data: 'kategori',
                                name: 'kategori',
                                className: "cuspad0 cuspad1 text-center"
                            },
                            {
                                title: 'Warna',
                                data: 'warna',
                                name: 'warna',
                                className: "cuspad0 cuspad1 text-center"
                            },
                            {
                                title: 'Berat',
                                data: 'berat',
                                name: 'berat',
                                className: "cuspad0 cuspad1 text-center"
                            },
                            {
                                title: 'Supplier',
                                data: 'supplier',
                                name: 'supplier',
                                className: "cuspad0 cuspad1 text-center"
                            },
                            {
                                title: 'Status',
                                data: 'status',
                                name: 'status',
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
                            this.api().columns([3, 4, 5]).every(function() {
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
                    $('.datatable-kontrak tfoot .th').each(function() {
                        var title = $(this).text();
                        $(this).html(
                            '<input type="text" class="form-control form-control-sm my-0 border" placeholder="' +
                            $(this).text().toUpperCase() + '" />'
                        );
                    });
                    $('.datatable-kontrak').on('click', '.remove', function() {
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
                                            url: "{{ route('getSuratkontrak.store') }}" +
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
                                                tableKontrak.ajax.reload(null, false);
                                                Swal.fire({
                                                    icon: 'success',
                                                    title: 'Berhasil',
                                                    html: data,
                                                    showConfirmButton: true
                                                });
                                            },
                                            error: function(data) {
                                                tableKontrak.ajax.reload(null, false);
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
                                        tableKontrak.ajax.reload(null, false);
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
                    $('#modal-detail-kontrak').on('show.bs.modal', function(e) {
                        var button = $(e.relatedTarget)
                        var id = button.data('id');
                        console.log("Fetch Id Item: " + id + "...");
                        $(".overlay").fadeIn(300);
                        $.ajax({
                            type: 'POST',
                            url: "{{ route('detail.kontrak') }}",
                            data: {
                                "_token": "{{ csrf_token() }}",
                                id: id,
                            },
                            success: function(data) {
                                $('.fetched-data-detail').html(data);
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
