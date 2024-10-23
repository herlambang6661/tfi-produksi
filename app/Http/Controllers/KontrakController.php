<?php

namespace App\Http\Controllers;

use App\Models\SuratkontrakModel;
use Illuminate\Http\Request;
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
        return view('products.02_kontrak.kontrak', [
            'active' => 'Suratkontrak',
            'judul' => 'Surat Kontrak',
        ]);
    }

    public function store(Request $request)
    {
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
        try {
            $firstWord = substr($request->tipe, 0, 1);
            $char = $firstWord . date('y');
            // generate kodeseri
            $getkodeseri = SuratkontrakModel::where('id_kontrak', 'like', '%' . $char . '%')->latest('id_kontrak')->first();
            if ($getkodeseri) {
                $kdseri = $getkodeseri->id_kontrak;
                $noUrutKodeseri = (int) substr($kdseri, -3);
                $noUrutKodeseri++;
                $kdseri = $char . sprintf("%03s", $noUrutKodeseri);
            } else {
                $kdseri = $char . "001";
            }
            // $firstWord = substr($request->tipe, 0, 1);
            // $char = $firstWord . date('y');
            // $lastID = SuratkontrakModel::max('id_kontrak')->where('id_kontrak', 'like', $char . '%')->first();
            // if (empty($lastID)) {
            //     $idKontrak = $request->tipe . date('y') . "001";
            // } else {
            //     $idKontrak = $lastID->id_kontrak + 1;
            // }
            SuratkontrakModel::insert([
                'entitas' => $request->entitas,
                'id_kontrak' => $kdseri,
                'tanggal' => $request->tanggal,
                'supplier' => $request->supplier,
                'dibeli' => $request->dibeli,
                'berat' => $request->berat,
                'harga' => $request->harga,
                'tipe' => $request->tipe,
                'warna' => $request->warna,
                'cacatan' => $request->cacatan,
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
}
