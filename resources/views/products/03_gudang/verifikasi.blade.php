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

        <style>
            .kbw-signature {
                width: 100%;
                height: 200px;
                border-radius: 5px;
            }

            #sigOperator canvas {
                width: 100% !important;
                height: auto;
                border-radius: 5px;
            }

            #sigPengemudi canvas {
                width: 100% !important;
                height: auto;
                border-radius: 5px;
            }
        </style>
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
                                    <li class="breadcrumb-item" aria-current="page">
                                        <a href="{{ route('gudang/penerimaan') }}">
                                            <i class="fa-solid fa-truck-ramp-box"></i>
                                            Penerimaan
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        <a href="#">
                                            <i class="fa-solid fa-circle-check"></i>
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
                                    <h1 style="font-size: 50px;">{{ $verifikasi->npb }}</h1>
                                </div>
                                <div class="d-sm-none btn-icon">
                                    <h1 style="font-size: 15px;">{{ $verifikasi->npb }}</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Page body -->
            <div class="page-body">
                <div class="container-xl">
                    <form method="post" id="formVerifikasi" name="formVerifikasi" method="post"
                        action="javascript:void(0)" enctype="multipart/form-data" accept-charset="utf-8">
                        @csrf
                        <div class="row row-deck row-cards">
                            <div class="col-md-7">
                                <div class="card card-xl border-success shadow rounded">
                                    <div class="card-stamp card-stamp-lg">
                                        <div class="card-stamp-icon bg-success">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="icon icon-tabler icons-tabler-outline icon-tabler-rosette-discount-check">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path
                                                    d="M5 7.2a2.2 2.2 0 0 1 2.2 -2.2h1a2.2 2.2 0 0 0 1.55 -.64l.7 -.7a2.2 2.2 0 0 1 3.12 0l.7 .7c.412 .41 .97 .64 1.55 .64h1a2.2 2.2 0 0 1 2.2 2.2v1c0 .58 .23 1.138 .64 1.55l.7 .7a2.2 2.2 0 0 1 0 3.12l-.7 .7a2.2 2.2 0 0 0 -.64 1.55v1a2.2 2.2 0 0 1 -2.2 2.2h-1a2.2 2.2 0 0 0 -1.55 .64l-.7 .7a2.2 2.2 0 0 1 -3.12 0l-.7 -.7a2.2 2.2 0 0 0 -1.55 -.64h-1a2.2 2.2 0 0 1 -2.2 -2.2v-1a2.2 2.2 0 0 0 -.64 -1.55l-.7 -.7a2.2 2.2 0 0 1 0 -3.12l.7 -.7a2.2 2.2 0 0 0 .64 -1.55v-1" />
                                                <path d="M9 12l2 2l4 -4" />
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <div class="card-header">
                                            <h3 class="card-title">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="icon icon-tabler icons-tabler-outline icon-tabler-arrow-narrow-right-dashed">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M5 12h.5m3 0h1.5m3 0h6" />
                                                    <path d="M15 16l4 -4" />
                                                    <path d="M15 8l4 4" />
                                                </svg>
                                                Nomor Penerimaan Barang : {{ $verifikasi->npb }}
                                            </h3>
                                        </div>
                                        <div class="card-header">
                                            <div class="row row-cards">
                                                <div class="col-md-4">
                                                    <label class="form-label">Tanggal Kedatangan</label>
                                                    <input type="hidden" name="idkontrak" id="idkontrak"
                                                        value="{{ Crypt::encryptString($verifikasi->npb) }}">
                                                    <input type="date" name="tanggal" id="tanggal" class="form-control"
                                                        value="{{ $verifikasi->tanggal }}">
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="form-label">Nopol</label>
                                                    <input type="text" class="form-control"
                                                        value="{{ $verifikasi->nopol }}">
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="form-label">NIK KTP</label>
                                                    <input type="text" class="form-control"
                                                        value="{{ $verifikasi->ktp }}">
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="form-label">Pengemudi</label>
                                                    <input type="text" class="form-control"
                                                        value="{{ $verifikasi->driver }}">
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">Operator</label>
                                                    <input type="number" name="qty" id="qty"
                                                        class="form-control" value="{{ $verifikasi->operator }}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card-header">
                                            <h3 class="card-title">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="icon icon-tabler icons-tabler-outline icon-tabler-arrow-narrow-right-dashed">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M5 12h.5m3 0h1.5m3 0h6" />
                                                    <path d="M15 16l4 -4" />
                                                    <path d="M15 8l4 4" />
                                                </svg>
                                                Data Pendukung
                                            </h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="alert alert-success shadow rounded" role="alert">
                                            <h4 class="alert-title">Informasi</h4>
                                            <div class="text-secondary">Cek kembali inputan anda, jika sudah yakin benar
                                                silahkan klik tombol Simpan</div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="card card-xl border-success shadow rounded">
                                            <div class="card-stamp card-stamp-lg">
                                                <div class="card-stamp-icon bg-success">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="icon icon-tabler icons-tabler-outline icon-tabler-truck">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path d="M7 17m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                                        <path d="M17 17m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                                        <path
                                                            d="M5 17h-2v-11a1 1 0 0 1 1 -1h9v12m-4 0h6m4 0h2v-6h-8m0 -5h5l3 5" />
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="table-responsive">
                                                <div class="card-body">
                                                    <h3 class="card-title h3">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                            height="24" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            class="icon icon-tabler icons-tabler-outline icon-tabler-arrow-narrow-right-dashed">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                            <path d="M5 12h.5m3 0h1.5m3 0h6" />
                                                            <path d="M15 16l4 -4" />
                                                            <path d="M15 8l4 4" />
                                                        </svg>
                                                        Paraf
                                                    </h3>
                                                    <div class="row row-cards">
                                                        <div class="col-md-12">
                                                            <label class="form-label">
                                                                <div class="row">
                                                                    <div class="col">
                                                                        Paraf Operator
                                                                    </div>
                                                                    <div class="col-auto ms-auto">
                                                                        <button id="clearOperator"
                                                                            class="btn btn-danger btn-sm">
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                width="24" height="24"
                                                                                viewBox="0 0 24 24" fill="none"
                                                                                stroke="currentColor" stroke-width="2"
                                                                                stroke-linecap="round"
                                                                                stroke-linejoin="round"
                                                                                class="icon icon-tabler icons-tabler-outline icon-tabler-rotate">
                                                                                <path stroke="none" d="M0 0h24v24H0z"
                                                                                    fill="none" />
                                                                                <path
                                                                                    d="M19.95 11a8 8 0 1 0 -.5 4m.5 5v-5h-5" />
                                                                            </svg>
                                                                            Hapus
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </label>
                                                            <div class="col-md-12">
                                                                <div id="sigOperator"></div>
                                                                <textarea id="signature64Operator" name="signedOperator" style="display: none"></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <label class="form-label">
                                                                <div class="row">
                                                                    <div class="col">
                                                                        Paraf Pengemudi
                                                                    </div>
                                                                    <div class="col-auto ms-auto">
                                                                        <button id="clearPengemudi"
                                                                            class="btn btn-danger btn-sm">
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                width="24" height="24"
                                                                                viewBox="0 0 24 24" fill="none"
                                                                                stroke="currentColor" stroke-width="2"
                                                                                stroke-linecap="round"
                                                                                stroke-linejoin="round"
                                                                                class="icon icon-tabler icons-tabler-outline icon-tabler-rotate">
                                                                                <path stroke="none" d="M0 0h24v24H0z"
                                                                                    fill="none" />
                                                                                <path
                                                                                    d="M19.95 11a8 8 0 1 0 -.5 4m.5 5v-5h-5" />
                                                                            </svg>
                                                                            Hapus
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </label>
                                                            <div class="col-md-12">
                                                                <div id="sigPengemudi"></div>
                                                                <textarea id="signature64Pengemudi" name="signedPengemudi" style="display: none"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <script type="text/javascript">
                                                        var sigOperator = $('#sigOperator').signature({
                                                            syncField: '#signature64Operator',
                                                            syncFormat: 'PNG'
                                                        });
                                                        var sigPengemudi = $('#sigPengemudi').signature({
                                                            syncField: '#signature64Pengemudi',
                                                            syncFormat: 'PNG'
                                                        });
                                                        $('#clearOperator').click(function(e) {
                                                            e.preventDefault();
                                                            sigOperator.signature('clear');
                                                            $("#signature64Operator").val('');
                                                        });
                                                        $('#clearPengemudi').click(function(e) {
                                                            e.preventDefault();
                                                            sigPengemudi.signature('clear');
                                                            $("#signature64Pengemudi").val('');
                                                        });
                                                    </script>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary" id="submitVerifikasi">
                                        <svg style="margin-ridht: 5px" xmlns="http://www.w3.org/2000/svg" width="24"
                                            height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-device-floppy">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path
                                                d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" />
                                            <path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                            <path d="M14 4l0 4l-6 0l0 -4" />
                                        </svg>
                                        Simpan
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                @include('shared.footer')
                <script type="text/javascript">
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
                        $(".select2Driver").select2({
                            language: "id",
                            width: '100%',
                            height: '100%',
                            placeholder: "Pilih Pengemudi",
                            ajax: {
                                url: "/getPengemudi",
                                dataType: 'json',
                                processResults: function(response) {
                                    return {
                                        results: $.map(response, function(item) {
                                            return {
                                                text: item.nama + (!item.kota ? '' : ' - ' + item
                                                    .kota),
                                                id: item.id,
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
                        if ($("#formVerifikasi").length > 0) {
                            $("#formVerifikasi").validate({
                                rules: {
                                    tanggal_kedatangan: {
                                        required: true,
                                    },
                                    qty: {
                                        required: true,
                                    },
                                    package: {
                                        required: true,
                                    },
                                    berat_trukpenuh: {
                                        required: true,
                                    },
                                    berat_trukkosong: {
                                        required: true,
                                    },
                                    nopol: {
                                        required: true,
                                    },
                                    driver: {
                                        required: true,
                                    },
                                    signature64Operator: {
                                        required: true,
                                    },
                                    signature64Driver: {
                                        required: true,
                                    },
                                    namaSupir: {
                                        required: true,
                                    },
                                    ktp: {
                                        required: true,
                                    },
                                    operator: {
                                        required: true,
                                    }
                                },
                                messages: {
                                    tanggal_kedatangan: {
                                        required: 'Kolom ini tidak boleh kosong',
                                    },
                                    qty: {
                                        required: 'Kolom ini tidak boleh kosong',
                                    },
                                    package: {
                                        required: 'Kolom ini tidak boleh kosong',
                                    },
                                    berat_trukpenuh: {
                                        required: 'Kolom ini tidak boleh kosong',
                                    },
                                    berat_trukkosong: {
                                        required: 'Kolom ini tidak boleh kosong',
                                    },
                                    nopol: {
                                        required: 'Kolom ini tidak boleh kosong',
                                    },
                                    driver: {
                                        required: 'Kolom ini tidak boleh kosong',
                                    },
                                    signature64Operator: {
                                        required: 'Kolom ini tidak boleh kosong',
                                    },
                                    signature64Driver: {
                                        required: 'Kolom ini tidak boleh kosong',
                                    },
                                    namaSupir: {
                                        required: 'Kolom ini tidak boleh kosong',
                                    },
                                    ktp: {
                                        required: 'Kolom ini tidak boleh kosong',
                                    },
                                    operator: {
                                        required: 'Kolom ini tidak boleh kosong',
                                    }
                                },

                                submitHandler: function(form) {
                                    let formData = new FormData(form);

                                    $.ajaxSetup({
                                        headers: {
                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                        }
                                    });
                                    $('#submitVerifikasi').html(
                                        '<i class="fa-solid fa-fw fa-spinner fa-spin"></i> Please Wait...');
                                    $("#submitVerifikasi").attr("disabled", true);
                                    $.ajax({
                                        url: "{{ url('storedataVerifikasi') }}",
                                        type: "POST",
                                        data: formData,
                                        contentType: false,
                                        processData: false,
                                        // data: $('#formVerifikasi').serialize(),
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
                                            $('#submitVerifikasi').html(
                                                '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-floppy" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" /><path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M14 4l0 4l-6 0l0 -4" /></svg> Simpan'
                                            );
                                            $("#submitVerifikasi").attr("disabled", false);
                                            Swal.fire({
                                                icon: 'success',
                                                title: 'Berhasil',
                                                html: response,
                                                showConfirmButton: true
                                            }).then((result) => {
                                                if (result.isConfirmed) {
                                                    location.reload();
                                                }
                                            });
                                        },
                                        error: function(data) {
                                            console.log('Error:', data);
                                            // const obj = JSON.parse(data.responseJSON);
                                            console.log($('#formVerifikasi').serialize());
                                            Swal.fire({
                                                icon: 'error',
                                                title: 'Gagal Input',
                                                html: data.responseJSON.message,
                                                showConfirmButton: true
                                            });
                                            $('#submitVerifikasi').html(
                                                '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-floppy" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" /><path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M14 4l0 4l-6 0l0 -4" /></svg> Simpan'
                                            );
                                            $("#submitVerifikasi").attr("disabled", false);
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
