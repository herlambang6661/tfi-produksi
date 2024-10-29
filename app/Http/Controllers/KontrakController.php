<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DaftartipeModel;
use App\Models\DaftarwarnaModel;
use App\Models\SuratkontrakModel;
use App\Models\DaftarsupplierModel;
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

    public function store(Request $request)
    {
        try {
            $request->validate([
                'entitas' => 'required',
                'tanggal' => 'required',
                'supplier' => 'required',
                'dibeli' => 'required',
                'berat' => 'required',
                'harga' => 'required',
                'tipe' => 'required',
                'warna' => 'required',
                'cacatan' => 'nullable',
            ]);
            $gettipe = DaftartipeModel::where('id', $request->tipe)->first();
            $char = $gettipe->kode . date('y');
            // generate kodeseri
            $getkodeseri = SuratkontrakModel::where('id_kontrak', 'like', '%' . $char . '%')->where('status', '>', 0)->latest('id_kontrak')->first();
            if ($getkodeseri) {
                $kdseri = $getkodeseri->id_kontrak;
                $noUrutKodeseri = (int) substr($kdseri, -3);
                $noUrutKodeseri++;
                $kdseri = $char . sprintf("%03s", $noUrutKodeseri);
            } else {
                $kdseri = $char . "001";
            }
            SuratkontrakModel::insert([
                'entitas' => $request->entitas,
                'id_kontrak' => $kdseri,
                'tanggal' => $request->tanggal,
                'supplier' => $request->supplier,
                'dibeli' => $request->dibeli,
                'berat' => $request->berat,
                'harga' => $request->harga,
                'tipe' => $gettipe->nama,
                'warna' => $request->warna,
                'catatan' => $request->catatan,
                'dibuat' => Auth::user()->nickname,
                'created_at' => date('Y-m-d H:i:s'),
            ]);
            $arr = array('msg' => 'Data Surat Kontrak telah berhasil disimpan', 'status' => true);
            return Response()->json($arr);
        } catch (\Illuminate\Database\QueryException $e) {
            // DEBUG IN CASE OF ERROR
            dd($e);
            $arr = array('msg' => 'Something goes to wrong. Please try later. ' . $e, 'status' => false);
        }
    }

    public function getWarnaByTipe(Request $request)
    {
        $getWarna = DaftarwarnaModel::where('id_tipe', $request->tipe)->get();
        echo '<option value="" hidden>-- Pilih Warna --</option>';
        foreach ($getWarna as $key => $value) {
            echo '<option value="' . $value->warna . '">' . $value->warna . '</option>';
        }
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
}
