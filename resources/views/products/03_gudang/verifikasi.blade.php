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
                                    <h1 style="font-size: 50px;">{{ $verifikasi->kodepenerimaan }}</h1>
                                </div>
                                <div class="d-sm-none btn-icon">
                                    <h1 style="font-size: 15px;">{{ $verifikasi->kodepenerimaan }}</h1>
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
                                    <form>
                                        <div class="card-body">
                                            <h3 class="card-title">Penerimaan Bahan baku {{ $verifikasi->tipe }}</h3>
                                            <div class="row row-cards">
                                                <div class="col-md-12">
                                                    <label class="form-label">Tanggal Kedatangan</label>
                                                    <input type="date" name="tanggal_kedatangan" id="tanggal_kedatangan"
                                                        class="form-control" value="{{ $verifikasi->tanggal_kedatangan }}">
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="form-label">Tipe</label>
                                                    <input type="text" disabled class="form-control cursor-not-allowed"
                                                        value="{{ $verifikasi->tipe }}">
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="form-label">Kode Kontrak</label>
                                                    <input type="text" class="form-control cursor-not-allowed" disabled
                                                        value="{{ $verifikasi->kodekontrak }}">
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="form-label">Kedatangan ke</label>
                                                    <input type="text" class="form-control cursor-not-allowed" disabled
                                                        value="{{ substr($verifikasi->kodepenerimaan, -2) }}">
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">Qty</label>
                                                    <input type="number" name="qty" id="qty" class="form-control"
                                                        value="{{ $verifikasi->qty }}">
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">Satuan</label>
                                                    <input type="text" name="satuan" id="satuan" class="form-control"
                                                        value="{{ $verifikasi->satuan }}">
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">Berat Kendaraan Penuh (KG)</label>
                                                    <input type="text" name="berat_trukpenuh" id="berat_trukpenuh"
                                                        class="form-control" value="{{ $verifikasi->berat_trukpenuh }}">
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">Berat Kendaraan Kosong (KG)</label>
                                                    <input type="text" name="berat_trukkosong" id="berat_trukkosong"
                                                        class="form-control" value="{{ $verifikasi->berat_trukkosong }}">
                                                </div>
                                            </div>
                                        </div>
                                    </form>
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
                                            <form>
                                                <div class="card-body">
                                                    <h3 class="card-title">Data Pendukung</h3>
                                                    <div class="row row-cards">
                                                        <div class="col-md-12">
                                                            <label class="form-label">Nomor Polisi Kendaraan</label>
                                                            <input type="text" name="nopol" id="nopol"
                                                                class="form-control" placeholder="Cth: E 1234 ABC">
                                                        </div>
                                                        <div class="col-md-12">
                                                            <label class="form-label">Pengemudi</label>
                                                            <input type="text" class="form-control mb-3"
                                                                placeholder="Username" value="michael23">
                                                            <div class="text-center">
                                                                <img class="card-img-top" src="https://fakeimg.pl/300/"
                                                                    style="width: 100%;max-width: 300px;max-height: 300px" />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <label class="form-label">KTP</label>
                                                            <input type="text" name="ktp" id="ktp"
                                                                class="form-control mb-3"
                                                                placeholder="Nomor NIK Pengemudi">
                                                            <div class="text-center">
                                                                <img class="card-img-top" src="https://fakeimg.pl/300/"
                                                                    style="width: 100%;max-width: 300px;max-height: 300px" />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <label class="form-label">Operator</label>
                                                            <input type="text" class="form-control"
                                                                placeholder="Masukkan Nama Operator"
                                                                value="{{ Auth::user()->nickname }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-footer text-end">
                                                    <button type="submit" class="btn btn-primary">
                                                        <svg style="margin-ridht: 5px" xmlns="http://www.w3.org/2000/svg"
                                                            width="24" height="24" viewBox="0 0 24 24"
                                                            fill="none" stroke="currentColor" stroke-width="2"
                                                            stroke-linecap="round" stroke-linejoin="round"
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
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Modal tambah --}}
            <div class="modal modal-blur fade" id="modal-penerimaan" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-primary text-white">
                            <h5 class="modal-title">
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
                                Buat Penerimaan
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <form id="formPenerimaan" name="formPenerimaan" method="post" action="javascript:void(0)">
                            @csrf
                            <div class="modal-body">
                                <div class="card-stamp card-stamp-lg">
                                    <div class="card-stamp-icon bg-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-pencil-plus">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M4 20h4l10.5 -10.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4" />
                                            <path d="M13.5 6.5l4 4" />
                                            <path d="M16 19h6" />
                                            <path d="M19 16v6" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 mb-3">
                                        <label class="form-label">Tanggal Kedatangan</label>
                                        <input type="date" class="form-control border border-dark"
                                            name="tanggal_kedatangan" id="tanggal_kedatangan"
                                            value="{{ date('Y-m-d') }}">
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <label class="form-label">Kode Kontrak</label>
                                        <style>
                                            #select2-kodekontrak-container {
                                                border: 1px solid black;
                                            }
                                        </style>
                                        <select name="kodekontrak" id="kodekontrak"
                                            class="form-select select2kodekodekontrak" data-select2-id="kodekontrak"
                                            tabindex="-1" aria-hidden="true">
                                        </select>
                                    </div>
                                </div>

                                <script type="text/javascript">
                                    $('#kodekontrak').change(function() {
                                        var id = $(this).val();
                                        console.log(id);
                                        $.ajax({
                                            type: 'POST',
                                            url: "{{ route('gudang/getTipeByKode') }}",
                                            data: {
                                                "_token": "{{ csrf_token() }}",
                                                id: id,
                                            },
                                            beforeSend: function() {
                                                $('#tipe').val('Loading Data...');
                                            },
                                            success: function(response) {
                                                $('#tipe').val(response);
                                            },
                                            error: function(data) {
                                                $('#tipe').val('Error');
                                            },
                                        });
                                    });
                                </script>
                                <div class="row">
                                    <div class="col-lg-6 mb-3">
                                        <label class="form-label">Kendaraan Ke</label>
                                        <input type="number" class="form-control border border-dark" name="kendaraan_ke"
                                            id="kendaraan_ke" value="1" min="1">
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <label class="form-label">Tipe</label>
                                        <input type="text" class="form-control border border-dark" name="tipe"
                                            id="tipe" placeholder="Otomatis terisi jika sudah mengisi kode kontrak"
                                            readonly>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 mb-3">
                                        <label class="form-label">Qty</label>
                                        <input type="number" class="form-control border border-dark" name="qty"
                                            id="qty" placeholder="Masukkan Qty">
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <label class="form-label">Satuan</label>
                                        <input type="text" class="form-control border border-dark" name="satuan"
                                            id="satuan" placeholder="Masukkan Satuan">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 mb-3">
                                        <label class="form-label">Berat Truck Penuh</label>
                                        <input type="number" class="form-control border border-dark"
                                            name="berat_trukpenuh" id="berat_trukpenuh" placeholder="KG">
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <label class="form-label">Berat Truck Kosong</label>
                                        <input type="number" class="form-control border border-dark"
                                            name="berat_trukkosong" id="berat_trukkosong" placeholder="KG">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label class="form-label">Keterangan Tambahan</label>
                                    <div class="col-lg-12">
                                        <textarea name="cacatan" id="cacatan" cols="90" rows="2" class="form-control border border-dark"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal"><i
                                        class="fa-solid fa-fw fa-arrow-rotate-left"></i> Kembali</a>
                                <button type="submit" id="submitpenerimaan" class="btn btn-primary ms-auto">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="icon icon-tabler icon-tabler-device-floppy" width="24" height="24"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" />
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
            @include('shared.footer')
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
                                            text: item.id_kontrak + (!item.supplier ? '' : ' - ' + item
                                                .supplier),
                                            id: item.id,
                                        }
                                    })
                                };
                            },
                            cache: true
                        },
                    });
                    /*------------------------------------------
                    --------------------------------------------
                    Render DataTable
                    --------------------------------------------
                    --------------------------------------------*/
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
                            "url": "{{ route('getPenerimaan.index') }}",
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
                                title: 'Satuan',
                                data: 'satuan',
                                name: 'satuan',
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
                        }
                    });
                    $('.datatable-penerimaan tfoot .th').each(function() {
                        var title = $(this).text();
                        $(this).html(
                            '<input type="text" class="form-control form-control-sm my-0 border" placeholder="' +
                            $(this).text().toUpperCase() + '" />'
                        );
                    });
                    $('.datatable-penerimaan').on('click', '.remove', function() {
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
                    $('#modal-edit-penerimaan').on('show.bs.modal', function(e) {
                        var button = $(e.relatedTarget)
                        var id = button.data('id');
                        console.log("Fetch Id Item: " + id + "...");
                        $(".overlay").fadeIn(300);
                        $.ajax({
                            type: 'POST',
                            url: "{{ url('viewEditsupplier') }}",
                            data: {
                                "_token": "{{ csrf_token() }}",
                                id: id,
                            },
                            success: function(data) {
                                $('.fetched-data-edit-penerimaan').html(data);
                            }
                        }).done(function() {
                            setTimeout(function() {
                                $(".overlay").fadeOut(300);
                            }, 500);
                        });
                    });
                    /*------------------------------------------==============================================================================================================================================================
                    --------------------------------------------==============================================================================================================================================================
                    Create Data
                    --------------------------------------------==============================================================================================================================================================
                    --------------------------------------------==============================================================================================================================================================*/
                    if ($("#formPenerimaan").length > 0) {
                        $("#formPenerimaan").validate({
                            rules: {
                                tanggal_kedatangan: {
                                    required: true,
                                },
                                kodekontrak: {
                                    required: true,
                                },
                                kendaraan_ke: {
                                    required: true,
                                },
                                tipe: {
                                    required: true,
                                },
                                qty: {
                                    required: true,
                                },
                                satuan: {
                                    required: true,
                                },
                                berat_trukpenuh: {
                                    required: true,
                                },
                                berat_trukkosong: {
                                    required: true,
                                },
                            },
                            messages: {
                                tanggal_kedatangan: {
                                    required: 'Kolom ini tidak boleh kosong',
                                },
                                kodekontrak: {
                                    required: 'Kolom ini tidak boleh kosong',
                                },
                                kendaraan_ke: {
                                    required: 'Kolom ini tidak boleh kosong',
                                },
                                tipe: {
                                    required: 'Kolom ini tidak boleh kosong',
                                },
                                qty: {
                                    required: 'Kolom ini tidak boleh kosong',
                                },
                                satuan: {
                                    required: 'Kolom ini tidak boleh kosong',
                                },
                                berat_trukpenuh: {
                                    required: 'Kolom ini tidak boleh kosong',
                                },
                                berat_trukkosong: {
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
                                            html: '<center><lottie-player src="https://lottie.host/933bb0e2-47c0-4fa6-83f9-3330b433b883/yymyeZt49h.json"  background="transparent"  speed="1"  style="width: 300px; height: 300px;"  loop autoplay></lottie-player></center><br><h1 class="h4">Sedang memproses data, Proses mungkin membutuhkan beberapa menit. <br><br><b class="text-danger">(Jangan menutup jendela ini, bisa mengakibatkan error)</b></h1>',
                                            showConfirmButton: false,
                                            timerProgressBar: true,
                                            allowOutsideClick: false,
                                            allowEscapeKey: false,
                                        })
                                    },
                                    success: function(response) {
                                        console.log('Completed.');
                                        $('#submitPenerimaan').html(
                                            '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-floppy" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" /><path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M14 4l0 4l-6 0l0 -4" /></svg> Simpan'
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
                                        document.getElementById("formPenerimaan").reset();
                                        tablePenerimaan.ajax.reload(null, false);
                                        $('#modal-penerimaan').modal('hide');
                                    },
                                    error: function(data) {
                                        tablePenerimaan.ajax.reload(null, false);
                                        console.log('Error:', data);
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
                });
            </script>
        </div>
    </div>
@endsection
