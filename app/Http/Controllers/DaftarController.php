<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\DaftartipeModel;
use App\Models\DaftarwarnaModel;
use App\Models\DaftarsupplierModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;

class DaftarController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        date_default_timezone_set('Asia/Jakarta');
        setlocale(LC_TIME, 'id_ID');
        \Carbon\Carbon::setLocale('id');
    }
    public function tipe()
    {
        return view('products.01_daftar.tipe', [
            'active' => 'Tipe',
            'judul' => 'Tipe Packaging',
        ]);
    }
    public function supplier()
    {
        return view('products.01_daftar.supplier', [
            'active' => 'Supplier',
            'judul' => 'Supplier',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeTipe(Request $request)
    {
        $request->validate(
            [
                'nama' => 'required',
                'kode' => 'required|unique:daftar_tipe|min:1|max:2|string',
            ],
            [
                'nama.required' => 'Masukkan Nama Tipe',
                'kode.required' => 'Kode Tidak Boleh Kosong',
                'kode.unique' => 'Kode "' . $request->kode . '" Sudah dipakai, Tidak Boleh Sama',
                'kode.min' => 'Kode Minimal 1 Karakter',
                'kode.max' => 'Kode Maksimal 2 Karakter',
                'kode.string' => 'Kode Harus Berupa String',
            ]
        );
        try {
            $ins = DaftartipeModel::insert([
                'kode' => $request->kode,
                'nama' => $request->nama,
                'dibuat' => Auth::user()->nickname,
                'created_at' => date('Y-m-d H:i:s'),
            ]);
            if ($ins) {
                $arr = 'Data Tipe telah berhasil disimpan';
            }
            return Response()->json($arr);
        } catch (\Illuminate\Database\QueryException $e) {
            dd($e);
            $arr = array('msg' => 'Something goes to wrong. Please try later. ' . $e, 'status' => false);
        }
    }

    /**
     * Store a newly created resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeWarna(Request $request)
    {
        $request->validate(
            [
                'kodetipe' => 'required',
                'warna' => 'required',
            ],
            [
                'kodetipe.required' => 'Masukkan Tipe',
                'warna.required' => 'Warna Tidak Boleh Kosong',
            ]
        );
        try {
            $tipe = DaftartipeModel::where('id', $request->kodetipe)->first();
            $ins = DaftarwarnaModel::insert([
                'id_tipe' => $tipe->id,
                'kode' => $tipe->kode,
                'warna' => $request->warna,
                'dibuat' => Auth::user()->nickname,
                'created_at' => date('Y-m-d H:i:s'),
            ]);
            if ($ins) {
                $arr = 'Data Tipe telah berhasil disimpan';
            }
            return Response()->json($arr);
        } catch (\Illuminate\Database\QueryException $e) {
            dd($e);
            $arr = array('msg' => 'Something goes to wrong. Please try later. ' . $e, 'status' => false);
        }
    }
    public function storeSupplier(Request $request)
    {
        $request->validate(
            [
                'nama' => 'required|unique:daftar_supplier',
                'telp' => 'required',
                'kota' => 'required',
                'provinsi' => 'required',
                'mtuang' => 'required',
                'alamat' => 'required',
            ],
            [
                'nama.required' => 'Masukkan Nama Tipe',
                'nama.unique' => 'Nama Supplier : "' . $request->nama . '" Sudah Ada, Cek kembali inputan anda',
                'telp.required' => 'Nomor Telepon Tidak Boleh Kosong',
                'kota.required' => 'Kota Harus Diisi',
                'provinsi.required' => 'Provinsi Harus Diisi',
                'mtuang.required' => 'Mata Uang tidak boleh kosong',
                'alamat.required' => 'alamat supplier tidak boleh kosong',
            ]
        );
        try {
            $ins = DaftarsupplierModel::insert([
                'nama' => $request->nama,
                'npwp' => $request->npwp,
                'alamat' => $request->alamat,
                'kopos' => $request->kopos,
                'kota' => $request->kota,
                'provinsi' => $request->provinsi,
                'telp' => $request->telp,
                'email' => $request->email,
                'mtuang' => $request->mtuang,
                'dibuat' => Auth::user()->nickname,
                'created_at' => date('Y-m-d H:i:s'),
            ]);
            if ($ins) {
                $arr = 'Data Supplier telah berhasil disimpan';
            }
            return Response()->json($arr);
        } catch (\Illuminate\Database\QueryException $e) {
            dd($e);
            $arr = array('msg' => 'Something goes to wrong. Please try later. ' . $e, 'status' => false);
        }
    }

    public function getkodetipe(Request $request)
    {
        if ($request->has('q')) {
            $search = $request->q;
            $kabag = DaftartipeModel::where('nama', 'LIKE', "%$search%")->orWhere('kode', 'LIKE', "%$search%")
                ->orderBy('nama')
                ->get();
        } else {
            $kabag = DaftartipeModel::all();
        }
        return Response()->json($kabag);
    }

    public function viewEdittipe(Request $request)
    {
        $data = DaftartipeModel::where('id', $request->id)->first();
        echo '
            <input type="hidden" name="_token" value="' . csrf_token() . '">
            <input type="hidden" name="id" value="' . $request->id . '">
            <div class="modal-body">
                <div class="card-stamp card-stamp-lg">
                    <div class="card-stamp-icon bg-primary">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Nama Tipe</label>
                    <input type="text" class="form-control border border-dark" name="nama"
                        id="Editnama" placeholder="Contoh: Flake, Popcorn" onchange="fetchKarEdit()"
                        onkeydown="if (event.keyCode == 13)  fetchKarEdit()"
                        style="text-transform: capitalize;" value="' . $data->nama . '">
                </div>
                <div class="mb-3">
                    <label class="form-label">Kode</label>
                    <input type="text" class="form-control border border-dark" name="kode"
                        id="Editkode" placeholder="Kode dibuat otomatis setelah nama tipe dibuat"
                        style="text-transform: uppercase;" value="' . $data->kode . '">
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" id="submitEditTipe" class="btn btn-primary ms-auto">
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
        ';
    }
    public function viewEditwarna(Request $request)
    {
        $data = DaftarwarnaModel::where('id', $request->id)->first();
        $dataTipe = DaftartipeModel::where('id', $data->id_tipe)->first();
        echo '
            <input type="hidden" name="_token" value="' . csrf_token() . '">
            <input type="hidden" name="id" value="' . $request->id . '">
            <div class="modal-body">
                <div class="card-stamp card-stamp-lg">
                    <div class="card-stamp-icon bg-purple">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Kode Tipe</label>
                    <style>
                        #select2-kodetipe-container {
                            border: 1px solid black;
                        }
                    </style>
                    <script>
                        $(".select2kodetipeedit").select2({
                            dropdownParent: $("#modal-edit-warna"),
                            language: "id",
                            width: "100%",
                            height: "100%",
                            placeholder: "Pilih Tipe",
                            ajax: {
                                url: "/getkodetipe",
                                dataType: "json",
                                processResults: function(response) {
                                    return {
                                        results: $.map(response, function(item) {
                                            return {
                                                text: item.kode + " - " + item.nama,
                                                id: item.id,
                                            }
                                        })
                                    };
                                },
                                cache: true
                            },
                        });
                    </script>
                    <select name="kodetipe" id="kodetipe" class="form-select select2kodetipeedit"
                        data-select2-id="kodetipe" tabindex="-1" aria-hidden="true">
                        <option value="' . $dataTipe->id . '" selected="selected">' . $dataTipe->kode . ' - ' . $dataTipe->nama . '</option> 
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Warna</label>
                    <input type="text" class="form-control border border-dark" name="warna"
                        id="Editwarna" style="text-transform: uppercase;" value="' . $data->warna . '">
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" id="submitEditWarna" class="btn btn-primary ms-auto">
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
        ';
    }
    public function viewEditsupplier(Request $request)
    {
        $data = DaftarsupplierModel::where('id', $request->id)->first();
        echo '
            <input type="hidden" name="id" value="' . $request->id . '">
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
                    <div class="mb-3 col-md-6">
                        <label class="form-label">Nama Supplier</label>
                        <input type="text" class="form-control border border-dark" name="nama"
                            id="nama" placeholder="Contoh: Jaya Indah. PT"
                            style="text-transform: uppercase;" value="' . $data->nama . '">
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label">NPWP</label>
                        <input type="text" class="form-control border border-dark" name="npwp"
                            id="npwp" placeholder="Masukkan NPWP"
                            style="text-transform: uppercase;" value="' . $data->npwp . '">
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label">Email</label>
                        <input type="text" class="form-control border border-dark" name="email"
                            id="email" placeholder="Masukkan Email" value="' . $data->email . '">
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label">Telepon</label>
                        <input type="text" class="form-control border border-dark" name="telp"
                            id="telp" placeholder="Masukkan Telepon" value="' . $data->telp . '">
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label">Kodepos</label>
                        <input type="text" class="form-control border border-dark" name="kopos"
                            id="kopos" placeholder="Contoh: 12345" value="' . $data->kopos . '">
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label">Kota</label>
                        <input type="text" class="form-control border border-dark" name="kota"
                            id="kota" placeholder="Contoh: Jakarta" value="' . $data->kota . '">
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label">Provinsi</label>
                        <input type="text" class="form-control border border-dark" name="provinsi"
                            id="provinsi" placeholder="Contoh: DKI Jakarta" value="' . $data->provinsi . '">
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label">Mata Uang Dipakai</label>
                        <input type="text" class="form-control border border-dark" name="mtuang"
                            id="mtuang" placeholder="Contoh: IDR, USD, EUR, JPY, SGD, CNY"
                            style="text-transform: uppercase;" value="' . $data->mtuang . '">
                    </div>
                    <div class="mb-3 col-md-12">
                        <label class="form-label">Alamat</label>
                        <input type="text" class="form-control border border-dark" name="alamat"
                            id="alamat" placeholder="Masukkan Alamat" value="' . $data->alamat . '">
                    </div>
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
        ';
    }

    public function storeEditTipe(Request $request)
    {
        $product = DaftartipeModel::findOrFail($request->id);
        try {
            $request->validate(
                [
                    'nama' => 'required',
                    'kode' => 'required|min:1|max:2|string',
                ],
                [
                    'nama.required' => 'Masukkan Nama Tipe',
                    'kode.required' => 'Kode Tidak Boleh Kosong',
                    'kode.min' => 'Kode Minimal 1 Karakter',
                    'kode.max' => 'Kode Maksimal 2 Karakter',
                    'kode.string' => 'Kode Harus Berupa String',
                ]
            );

            $upd = $product->update([
                'kode' => $request->kode,
                'nama' => $request->nama,
                'dibuat' => Auth::user()->nickname,
                'updated_at' => date('Y-m-d H:i:s'),
            ]);

            if ($upd) {
                $arr = 'Data Tipe telah berhasil diubah';
            }
            return Response()->json($arr);
        } catch (\Illuminate\Database\QueryException $e) {
            dd($e);
            $arr = array('msg' => 'Something goes to wrong. Please try later. ' . $e, 'status' => false);
        }
    }
    public function storeEditWarna(Request $request)
    {
        try {
            $request->validate(
                [
                    'kodetipe' => 'required',
                    'warna' => 'required',
                ],
                [
                    'kodetipe.required' => 'Masukkan Kode Tipe',
                    'warna.required' => 'Warna Tidak Boleh Kosong',
                ]
            );

            $product = DaftarwarnaModel::findOrFail($request->id);
            $dataTipe = DaftartipeModel::where('id', $request->kodetipe)->first();

            $upd = $product->update([
                'id_tipe' => $dataTipe->id,
                'kode' => $dataTipe->kode,
                'warna' => $request->warna,
                'dibuat' => Auth::user()->nickname,
                'updated_at' => date('Y-m-d H:i:s'),
            ]);

            if ($upd) {
                $arr = 'Data Warna telah berhasil diubah';
            }
            return Response()->json($arr);
        } catch (\Illuminate\Database\QueryException $e) {
            dd($e);
            $arr = array('msg' => 'Something goes to wrong. Please try later. ' . $e, 'status' => false);
        }
    }
    public function storeEditSupplier(Request $request)
    {
        try {
            $request->validate(
                [
                    'nama' => 'required',
                    'telp' => 'required',
                    'kota' => 'required',
                    'provinsi' => 'required',
                    'mtuang' => 'required',
                    'alamat' => 'required',
                ],
                [
                    'nama.required' => 'Masukkan Nama Tipe',
                    'telp.required' => 'Nomor Telepon Tidak Boleh Kosong',
                    'kota.required' => 'Kota Harus Diisi',
                    'provinsi.required' => 'Provinsi Harus Diisi',
                    'mtuang.required' => 'Mata Uang tidak boleh kosong',
                    'alamat.required' => 'alamat supplier tidak boleh kosong',
                ]
            );

            $product = DaftarsupplierModel::findOrFail($request->id);

            $upd = $product->update([
                'nama' => $request->nama,
                'npwp' => $request->npwp,
                'alamat' => $request->alamat,
                'kopos' => $request->kopos,
                'kota' => $request->kota,
                'provinsi' => $request->provinsi,
                'telp' => $request->telp,
                'email' => $request->email,
                'mtuang' => $request->mtuang,
                'dibuat' => Auth::user()->nickname,
                'updated_at' => date('Y-m-d H:i:s'),
            ]);

            if ($upd) {
                $arr = 'Data Supplier telah berhasil diubah';
            }
            return Response()->json($arr);
        } catch (\Illuminate\Database\QueryException $e) {
            dd($e);
            $arr = array('msg' => 'Something goes to wrong. Please try later. ' . $e, 'status' => false);
        }
    }
}
