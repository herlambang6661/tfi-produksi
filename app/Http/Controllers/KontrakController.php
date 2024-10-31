<?php

namespace App\Http\Controllers;

use App\Http\Controllers\_01_Datatables\Kontrak\SuratkontrakList;
use Illuminate\Http\Request;
use App\Models\DaftartipeModel;
use App\Models\DaftarwarnaModel;
use App\Models\SuratkontrakModel;
use App\Models\DaftarsupplierModel;
use App\Models\DaftarTipeSubKategoriModel;
use App\Models\SuratkontrakitmModel;
use Database\Seeders\Daftar_tipe;
use Illuminate\Support\Facades\Auth;

class KontrakController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        date_default_timezone_set('Asia/Jakarta');
        setlocale(LC_TIME, 'id_ID');
        \Carbon\Carbon::setLocale('id');
    }

    public function suratKontrak()
    {
        $getTipe = DaftartipeModel::all();
        return view('products.02_kontrak.kontrak', [
            'active' => 'Suratkontrak',
            'judul' => 'Surat Kontrak',
            'tipe' => $getTipe,
        ]);
    }
    public function suratKontrakAdd()
    {
        $getTipe = DaftartipeModel::all();
        return view('products.02_kontrak.kontrakAdd', [
            'active' => 'Suratkontrak',
            'judul' => 'Tambah Surat Kontrak',
            'tipe' => $getTipe,
        ]);
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'entitas' => 'required',
                'tanggal' => 'required',
                'supplier' => 'required',
                'dibeli' => 'required',
                'keterangan' => 'nullable',
            ]);

            //generate noform
            $checknoform = SuratkontrakModel::latest('noform')->first();
            if ($checknoform) {
                $y = substr($checknoform->noform, 0, 2);
                if (date('y') == $y) {
                    $query = SuratkontrakModel::where('noform', 'like', '%' . date('y') . '%')->orderBy('noform', 'desc')->first();
                    $noUrut = (int) substr($query->noform, -4);
                    $noUrut++;
                    $char = date('y-');
                    $kode_noform = $char . sprintf("%04s", $noUrut);
                } else {
                    $kode_noform = date('y-') . "0001";
                }
            } else {
                $kode_noform = date('y-') . "0001";
            }

            $ins = SuratkontrakModel::insert([
                'entitas' => $request->entitas,
                'noform' => $kode_noform,
                'tanggal' => $request->tanggal,
                'supplier' => $request->supplier,
                'dibeli' => $request->dibeli,
                'keterangan' => $request->keterangan,

                'dibuat' => Auth::user()->nickname,
                'created_at' => date('Y-m-d H:i:s'),
            ]);

            for ($i = 0; $i < count($request->tipe); $i++) {
                $gettipe        = DaftartipeModel::where('id', $request->tipe[$i])->first();
                $getkategori    = DaftarTipeSubKategoriModel::where('id', $request->kategori[$i])->first();
                $getwarna       = DaftarwarnaModel::where('id', $request->warna[$i])->first();
                $char = $gettipe->kode . $getkategori->kode_kategori . $getwarna->kode_warna . date('y');

                // generate kodeseri
                $getkodeseri = SuratkontrakitmModel::where('kode_kontrak', 'like', '%' . $char . '%')->where('status', '>', 0)->latest('kode_kontrak')->first();
                if ($getkodeseri) {
                    $kdseri = $getkodeseri->kode_kontrak;
                    $noUrutKodeseri = (int) substr($kdseri, -3);
                    $noUrutKodeseri++;
                    $kdseri = $char . sprintf("%03s", $noUrutKodeseri);
                } else {
                    $kdseri = $char . "001";
                }
                SuratkontrakitmModel::insert([
                    'noform' => $kode_noform,
                    'kode_kontrak' => $kdseri,
                    'tanggal' => $request->tanggal,
                    'tipe' => $gettipe->nama,
                    'kategori' => $getkategori->nama_kategori,
                    'warna' => $getwarna->warna,
                    'berat' => $request->berat[$i],
                    'harga' => $request->harga[$i],
                    'dibuat' => Auth::user()->nickname,
                    'created_at' => date('Y-m-d H:i:s'),
                ]);
            }
            if ($ins) {
                return response()->json('Data Surat Kontrak telah berhasil disimpan');
            }
        } catch (\Illuminate\Database\QueryException $e) {
            // DEBUG IN CASE OF ERROR
            dd($e);
            return response()->json(['msg' => 'Something went wrong. Please try later. ' . $e->getMessage(), 'status' => false], 500);
        }
    }
    public function getBahanBaku(Request $request)
    {
        if ($request->has('q')) {
            $search = $request->q;
            $kabag = DaftartipeModel::where('nama', 'LIKE', "%$search%")
                ->orderBy('nama')
                ->get();
        } else {
            $kabag = DaftartipeModel::all();
        }
        return Response()->json($kabag);
    }

    public function getWarnaByTipe(Request $request)
    {
        $getWarna = DaftarwarnaModel::where('id_tipe', $request->tipe)->get();
        echo '<option value="" hidden>-- Pilih Warna --</option>';
        foreach ($getWarna as $key => $value) {
            echo '<option value="' . $value->warna . '">' . $value->warna . '</option>';
        }
    }

    public function getKategori(Request $request)
    {
        if ($request->has('q')) {
            $search = $request->q;
            $kabag = DaftarTipeSubKategoriModel::where('nama_kategori', 'LIKE', "%$search%")
                ->orderBy('nama_kategori')
                ->get();
        } else {
            $kabag = DaftarTipeSubKategoriModel::all();
        }
        return Response()->json($kabag);
    }
    public function getWarna(Request $request)
    {
        if ($request->has('q')) {
            $search = $request->q;
            $kabag = DaftarwarnaModel::where('warna', 'LIKE', "%$search%")
                ->orderBy('warna')
                ->get();
        } else {
            $kabag = DaftarwarnaModel::all();
        }
        return Response()->json($kabag);
    }
    public function getsupplierKontrak(Request $request)
    {
        if ($request->has('q')) {
            $search = $request->q;
            $kabag = DaftarsupplierModel::where('jenisperson', 'Supplier')->where('nama', 'LIKE', "%$search%")
                ->orderBy('nama')
                ->get();
        } else {
            $kabag = DaftarsupplierModel::where('jenisperson', 'Supplier')->get();
        }
        return Response()->json($kabag);
    }
    public function getPengemudi(Request $request)
    {
        if ($request->has('q')) {
            $search = $request->q;
            $kabag = DaftarsupplierModel::where('jenisperson', 'Driver')->where('nama', 'LIKE', "%$search%")
                ->orderBy('nama')
                ->get();
        } else {
            $kabag = DaftarsupplierModel::where('jenisperson', 'Driver')->get();
        }
        return Response()->json($kabag);
    }

    public function detailKontrak(Request $request)
    {
        $data = SuratkontrakModel::where('id', $request->id)->first();

        echo '
        <input type="hidden" name="_token" value="' . csrf_token() . '">
        <input type="hidden" name="id" value="' . $request->id . '">
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
                    name="entitas" id="entitas" readonly value="TFI" disabled>
            </div>
            <div class="col-lg-6 mb-3">
                <label class="form-label">Tanggal Kontrak</label>
                <input type="date" class="form-control border border-dark" name="tanggal"
                    id="tanggal" value="' . ($data->tanggal ?? date('Y-m-d')) . '" disabled>
            </div>
        </div>
        <div class="row">
             <div class="col-lg-6 mb-3">
                <label class="form-label">Supplier</label>
                <input type="text" class="form-control border border-dark" name="supplier" id="supplier" value="' . ($data->supplier ?? 'Pilih Supplier') . '" disabled>
            </div>
            <div class="col-lg-6 mb-3">
                <label class="form-label">Dibeli Oleh</label>
                <input type="text" class="form-control border border-dark" name="dibeli"
                    id="dibeli" value="' . ($data->dibeli ?? '') . '" placeholder="Masukkan Nomor Import" disabled>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 mb-3">
                <label class="form-label">Berat Kontrak (KG)</label>
                <input type="number" class="form-control border border-dark" name="berat"
                    id="berat" value="' . ($data->berat ?? '') . '" placeholder="Masukkan Berat" disabled>
            </div>
            <div class="col-lg-6 mb-3">
                <label class="form-label">Harga</label>
                <input type="number" class="form-control border border-dark" name="harga"
                    id="harga" value="' . ($data->harga ?? '') . '" placeholder="Masukkan Harga" disabled>
            </div>
        </div>
        <div class="row">
             <div class="col-lg-6 mb-3">
                <label class="form-label">Tipe</label>
                <input type="text" class="form-control border border-dark" name="tipe" id="tipe" value="' . ($data->tipe ?? 'Pilih Tipe') . '" disabled>
            </div>
         <div class="col-lg-6 mb-3">
                <label class="form-label">Warna</label>
                <input type="text" class="form-control border border-dark" name="warna" id="warna" value="' . ($data->warna ?? 'Pilih Tipe') . '" placeholder="Silahkan Pilih Tipe Terlebih Dahulu" disabled>
            </div>
        </div>
    </div>
    <div class="modal-body">
        <div class="mb-3">
            <label class="form-label">Keterangan Tambahan</label>
            <textarea name="cacatan" id="cacatan" cols="90" rows="2" class="form-control border border-dark" disabled>' . ($data->catatan ?? '') . '</textarea>
        </div>
    </div>
    <div class="modal-footer">
        <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal"><i class="fa-solid fa-fw fa-arrow-rotate-left"></i> Kembali</a>
        <button type="submit" id="submitSuratkontrak" class="btn btn-primary ms-auto">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-floppy" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2"/>
                <path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"/>
                <path d="M14 4l0 4l-6 0l0 -4"/>
            </svg>
            Simpan
        </button>
    </div>';
    }
}
