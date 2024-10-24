<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SuratkontrakModel;
use Illuminate\Support\Facades\Auth;
use App\Models\GudangpenerimaanModel;
use Illuminate\Support\Facades\Crypt;
use App\Models\GudangpenerimaanitmModel;
use App\Http\Controllers\_01_Datatables\Kontrak\SuratkontrakList;

class GudangController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        date_default_timezone_set('Asia/Jakarta');
        setlocale(LC_TIME, 'id_ID');
        \Carbon\Carbon::setLocale('id');
    }
    public function penerimaan()
    {
        return view('products.03_gudang.penerimaan', [
            'active' => 'Penerimaan',
            'judul' => 'Penerimaan Bahan Baku',
        ]);
    }
    public function getkodeKontrak(Request $request)
    {
        if ($request->has('q')) {
            $search = $request->q;
            $data = SuratkontrakModel::where('id_kontrak', 'LIKE', "%$search%")
                ->where('status', '>', 0)
                ->orderBy('id_kontrak')
                ->get();
        } else {
            $data = SuratkontrakModel::where('status', '>', 0)->get();
        }
        return Response()->json($data);
    }

    public function getTipeByKode(Request $request)
    {
        $getTipe = SuratkontrakModel::where('id', $request->id)->get();
        foreach ($getTipe as $key => $value) {
            echo $value->tipe;
        }
    }

    public function storePenerimaan(Request $request)
    {
        try {
            // Validasi untuk menanggulangi error
            $request->validate(
                [
                    'tanggal_kedatangan' => 'required',
                    'kodekontrak' => 'required',
                    'kendaraan_ke' => 'required',
                    'tipe' => 'required',
                    'qty' => 'required',
                    'satuan' => 'required',
                    'berat_trukpenuh' => 'required',
                    'berat_trukkosong' => 'required',
                ],
                [
                    'tanggal_kedatangan.required' => 'Tanggal Kedatangan wajib diisi',
                    'kodekontrak.required' => 'Kodekontrak wajib diisi',
                    'kendaraan_ke.required' => 'Kendaraan ke wajib diisi',
                    'tipe.required' => 'Tipe wajib diisi',
                    'qty.required' => 'Qty wajib diisi',
                    'satuan.required' => 'Satuan wajib diisi',
                    'berat_trukpenuh.required' => 'Berat Truck penuh wajib diisi',
                    'berat_trukkosong.required' => 'Berat Truck kosong wajib diisi',
                ]
            );
            // ambil data kontrak
            $getKontrak = SuratkontrakModel::where('id', $request->kodekontrak)->first();
            $kodepenerimaan = $getKontrak->id_kontrak . '-' . sprintf("%02s", $request->kendaraan_ke);
            // insert data penerimaan
            GudangpenerimaanModel::insert([
                'id_suratkontrak' => $request->kodekontrak,
                'tanggal_kedatangan' => $request->tanggal_kedatangan,
                'kodekontrak' => $getKontrak->id_kontrak,
                'kodepenerimaan' => $kodepenerimaan,
                'tipe' => $request->tipe,
                'qty' => $request->qty,
                'satuan' => $request->satuan,
                'berat_trukpenuh' => $request->berat_trukpenuh,
                'berat_trukkosong' => $request->berat_trukkosong,
                'nopol' => $request->nopol,
                'driver' => $request->driver,
                'ktp' => $request->ktp,
                'keterangan' => $request->keterangan,
                'dibuat' => Auth::user()->nickname,
                'created_at' => date('Y-m-d H:i:s'),
            ]);
            for ($i = 1; $i <= $request->qty; $i++) {
                // insert data penerimaanitm
                GudangpenerimaanitmModel::insert([
                    'tanggal_kedatangan' => $request->tanggal_kedatangan,
                    'kodepenerimaan' => $kodepenerimaan,
                    'subkode' => $kodepenerimaan . '-' . sprintf("%03s", $i),
                    'nourut' => sprintf("%03s", $i),
                    'dibuat' => Auth::user()->nickname,
                    'created_at' => date('Y-m-d H:i:s'),
                ]);
            }
            $arr = array('msg' => 'Data Surat Kontrak telah berhasil disimpan', 'status' => true);
            return Response()->json($arr);
        } catch (\Illuminate\Database\QueryException $e) {
            // DEBUG IN CASE OF ERROR
            dd($e);
            $arr = array('msg' => 'Something goes to wrong. Please try later. ' . $e, 'status' => false);
        }
    }

    public function verifikasi($id)
    {
        $decrypted = Crypt::decryptString($id);
        $verifikasi = GudangpenerimaanModel::where('id', $decrypted)->first();
        return view('products.03_gudang.verifikasi', [
            'active' => 'Penerimaan',
            'judul' => 'Verifikasi kedatangan',
            'verifikasi' => $verifikasi,
        ]);
    }
}
