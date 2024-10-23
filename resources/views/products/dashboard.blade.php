@extends('layouts.app')
@section('content')
    <style>
        .card-sponsor {
            position: relative;
            overflow: hidden;
        }

        .card-sponsor::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-size: cover;
            background-position: center;
            background-image: inherit;
            transition: transform 0.3s ease;
            z-index: 0;
        }

        .card-sponsor:hover::before {
            transform: scale(1.1);
        }

        .card-body {
            position: relative;
            z-index: 1;
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
                            <div class="page-pretitle">
                                Selamat Datang
                            </div>
                            <h2 class="page-title">
                                Halaman Dashboard
                            </h2>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Page body -->
            <div class="page-body">
                <div class="container-xl">
                    <div class="row row-deck row-cards">
                        <!-- Welcome Card -->
                        <div class="col-md-6 col-lg-10">
                            <div class="card card-sm">
                                <div class="card-stamp card-stamp-lg">
                                    <div class="card-stamp-icon bg-primary">
                                        <!-- SVG Icon -->
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row align-items-center px-0">
                                        <div class="col-3">
                                            <iframe
                                                src="https://lottie.host/embed/97ec1b9d-a3a0-49a5-ad64-fde41649f07e/AO6UokX4rf.lottie"
                                                width="250px" height="250px"></iframe>
                                        </div>
                                        <div class="col-9">
                                            <h3 class="h1">Selamat Datang di Aplikasi Produksi,
                                                {{ Auth::user()->nickname }}
                                                🎉</h3>
                                            <div class="markdown text-secondary">
                                                Aplikasi Produksi ini adalah aplikasi untuk Kedatangan barang sampai dengan
                                                identifikasi Produk di PT.
                                                Tantra Fiber Industry.
                                                <br>
                                                Silahkan pilih menu disamping untuk mulai menggunakan aplikasi.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Avatar Card -->
                        <div class="col-lg-2">
                            <?php
                            $role = Auth::user()->role;
                            $username = Auth::user()->username;
                            
                            // Default avatar URL
                            $avatarUrl = asset('assets/static/avatars/super.jpg');
                            
                            if ($role === 'own') {
                                if ($username === 'alvin') {
                                    $avatarUrl = asset('assets/static/avatars/1.jpg');
                                } elseif ($username === 'brian') {
                                    $avatarUrl = asset('assets/static/avatars/2.jpg');
                                } elseif ($username === 'felixjesse') {
                                    $avatarUrl = asset('assets/static/avatars/3.jpg');
                                } else {
                                    $avatarUrl = asset('assets/static/avatars/avatar.png');
                                }
                            } elseif ($role === 'pur') {
                                $avatarUrl = asset('assets/static/avatars/puji.jpg');
                            } elseif ($role === 'kng') {
                                $avatarUrl = asset('assets/static/avatars/avatar.png');
                            } elseif ($role === 'whs') {
                                if ($username === 'fahmi') {
                                    $avatarUrl = asset('assets/static/avatars/fahmi.jpg');
                                } elseif ($username === 'rizki') {
                                    $avatarUrl = asset('assets/static/avatars/rizky.jpg');
                                } elseif ($username === 'yanti') {
                                    $avatarUrl = asset('assets/static/avatars/yanti.jpg');
                                } else {
                                    $avatarUrl = asset('assets/static/avatars/avatar.png');
                                }
                            }
                            ?>
                            <a href="#" class="card card-sponsor" rel="noopener"
                                style="background-image: url('{{ $avatarUrl }}')" aria-label="Sponsor Tabler!">
                                <div class="card-body"></div>
                            </a>
                        </div>

                        <div class="col-sm-6 col-lg-3">
                            <div class="card card-sm">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <span
                                                class="bg-primary text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/currency-dollar -->
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                                    height="24" viewBox="0 0 24 24" stroke-width="2"
                                                    stroke="currentColor" fill="none" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <path
                                                        d="M16.7 8a3 3 0 0 0 -2.7 -2h-4a3 3 0 0 0 0 6h4a3 3 0 0 1 0 6h-4a3 3 0 0 1 -2.7 -2">
                                                    </path>
                                                    <path d="M12 3v3m0 12v3"></path>
                                                </svg>
                                            </span>
                                        </div>
                                        <div class="col">
                                            <div class="font-weight-medium">
                                                Permintaan
                                            </div>
                                            <div class="text-secondary">
                                                {{-- {{ $countPermintaan }} item --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="card card-sm">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <span
                                                class="bg-green text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/shopping-cart -->
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                                    height="24" viewBox="0 0 24 24" stroke-width="2"
                                                    stroke="currentColor" fill="none" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <path d="M6 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                                                    <path d="M17 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                                                    <path d="M17 17h-11v-14h-2"></path>
                                                    <path d="M6 5l14 1l-1 7h-13"></path>
                                                </svg>
                                            </span>
                                        </div>
                                        <div class="col">
                                            <div class="font-weight-medium">
                                                Barang di Hold
                                            </div>
                                            <div class="text-secondary">
                                                {{-- {{ $countHold }} item --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="card card-sm">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <span class="bg-red text-white avatar">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="icon icon-tabler icons-tabler-outline icon-tabler-ban">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                                                    <path d="M5.7 5.7l12.6 12.6" />
                                                </svg>
                                            </span>
                                        </div>
                                        <div class="col">
                                            <div class="font-weight-medium">
                                                Barang di Reject
                                            </div>
                                            <div class="text-secondary">
                                                {{-- {{ $countReject }} item --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="card card-sm">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <span
                                                class="bg-facebook text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/brand-facebook -->
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="icon icon-tabler icons-tabler-outline icon-tabler-settings">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path
                                                        d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z" />
                                                    <path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" />
                                                </svg>
                                            </span>
                                        </div>
                                        <div class="col">
                                            <div class="font-weight-medium">
                                                Barang di Servis
                                            </div>
                                            <div class="text-secondary">
                                                {{-- {{ $countServis }} item --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if (Auth::user()->role === 'own' || Auth::user()->role === 'pur' || Auth::user()->role === 'kng')
                        <div class="row row-deck row-cards mt-1">
                            <div class="col-sm-12 col-lg-6">
                                <div class="card bg-blue-lt" style="height: 28rem">
                                    <div class="card-header border-0">
                                        <div class="card-title"><i class="fa-solid fa-file-signature"></i> Permintaan
                                            ({{ $qtyPermintaan }} Item) penarikan dari tanggal
                                            {{ now()->subMonths(24)->format('d/m/Y') }}
                                        </div>
                                    </div>
                                    <div class="card-body card-body-scrollable card-body-scrollable-shadow">
                                        <div class="divide-y">
                                            <?php $i = 1; ?>
                                            @foreach ($permintaan as $item)
                                                <div>
                                                    <div class="row">
                                                        <div class="col-auto">
                                                            <span class="avatar">{{ $i }}</span>
                                                        </div>
                                                        <div class="col">
                                                            <div class="text-truncate">
                                                                <strong>{{ '(' . $item->kodeseri . ') ' . strtoupper($item->namaBarang) }}</strong>
                                                                <strong>{{ strtoupper($item->keterangan) . ' ' . strtoupper($item->katalog) . ' ' . strtoupper($item->part) }}</strong>.
                                                            </div>
                                                            <div class="text-secondary">
                                                                <i class="fa-solid fa-circle-info"
                                                                    style="margin-right: 3px"></i>
                                                                {{ Str::title($item->status) }}
                                                                <i class="fa-solid fa-calendar-days"
                                                                    style="margin-left: 10px;margin-right: 3px"></i>
                                                                {{ \Carbon\Carbon::parse($item->tgl)->isoFormat('D MMMM Y') }}
                                                                <i class="fa-solid fa-circle-right"
                                                                    style="margin-left: 10px;margin-right: 3px"></i>
                                                                {{ \Carbon\Carbon::parse($item->tgl)->diffForHumans() }}
                                                            </div>
                                                        </div>
                                                        <div class="col-auto align-self-center">
                                                            <div class="badge bg-primary"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php $i++; ?>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="card-footer border-0 bg-blue-lt">
                                        <div>
                                            <div class="row">
                                                <div class="col">
                                                    <div class="text-truncate" style="text-align: right;">
                                                        <form action="{{ url('existingPermintaan') }}" method="post">
                                                            @csrf
                                                            <input type="hidden" name="item" value="ALL">
                                                            <button type="submit" class="btn btn-sm bg-blue-lt border-0">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="24" viewBox="0 0 24 24" fill="none"
                                                                    stroke="currentColor" stroke-width="2"
                                                                    stroke-linecap="round" stroke-linejoin="round"
                                                                    class="icon icon-tabler icons-tabler-outline icon-tabler-download">
                                                                    <path stroke="none" d="M0 0h24v24H0z"
                                                                        fill="none" />
                                                                    <path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2" />
                                                                    <path d="M7 11l5 5l5 -5" />
                                                                    <path d="M12 4l0 12" />
                                                                </svg>
                                                                Unduh Selengkapnya
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-lg-6">
                                <div class="card bg-green-lt" style="height: 28rem">
                                    <div class="card-header border-0">
                                        <div class="card-title">
                                            <i class="fa-solid fa-cart-shopping"></i>
                                            Hanya Pembelian
                                            ({{ $qtyPembelian }} Item) penarikan dari tanggal
                                            {{ now()->subMonths(24)->format('d/m/Y') }}
                                        </div>
                                    </div>
                                    <div class="card-body card-body-scrollable card-body-scrollable-shadow">
                                        <div class="divide-y">
                                            <?php $j = 1; ?>
                                            @foreach ($pembelian as $item)
                                                <div>
                                                    <div class="row">
                                                        <div class="col-auto">
                                                            <span class="avatar">{{ $j }}</span>
                                                        </div>
                                                        <div class="col">
                                                            <div class="text-truncate">
                                                                <strong>{{ '(' . $item->kodeseri . ') ' . strtoupper($item->namaBarang) }}</strong>
                                                                <strong>{{ strtoupper($item->keterangan) . ' ' . strtoupper($item->katalog) . ' ' . strtoupper($item->part) }}</strong>.
                                                            </div>
                                                            <div class="text-secondary">
                                                                <i class="fa-solid fa-circle-info"
                                                                    style="margin-right: 3px"></i>
                                                                {{ Str::title($item->status) }}
                                                                <i class="fa-solid fa-calendar-days"
                                                                    style="margin-left: 10px;margin-right: 3px"></i>
                                                                {{ \Carbon\Carbon::parse($item->tgl)->isoFormat('D MMMM Y') }}
                                                                <i class="fa-solid fa-circle-right"
                                                                    style="margin-left: 10px;margin-right: 3px"></i>
                                                                {{ \Carbon\Carbon::parse($item->tgl)->diffForHumans() }}
                                                            </div>
                                                        </div>
                                                        <div class="col-auto align-self-center">
                                                            <div class="badge bg-primary"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php $j++; ?>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="card-footer border-0 bg-green-lt">
                                        <div>
                                            <div class="row">
                                                <div class="col">
                                                    <div class="text-truncate" style="text-align: right;">
                                                        <form action="{{ url('existingPermintaan') }}" method="post">
                                                            @csrf
                                                            <input type="hidden" name="item"
                                                                value="PROSES PEMBELIAN">
                                                            <button type="submit"
                                                                class="btn btn-sm bg-green-lt border-0">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="24" viewBox="0 0 24 24" fill="none"
                                                                    stroke="currentColor" stroke-width="2"
                                                                    stroke-linecap="round" stroke-linejoin="round"
                                                                    class="icon icon-tabler icons-tabler-outline icon-tabler-download">
                                                                    <path stroke="none" d="M0 0h24v24H0z"
                                                                        fill="none" />
                                                                    <path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2" />
                                                                    <path d="M7 11l5 5l5 -5" />
                                                                    <path d="M12 4l0 12" />
                                                                </svg>
                                                                Unduh Selengkapnya
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            @include('shared.footer')
        </div>
    </div>
@endsection
