@extends('layouts.app')
@section('content')
    <style>
        .card-sponsor {
            position: relative;
            overflow: hidden;
            width: 100%;
            /* Lebar penuh kolom */
            height: 60px;
            /* Tinggi lebih pendek */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
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
            /* Efek zoom saat hover */
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
                            <div class="card bg-100 shadow-none border">
                                <div class="row gx-0 flex-between-center">
                                    <!-- Bagian Kiri -->
                                    <div class="col-sm-9 d-flex align-items-center">
                                        <img class="ms-n2" src="{{ asset('assets/static/crm-bar-chart.png') }}"
                                            alt="" width="100" />
                                        <div>
                                            <h5 class="text-primary fs--1 mb-0">Welcome to E-Produksi Online
                                                <strong>{{ Auth::user()->name }} 🎉</strong>
                                            </h5>
                                            <h4 class="text-primary fw-bold mb-0">
                                                <span class="text-info fw-medium">
                                                    Aplikasi Produksi ini adalah aplikasi untuk Kedatangan barang sampai
                                                    dengan
                                                    identifikasi Produk di PT.
                                                    Tantra Fiber Industry.</b>
                                                </span>
                                            </h4>
                                        </div>

                                    </div>

                                    <!-- Bagian Kanan -->
                                    <div class="col-md-3 p-4">
                                        <img class="ms-n4 d-md-none d-lg-block"
                                            src="{{ asset('assets/static/crm-line-chart.png') }}" alt=""
                                            width="150" />
                                    </div>
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

                        <div class="col-md-6 col-xl-3">
                            <a class="card card-link" href="{{ url()->current() }}">
                                <div class="card-cover card-cover-blurred text-center"
                                    style="background-image: url(photo/icon/tantra.png)">
                                    <?php
                                    $role = Auth::user()->role;
                                    $username = Auth::user()->username;
                                    
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
                                    <span class="avatar avatar-xl avatar-thumb rounded"
                                        style="background-image: url(<?php echo $avatarUrl; ?>)"></span>
                                </div>
                                <div class="card-body text-center">
                                    <div class="card-title mb-1">{{ strtoupper(Auth::user()->username) }}</div>
                                    <div class="text-primary">
                                        {{ \Carbon\Carbon::parse(Auth::user()->created_at)->format('d M Y H:i') }}
                                        WIB</div>
                                </div>
                            </a>
                        </div>
                        {{-- <div class="col-lg-6">
                            <div class="card bg-primary text-primary-fg">
                                <div class="card-stamp">
                                    <div class="card-stamp-icon bg-white text-primary">
                                        <!-- Download SVG icon from http://tabler-icons.io/i/star -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path
                                                d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873z" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="row row-0">
                                    <div class="col-5">
                                        <?php
                                        $role = Auth::user()->role;
                                        $username = Auth::user()->username;
                                        
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
                                        <img src="<?php echo $avatarUrl; ?>" class="w-100 h-100 object-cover card-img-start"
                                            alt="Beautiful blonde woman relaxing with a can of coke on a tree stump by the beach" />
                                    </div>
                                    <div class="col">
                                        <div class="card-body">
                                            <table style="width: 100%; border: none;">
                                                <tr>
                                                    <td style="text-align: center; padding: 5px 0;" colspan="2">PT.
                                                        Tantra Fiber Industry</td>
                                                </tr>
                                                <tr class="md-5">
                                                    <td style="padding: 5px 0;"><strong>Login As:</strong></td>
                                                    <td style="padding: 5px 0;">{{ strtoupper(Auth::user()->role) }}</td>
                                                </tr>
                                                <tr>
                                                    <td style="padding: 5px 0;"><strong>Joined:</strong></td>
                                                    <td style="padding: 5px 0;">
                                                        {{ \Carbon\Carbon::parse(Auth::user()->created_at)->format('d M Y H:i') }}
                                                        WIB
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="padding: 5px 0;"><strong>Nickname:</strong></td>
                                                    <td style="padding: 5px 0;">{{ strtoupper(Auth::user()->nickname) }}
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div> --}}

                        <div class="col-sm-6 col-md-9">
                            <div class="card h-md-100">
                                <div class="card-header d-flex align-items-center justify-content-between pb-0">
                                    <h4><i class="fa-solid fa-location-dot" style="color: red"></i> Weather</h4>
                                    <div class="dropdown font-sans-serif btn-reveal-trigger ms-auto">
                                        <button
                                            class="btn btn-link text-600 btn-sm dropdown-toggle dropdown-caret-none btn-reveal"
                                            type="button" id="dropdown-weather-update" data-bs-toggle="dropdown"
                                            data-boundary="viewport" aria-haspopup="true" aria-expanded="false">
                                            <span class="fas fa-ellipsis-h fs--2"></span>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end border py-2"
                                            aria-labelledby="dropdown-weather-update">
                                            <a class="dropdown-item text-primary" href="{{ url()->current() }}"><i
                                                    class="fas fa-sync fs--1"></i><span class="ms-1">Reload</span></a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item text-warning"><strong>Informasi Cuaca</strong></a>
                                            <a class="dropdown-item"><strong>Pressure:</strong>
                                                {{ $weatherData['main']['pressure'] ?? 'N/A' }} hPa</a>
                                            <a class="dropdown-item"><strong>Humidity:</strong>
                                                {{ $weatherData['main']['humidity'] ?? 'N/A' }}%</a>
                                            <a class="dropdown-item"><strong>Wind:</strong>
                                                {{ $weatherData['wind']['speed'] ?? 'N/A' }}
                                                m/s,
                                                {{ $weatherData['wind']['deg'] ?? 'N/A' }}°</a>
                                            <a class="dropdown-item"><strong>Cloudiness:</strong>
                                                {{ $weatherData['clouds']['all'] ?? 'N/A' }}%</a>
                                            <a class="dropdown-item"><strong>Visibility:</strong>
                                                {{ $weatherData['visibility'] ?? 'N/A' }}
                                                m</a>
                                            <a class="dropdown-item"><strong>Sunrise:</strong>
                                                {{ isset($weatherData['sys']['sunrise']) ? date('H:i:s', $weatherData['sys']['sunrise']) : 'N/A' }}
                                                WIB</a>
                                            <a class="dropdown-item"><strong>Sunset:</strong>
                                                {{ isset($weatherData['sys']['sunset']) ? date('H:i:s', $weatherData['sys']['sunset']) : 'N/A' }}
                                                WIB</a>
                                            <a class="dropdown-item text-warning"><strong>Informasi Lokasi</strong></a>
                                            <a class="dropdown-item"
                                                style="white-space: normal; word-wrap: break-word; max-width: 200px; font-size: 10px;">
                                                {{ $weatherData['display_name'] ?? 'Unknown' }}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body pt-2">
                                    <div class="row g-0 h-100 align-items-center">
                                        <div class="col">
                                            <div class="d-flex align-items-center">
                                                {{-- @php
                                                    $temperature = $weatherData['temperature'] ?? null;
                                                    $iconPath = 'assets/static/weather-icon.png';

                                                    if ($temperature !== null) {
                                                        if ($temperature > 30) {
                                                            $iconPath = 'assets/static/weather-icon.png';
                                                        } elseif ($temperature > 20) {
                                                            $iconPath = 'assets/static/weather.jpg';
                                                        } else {
                                                            $iconPath = 'assets/static/weather-icon-cold.png';
                                                        }
                                                    }
                                                @endphp --}}
                                                @php
                                                    $temperature = $weatherData['main']['temp'] ?? null;
                                                    $weatherCondition = $weatherData['weather'][0]['main'] ?? 'Clear';
                                                    $currentTime = date('H');
                                                    $iconClass = 'fas fa-sun';

                                                    if ($temperature !== null) {
                                                        if ($temperature > 30) {
                                                            $iconClass = 'fas fa-thermometer-full';
                                                        } elseif ($temperature > 20) {
                                                            $iconClass = 'fas fa-thermometer-half';
                                                        } else {
                                                            $iconClass = 'fas fa-thermometer-quarter';
                                                        }
                                                    }

                                                    switch ($weatherCondition) {
                                                        case 'Rain':
                                                            $iconClass = 'assets/static/shower.png';
                                                            break;
                                                        case 'Clouds':
                                                            $iconClass = 'assets/static/weather.png';
                                                            break;
                                                        case 'Clear':
                                                            if ($currentTime >= 6 && $currentTime < 18) {
                                                                $iconClass = 'assets/static/weather-icon.png';
                                                            } else {
                                                                $iconClass = 'assets/static/moon.png';
                                                            }
                                                            break;
                                                        case 'Snow':
                                                            $iconClass = 'assets/static/snowflake.png';
                                                            break;
                                                        default:
                                                            $iconClass = 'assets/static/weather.png';
                                                            break;
                                                    }
                                                @endphp
                                                <img class="me-3" src="{{ asset($iconClass) }}" alt=""
                                                    height="50" />
                                                <div>
                                                    <h6 class="mb-2" style="font-size: 12px;">
                                                        {{ isset($locationData['suburb'], $locationData['city_district']) &&
                                                        $locationData['suburb'] &&
                                                        $locationData['city_district']
                                                            ? $locationData['suburb'] . ' - ' . $locationData['city_district']
                                                            : ($weatherData['display_name']
                                                                ? collect(explode(',', $weatherData['display_name']))->slice(2, 2)->implode(', ')
                                                                : $weatherData['city'] ?? 'Unknown') }}

                                                    </h6>
                                                    <div class="fs--2 fw-semi-bold">
                                                        <div class="text-warning">
                                                            {{ isset($weatherData['weather'][0]['main']) ? ucfirst($weatherData['weather'][0]['main']) : 'N/A' }}
                                                        </div>
                                                        Precipitation:
                                                        {{ $weatherData['weather'][0]['description'] ?? 'N/A' }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto text-center ps-2">
                                            <div class="fs-4 fw-normal font-sans-serif text-primary mb-1 lh-1">
                                                {{ isset($weatherData['main']['temp']) ? round($weatherData['main']['temp'], 2) . '°C' : 'N/A' }}
                                            </div>
                                            <div class="fs--1 text-800">
                                                {{ isset($weatherData['main']['temp_max']) ? round($weatherData['main']['temp_max'], 2) . '°C' : 'N/A' }}&deg;
                                                /
                                                {{ isset($weatherData['main']['temp_min']) ? round($weatherData['main']['temp_min'], 2) . '°C' : 'N/A' }}&deg;
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Welcome Card -->
                        {{-- <div class="col-md-6 col-lg-12">
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
                        </div> --}}
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

                        <!-- Activity Log -->
                        {{-- <div class="col-lg-5">
                            <div class="row g-3">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h6 class="mb-0">Activity Logs <a href="{{ url('settings/logActivity') }}"
                                                    class="ms-1 me-1 text-primary">View All</a type="button"></h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="row g-3">
                                                <div class="col">
                                                    <h4 class="text-primary fw-normal">
                                                        {{ \App\Models\ActivityLog::where('created_at', '>=', now()->subDays(1))->count() }}
                                                        Data Activity Hari Ini</h4>
                                                    <p class="fs--2 fw-semi-bold text-500 mb-0">
                                                        {{ \App\Models\ActivityLog::count() }}
                                                        data activity keseluruhan</p>
                                                </div>
                                                <div class="col-auto pe-0 text-end">
                                                    <div class="echart-call-duration" data-echart-responsive="true"
                                                        data-echarts='{"series":[{"type":"line","data":[8,15,12,14,18,12,12,25,13,12,10,13,35],"color":"#f5803e","areaStyle":{"color":{"colorStops":[{"offset":0,"color":"#f5803e3A"},{"offset":1,"color":"#f5803e0A"}]}}}],"grid":{"bottom":"-10px","right":"0px"}}'>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="card h-100">
                                        <div class="card-header">
                                            <h6 class="mb-0">{{ \App\Models\ActivityLog::count() }} Recent Activity</h6>
                                        </div>
                                        <div class="card-body scrollbar recent-activity-body-height ps-2">

                                            @foreach ($activity as $key => $logs)
                                                <div class="row g-3 timeline timeline-primary timeline-past pb-card">
                                                    <div class="col-auto ps-4 ms-2">
                                                        <div class="ps-2">
                                                            <div
                                                                class="icon-item icon-item-sm rounded-circle bg-200 shadow-none">
                                                                <span class="text-primary fas fa-code-branch"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="row gx-0 border-bottom pb-card">
                                                            <div class="col">
                                                                <h6 class="text-800 mb-1">{{ $logs->nickname }} -
                                                                    {{ $logs->username }}</h6>
                                                                <p class="fs--1 text-600 mb-0">IP Address :
                                                                    {{ $logs->ip_address }}</p>
                                                                <p class="fs--1 text-600 mb-0">Akses Page :
                                                                    {{ $logs->description }}</p>
                                                                <p class="fs--1 text-600 mb-0">Method :
                                                                    {{ $logs->action }}</p>
                                                                <p class="fs--1 text-600 mb-0">Status :
                                                                    {{ $logs->status_code }}
                                                                    ({{ $logs->status_description }})
                                                                </p>
                                                            </div>
                                                            <div class="col-auto">
                                                                <p class="fs--2 text-500 mb-0">
                                                                    {{ \Carbon\Carbon::parse($logs->updated_at)->diffForHumans() }}
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach

                                        </div>
                                        <div class="card-footer bg-light p-0"><a
                                                class="btn btn-sm btn-link d-block w-100 py-2"
                                                href="{{ url('settings/logActivity') }}">All Activity<span
                                                    class="fas fa-chevron-right ms-1 fs--2"></span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
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
            <script>
                function getLocation() {
                    if (navigator.geolocation) {
                        navigator.geolocation.getCurrentPosition(sendLocationToServer);
                    } else {
                        console.log("Geolocation is not supported by this browser.");
                    }
                }

                function sendLocationToServer(position) {
                    const latitude = position.coords.latitude;
                    const longitude = position.coords.longitude;

                    fetch('/update-location', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({
                            latitude,
                            longitude
                        })
                    })
                    // .then(response => response.json())
                    // .then(data => {
                    //     console.log('Success:', data);
                    // })
                    // .catch(error => {
                    //     console.error('Error:', error);
                    // });
                }

                document.addEventListener('DOMContentLoaded', getLocation);

                function updateTime() {
                    const now = new Date();

                    const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
                    const months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September',
                        'Oktober', 'November', 'Desember'
                    ];

                    const dayName = days[now.getDay()];
                    const day = now.getDate();
                    const month = months[now.getMonth()];
                    const year = now.getFullYear();
                    const hour = String(now.getHours()).padStart(2, '0');
                    const minute = String(now.getMinutes()).padStart(2, '0');
                    const second = String(now.getSeconds()).padStart(2, '0');

                    const formattedTime = `${dayName}, ${day} ${month} ${year}`;
                    document.getElementById('CRMDateRange').value = formattedTime;
                }

                setInterval(updateTime, 1000);

                updateTime();
            </script>

        </div>
    </div>
@endsection
