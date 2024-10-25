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

        /* END Loader style */
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
                                <svg xmlns="http://www.w3.org/2000/svg" style="margin-right: 10px" width="24"
                                    height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-users">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                                    <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                                    <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                                    <path d="M21 21v-2a4 4 0 0 0 -3 -3.85" />
                                </svg>
                                Management Person
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
                                            <i class="fa-solid fa-list-check"></i>
                                            Daftar
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        <a href="#">
                                            <i class="fa-solid fa-users"></i>
                                            Management Person
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
                                <div class="card-header">
                                    <a href="#" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#modal-supplier" data-bs-backdrop="static" data-bs-keyboard="false">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-user-plus">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                                            <path d="M16 19h6" />
                                            <path d="M19 16v6" />
                                            <path d="M6 21v-2a4 4 0 0 1 4 -4h4" />
                                        </svg>
                                        Tambah Person
                                    </a>
                                </div>
                                <div class="table-responsive">
                                    <table style="width:100%; height: 100%;font-size:13px;"
                                        class="table table-sm table-bordered table-striped table-vcenter card-table table-hover text-nowrap datatable datatable-supplier">
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Modal tambah --}}
            <div class="modal modal-blur fade" id="modal-supplier" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-md" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-primary text-white">
                            <h5 class="modal-title">
                                <svg xmlns="http://www.w3.org/2000/svg" style="margin-right: 10px" width="24"
                                    height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-user-plus">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                                    <path d="M16 19h6" />
                                    <path d="M19 16v6" />
                                    <path d="M6 21v-2a4 4 0 0 1 4 -4h4" />
                                </svg>
                                Buat Supplier Baru
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form id="formSupplier" name="formSupplier" method="post" action="javascript:void(0)"
                            enctype="multipart/form-data" accept-charset="utf-8">
                            @csrf
                            <div class="modal-body">
                                <div class="card-stamp card-stamp-lg">
                                    <div class="card-stamp-icon bg-primary">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </div>
                                </div>
                                <div class="alert alert-info" role="alert">
                                    <div class="d-flex">
                                        <div>
                                            <svg xmlns="http://www.w3.org/2000/svg" style="margin-right: 10px"
                                                width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round"
                                                class="icon icon-tabler icons-tabler-outline icon-tabler-info-triangle">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path
                                                    d="M10.363 3.591l-8.106 13.534a1.914 1.914 0 0 0 1.636 2.871h16.214a1.914 1.914 0 0 0 1.636 -2.87l-8.106 -13.536a1.914 1.914 0 0 0 -3.274 0z" />
                                                <path d="M12 9h.01" />
                                                <path d="M11 12h1v4h1" />
                                            </svg>
                                        </div>
                                        <div>
                                            <h4 class="alert-title">Informasi</h4>
                                            <div class="text-secondary">Mohon hindari penginputan koma "," dalam inputan.
                                                disarankan menggunakan titik "." untuk mengganti koma
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-md-12">
                                        <label class="form-label">Jenis Person</label>
                                        <select name="jenisperson" id="jenisperson"
                                            class="form-select border border-dark">
                                            <option value="" hidden>-- Pilih Jenis Person --</option>
                                            <option value="Supplier">Supplier</option>
                                            <option value="Driver">Pengemudi</option>
                                        </select>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label">Nama</label>
                                        <input type="text" class="form-control border border-dark" name="nama"
                                            id="nama" placeholder="Contoh: Jaya Indah. PT"
                                            style="text-transform: uppercase;">
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label">NPWP / No. KTP</label>
                                        <input type="text" class="form-control border border-dark" name="noid"
                                            id="noid" placeholder="Masukkan Nomor ID Person"
                                            style="text-transform: uppercase;">
                                        <i class="text-small">jika tdk ada isi dengan tanda -</i>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label">Email</label>
                                        <input type="text" class="form-control border border-dark" name="email"
                                            id="email" placeholder="Masukkan Email">
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label">Telepon</label>
                                        <input type="text" class="form-control border border-dark" name="telp"
                                            id="telp" placeholder="Masukkan Telepon">
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label">Kodepos</label>
                                        <input type="text" class="form-control border border-dark" name="kopos"
                                            id="kopos" placeholder="Contoh: 12345">
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label">Kota</label>
                                        <input type="text" class="form-control border border-dark" name="kota"
                                            id="kota" placeholder="Contoh: Jakarta">
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label">Provinsi</label>
                                        <input type="text" class="form-control border border-dark" name="provinsi"
                                            id="provinsi" placeholder="Contoh: DKI Jakarta">
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label">Mata Uang Dipakai</label>
                                        <input type="text" class="form-control border border-dark" name="mtuang"
                                            id="mtuang" placeholder="Contoh: IDR, USD, EUR, JPY, SGD, CNY"
                                            style="text-transform: uppercase;">
                                    </div>
                                    <div class="mb-3 col-md-12">
                                        <label class="form-label">Alamat</label>
                                        <input type="text" class="form-control border border-dark" name="alamat"
                                            id="alamat" placeholder="Masukkan Alamat">
                                    </div>
                                    <div class="mb-3 col-md-12">
                                        <label class="form-label">Pas Foto</label>
                                        <input type="file" class="form-control border border-dark" name="foto1"
                                            id="foto1" accept="image/*" onchange="preview(pas)">
                                    </div>
                                    <div class="mb-3 col-md-12">
                                        <label class="form-label">Foto KTP / ID</label>
                                        <input type="file" class="form-control border border-dark" name="foto2"
                                            id="foto2" accept="image/*" onchange="preview(ktp)">
                                    </div>
                                    <div class="mb-3 col-md-6 text-center">
                                        <img class="card-img-top" src="{{ asset('assets/static/pas.jpg') }}"
                                            id="pas" style="width: 100%;max-width: 300px;max-height: 300px" />
                                    </div>
                                    <div class="mb-3 col-md-6 text-center">
                                        <img class="card-img-top" src="{{ asset('assets/static/ktp.jpg') }}"
                                            id="ktp" style="width: 100%;max-width: 300px;max-height: 300px" />
                                    </div>
                                    <script>
                                        function preview(param) {
                                            param.src = URL.createObjectURL(event.target.files[0]);
                                        }
                                    </script>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" id="submitSupplier" class="btn btn-primary ms-auto">
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
            {{-- Modal Edit --}}
            <div class="modal modal-blur fade" id="modal-edit-supplier" tabindex="-1" role="dialog"
                aria-hidden="true">
                <div class="overlay">
                    <div class="cv-spinner">
                        <span class="loader"></span>
                    </div>
                </div>
                <div class="modal-dialog modal-md" role="document">
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
                                Edit Supplier
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <form id="formEditSupplier" name="formEditSupplier" method="post" action="javascript:void(0)">
                            @csrf
                            <div class="fetched-data-edit-supplier"></div>
                        </form>
                    </div>
                </div>
            </div>
            @include('shared.footer')
            <script type="text/javascript">
                var tableSupplier;
                $(function() {
                    /*------------------------------------------
                    --------------------------------------------
                    Render DataTable
                    --------------------------------------------
                    --------------------------------------------*/
                    tableSupplier = $('.datatable-supplier').DataTable({
                        "processing": true, //Feature control the processing indicator.
                        "serverSide": false, //Feature control DataTables' server-side processing mode.
                        "scrollX": false,
                        "scrollCollapse": false,
                        "pagingType": 'full_numbers',
                        "dom": "<'card-body border-bottom py-3' <'row'<'col-sm-6'l><'col-sm-6'f>> >" +
                            "<'table-responsive' <'col-sm-12'tr> >" +
                            "<'card-footer' <'row'<'col-sm-5'i><'col-sm-7'p> >>",
                        "lengthMenu": [
                            [25, 50, -1],
                            ['Default', '50', 'Semua']
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
                            "url": "{{ route('getSupplier.index') }}",
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
                                title: '',
                                data: 'action',
                                name: 'action',
                                className: "w-0",
                                orderable: false,
                                searchable: false,
                            },
                            {
                                title: 'Jenis Person',
                                data: 'jenisperson',
                                name: 'jenisperson',
                                className: "cuspad0 cuspad1 text-center"
                            },
                            {
                                title: 'Nama Supplier',
                                data: 'nama',
                                name: 'nama',
                                className: "cuspad0 cuspad1 text-center"
                            },
                            {
                                title: 'No. ID',
                                data: 'noid',
                                name: 'noid',
                                className: "cuspad0 cuspad1 text-center"
                            },
                            {
                                title: 'Alamat',
                                data: 'alamat',
                                name: 'alamat',
                                className: "cuspad0 cuspad1 text-center"
                            },
                            {
                                title: 'Kode Pos',
                                data: 'kopos',
                                name: 'kopos',
                                className: "cuspad0 cuspad1 text-center"
                            },
                            {
                                title: 'Kota',
                                data: 'kota',
                                name: 'kota',
                                className: "cuspad0 cuspad1 text-center"
                            },
                            {
                                title: 'Provinsi',
                                data: 'provinsi',
                                name: 'provinsi',
                                className: "cuspad0 cuspad1 text-center"
                            },
                            {
                                title: 'Telepon',
                                data: 'telp',
                                name: 'telp',
                                className: "cuspad0 cuspad1 text-center"
                            },
                            {
                                title: 'Email',
                                data: 'email',
                                name: 'email',
                                className: "cuspad0 cuspad1 text-center"
                            },
                            {
                                title: 'Mata Uang',
                                data: 'mtuang',
                                name: 'mtuang',
                                className: "cuspad0 cuspad1 text-center"
                            },
                        ],
                    });
                    $('.datatable-supplier').on('click', '.remove', function() {
                        var id = $(this).data('id');
                        var nama = $(this).data('nama');
                        var kode = $(this).data('kode');
                        var token = $("meta[name='csrf-token']").attr("content");
                        let r = (Math.random() + 1).toString(36).substring(2);
                        swal.fire({
                            title: 'Hapus ' + nama,
                            text: 'Apakah anda yakin ingin menghapus ' + nama + ', Kota : ' + kode,
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
                                            url: "{{ route('getSupplier.store') }}" +
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
                                                tableSupplier.ajax.reload(null, false);
                                                Swal.fire({
                                                    icon: 'success',
                                                    title: 'Berhasil',
                                                    html: data,
                                                    showConfirmButton: true
                                                });
                                            },
                                            error: function(data) {
                                                tableSupplier.ajax.reload(null, false);
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
                                        tableSupplier.ajax.reload();
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

                                $.ajaxSetup({
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    }
                                });

                                $('#submitSupplier').html(
                                    '<i class="fa-solid fa-fw fa-spinner fa-spin"></i> Please Wait...'
                                );
                                $("#submitSupplier").attr("disabled", true);

                                $.ajax({
                                    url: "{{ url('storedataSupplier') }}",
                                    type: "POST",
                                    data: formData,
                                    contentType: false,
                                    processData: false,
                                    beforeSend: function() {
                                        Swal.fire({
                                            title: 'Mohon Menunggu',
                                            html: '<center><lottie-player src="https://lottie.host/9f0e9407-ad00-4a21-a698-e19bed2949f6/mM7VH432d9.json" background="transparent" speed="1" style="width: 300px; height: 300px;" loop autoplay></lottie-player></center><br><h1 class="h4">Sedang memproses data, Proses mungkin membutuhkan beberapa menit. </h1>',
                                            showConfirmButton: false,
                                            timerProgressBar: true,
                                            allowOutsideClick: false,
                                            allowEscapeKey: false,
                                        });
                                    },
                                    success: function(response) {
                                        tableSupplier.ajax.reload(null, false);
                                        console.log('Completed. ' + response);
                                        $('#submitSupplier').html(
                                            '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-floppy" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 1 1 2 -2" /><path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M14 4l0 4l-6 0l0 -4" /></svg> Simpan'
                                        );
                                        $("#submitSupplier").attr("disabled", false);
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
                                        document.getElementById("formSupplier").reset();
                                        $('#modal-supplier').modal('hide');
                                    },
                                    error: function(data) {
                                        console.log('Error:', data);
                                        tableSupplier.ajax.reload(null, false);
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Gagal Input',
                                            html: data.responseJSON.message,
                                            showConfirmButton: true
                                        });
                                        $('#submitSupplier').html(
                                            '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-floppy" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 1 1 2 -2" /><path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M14 4l0 4l-6 0l0 -4" /></svg> Simpan'
                                        );
                                        $("#submitSupplier").attr("disabled", false);
                                    }
                                });
                            }

                        })
                    }
                    if ($("#formEditSupplier").length > 0) {
                        $("#formEditSupplier").validate({
                            rules: {
                                nama: {
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
                                $.ajaxSetup({
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    }
                                });
                                $('#submitEditSupplier').html(
                                    '<i class="fa-solid fa-fw fa-spinner fa-spin"></i> Please Wait...');
                                $("#submitEditSupplier").attr("disabled", true);
                                var formDataSerialized = $(this).serialize();
                                console.log(formDataSerialized);
                                $.ajax({
                                    url: "{{ url('storedataEditSupplier') }}",
                                    type: "POST",
                                    data: formDataSerialized,
                                    contentType: false,
                                    processData: false,
                                    beforeSend: function() {
                                        Swal.fire({
                                            title: 'Mohon Menunggu',
                                            html: '<center><lottie-player src="https://lottie.host/9f0e9407-ad00-4a21-a698-e19bed2949f6/mM7VH432d9.json"  background="transparent"  speed="1"  style="width: 300px; height: 300px;"  loop autoplay></lottie-player></center><br><h1 class="h4">Sedang memproses data, Proses mungkin membutuhkan beberapa menit. </h1>',
                                            showConfirmButton: false,
                                            timerProgressBar: true,
                                            allowOutsideClick: false,
                                            allowEscapeKey: false,
                                        })
                                    },
                                    success: function(response) {
                                        tableSupplier.ajax.reload(null, false);
                                        console.log('Completed. ' + response);
                                        $('#submitEditSupplier').html(
                                            '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-floppy" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" /><path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M14 4l0 4l-6 0l0 -4" /></svg> Simpan'
                                        );
                                        $("#submitEditSupplier").attr("disabled", false);
                                        Swal.fire({
                                            icon: 'success',
                                            title: 'Berhasil',
                                            html: response,
                                            showConfirmButton: true
                                        });
                                        document.getElementById("formEditSupplier").reset();
                                        $('#modal-edit-supplier').modal('hide');
                                    },
                                    error: function(data) {
                                        console.log('Error:', data);
                                        // const obj = JSON.parse(data.responseJSON);
                                        tableSupplier.ajax.reload(null, false);
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Gagal Update',
                                            html: data.responseJSON.message,
                                            showConfirmButton: true
                                        });
                                        $('#submitEditSupplier').html(
                                            '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-floppy" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" /><path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M14 4l0 4l-6 0l0 -4" /></svg> Simpan'
                                        );
                                        $("#submitEditSupplier").attr("disabled", false);
                                    }
                                });
                            }
                        })
                    }

                    $('#modal-edit-supplier').on('show.bs.modal', function(e) {
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
                                $('.fetched-data-edit-supplier').html(data);
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
