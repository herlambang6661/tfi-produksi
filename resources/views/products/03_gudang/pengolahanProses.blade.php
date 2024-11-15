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
                                    stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-a-b-2">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path
                                        d="M16 21h3c.81 0 1.48 -.67 1.48 -1.48l.02 -.02c0 -.82 -.69 -1.5 -1.5 -1.5h-3v3z" />
                                    <path d="M16 15h2.5c.84 -.01 1.5 .66 1.5 1.5s-.66 1.5 -1.5 1.5h-2.5v-3z" />
                                    <path d="M4 9v-4c0 -1.036 .895 -2 2 -2s2 .964 2 2v4" />
                                    <path d="M2.99 11.98a9 9 0 0 0 9 9m9 -9a9 9 0 0 0 -9 -9" />
                                    <path d="M8 7h-4" />
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
                                    <li class="breadcrumb-item">
                                        <a href="{{ url('gudang/pengolahan') }}">
                                            <i class="fa-solid fa-qrcode"></i>
                                            Pengolahan Bahan Baku
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        <a href="#">
                                            <i class="fa-solid fa-arrows-spin"></i>
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
                        <div class="card card-xl border-primary shadow rounded">
                            <div class="card-stamp card-stamp-lg">
                                <div class="card-stamp-icon bg-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-box">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M12 3l8 4.5l0 9l-8 4.5l-8 -4.5l0 -9l8 -4.5" />
                                        <path d="M12 12l8 -4.5" />
                                        <path d="M12 12l0 9" />
                                        <path d="M12 12l-8 -4.5" />
                                    </svg>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row row-cards">
                                    <div class="col-md-12 text-center">
                                        <img src="{{ asset('photo/illustration/karung.png') }}" width="100px"
                                            class="object-cover card-img-start" alt="Karung" />
                                        <img src="{{ asset('photo/illustration/arrow.png') }}" width="100px"
                                            class="object-cover card-img-start" alt="Karung" />
                                        <img src="{{ asset('photo/illustration/jumbobag2.png') }}" width="100px"
                                            class="object-cover card-img-start" alt="Karung" />
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <form id="formPengolahan" name="formPengolahan" method="post" action="javascript:void(0)">
                                    <div class="row">
                                        @csrf
                                        <div class="col-md-6">
                                            <div class="table-responsive">
                                                <h3>List Bahan Baku</h3>
                                                <table class="table table-sm table-bordered text-nowrap">
                                                    <thead>
                                                        <tr>
                                                            <th style="width: 1%" class="text-center">No</th>
                                                            <th>Kodekontrak</th>
                                                            <th style="width: 1%" class="text-center">Jenis</th>
                                                            <th style="width: 1%" class="text-center">Kategori</th>
                                                            <th style="width: 1%" class="text-center">Warna</th>
                                                            <th style="width: 1%">Berat</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php
                                                            $no = 1;
                                                        @endphp
                                                        @foreach ($pengolahanItm as $item)
                                                            <input type="hidden" name="id[]"
                                                                value="{{ $item->id }}">
                                                            <tr>
                                                                <td class="text-center">{{ $no++ }}</td>
                                                                <td>{{ $item->subkode }}</td>
                                                                <td class="text-center">{{ $item->package }}</td>
                                                                <td class="text-center">{{ $item->kategori }}</td>
                                                                <td class="text-center">{{ $item->warna }}</td>
                                                                <td class="text-center">
                                                                    <input type="number" name="berat_satuan[]"
                                                                        style="width: 100px" value="{{ $item->berat }}"
                                                                        class="form-control">
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <h3>Spesifikasi Bahan Baku Baru</h3>
                                            <fieldset class="form-fieldset">
                                                <div class="mb-1">
                                                    <label class="form-label required">Tanggal</label>
                                                    <input name="tanggal" id="tanggal" type="date"
                                                        class="form-control" autocomplete="off"
                                                        value="{{ date('Y-m-d') }}">
                                                </div>
                                                <div class="mb-1">
                                                    <label class="form-label required">Jenis Bahan Baku</label>
                                                    <select name='tipe' id='tipe' class='form-select'
                                                        style='width:100%;text-transform: uppercase;'></select>
                                                </div>
                                                <div class="mb-1">
                                                    <label class="form-label required">Kategori Bahan Baku</label>
                                                    <select name='kategori' id='kategori' class='form-select'
                                                        style='width:100%;text-transform: uppercase;'></select>
                                                </div>
                                                <div class="mb-1">
                                                    <label class="form-label required">Warna Bahan Baku</label>
                                                    <select name='warna' id='warna' class='form-select w-100'
                                                        style='width:100%;text-transform: uppercase;'></select>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="mb-1">
                                                            <label class="form-label required">Berat Bahan Baku</label>
                                                            <input name='berat' id='berat' type="number"
                                                                class="form-control" min="0" autocomplete="off">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="mb-1">
                                                            <label class="form-label required">Qty Jumbo Bag</label>
                                                            <input name="qty" id="qty" type="number"
                                                                class="form-control" min="0" autocomplete="off"
                                                                value="1">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="mb-1">
                                                            <label class="form-label required">Satuan</label>
                                                            <select name="satuan" id="satuan" class="form-select">
                                                                <option value="Jumbo Bag">Jumbo Bag</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="mb-1">
                                                            <label class="form-label required">Kedatangan</label>
                                                            <input type="text" class="form-control" disabled
                                                                autocomplete="off" value="1">
                                                            <input type="hidden" name="kedatangan" value="1">
                                                        </div>
                                                    </div>
                                                </div>
                                            </fieldset>
                                            <button type="submit" class="btn btn-primary" id="submitPengolahan">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
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
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('shared.footer')
            <script>
                $(function() {
                    $("#tipe").select2({
                        language: "id",
                        width: '100%',
                        placeholder: "Pilih Bahan Baku",
                        ajax: {
                            url: "{{ route('getBB') }}",
                            dataType: 'json',
                            delay: 200,
                            processResults: function(response) {
                                return {
                                    results: $.map(response, function(item) {
                                        return {
                                            text: (!item.kode ? '' : item.kode + ' - ') + item.nama
                                                .toUpperCase(),
                                            id: item.id,
                                        }
                                    })
                                };
                            },
                            cache: true
                        },
                    });
                    $("#kategori").select2({
                        language: "id",
                        width: '100%',
                        placeholder: "Pilih Kategori",
                        ajax: {
                            url: "{{ route('getKT') }}",
                            dataType: 'json',
                            delay: 200,
                            processResults: function(response) {
                                return {
                                    results: $.map(response, function(item) {
                                        return {
                                            text: (!item.kode_kategori ? '' : item.kode_kategori +
                                                    ' - ') + item
                                                .nama_kategori.toUpperCase(),
                                            id: item.id,
                                        }
                                    })
                                };
                            },
                            cache: true
                        },
                    });
                    $("#warna").select2({
                        language: "id",
                        width: '100%',
                        placeholder: "Pilih Warna",
                        ajax: {
                            url: "{{ route('getWR') }}",
                            dataType: 'json',
                            delay: 200,
                            processResults: function(response) {
                                return {
                                    results: $.map(response, function(item) {
                                        return {
                                            text: (!item.kode_warna ? '' : item.kode_warna + ' - ') +
                                                item
                                                .warna.toUpperCase(),
                                            id: item.id,
                                        }
                                    })
                                };
                            },
                            cache: true
                        },
                    });
                });

                if ($("#formPengolahan").length > 0) {
                    $("#formPengolahan").validate({
                        rules: {
                            tanggal: {
                                required: true,
                            },
                            tipe: {
                                required: true,
                            },
                            kategori: {
                                required: true,
                            },
                            warna: {
                                required: true,
                            },
                            berat: {
                                required: true,
                            },
                            qty: {
                                required: true,
                            },
                            satuan: {
                                required: true,
                            },
                            kedatangan: {
                                required: true,
                            },
                            "id[]": "required",
                            "berat_satuan[]": "required",
                        },
                        messages: {
                            tanggal: {
                                required: 'Kolom ini tidak boleh kosong',
                            },
                            tipe: {
                                required: 'Kolom ini tidak boleh kosong',
                            },
                            kategori: {
                                required: 'Kolom ini tidak boleh kosong',
                            },
                            warna: {
                                required: 'Kolom ini tidak boleh kosong',
                            },
                            berat: {
                                required: 'Kolom ini tidak boleh kosong',
                            },
                            qty: {
                                required: 'Kolom ini tidak boleh kosong',
                            },
                            satuan: {
                                required: 'Kolom ini tidak boleh kosong',
                            },
                            kedatangan: {
                                required: 'Kolom ini tidak boleh kosong',
                            },
                            "id[]": "Kolom ini tidak boleh kosong",
                            "berat_satuan[]": "required",
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
                            $('#submitPengolahan').html(
                                '<i class="fa-solid fa-fw fa-spinner fa-spin"></i> Please Wait...');
                            $("#submitPengolahan").attr("disabled", true);
                            $.ajax({
                                url: "{{ url('storedataFixPengolahan') }}",
                                type: "POST",
                                data: formData,
                                contentType: false,
                                processData: false,
                                // data: $('#formPengolahan').serialize(),
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
                                    $('#submitPengolahan').html(
                                        '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-floppy" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" /><path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M14 4l0 4l-6 0l0 -4" /></svg> Simpan'
                                    );
                                    $("#submitPengolahan").attr("disabled", false);
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Berhasil',
                                        html: response.msg,
                                        showConfirmButton: true,
                                        allowOutsideClick: false,
                                        allowEscapeKey: false,
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            window.location.href =
                                                "{{ route('gudang/pengolahan') }}";
                                        }
                                    });
                                },
                                error: function(data) {
                                    // console.log('Error:', data);
                                    // const obj = JSON.parse(data.responseJSON);
                                    console.log($('#formPengolahan').serialize());
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Gagal Input',
                                        html: data.responseJSON.message,
                                        showConfirmButton: true
                                    });
                                    $('#submitPengolahan').html(
                                        '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-floppy" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" /><path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M14 4l0 4l-6 0l0 -4" /></svg> Proses'
                                    );
                                    $("#submitPengolahan").attr("disabled", false);
                                }
                            });
                        }
                    })
                }
            </script>
        </div>
    </div>
@endsection
