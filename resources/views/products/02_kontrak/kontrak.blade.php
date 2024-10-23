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
                                <a href="#" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal"
                                    data-bs-target="#modal-Suratkontrak" data-bs-backdrop="static" data-bs-keyboard="false">
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
                                <a href="#" class="btn btn-primary d-sm-none btn-icon" data-bs-toggle="modal"
                                    data-bs-target="#modal-Suratkontrak" aria-label="Tambah Suratkontrak">
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
                                        <i class="fa-solid fa-users"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Modal tambah --}}
            <div class="modal modal-blur fade" id="modal-Suratkontrak" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-primary text-white">
                            <h5 class="modal-title">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-contract">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M8 21h-2a3 3 0 0 1 -3 -3v-1h5.5" />
                                    <path d="M17 8.5v-3.5a2 2 0 1 1 2 2h-2" />
                                    <path d="M19 3h-11a3 3 0 0 0 -3 3v11" />
                                    <path d="M9 7h4" />
                                    <path d="M9 11h4" />
                                    <path d="M18.42 12.61a2.1 2.1 0 0 1 2.97 2.97l-6.39 6.42h-3v-3z" />
                                </svg>
                                Buat Surat Kontrak
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form id="formSuratkontrak" name="formSuratkontrak" method="post" action="javascript:void(0)">
                            @csrf
                            <div class="modal-body">
                                <div class="card-stamp card-stamp-lg">
                                    <div class="card-stamp-icon bg-primary">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 mb-3">
                                        <label class="form-label">Entitas</label>
                                        <input type="text" class="form-control border border-dark bg-secondary-lt"
                                            name="entitas" id="entitas" readonly value="TFI">
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <label class="form-label">Tanggal Kontrak</label>
                                        <input type="date" class="form-control border border-dark" name="tanggal"
                                            id="tanggal" value="{{ date('Y-m-d') }}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 mb-3">
                                        <label class="form-label">Supplier</label>
                                        <input type="text" class="form-control border border-dark" name="supplier"
                                            id="supplier">
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <label class="form-label">Dibeli Oleh</label>
                                        <input type="text" class="form-control border border-dark" name="dibeli"
                                            id="dibeli" placeholder="Masukkan Nomor Import">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 mb-3">
                                        <label class="form-label">Berat Kontrak</label>
                                        <input type="number" class="form-control border border-dark" name="berat"
                                            id="berat" placeholder="Masukkan Nomor Import">
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <label class="form-label">Harga</label>
                                        <input type="number" class="form-control border border-dark" name="harga"
                                            id="harga" placeholder="Masukkan Nomor Import">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 mb-3">
                                        <label class="form-label">Tipe</label>
                                        <input type="text" class="form-control border border-dark" name="tipe"
                                            id="tipe" placeholder="Masukkan Nomor Import">
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <label class="form-label">Warna</label>
                                        <input type="text" class="form-control border border-dark" name="warna"
                                            id="warna" placeholder="Masukkan Nomor Import">
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
                                <button type="submit" id="submitSuratkontrak" class="btn btn-primary ms-auto">
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
                $(function() {
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
                                berat: {
                                    required: true,
                                },
                                harga: {
                                    required: true,
                                },
                                tipe: {
                                    required: true,
                                },
                                warna: {
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
                                berat: {
                                    required: "Masukkan Berat Kontrak",
                                },
                                harga: {
                                    required: "Masukkan Harga Kontrak",
                                },
                                tipe: {
                                    required: "Masukkan Tipe Package",
                                },
                                warna: {
                                    required: "Masukkan Warna Tipe",
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
                                            html: '<center><lottie-player src="https://lottie.host/933bb0e2-47c0-4fa6-83f9-3330b433b883/yymyeZt49h.json"  background="transparent"  speed="1"  style="width: 300px; height: 300px;"  loop autoplay></lottie-player></center><br><h1 class="h4">Sedang memproses data, Proses mungkin membutuhkan beberapa menit. <br><br><b class="text-danger">(Jangan menutup jendela ini, bisa mengakibatkan error)</b></h1>',
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
                                        document.getElementById("formSuratkontrak").reset();
                                        var sp = $('#selectEntitas').val();
                                        $('#entitas').val(sp);
                                        $('#modal-Suratkontrak').modal('hide');
                                    },
                                    error: function(data) {
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
                });
            </script>
        </div>
    </div>
@endsection
