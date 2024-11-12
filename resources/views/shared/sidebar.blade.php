<aside class="navbar navbar-vertical navbar-expand-lg" data-bs-theme="dark">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar-menu"
            aria-controls="sidebar-menu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <h1 class="navbar-brand navbar-brand-autodark" style="margin-top: 5px">
            <a href="{{ url('dashboard') }}" style="margin-right: 5px">
                <img src="{{ asset('assets/static/icon.png') }}" width="50px" alt="" srcset="">
            </a>
            <a href="{{ url('dashboard') }}">
                PRODUKSI
            </a>
        </h1>
        <div class="navbar-nav flex-row d-lg-none">
            <div class="nav-item d-none d-lg-flex me-3">
                <div class="btn-list">
                    <a href="https://github.com/tabler/tabler" class="btn" target="_blank" rel="noreferrer">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path
                                d="M9 19c-4.3 1.4 -4.3 -2.5 -6 -3m12 5v-3.5c0 -1 .1 -1.4 -.5 -2c2.8 -.3 5.5 -1.4 5.5 -6a4.6 4.6 0 0 0 -1.3 -3.2a4.2 4.2 0 0 0 -.1 -3.2s-1.1 -.3 -3.5 1.3a12.3 12.3 0 0 0 -6.2 0c-2.4 -1.6 -3.5 -1.3 -3.5 -1.3a4.2 4.2 0 0 0 -.1 3.2a4.6 4.6 0 0 0 -1.3 3.2c0 4.6 2.7 5.7 5.5 6c-.6 .6 -.6 1.2 -.5 2v3.5" />
                        </svg>
                        Source code
                    </a>
                    <a href="https://github.com/sponsors/codecalm" class="btn" target="_blank" rel="noreferrer">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon text-pink" width="24" height="24"
                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M19.5 12.572l-7.5 7.428l-7.5 -7.428a5 5 0 1 1 7.5 -6.566a5 5 0 1 1 7.5 6.572" />
                        </svg>
                        Sponsor
                    </a>
                </div>
            </div>
            <div class="d-none d-lg-flex">
                <a href="?theme=dark" class="nav-link px-0 hide-theme-dark" title="Enable dark mode"
                    data-bs-toggle="tooltip" data-bs-placement="bottom">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M12 3c.132 0 .263 0 .393 0a7.5 7.5 0 0 0 7.92 12.446a9 9 0 1 1 -8.313 -12.454z" />
                    </svg>
                </a>
                <a href="?theme=light" class="nav-link px-0 hide-theme-light" title="Enable light mode"
                    data-bs-toggle="tooltip" data-bs-placement="bottom">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M12 12m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                        <path
                            d="M3 12h1m8 -9v1m8 8h1m-9 8v1m-6.4 -15.4l.7 .7m12.1 -.7l-.7 .7m0 11.4l.7 .7m-12.1 -.7l-.7 .7" />
                    </svg>
                </a>
                <div class="nav-item dropdown d-none d-md-flex me-3">
                    <a href="#" class="nav-link px-0" data-bs-toggle="dropdown" tabindex="-1"
                        aria-label="Show notifications">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path
                                d="M10 5a2 2 0 1 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6" />
                            <path d="M9 17v1a3 3 0 0 0 6 0v-1" />
                        </svg>
                        <span class="badge bg-red"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-end dropdown-menu-card">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Last updates</h3>
                            </div>
                            <div class="list-group list-group-flush list-group-hoverable">
                                <div class="list-group-item">
                                    <div class="row align-items-center">
                                        <div class="col-auto"><span
                                                class="status-dot status-dot-animated bg-red d-block"></span></div>
                                        <div class="col text-truncate">
                                            <a href="#" class="text-body d-block">Example 1</a>
                                            <div class="d-block text-muted text-truncate mt-n1">
                                                Change deprecated html tags to text decoration classes (#29604)
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <a href="#" class="list-group-item-actions">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon text-muted"
                                                    width="24" height="24" viewBox="0 0 24 24"
                                                    stroke-width="2" stroke="currentColor" fill="none"
                                                    stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path
                                                        d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873z" />
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="list-group-item">
                                    <div class="row align-items-center">
                                        <div class="col-auto"><span class="status-dot d-block"></span></div>
                                        <div class="col text-truncate">
                                            <a href="#" class="text-body d-block">Example 2</a>
                                            <div class="d-block text-muted text-truncate mt-n1">
                                                justify-content:between ⇒ justify-content:space-between (#29734)
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <a href="#" class="list-group-item-actions show">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon text-yellow"
                                                    width="24" height="24" viewBox="0 0 24 24"
                                                    stroke-width="2" stroke="currentColor" fill="none"
                                                    stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path
                                                        d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873z" />
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="list-group-item">
                                    <div class="row align-items-center">
                                        <div class="col-auto"><span class="status-dot d-block"></span></div>
                                        <div class="col text-truncate">
                                            <a href="#" class="text-body d-block">Example 3</a>
                                            <div class="d-block text-muted text-truncate mt-n1">
                                                Update change-version.js (#29736)
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <a href="#" class="list-group-item-actions">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon text-muted"
                                                    width="24" height="24" viewBox="0 0 24 24"
                                                    stroke-width="2" stroke="currentColor" fill="none"
                                                    stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path
                                                        d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873z" />
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="list-group-item">
                                    <div class="row align-items-center">
                                        <div class="col-auto"><span
                                                class="status-dot status-dot-animated bg-green d-block"></span></div>
                                        <div class="col text-truncate">
                                            <a href="#" class="text-body d-block">Example 4</a>
                                            <div class="d-block text-muted text-truncate mt-n1">
                                                Regenerate package-lock.json (#29730)
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <a href="#" class="list-group-item-actions">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon text-muted"
                                                    width="24" height="24" viewBox="0 0 24 24"
                                                    stroke-width="2" stroke="currentColor" fill="none"
                                                    stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path
                                                        d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873z" />
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown"
                    aria-label="Open user menu">
                    <span class="avatar avatar-sm" style=""></span>
                    <div class="d-none d-xl-block ps-2">
                        <div>Paweł Kuna</div>
                        <div class="mt-1 small text-muted">UI Designer</div>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <a href="#" class="dropdown-item">Status</a>
                    <a href="./profile.html" class="dropdown-item">Profile</a>
                    <a href="#" class="dropdown-item">Feedback</a>
                    <div class="dropdown-divider"></div>
                    <a href="./settings.html" class="dropdown-item">Settings</a>
                    <a href="{{ route('logout') }}" class="dropdown-item">Logout</a>
                </div>
            </div>
        </div>
        <div class="collapse navbar-collapse" id="sidebar-menu">
            <ul class="navbar-nav pt-lg-3">
                <div class="d-sm-none">
                    <li class="nav-item">
                        @if (Auth::user()->role === 'super' || Auth::user()->role === 'own')
                            <form action="./" method="get" autocomplete="off" novalidate>
                                <div class="input-icon">
                                    <span class="input-icon-addon">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                            height="24" viewBox="0 0 24 24" stroke-width="2"
                                            stroke="currentColor" fill="none" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                                            <path d="M21 21l-6 -6" />
                                        </svg>
                                    </span>
                                    <select class="form-control searchengine" style="width: 100%"
                                        id="searchengine2"></select>
                                </div>
                            </form>
                        @endif
                    </li>
                </div>
                <li class="nav-item {{ $active == 'Dashboard' ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('dashboard') }}">
                        <span
                            class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M5 12l-2 0l9 -9l9 9l-2 0" />
                                <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                                <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
                            </svg>
                        </span>
                        <span class="nav-link-title">
                            Dashboard
                        </span>
                    </a>
                </li>
                {{-- @if (Auth::user()->p_pengadaan === 1) --}}
                <li
                    class="nav-item dropdown {{ $active == 'Tipe' || $active == 'Supplier' || $active == 'ProsesEmail' || $active == 'Pembelian' || $active == 'StatusBarang' ? 'active' : '' }}">
                    <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown"
                        data-bs-auto-close="false" role="button" aria-expanded="false">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-list-details">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M13 5h8" />
                                <path d="M13 9h5" />
                                <path d="M13 15h8" />
                                <path d="M13 19h5" />
                                <path
                                    d="M3 4m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                                <path
                                    d="M3 14m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                            </svg>
                        </span>
                        <span class="nav-link-title">
                            Daftar
                        </span>
                    </a>
                    <div
                        class="dropdown-menu {{ $active == 'Tipe' || $active == 'Supplier' || $active == 'ProsesEmail' || $active == 'Pembelian' || $active == 'StatusBarang' ? 'show' : '' }}">
                        <div class="dropdown-menu-columns">
                            <div class="dropdown-menu-column">
                                {{-- @if (Auth::user()->c_permintaan === 1) --}}
                                <a class="dropdown-item {{ $active == 'Tipe' ? 'active' : '' }}"
                                    href="{{ url('daftar/tipe') }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" style="margin-right: 5px" width="24"
                                        height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-box">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M12 3l8 4.5l0 9l-8 4.5l-8 -4.5l0 -9l8 -4.5" />
                                        <path d="M12 12l8 -4.5" />
                                        <path d="M12 12l0 9" />
                                        <path d="M12 12l-8 -4.5" />
                                    </svg>
                                    Tipe Packaging
                                </a>
                                {{-- @endif --}}
                                {{-- @if (Auth::user()->c_permintaan === 1) --}}
                                <a class="dropdown-item {{ $active == 'Supplier' ? 'active' : '' }}"
                                    href="{{ url('daftar/supplier') }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" style="margin-right: 5px" width="24"
                                        height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-users">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                                        <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                                        <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                                        <path d="M21 21v-2a4 4 0 0 0 -3 -3.85" />
                                    </svg>
                                    Person
                                </a>
                                {{-- @endif --}}
                                {{-- @if (Auth::user()->c_permintaan === 1)
                                <a class="dropdown-item {{ $active == 'Pengemudi' ? 'active' : '' }}"
                                    href="{{ url('daftar/driver') }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" style="margin-right: 5px" width="24"
                                        height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-user-pin">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                                        <path d="M6 21v-2a4 4 0 0 1 4 -4h2.5" />
                                        <path
                                            d="M21.121 20.121a3 3 0 1 0 -4.242 0c.418 .419 1.125 1.045 2.121 1.879c1.051 -.89 1.759 -1.516 2.121 -1.879z" />
                                        <path d="M19 18v.01" />
                                    </svg>
                                    Pengemudi
                                </a>
                                @endif --}}
                            </div>
                        </div>
                    </div>
                </li>
                {{-- @endif --}}
                {{-- @if (Auth::user()->p_pengadaan === 1) --}}
                <li
                    class="nav-item dropdown {{ $active == 'Suratkontrak' || $active == 'Persetujuan' || $active == 'ProsesEmail' || $active == 'Pembelian' || $active == 'StatusBarang' ? 'active' : '' }}">
                    <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown"
                        data-bs-auto-close="false" role="button" aria-expanded="false">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-license">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path
                                    d="M15 21h-9a3 3 0 0 1 -3 -3v-1h10v2a2 2 0 0 0 4 0v-14a2 2 0 1 1 2 2h-2m2 -4h-11a3 3 0 0 0 -3 3v11" />
                                <path d="M9 7l4 0" />
                                <path d="M9 11l4 0" />
                            </svg>
                        </span>
                        <span class="nav-link-title">
                            Kontrak
                        </span>
                    </a>
                    <div class="dropdown-menu {{ $active == 'Suratkontrak' ? 'show' : '' }}">
                        <div class="dropdown-menu-columns">
                            <div class="dropdown-menu-column">
                                {{-- @if (Auth::user()->c_permintaan === 1) --}}
                                <a class="dropdown-item {{ $active == 'Suratkontrak' ? 'active' : '' }}"
                                    href="{{ url('kontrak/suratkontrak') }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" style="margin-right: 5px"
                                        class="icon icon-tabler icon-tabler-clipboard-text" width="24"
                                        height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                        fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path
                                            d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2" />
                                        <path
                                            d="M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z" />
                                        <path d="M9 12h6" />
                                        <path d="M9 16h6" />
                                    </svg>
                                    Surat Kontrak
                                </a>
                                {{-- @endif --}}
                            </div>
                        </div>
                    </div>
                </li>
                {{-- @endif --}}
                {{-- @if (Auth::user()->p_pengadaan === 1) --}}
                <li
                    class="nav-item dropdown {{ $active == 'Penerimaan' || $active == 'Persetujuan' || $active == 'ProsesEmail' || $active == 'Pembelian' || $active == 'StatusBarang' ? 'active' : '' }}">
                    <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown"
                        data-bs-auto-close="false" role="button" aria-expanded="false">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-building-warehouse">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M3 21v-13l9 -4l9 4v13" />
                                <path d="M13 13h4v8h-10v-6h6" />
                                <path d="M13 21v-9a1 1 0 0 0 -1 -1h-2a1 1 0 0 0 -1 1v3" />
                            </svg>
                        </span>
                        <span class="nav-link-title">
                            Gudang
                        </span>
                    </a>
                    <div
                        class="dropdown-menu {{ $active == 'Penerimaan' || $active == 'Pengolahan' || $active == 'Scanner' ? 'show' : '' }}">
                        <div class="dropdown-menu-columns">
                            <div class="dropdown-menu-column">
                                {{-- @if (Auth::user()->c_permintaan === 1) --}}
                                <a class="dropdown-item {{ $active == 'Penerimaan' ? 'active' : '' }}"
                                    href="{{ url('gudang/penerimaan') }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" style="margin-right: 5px" width="24"
                                        height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-truck">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M7 17m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                        <path d="M17 17m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                        <path d="M5 17h-2v-11a1 1 0 0 1 1 -1h9v12m-4 0h6m4 0h2v-6h-8m0 -5h5l3 5" />
                                    </svg>
                                    Penerimaan
                                </a>
                                {{-- @endif --}}
                                {{-- @if (Auth::user()->c_permintaan === 1) --}}
                                <a class="dropdown-item {{ $active == 'Pengolahan' ? 'active' : '' }}"
                                    href="{{ url('gudang/Pengolahan') }}">
                                    <svg style="margin-right: 5px" xmlns="http://www.w3.org/2000/svg" width="24"
                                        height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-recycle">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M12 17l-2 2l2 2" />
                                        <path d="M10 19h9a2 2 0 0 0 1.75 -2.75l-.55 -1" />
                                        <path d="M8.536 11l-.732 -2.732l-2.732 .732" />
                                        <path d="M7.804 8.268l-4.5 7.794a2 2 0 0 0 1.506 2.89l1.141 .024" />
                                        <path d="M15.464 11l2.732 .732l.732 -2.732" />
                                        <path d="M18.196 11.732l-4.5 -7.794a2 2 0 0 0 -3.256 -.14l-.591 .976" />
                                    </svg>
                                    Pengolahan BB
                                </a>
                                {{-- @endif --}}
                                <a class="dropdown-item {{ $active == 'Scanner' ? 'active' : '' }}"
                                    href="{{ url('gudang/scanner') }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" style="margin-right: 5px" width="24"
                                        height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
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
                                    Scan Barcode
                                </a>
                            </div>
                        </div>
                    </div>
                </li>
                {{-- @endif --}}
                {{-- @if (Auth::user()->p_pengadaan === 1) --}}
                <li
                    class="nav-item dropdown {{ $active == 'QC' || $active == 'Persetujuan' || $active == 'ProsesEmail' || $active == 'Pembelian' || $active == 'StatusBarang' ? 'active' : '' }}">
                    <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown"
                        data-bs-auto-close="false" role="button" aria-expanded="false">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-building-factory">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M4 21c1.147 -4.02 1.983 -8.027 2 -12h6c.017 3.973 .853 7.98 2 12" />
                                <path d="M12.5 13h4.5c.025 2.612 .894 5.296 2 8" />
                                <path
                                    d="M9 5a2.4 2.4 0 0 1 2 -1a2.4 2.4 0 0 1 2 1a2.4 2.4 0 0 0 2 1a2.4 2.4 0 0 0 2 -1a2.4 2.4 0 0 1 2 -1a2.4 2.4 0 0 1 2 1" />
                                <path d="M3 21l19 0" />
                            </svg>
                        </span>
                        <span class="nav-link-title">
                            Produksi
                        </span>
                    </a>
                    <div
                        class="dropdown-menu {{ $active == 'QC' || $active == 'Persetujuan' || $active == 'ProsesEmail' || $active == 'Pembelian' || $active == 'StatusBarang' ? 'show' : '' }}">
                        <div class="dropdown-menu-columns">
                            <div class="dropdown-menu-column">
                                {{-- @if (Auth::user()->c_persetujuan === 1) --}}
                                <a class="dropdown-item" href="{{ url('pengadaan/persetujuan') }}"
                                    {{ $active == 'Persetujuan' ? 'active' : '' }}>
                                    <svg xmlns="http://www.w3.org/2000/svg" style="margin-right: 5px" width="24"
                                        height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-apps">
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
                                    Pengebonan
                                </a>
                                {{-- @endif --}}
                                {{-- @if (Auth::user()->c_permintaan === 1) --}}
                                <a class="dropdown-item {{ $active == 'QC' ? 'active' : '' }}"
                                    href="{{ url('pengadaan/permintaan') }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" style="margin-right: 5px" width="24"
                                        height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-test-pipe">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path
                                            d="M20 8.04l-12.122 12.124a2.857 2.857 0 1 1 -4.041 -4.04l12.122 -12.124" />
                                        <path d="M7 13h8" />
                                        <path d="M19 15l1.5 1.6a2 2 0 1 1 -3 0l1.5 -1.6z" />
                                        <path d="M15 3l6 6" />
                                    </svg>
                                    Quality Control
                                </a>
                                {{-- @endif --}}
                            </div>
                        </div>
                    </div>
                </li>
                {{-- @endif --}}
                {{-- @if (Auth::user()->p_pengadaan === 1) --}}
                <li
                    class="nav-item dropdown {{ $active == 'Permintaan' || $active == 'Persetujuan' || $active == 'ProsesEmail' || $active == 'Pembelian' || $active == 'StatusBarang' ? 'active' : '' }}">
                    <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown"
                        data-bs-auto-close="false" role="button" aria-expanded="false">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-chart-infographic">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M7 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                                <path d="M7 3v4h4" />
                                <path d="M9 17l0 4" />
                                <path d="M17 14l0 7" />
                                <path d="M13 13l0 8" />
                                <path d="M21 12l0 9" />
                            </svg>
                        </span>
                        <span class="nav-link-title">
                            Laporan
                        </span>
                    </a>
                    <div
                        class="dropdown-menu {{ $active == 'Permintaan' || $active == 'Persetujuan' || $active == 'ProsesEmail' || $active == 'Pembelian' || $active == 'StatusBarang' ? 'show' : '' }}">
                        <div class="dropdown-menu-columns">
                            <div class="dropdown-menu-column">
                                @if (Auth::user()->c_permintaan === 1)
                                    <a class="dropdown-item {{ $active == 'Permintaan' ? 'active' : '' }}"
                                        href="{{ url('pengadaan/permintaan') }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" style="margin-right: 10px"
                                            class="icon icon-tabler icon-tabler-clipboard-text" width="24"
                                            height="24" viewBox="0 0 24 24" stroke-width="1.5"
                                            stroke="currentColor" fill="none" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path
                                                d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2" />
                                            <path
                                                d="M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z" />
                                            <path d="M9 12h6" />
                                            <path d="M9 16h6" />
                                        </svg>
                                        Permintaan
                                    </a>
                                @endif
                                @if (Auth::user()->c_persetujuan === 1)
                                    <a class="dropdown-item" href="{{ url('pengadaan/persetujuan') }}"
                                        {{ $active == 'Persetujuan' ? 'active' : '' }}>
                                        <svg xmlns="http://www.w3.org/2000/svg" style="margin-right: 10px"
                                            class="icon icon-tabler icon-tabler-heart-handshake" width="24"
                                            height="24" viewBox="0 0 24 24" stroke-width="1.5"
                                            stroke="currentColor" fill="none" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path
                                                d="M19.5 12.572l-7.5 7.428l-7.5 -7.428a5 5 0 1 1 7.5 -6.566a5 5 0 1 1 7.5 6.572" />
                                            <path
                                                d="M12 6l-3.293 3.293a1 1 0 0 0 0 1.414l.543 .543c.69 .69 1.81 .69 2.5 0l1 -1a3.182 3.182 0 0 1 4.5 0l2.25 2.25" />
                                            <path d="M12.5 15.5l2 2" />
                                            <path d="M15 13l2 2" />
                                        </svg>
                                        Persetujuan
                                    </a>
                                @endif
                                @if (Auth::user()->c_email === 1)
                                    <a class="dropdown-item" href="{{ url('pengadaan/email') }}"
                                        {{ $active == 'ProsesEmail' ? 'active' : '' }}>
                                        <svg xmlns="http://www.w3.org/2000/svg" style="margin-right: 10px"
                                            class="icon icon-tabler icon-tabler-mail" width="24" height="24"
                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path
                                                d="M3 7a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-10z" />
                                            <path d="M3 7l9 6l9 -6" />
                                        </svg>
                                        Proses Email
                                    </a>
                                @endif
                                @if (Auth::user()->c_pembelian === 1)
                                    <a class="dropdown-item" href="{{ url('pengadaan/pembelian') }}"
                                        {{ $active == 'Pembelian' ? 'active' : '' }}>
                                        <svg xmlns="http://www.w3.org/2000/svg" style="margin-right: 10px"
                                            width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-shopping-cart">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M6 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                            <path d="M17 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                            <path d="M17 17h-11v-14h-2" />
                                            <path d="M6 5l14 1l-1 7h-13" />
                                        </svg>
                                        Pembelian
                                    </a>
                                @endif
                                @if (Auth::user()->c_status === 1)
                                    <a class="dropdown-item" href="{{ url('pengadaan/status_barang') }}"
                                        {{ $active == 'StatusBarang' ? 'active' : '' }}>
                                        <svg xmlns="http://www.w3.org/2000/svg" style="margin-right: 10px"
                                            class="icon icon-tabler icon-tabler-git-pull-request-draft" width="24"
                                            height="24" viewBox="0 0 24 24" stroke-width="1.5"
                                            stroke="currentColor" fill="none" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M6 18m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                            <path d="M6 6m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                            <path d="M18 18m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                            <path d="M6 8v8" />
                                            <path d="M18 11h.01" />
                                            <path d="M18 6h.01" />
                                        </svg>
                                        Status Barang
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </li>
                {{-- @endif --}}
                {{-- @if (Auth::user()->p_pengadaan === 1) --}}
                <li class="nav-item dropdown {{ $active == 'Pengguna' || $active == 'Log' ? 'active' : '' }}">
                    <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown"
                        data-bs-auto-close="false" role="button" aria-expanded="false">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-settings">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path
                                    d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z" />
                                <path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" />
                            </svg>
                        </span>
                        <span class="nav-link-title">
                            Settings
                        </span>
                    </a>
                    <div class="dropdown-menu {{ $active == 'Pengguna' || $active == 'Log' ? 'show' : '' }}">
                        <div class="dropdown-menu-columns">
                            <div class="dropdown-menu-column">
                                {{-- @if (Auth::user()->c_permintaan === 1) --}}
                                <a class="dropdown-item {{ $active == 'Pengguna' ? 'active' : '' }}"
                                    href="{{ url('settings/pengguna') }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" style="margin-right: 5px" width="24"
                                        height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-users-group">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M10 13a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                        <path d="M8 21v-1a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v1" />
                                        <path d="M15 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                        <path d="M17 10h2a2 2 0 0 1 2 2v1" />
                                        <path d="M5 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                        <path d="M3 13v-1a2 2 0 0 1 2 -2h2" />
                                    </svg>
                                    Pengguna
                                </a>
                                <a class="dropdown-item {{ $active == 'Log' ? 'active' : '' }}"
                                    href="{{ url('settings/logActivity') }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" style="margin-right: 5px" width="24"
                                        height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-activity">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M3 12h4l3 8l4 -16l3 8h4" />
                                    </svg>
                                    Log Activity
                                </a>
                            </div>
                        </div>
                    </div>
                    <div
                        class="dropdown-menu {{ $active == 'Permintaan' || $active == 'Persetujuan' || $active == 'ProsesEmail' || $active == 'Pembelian' || $active == 'StatusBarang' ? 'show' : '' }}">
                        <div class="dropdown-menu-columns">
                            <div class="dropdown-menu-column">
                                @if (Auth::user()->c_permintaan === 1)
                                    <a class="dropdown-item {{ $active == 'Permintaan' ? 'active' : '' }}"
                                        href="{{ url('pengadaan/permintaan') }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" style="margin-right: 10px"
                                            class="icon icon-tabler icon-tabler-clipboard-text" width="24"
                                            height="24" viewBox="0 0 24 24" stroke-width="1.5"
                                            stroke="currentColor" fill="none" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path
                                                d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2" />
                                            <path
                                                d="M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z" />
                                            <path d="M9 12h6" />
                                            <path d="M9 16h6" />
                                        </svg>
                                        Permintaan
                                    </a>
                                @endif
                                @if (Auth::user()->c_persetujuan === 1)
                                    <a class="dropdown-item" href="{{ url('pengadaan/persetujuan') }}"
                                        {{ $active == 'Persetujuan' ? 'active' : '' }}>
                                        <svg xmlns="http://www.w3.org/2000/svg" style="margin-right: 10px"
                                            class="icon icon-tabler icon-tabler-heart-handshake" width="24"
                                            height="24" viewBox="0 0 24 24" stroke-width="1.5"
                                            stroke="currentColor" fill="none" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path
                                                d="M19.5 12.572l-7.5 7.428l-7.5 -7.428a5 5 0 1 1 7.5 -6.566a5 5 0 1 1 7.5 6.572" />
                                            <path
                                                d="M12 6l-3.293 3.293a1 1 0 0 0 0 1.414l.543 .543c.69 .69 1.81 .69 2.5 0l1 -1a3.182 3.182 0 0 1 4.5 0l2.25 2.25" />
                                            <path d="M12.5 15.5l2 2" />
                                            <path d="M15 13l2 2" />
                                        </svg>
                                        Persetujuan
                                    </a>
                                @endif
                                @if (Auth::user()->c_email === 1)
                                    <a class="dropdown-item" href="{{ url('pengadaan/email') }}"
                                        {{ $active == 'ProsesEmail' ? 'active' : '' }}>
                                        <svg xmlns="http://www.w3.org/2000/svg" style="margin-right: 10px"
                                            class="icon icon-tabler icon-tabler-mail" width="24" height="24"
                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path
                                                d="M3 7a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-10z" />
                                            <path d="M3 7l9 6l9 -6" />
                                        </svg>
                                        Proses Email
                                    </a>
                                @endif
                                @if (Auth::user()->c_pembelian === 1)
                                    <a class="dropdown-item" href="{{ url('pengadaan/pembelian') }}"
                                        {{ $active == 'Pembelian' ? 'active' : '' }}>
                                        <svg xmlns="http://www.w3.org/2000/svg" style="margin-right: 10px"
                                            width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-shopping-cart">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M6 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                            <path d="M17 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                            <path d="M17 17h-11v-14h-2" />
                                            <path d="M6 5l14 1l-1 7h-13" />
                                        </svg>
                                        Pembelian
                                    </a>
                                @endif
                                @if (Auth::user()->c_status === 1)
                                    <a class="dropdown-item" href="{{ url('pengadaan/status_barang') }}"
                                        {{ $active == 'StatusBarang' ? 'active' : '' }}>
                                        <svg xmlns="http://www.w3.org/2000/svg" style="margin-right: 10px"
                                            class="icon icon-tabler icon-tabler-git-pull-request-draft" width="24"
                                            height="24" viewBox="0 0 24 24" stroke-width="1.5"
                                            stroke="currentColor" fill="none" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M6 18m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                            <path d="M6 6m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                            <path d="M18 18m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                            <path d="M6 8v8" />
                                            <path d="M18 11h.01" />
                                            <path d="M18 6h.01" />
                                        </svg>
                                        Status Barang
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </li>
                {{-- @endif --}}
            </ul>
        </div>
    </div>
</aside>
