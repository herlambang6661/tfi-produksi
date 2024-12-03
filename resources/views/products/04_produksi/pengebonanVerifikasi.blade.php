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

        .overlayModals {
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
    <div class="page bg-success-lt">
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
                                    stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-apps">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path
                                        d="M4 4m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                                    <path
                                        d="M4 14m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                                    <path
                                        d="M14 14m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                                    <path d="M14 7l6 0" />
                                    <path d="M17 4l0 6" />
                                </svg>
                                {{ $judul }} {{ $pengebonan->formproduksi }}
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
                                            <i class="fa-solid fa-industry"></i>
                                            Produksi
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item" aria-current="page">
                                        <a href="{{ route('produksi.pengebonan') }}">
                                            <i class="fa-solid fa-people-carry-box"></i>
                                            Production Planning
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        <a href="#">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                            {{ $judul }}
                                        </a>
                                    </li>
                                </ol>
                            </div>
                        </div>
                        <!-- Page title actions -->
                        <div class="col-auto ms-auto d-print-none">
                            <div class="btn-list">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Page body -->
            <div class="page-body">
                <div class="container-xl">
                    <div class="row">
                        <div class="col-lg-12" onkeydown="return event.key != 'Enter';">
                            <div class="card card-xl border-success shadow rounded mb-3">
                                <div class="table-responsive">
                                    <form id="formPengebonan" name="formPengebonan" method="post"
                                        action="javascript:void(0)" autocomplete="off">
                                        @csrf
                                        <input name="nomorform" value="{{ $pengebonan->formproduksi }}" type="hidden">
                                        <div class="card-body px-1 py-1 my-1 mx-1">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label class="form-label">Tanggal Produksi</label>
                                                    <div class="form-control disabled cursor-not-allowed">
                                                        {{ \Carbon\Carbon::parse($pengebonan->tanggal)->format('d F Y') }}
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="form-label">Operator</label>
                                                    <div class="form-control disabled cursor-not-allowed">
                                                        {{ $pengebonan->operator }}
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="form-label">Verifikator</label>
                                                    <input type="text" class="form-control" name="verifikator"
                                                        value="{{ Auth::user()->nickname }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body px-1 py-1 my-1 mx-1 text-end">
                                            <div class="mb-0">
                                                <div class="form-selectgroup form-selectgroup-boxes d-flex flex-column">
                                                    @php
                                                        $ArWarna = [
                                                            'green' => 'Hijau',
                                                            'red' => 'Merah',
                                                            'blue' => 'Biru',
                                                            'yellow' => 'Kuning',
                                                            'purple' => 'Ungu',
                                                            'black' => 'Hitam',
                                                            'white' => 'Putih',
                                                            'brown' => 'Coklat',
                                                            'orange' => 'Oranye',
                                                            'secondary-lt' => 'Clear',
                                                            'mambo' => 'Mambo',
                                                        ];
                                                    @endphp
                                                    @foreach ($pengebonanItem as $item)
                                                        <input type="hidden" name="idItem[]" value="{{ $item->id }}">
                                                        <label class="form-selectgroup-item flex-fill">
                                                            <input type="checkbox" name="form-project-manager[]"
                                                                value="1" class="form-selectgroup-input checkSingle"
                                                                wfd-id="id97">
                                                            <div
                                                                class="form-selectgroup-label d-flex align-items-center p-3">
                                                                <div class="me-3">
                                                                    <span class="form-selectgroup-check"></span>
                                                                </div>
                                                                <div
                                                                    class="form-selectgroup-label-content d-flex align-items-center">
                                                                    <span
                                                                        class="avatar me-3 bg-{{ array_search($item->warna, $ArWarna) }} text-white shadow">
                                                                        {{ substr($item->type, 0, 2) }}
                                                                    </span>
                                                                    <div>
                                                                        <div class="fw-bolder">{{ $item->subkode }}
                                                                        </div>
                                                                        <div class="text-secondary">
                                                                            <span
                                                                                class="badge bg-indigo-lt">{{ $item->type . ' ' . $item->kategori . ' ' . $item->warna }}</span>
                                                                            <span
                                                                                class="badge bg-purple-lt">{{ $item->package }}</span>
                                                                            <span
                                                                                class="badge bg-teal-lt">{{ $item->berat }}
                                                                                KG</span>
                                                                            <span
                                                                                class="badge bg-lime-lt">{{ $item->supplier }}
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </label>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body px-1 py-1 my-1 mx-1 text-end">
                                            <label class="form-selectgroup-item col-md-3">
                                                <input type="checkbox" id="checkedAll" class="form-selectgroup-input">
                                                <span class="form-selectgroup-label border-dark shadow">Checklist
                                                    Semua</span>
                                            </label>
                                        </div>
                                        <div class="card-footer px-1 py-1 my-1 mx-1 text-end">
                                            {{-- <button id="btnCheckAll" type="button" class="btn btn-primary">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="icon icon-tabler icons-tabler-outline icon-tabler-checks">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M7 12l5 5l10 -10" />
                                                    <path d="M2 12l5 5m5 -5l5 -5" />
                                                </svg>
                                                Checklist Semua
                                            </button> --}}
                                            <button id="submitPengebonan" type="submit"
                                                class="btn btn-success toggle-disabled" disabled>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="icon icon-tabler icons-tabler-outline icon-tabler-pencil-check">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M4 20h4l10.5 -10.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4" />
                                                    <path d="M13.5 6.5l4 4" />
                                                    <path d="M15 19l2 2l4 -4" />
                                                </svg>
                                                Proses Planning ke Produksi
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div id="notifications"></div>
                        </div>
                    </div>
                    <div style="display: none">
                        <select id="inversion-mode-select">
                            <option value="original">Scan original (dark QR code on bright background)</option>
                            <option value="invert">Scan with inverted colors (bright QR code on dark background)
                            </option>
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
        <script type="text/javascript">
            var tableResult;

            if ($("#formPengebonan").length > 0) {
                $("#formPengebonan").validate({
                    rules: {
                        verifikator: {
                            required: true,
                        },
                    },
                    messages: {
                        verifikator: {
                            required: 'Silahkan isi kolom berikut',
                        },
                    },
                    highlight: function(element) {
                        // add a class "errorClass" to the element
                        $(element).addClass('border-danger');
                    },
                    unhighlight: function(element) {
                        // class "errorClass" remove from the element
                        $(element).removeClass('border-danger');
                    },

                    submitHandler: function(form) {
                        let formData = new FormData(form);
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $('#submitPengebonan').html(
                            '<i class="fa-solid fa-fw fa-spinner fa-spin"></i> Please Wait...');
                        $("#submitPengebonan").attr("disabled", true);
                        $.ajax({
                            url: "{{ url('verifyPengebonan') }}",
                            type: "POST",
                            data: formData,
                            contentType: false,
                            processData: false,
                            // data: $('#formPengebonan').serialize(),
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
                                $('#submitPengebonan').html('Formulir berhasil di Verifikasi');
                                $("#submitPengebonan").attr("disabled", true);
                                if (response.success == true) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Berhasil',
                                        html: response.message,
                                        showConfirmButton: true,
                                        // showDenyButton: true,
                                        allowOutsideClick: false,
                                        allowEscapeKey: false,
                                        confirmButtonColor: '#3085d6',
                                        confirmButtonText: 'Ok',
                                        // denyButtonText: '<i class="fa-solid fa-print"></i> Print Formulir',
                                    }).then((result) => {
                                        $(".overlay").fadeIn(300);
                                        window.location.href =
                                            "{{ route('produksi.pengebonan') }}";
                                    });
                                    document.getElementById("formPengebonan").reset();
                                    // tablePengebonan.ajax.reload(null, false);
                                    $('#modal-penerimaan').modal('hide');
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Gagal Input',
                                        html: response.message,
                                        showConfirmButton: true
                                    });
                                }
                            },
                            error: function(data) {
                                // tablePengebonan.ajax.reload(null, false);
                                // console.log('Error:', data);
                                // const obj = JSON.parse(data.responseJSON);
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal Input',
                                    html: data,
                                    showConfirmButton: true
                                });
                                $('#submitPengebonan').html(
                                    '<svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-pencil-check"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 20h4l10.5 -10.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4" /><path d="M13.5 6.5l4 4" /><path d="M15 19l2 2l4 -4" /></svg>' +
                                    'Proses Planning ke Produksi');
                                $("#submitPengebonan").attr("disabled", false);
                            }
                        });
                    }
                })
            }

            $(document).on('click', '.btnHapusForm', function() {
                var id = $(this).data('id');
                var noform = $(this).data('noform');
                var kode = $(this).data('kode');
                var typeHapus = $(this).data('typehapus');
                var kodeproduksi = $(this).data('kodeproduksi');
                var token = $("meta[name='csrf-token']").attr("content");
                nama = (typeHapus == "form") ? noform : kode;
                console.log("menghapus " + kodeproduksi);
                let r = (Math.random() + 1).toString(36).substring(2);
                swal.fire({
                    title: 'Hapus ' + nama,
                    html: 'Apakah anda yakin ingin menghapus <b class="text-red fw-bolder">' + nama +
                        '</b><br><br>Kode<br>' +
                        '<div class="alert alert-important alert-yellow text-dark" role="alert" style="font-size: 12px; max-height: 260px;">' +
                        '<div class="d-flex" ><b class="fw-bolder" > ' +
                        kode +
                        ' </b></div> </div> ',
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
                                title: "Ketik tulisan dibawah untuk menghapus " + nama,
                                html: '<div class="unselectable">' + r + '</div>',
                                input: "text",
                                // inputValue: r,
                                inputPlaceholder: r,
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
                                    url: "{{ route('delete.deleteExist') }}",
                                    data: {
                                        "_token": "{{ csrf_token() }}",
                                        "id": id,
                                        "noform": noform,
                                        "kodeproduksi": kodeproduksi,
                                        "tipeHapus": typeHapus,
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
                                        // tablePengebonan.ajax.reload(null,
                                        //     false);
                                        $('#modalViewItem').modal('hide');
                                        Swal.fire({
                                            icon: 'success',
                                            title: 'Berhasil',
                                            html: data,
                                            showConfirmButton: true
                                        });
                                        if (kodeproduksi) {
                                            $("#btn-remove" + kodeproduksi).remove();
                                        }
                                    },
                                    error: function(data) {
                                        // tablePengebonan.ajax.reload(null,
                                        //     false);
                                        // console.log('Error:', data
                                        //     .responseText);
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Gagal!',
                                            text: 'Error: ' + data.responseText,
                                            showConfirmButton: true,
                                        });
                                    }
                                });
                            } else {
                                // tablePengebonan.ajax.reload(null, false);
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

            $(document).ready(function() {

                $('form input[type="checkbox"]').change(function() {
                    var allChecked = !!$('.checkSingle:not(:checked)').length;
                    $('.toggle-disabled').prop('disabled', allChecked);
                });

                $("#checkedAll").change(function() {
                    if (this.checked) {
                        $(".checkSingle").each(function() {
                            this.checked = true;
                            var allChecked = !!$('form input[type="checkbox"]:not(:checked)').length;
                            $('.toggle-disabled').prop('disabled', allChecked);
                        });
                    } else {
                        $(".checkSingle").each(function() {
                            this.checked = false;
                            var allChecked = !!$('form input[type="checkbox"]:not(:checked)').length;
                            $('.toggle-disabled').prop('disabled', allChecked);
                        })
                    }
                });
            });
        </script>
    </div>
@endsection
