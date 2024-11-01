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
        <div class="modal-body">
        </div>
        <div class="modal-footer">
            <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal"><i class="fa-solid fa-fw fa-arrow-rotate-left"></i> Tutup</a>
        </div>
        ';
    }
}
