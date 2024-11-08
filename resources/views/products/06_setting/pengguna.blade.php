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
                                    stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-users-group">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M10 13a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                    <path d="M8 21v-1a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v1" />
                                    <path d="M15 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                    <path d="M17 10h2a2 2 0 0 1 2 2v1" />
                                    <path d="M5 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                    <path d="M3 13v-1a2 2 0 0 1 2 -2h2" />
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
                                            <i class="fa-solid fa-gear"></i>
                                            Settings
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item" aria-current="page">
                                        <a href="{{ route('setting.pengguna') }}">
                                            <i class="fa-solid fa-user"></i>
                                            Pengguna
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        <a href="#">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="icon icon-tabler icons-tabler-outline icon-tabler-users-group">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M10 13a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                                <path d="M8 21v-1a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v1" />
                                                <path d="M15 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                                <path d="M17 10h2a2 2 0 0 1 2 2v1" />
                                                <path d="M5 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                                <path d="M3 13v-1a2 2 0 0 1 2 -2h2" />
                                            </svg>
                                            {{ $judul }}
                                        </a>
                                    </li>
                                </ol>
                            </div>
                        </div>
                        <div class="col-auto ms-auto d-print-none">
                            <div class="d-flex">
                                <input type="search" id="user-list" class="form-control d-inline-block w-75 me-3"
                                    placeholder="Search user…">
                                <button href="#" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#modal-add">
                                    <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                                    <svg xmlns="http://www.w3.org/2000/svg" style="margin-right: 10px"
                                        class="icon icon-tabler icon-tabler-users" width="24" height="24"
                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                                        <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                                        <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                                        <path d="M21 21v-2a4 4 0 0 0 -3 -3.85" />
                                    </svg>
                                    New Pengguna
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="page-body">
                <div class="container-xl">
                    <div class="row row-cards">
                        @foreach ($users as $item)
                            <div class="col-md-6 col-lg-3 mb-4">
                                <div id="search-results" class="row"></div>
                                <div class="card h-100">
                                    <div class="card-body d-flex flex-column align-items-center">
                                        <span class="avatar avatar-xl mb-3 rounded"
                                            style="background-image: url(assets/static/avatar.png)"></span>
                                        <h3 class="m-0 mb-1"><a href="#">{{ $item->nickname }}</a></h3>
                                        <div class="text-secondary">{{ $item->username }}</div>
                                        <div class="mt-3">
                                            <span class="badge bg-purple-lt">{{ $item->role }}</span>
                                        </div>

                                        <br>
                                        <!-- Tambahkan tombol di sini -->
                                        <div class="row">
                                            <div class="col">
                                                <button class="btn btn-outline-green me-2" data-bs-toggle="modal"
                                                    data-bs-target="#modal-checklist{{ $item->id }}">
                                                    <i class="fa-solid fa-list-check"></i>
                                                </button>
                                            </div>
                                            <div class="col">
                                                <button class="btn btn-outline-primary me-2" data-bs-toggle="modal"
                                                    data-bs-target="#modal-reset{{ $item->id }}">
                                                    <i class="fa-solid fa-unlock-keyhole"></i>
                                                </button>
                                            </div>
                                            <div class="col">
                                                <button class="btn btn-outline-warning me-2" data-bs-toggle="modal"
                                                    data-bs-target="#modal-edit{{ $item->id }}"><i
                                                        class="fas fa-edit"></i></button>
                                            </div>
                                            <div class="col">
                                                <form id="deleteForm{{ $item->id }}"
                                                    action="/settings/destroy/{{ $item->id }}" method="POST"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-outline-danger me-2"
                                                        onclick="confirmDelete(event, {{ $item->id }})">
                                                        <i class="fa-solid fa-fw fa-trash-can"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
            @include('shared.footer')
        </div>
    </div>

    {{-- Add pengguna --}}
    <div class="modal modal-blur fade" id="modal-add" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Users</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('setting.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">STB</label>
                                    <input type="text" class="form-control" name="stb" placeholder="Input STB">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Nickname</label>
                                    <input type="text" class="form-control" name="nickname"
                                        placeholder="Input Nickname">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Username</label>
                                    <input type="text" class="form-control" name="username"
                                        placeholder="Input Username">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Password</label>
                                    <input type="password" class="form-control" name="password"
                                        placeholder="Input Password">
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="form-label">No Hp</div>
                            <input type="text" class="form-control" name="telp" placeholder="Input No Hp">
                        </div>
                        <div class="mb-3">
                            <div class="form-label">Role</div>
                            <select class="form-select" name="role">
                                <option value="">--Pilih Role--</option>
                                <option value="administrator">Administrator</option>
                                <option value="admin">Admin</option>
                                <option value="operator">Operator</option>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- end pengguna --}}

    {{-- modal edit --}}
    @foreach ($users as $item)
        <div class="modal modal-blur fade" id="modal-edit{{ $item->id }}" tabindex="-1" role="dialog"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Users</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('setting.update', $item->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">STB</label>
                                        <input type="text" class="form-control" name="stb"
                                            placeholder="Input placeholder" value="{{ old('stb', $item->stb) }}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Nickname</label>
                                        <input type="text" class="form-control" name="nickname"
                                            placeholder="Input placeholder"
                                            value="{{ old('nickname', $item->nickname) }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Username</label>
                                        <input type="text" class="form-control" name="username"
                                            placeholder="Input placeholder"
                                            value="{{ old('username', $item->username) }}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">No Hp</label>
                                        <input type="text" class="form-control" name="telp"
                                            placeholder="Input placeholder" value="{{ old('telp', $item->telp) }}">
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <div class="form-label">Role</div>
                                <select class="form-select" name="role">
                                    <option value="">--Pilih Role--</option>
                                    <option
                                        value="administrator"{{ old('role', $item->role) == 'administrator' ? 'selected' : '' }}>
                                        Administrator</option>
                                    <option value="admin"{{ old('role', $item->role) == 'admin' ? 'selected' : '' }}>
                                        Admin</option>
                                    <option
                                        value="operator"{{ old('role', $item->role) == 'operator' ? 'selected' : '' }}>
                                        Operator</option>
                                </select>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    {{-- end modal edit --}}

    {{-- modal reset --}}
    @foreach ($users as $item)
        <div class="modal modal-blur fade" id="modal-reset{{ $item->id }}" tabindex="-1" role="dialog"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Reset Password</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('settings.reset', $item->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="text-center">
                                            <img src="{{ asset('assets/static/machine.png') }}"
                                                class="avatar img-circle img-thumbnail"
                                                style="height: 150px; width: 150px;" alt="avatar">
                                            <hr>
                                        </div>
                                        <div class="card-body">
                                            <div class="mb-3">
                                                <label for="password" class="form-label">Password</label>
                                                <input type="password" class="form-control" id="password"
                                                    name="password" placeholder="Masukkan Password Baru"
                                                    value="{{ old('password') }}">
                                            </div>
                                            <div class="mb-3">
                                                <label for="password_confirmation" class="form-label">Konfirmasi Password
                                                    Baru</label>
                                                <input type="password" class="form-control" id="password_confirmation"
                                                    name="password_confirmation" placeholder="Ulangi Password Baru">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Save
                                    changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    {{-- end modal reset --}}
@endsection
