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
                                <div class="d-none d-sm-inline-block">
                                    <h1 style="font-size: 50px;">{{ $kodekontrak }}</h1>
                                </div>
                                <div class="d-sm-none btn-icon">
                                    <h1 style="font-size: 15px;">{{ $kodekontrak }}</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Page body -->
            <div class="page-body">
                <div class="container-xl">
                    <div class="row row-deck row-cards">
                        <div class="table-responsive">
                            <div class="card card-xl border-success shadow rounded">
                                <div class="card-stamp card-stamp-lg">
                                    <div class="card-stamp-icon bg-success">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
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
                                    </div>
                                </div>
                                <table style="width:100%; height: 100%;font-size:13px;"
                                    class="table table-sm table-bordered table-striped table-vcenter card-table table-hover text-nowrap datatable datatable-qrcode">
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
                                            <th class="px-1 th py-1" style="width: 1%">Tipe</th>
                                            <th class="px-1 th py-1" style="width: 1%">NPB</th>
                                            <th class="px-1 th py-1" style="width: 1%">Kode Kontrak</th>
                                            <th class="px-1 th py-1">Nomor Qrcode</th>
                                            <th class="px-1 th py-1" style="width: 1%">Berat Satuan</th>
                                            <th class="px-1 th py-1" style="width: 10%">Qrcode</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                @include('shared.footer')
                <script type="text/javascript">
                    var QrTable;

                    function syn() {
                        QrTable.ajax.reload();
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
                        QrTable = $('.datatable-qrcode').DataTable({
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
                                    className: 'btn',
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
                                    className: 'btn btn-dark',
                                    text: '<i class="fa-solid fa-arrows-rotate"></i> Refresh',
                                    action: function(e, dt, node, config) {
                                        dt.ajax.reload();
                                    }
                                },
                                {
                                    className: 'btn btn-info',
                                    text: '<svg style="margin-right: 10px" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-printer"><path stroke="none" d="M0 0h24v24H0z" fill="none" /><path d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2" /><path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4" /><path d="M7 13m0 2a2 2 0 0 1 2 -2h6a2 2 0 0 1 2 2v4a2 2 0 0 1 -2 2h-6a2 2 0 0 1 -2 -2z" /></svg>Cetak Semua QR',
                                    action: function(e, dt, button, config) {
                                        window.open(
                                            "{{ url('gudang/printBarcode/' . Crypt::encryptString($kodekontrak)) }}",
                                            "_blank");
                                        // window.location = "{{ url('gudang/printBarcode/' . Crypt::encryptString($kodekontrak)) }}";
                                    }
                                },
                                {
                                    className: 'btn btn-teal',
                                    text: '<svg style="margin-right: 10px" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-pointer"><path stroke="none" d="M0 0h24v24H0z" fill="none" /><path d="M7.904 17.563a1.2 1.2 0 0 0 2.228 .308l2.09 -3.093l4.907 4.907a1.067 1.067 0 0 0 1.509 0l1.047 -1.047a1.067 1.067 0 0 0 0 -1.509l-4.907 -4.907l3.113 -2.09a1.2 1.2 0 0 0 -.309 -2.228l-13.582 -3.904l3.904 13.563z" /></svg>Cetak QR yang dipilih',
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
                                "select": {
                                    rows: {
                                        _: "%d item dipilih ",
                                        0: "Pilih Qr dan tekan tombol Print untuk Mencetak sebagian Qrcode",
                                    }
                                },
                            },
                            "ajax": {
                                "url": "{{ route('getPenerimaanQR.index') }}",
                                "data": function(data) {
                                    data._token = "{{ csrf_token() }}";
                                    data.kodekontrak = '{{ $kodekontrak }}';
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
                                "selector": 'td:not(:nth-child(6))',
                            },
                            columns: [{
                                    title: '<svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-list-details"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M13 5h8" /><path d="M13 9h5" /><path d="M13 15h8" /><path d="M13 19h5" /><path d="M3 4m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" /><path d="M3 14m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" /></svg>',
                                    data: 'select_orders',
                                    name: 'select_orders',
                                    className: "text-center",
                                    orderable: false,
                                    searchable: false,
                                    visible: false,
                                },
                                {
                                    title: 'Tipe',
                                    data: 'type',
                                    name: 'type',
                                    className: "cuspad0 cuspad1 text-center"
                                },
                                {
                                    title: 'NPB',
                                    data: 'npb',
                                    name: 'npb',
                                    className: "cuspad0 cuspad1 text-center"
                                },
                                {
                                    title: 'Kode Kontrak',
                                    data: 'kodekontrak',
                                    name: 'kodekontrak',
                                    className: "cuspad0 cuspad1 text-center"
                                },
                                {
                                    title: 'Nomor QRCODE',
                                    data: 'subkode',
                                    name: 'subkode',
                                    className: "cuspad0 cuspad1 text-center"
                                },
                                {
                                    title: 'Berat Satuan',
                                    data: 'berat_satuan',
                                    name: 'berat_satuan',
                                    className: "cuspad0 cuspad1 text-center"
                                },
                                {
                                    title: 'Qrcode',
                                    data: 'qrcode',
                                    name: 'qrcode',
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
                                // this.api().columns([4, 5, 6]).every(function() {
                                //     var column = this;
                                //     var select = $(
                                //             '<select class="form-select form-select-sm"><option value="">Semua</option></select>'
                                //         )
                                //         .appendTo($(column.footer()).empty())
                                //         .on('change', function() {
                                //             var val = $.fn.dataTable.util.escapeRegex(
                                //                 $(this).val()
                                //             );
                                //             column
                                //                 .search(val ? '^' + val + '$' : '', true, false)
                                //                 .draw();
                                //         });
                                //     column.data().unique().sort().each(function(d, j) {
                                //         select.append('<option value="' + d + '">' + d +
                                //             '</option>');
                                //     });
                                // });
                            }
                        });
                        $('.datatable-all tfoot .th').each(function() {
                            var title = $(this).text();
                            $(this).html(
                                '<input type="text" class="form-control form-control-sm my-0 border" placeholder="' +
                                $(this).text().toUpperCase() + '" />'
                            );
                        });
                    });
                </script>
            </div>
        </div>
    @endsection
