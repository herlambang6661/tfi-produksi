<?php

namespace App\Http\Controllers;

use App\Models\DaftarJenisModel;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\DaftartipeModel;
use App\Models\DaftarwarnaModel;
use App\Models\DaftarsupplierModel;
use App\Models\DaftarTipeSubKategoriModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
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
                'warna' => 'required',
                'kode_warna' => 'required|unique:daftar_tipewarna|min:1|max:2|string',

            ],
            [
                'warna.required' => 'Warna Tidak Boleh Kosong',
                'kode_warna.required' => 'Kode Tidak Boleh Kosong',
                'kode_warna.unique' => 'Kode "' . $request->kode_warna . '" Sudah dipakai, Tidak Boleh Sama',
                'kode_warna.min' => 'Kode Minimal 1 Karakter',
                'kode_warna.max' => 'Kode Maksimal 2 Karakter',
                'kode_warna.string' => 'Kode Harus Berupa String',
            ]
        );
        try {
            $ins = DaftarwarnaModel::insert([
                'kode_warna' => $request->kode_warna,
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

    public function storeTipesub(Request $request)
    {
        $request->validate(
            [
                'nama_kategori' => 'required',
                'kode_kategori' => 'required|unique:daftar_tipe_subkategori|min:1|max:2|string',

            ],
            [
                'nama_kategori.required' => 'Nama Tidak Boleh Kosong',
                'kode_kategori.required' => 'Kode Tidak Boleh Kosong',
                'kode_kategori.unique' => 'Kode "' . $request->kode_kategori . '" Sudah dipakai, Tidak Boleh Sama',
                'kode_kategori.min' => 'Kode Minimal 1 Karakter',
                'kode_kategori.max' => 'Kode Maksimal 2 Karakter',
                'kode_kategori.string' => 'Kode Harus Berupa String',
            ]
        );
        try {
            $ins = DaftarTipeSubKategoriModel::insert([
                'kode_kategori' => $request->kode_kategori,
                'nama_kategori' => $request->nama_kategori,
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
                'foto1' => 'image|mimes:jpg,jpeg,png|max:2048',
                'foto2' => 'image|mimes:jpg,jpeg,png|max:2048',
            ],
            [
                'nama.required' => 'Masukkan Nama Tipe',
                'nama.unique' => 'Nama Supplier : "' . $request->nama . '" Sudah Ada, Cek kembali inputan anda',
                'telp.required' => 'Nomor Telepon Tidak Boleh Kosong',
                'kota.required' => 'Kota Harus Diisi',
                'provinsi.required' => 'Provinsi Harus Diisi',
                'mtuang.required' => 'Mata Uang tidak boleh kosong',
                'alamat.required' => 'Alamat supplier tidak boleh kosong',
                'foto1.image' => 'File harus berupa gambar',
                'foto2.image' => 'File harus berupa gambar',
                'foto1.max' => 'File Pas tidak boleh lebih besar dari 2 MB',
                'foto2.max' => 'File KTP tidak boleh lebih besar dari 2 MB',
            ]
        );

        try {
            $pas_foto = null;
            $pas_ktp = null;

            if ($request->hasFile('foto1')) {
                $pas_foto = 'Pas_' . uniqid() . '.' . $request->file('foto1')->getClientOriginalExtension();
                $request->file('foto1')->storeAs('public/file/pas/', $pas_foto);
            }

            if ($request->hasFile('foto2')) {
                $pas_ktp = 'KTP_' . uniqid() . '.' . $request->file('foto2')->getClientOriginalExtension();
                $request->file('foto2')->storeAs('public/file/pas/', $pas_ktp);
            }

            $ins = DaftarsupplierModel::insert([
                'nama' => $request->nama,
                'jenisperson' => $request->jenisperson,
                'noid' => $request->noid,
                'alamat' => $request->alamat,
                'kopos' => $request->kopos,
                'kota' => $request->kota,
                'provinsi' => $request->provinsi,
                'telp' => $request->telp,
                'email' => $request->email,
                'mtuang' => $request->mtuang,
                'foto1' => $pas_foto,
                'foto2' => $pas_ktp,
                'dibuat' => Auth::user()->nickname,
                'created_at' => now(),
            ]);

            if ($ins) {
                return response()->json('Data Supplier telah berhasil disimpan');
            }
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json(['msg' => 'Something went wrong. Please try later. ' . $e->getMessage(), 'status' => false], 500);
        }
    }

    public function storeJenis(Request $request)
    {
        $request->validate(
            [
                'nama_jenis' => 'required',
            ],
            [
                'nama_jenis.required' => 'Masukkan Nama Jenis',
            ]
        );
        try {
            $jen = DaftarJenisModel::insert([
                'nama_jenis' => $request->nama_jenis,
                'dibuat' => Auth::user()->nickname,
                'created_at' => date('Y-m-d H:i:s'),
            ]);

            if ($jen) {
                $arr = 'Data jenis telah berhasil di simpan';
            }
            return Response()->json($arr);
        } catch (\Illuminate\Database\QueryException $e) {
            dd($e);
            $arr = array('msg' => 'Something goes to wrong. Please try later. ' . $e, 'status' => false);
        }
    }

    public function updateSupplier(Request $request, $id)
    {
        $request->validate(
            [
                'nama' => 'required',
                'telp' => 'required',
                'kota' => 'required',
                'provinsi' => 'required',
                'mtuang' => 'required',
                'alamat' => 'required',
                'foto1' => 'image|mimes:jpg,jpeg,png|max:2048',
                'foto2' => 'image|mimes:jpg,jpeg,png|max:2048',
            ],
            [
                'nama.required' => 'Masukkan Nama Tipe',
                'telp.required' => 'Nomor Telepon Tidak Boleh Kosong',
                'kota.required' => 'Kota Harus Diisi',
                'provinsi.required' => 'Provinsi Harus Diisi',
                'mtuang.required' => 'Mata Uang tidak boleh kosong',
                'alamat.required' => 'Alamat supplier tidak boleh kosong',
                'foto1.image' => 'File harus berupa gambar',
                'foto2.image' => 'File harus berupa gambar',
                'foto1.max' => 'File Pas tidak boleh lebih besar dari 2 MB',
                'foto2.max' => 'File KTP tidak boleh lebih besar dari 2 MB',
            ]
        );

        $supplier = DaftarsupplierModel::find($id);
        if (!$supplier) {
            return response()->json(['msg' => 'Supplier tidak ditemukan. Periksa kembali ID yang dikirim.', 'status' => false], 404);
        }

        try {
            $pas_foto = $supplier->foto1;
            $pas_ktp = $supplier->foto2;

            // Jika ada file foto1 baru, hapus yang lama dan simpan yang baru
            if ($request->hasFile('foto1')) {
                if ($pas_foto) {
                    Storage::delete('public/file/pas/' . $pas_foto);
                }
                $pas_foto = 'Pas_' . uniqid() . '.' . $request->file('foto1')->getClientOriginalExtension();
                $request->file('foto1')->storeAs('public/file/pas/', $pas_foto);
            }

            // Jika ada file foto2 baru, hapus yang lama dan simpan yang baru
            if ($request->hasFile('foto2')) {
                if ($pas_ktp) {
                    Storage::delete('public/file/pas/' . $pas_ktp);
                }
                $pas_ktp = 'KTP_' . uniqid() . '.' . $request->file('foto2')->getClientOriginalExtension();
                $request->file('foto2')->storeAs('public/file/pas/', $pas_ktp);
            }

            $supplier->update([
                'nama' => $request->nama,
                'jenisperson' => $request->jenisperson,
                'noid' => $request->noid,
                'alamat' => $request->alamat,
                'kopos' => $request->kopos,
                'kota' => $request->kota,
                'provinsi' => $request->provinsi,
                'telp' => $request->telp,
                'email' => $request->email,
                'mtuang' => $request->mtuang,
                'foto1' => $pas_foto,
                'foto2' => $pas_ktp,
                'dibuat' => Auth::user()->nickname,
                'updated_at' => now(),
            ]);

            return response()->json('Data Supplier telah berhasil diperbarui');
        } catch (\Exception $e) {
            return response()->json(['msg' => 'Terjadi kesalahan. Silakan coba lagi. ' . $e->getMessage(), 'status' => false], 500);
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

    public function viewEditTipeSub(Request $request)
    {
        $data = DaftarTipeSubKategoriModel::where('id', $request->id)->first();
        echo '
            <input type="hidden" name="_token" value="' . csrf_token() . '">
            <input type="hidden" name="id" value="' . $request->id . '">
            <div class="modal-body">
                <div class="card-stamp card-stamp-lg">
                    <div class="card-stamp-icon bg-danger">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Nama</label>
                    <input type="text" class="form-control border border-dark" name="nama_kategori"
                        id="Editnama_kategori" Popcorn" onchange="fetchKarSubEdit()"
                        onkeydown="if (event.keyCode == 13)  fetchKarSubEdit()" style="text-transform: uppercase;" value="' . $data->nama_kategori . '">
                </div>
                <div class="mb-3">
                    <label class="form-label">Kode</label>
                    <input type="text" class="form-control border border-dark" name="kode_kategori"
                        id="Editkode_kategori" placeholder="Kode dibuat otomatis setelah nama kategori dibuat"
                        style="text-transform: uppercase;" value="' . $data->kode_kategori . '">
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" id="submitEditTipesub" class="btn btn-danger ms-auto">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="icon icon-tabler icon-tabler-device-floppy" width="24" height="24"
                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" />
                        <path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                        <path d="M14 4l0 4l-6 0l0 -4" />
                    </svg>
                    Update
                </button>
            </div>
        ';
    }

    public function viewEditwarna(Request $request)
    {
        $data = DaftarwarnaModel::where('id', $request->id)->first();
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
                    <label class="form-label">Warna</label>
                    <input type="text" class="form-control border border-dark" name="warna"
                        id="Editwarna" onchange="fetchKarWEdit()"
                        onkeydown="if (event.keyCode == 13)  fetchKarWEdit()" style="text-transform: uppercase;" value="' . $data->warna . '">
                </div>
                <div class="mb-3">
                    <label class="form-label">Kode Warna</label>
                    <input type="text" class="form-control border border-dark" name="kode_warna"
                        id="Editkode_warna" placeholder="Kode dibuat otomatis setelah warna tipe dibuat"
                        style="text-transform: uppercase;" value="' . $data->kode_warna . '">
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" id="submitEditWarna" class="btn btn-purple ms-auto">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="icon icon-tabler icon-tabler-device-floppy" width="24" height="24"
                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" />
                        <path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                        <path d="M14 4l0 4l-6 0l0 -4" />
                    </svg>
                    Update
                </button>
            </div>
        ';
    }
    public function viewEditJenis(Request $request)
    {
        $data = DaftarJenisModel::where('id', $request->id)->first();
        echo '<input type="hidden" name="_token" value="' . csrf_token() . '">
            <input type="hidden" name="id" value="' . $request->id . '">
            <div class="modal-body">
                <div class="card-stamp card-stamp-lg">
                    <div class="card-stamp-icon bg-warning">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </div>
                </div>
                <div class="mb-3">
                <div class="mb-3">
                    <label class="form-label">Jenis</label>
                    <input type="text" class="form-control border border-dark" name="nama_jenis"
                        id="Editjenis" style="text-transform: uppercase;" value="' . $data->nama_jenis . '">
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" id="submitEditJenis" class="btn btn-warning ms-auto">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="icon icon-tabler icon-tabler-device-floppy" width="24" height="24"
                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" />
                        <path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                        <path d="M14 4l0 4l-6 0l0 -4" />
                    </svg>
                    Update
                </button>
            </div>';
    }
    public function viewEditsupplier(Request $request)
    {
        $data = DaftarsupplierModel::where('id', $request->id)->first();
        $foto1 = $data->foto1 ? asset('storage/file/pas/' . $data->foto1) : asset('assets/static/pas.jpg');
        $foto2 = $data->foto2 ? asset('storage/file/pas/' . $data->foto2) : asset('assets/static/ktp.jpg');
        echo '
            <input type="hidden" id="supplierId" name="supplierId" value="' . $data->id . '">
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
                            <option value="' . $data->jenisperson . '" hidden>' . $data->jenisperson . '</option>
                            <option value="Supplier">Supplier</option>
                            <option value="Driver">Pengemudi</option>
                        </select>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label">Nama</label>
                        <input type="text" class="form-control border border-dark" name="nama"
                            id="nama" placeholder="Contoh: Jaya Indah. PT"
                            style="text-transform: uppercase;" value="' . $data->nama . '">
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label">NPWP / No. KTP</label>
                        <input type="text" class="form-control border border-dark" name="noid"
                            id="noid" value="' . $data->noid . '"
                            style="text-transform: uppercase;">
                        <i class="text-small">jika tdk ada isi dengan tanda -</i>
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
                        <img class="card-img-top" src="' . $foto1 . '"
                            id="pas" style="width: 100%;max-width: 300px;max-height: 300px" />
                    </div>
                    <div class="mb-3 col-md-6 text-center">
                        <img class="card-img-top" src="' . $foto2 . '"
                            id="ktp" style="width: 100%;max-width: 300px;max-height: 300px" />
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" id="submitEditSupplier" class="btn btn-primary ms-auto">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="icon icon-tabler icon-tabler-device-floppy" width="24" height="24"
                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" />
                        <path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                        <path d="M14 4l0 4l-6 0l0 -4" />
                    </svg>
                    Update
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

    public function storeEditTipeSub(Request $request)
    {
        try {
            $request->validate(
                [
                    'kode_kategori' => 'required',
                    'nama_kategori' => 'required',
                ],
                [
                    'kode_kategori.required' => 'Masukkan Kode Kategori',
                    'nama_kategori.required' => 'Nama Kategori Tidak Boleh Kosong',
                ]
            );

            $product = DaftarTipeSubKategoriModel::findOrFail($request->id);

            $upd = $product->update([
                'kode_kategori' => $request->kode_kategori,
                'nama_kategori' => $request->nama_kategori,
                'dibuat' => Auth::user()->nickname,
                'updated_at' => date('Y-m-d H:i:s'),
            ]);

            if ($upd) {
                $arr = 'Data Tipe Sub Kategori telah berhasil diubah';
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
                    'kode_warna' => 'required',
                    'warna' => 'required',
                ],
                [
                    'kode_warna.required' => 'Masukkan Kode Warna',
                    'warna.required' => 'Warna Tidak Boleh Kosong',
                ]
            );

            $product = DaftarwarnaModel::findOrFail($request->id);

            $upd = $product->update([
                'kode_warna' => $request->kode_warna,
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

    public function storeEditJenis(Request $request)
    {
        $jenis = DaftarJenisModel::findOrfail($request->id);
        try {
            $request->validate(
                [
                    'nama_jenis' => 'required',
                ],
                [
                    'nama_jenis.required' => 'Masukkan nama jenis',
                ]
            );

            $jenupd = $jenis->update([
                'nama_jenis' => $request->nama_jenis,
                'dibuat' => Auth::user()->nickname,
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
            if ($jenupd) {
                $arr = 'Data Jenis telah berhasil diubah';
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
                    'foto1' => 'image|mimes:jpg,jpeg,png|max:2048',
                    'foto2' => 'image|mimes:jpg,jpeg,png|max:2048',
                ],
                [
                    'nama.required' => 'Masukkan Nama Tipe',
                    'telp.required' => 'Nomor Telepon Tidak Boleh Kosong',
                    'kota.required' => 'Kota Harus Diisi',
                    'provinsi.required' => 'Provinsi Harus Diisi',
                    'mtuang.required' => 'Mata Uang tidak boleh kosong',
                    'alamat.required' => 'alamat supplier tidak boleh kosong',
                    'foto1.image' => 'File harus berupa gambar',
                    'foto2.image' => 'File harus berupa gambar',
                    'foto1.max' => 'File Pas tidak boleh lebih besar dari 2 MB',
                    'foto2.max' => 'File KTP tidak boleh lebih besar dari 2 MB',
                ]
            );

            $product = DaftarsupplierModel::where('id', $request->id)->first();

            // $pas_foto = $product->foto1;
            // $pas_ktp = $product->foto2;
            // if ($request->hasFile('foto1')) {
            //     $pas_foto = 'Pas_' . rand(0000000001, 9999999999) . '.' . $request->file('foto1')->getClientOriginalExtension();
            //     // Storage::disk('local')->put($pas_foto, 'Contents');
            //     $request->file('foto1')->storeAs('file/pas/' . $pas_foto, 'public');
            // }
            // if ($request->hasFile('foto2')) {
            //     $pas_ktp = 'Pas_' . rand(0000000001, 9999999999) . '.' . $request->file('foto2')->getClientOriginalExtension();
            //     $request->file('foto2')->storeAs('file/pas/' . $pas_ktp, 'public');
            // }

            $request->file('foto1')->storeAs('uploads', $request->file('foto1')->getClientOriginalExtension());

            $upd = $product->update([
                'nama' => $request->nama,
                'jenisperson' => $request->jenisperson,
                'noid' => $request->noid,
                'alamat' => $request->alamat,
                'kopos' => $request->kopos,
                'kota' => $request->kota,
                'provinsi' => $request->provinsi,
                'telp' => $request->telp,
                'email' => $request->email,
                'mtuang' => $request->mtuang,
                'foto1' => $request->file('foto1')->getClientOriginalExtension(),
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

    public function viewAddDaftar(Request $request)
    {
        if ($request->id == 'bahan') {
            echo '
                <form id="formTipe" name="formTipe" method="post" action="javascript:void(0)">
                    <input type="hidden" name="_token" value="' . csrf_token() . '">
                    <div class="modal-body">
                        <div class="card-stamp card-stamp-lg">
                            <div class="card-stamp-icon bg-primary">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </div>
                        </div>
                        <script>
                            function fetchKar() {
                                var kode = $("#kode").val();
                                var nama = $("#nama").val();
                                console.log(kode);
                                $("#kode").val(nama.charAt(0));
                            }
                        </script>
                        <div class="mb-3">
                            <label class="form-label">Nama Bahan Baku</label>
                            <input type="text" class="form-control border border-dark" name="nama"
                                id="nama" placeholder="Contoh: Flake, Popcorn" onchange="fetchKar()"
                                onkeydown="if (event.keyCode == 13)  fetchKar()"
                                style="text-transform: capitalize;">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Kode Bahan Baku</label>
                            <input type="text" class="form-control border border-dark" name="kode"
                                id="kode" placeholder="Kode dibuat otomatis setelah nama tipe dibuat"
                                style="text-transform: uppercase;">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="submitTipe" class="btn btn-primary ms-auto">
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
            ';
        } elseif ($request->id == 'kategori') {
            echo '
                <form id="formTipesub" name="formTipesub" method="post" action="javascript:void(0)">
                    <input type="hidden" name="_token" value="' . csrf_token() . '">
                    <div class="modal-body">
                        <div class="card-stamp card-stamp-lg">
                            <div class="card-stamp-icon bg-primary">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </div>
                        </div>
                        <script>
                            function fetchSub() {
                                var kode_kategori = $("#kode_kategori").val();
                                var nama_kategori = $("#nama_kategori").val();
                                console.log(kode_kategori);
                                $("#kode_kategori").val(nama_kategori.charAt(0));
                            }
                        </script>
                        <div class="mb-3">
                            <label class="form-label">Nama Kategori</label>
                            <input type="text" class="form-control border border-dark" name="nama_kategori"
                                id="nama_kategori" onchange="fetchSub()"
                                onkeydown="if (event.keyCode == 13)  fetchSub()"
                                style="text-transform: uppercase;">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Kode Kategori</label>
                            <input type="text" class="form-control border border-dark" name="kode_kategori"
                                id="kode_kategori" placeholder="Kode dibuat otomatis setelah nama tipe dibuat"
                                style="text-transform: uppercase;">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="submitTipeSub" class="btn btn-danger ms-auto">
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
            ';
        } elseif ($request->id == 'warna') {
            echo '
                <form id="formWarna" name="formWarna" method="post" action="javascript:void(0)">
                    <input type="hidden" name="_token" value="' . csrf_token() . '">
                    <div class="modal-body">
                        <div class="card-stamp card-stamp-lg">
                            <div class="card-stamp-icon bg-primary">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </div>
                        </div>
                        <script>
                            function fetchWarna() {
                                var kode_warna = $("#kode_warna").val();
                                var warna = $("#warna").val();
                                console.log(kode_warna);
                                $("#kode_warna").val(warna.charAt(0));
                            }
                        </script>
                        <div class="mb-3">
                            <label class="form-label">Warna</label>
                            <input type="text" class="form-control border border-dark" name="warna"
                                id="warna" onchange="fetchWarna()"
                                onkeydown="if (event.keyCode == 13)  fetchWarna()"
                                style="text-transform: uppercase;">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Kode Warna</label>
                            <input type="text" class="form-control border border-dark" name="kode_warna"
                                id="kode_warna" placeholder="Kode dibuat otomatis setelah nama tipe dibuat"
                                style="text-transform: uppercase;">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="submitWarna" class="btn btn-purple ms-auto">
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
            ';
        } elseif ($request->id == 'supplier') {
            echo '
                <form id="formSupplier" name="formSupplier" method="post" action="javascript:void(0)"
                    enctype="multipart/form-data" accept-charset="utf-8">
                    <input type="hidden" name="_token" value="' . csrf_token() . '">
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
                                <input type="text" name="jenisperson" id="jenisperson" value="Supplier" class="form-control border border-dark cursor-not-allowed bg-dark-lt" readonly>
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
            ';
        } elseif ($request->id == 'jenis') {
            echo '
                <form id="formJenis" name="formJenis" method="post" action="javascript:void(0)">
                    <input type="hidden" name="_token" value="' . csrf_token() . '">
                    <div class="modal-body">
                        <div class="card-stamp card-stamp-lg">
                            <div class="card-stamp-icon bg-warning">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Jenis</label>
                            <input type="text" class="form-control border border-dark" name="nama_jenis"
                                id="warna" style="text-transform: uppercase;"
                                placeholder="Contoh: Jumbo Bag, Karung">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="submitJenis" class="btn btn-warning ms-auto">
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
            ';
        }
    }
}
