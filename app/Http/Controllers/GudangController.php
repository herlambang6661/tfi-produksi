<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SuratkontrakModel;
use Illuminate\Support\Facades\Auth;
use App\Models\GudangpenerimaanModel;
use Illuminate\Support\Facades\Crypt;
use App\Models\GudangpenerimaanitmModel;
use App\Http\Controllers\_01_Datatables\Kontrak\SuratkontrakList;
use App\Models\DaftarsupplierModel;

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
                    'package' => 'required',
                    'berat_trukpenuh' => 'required',
                    'berat_trukkosong' => 'required',
                ],
                [
                    'tanggal_kedatangan.required' => 'Tanggal Kedatangan wajib diisi',
                    'kodekontrak.required' => 'Kodekontrak wajib diisi',
                    'kendaraan_ke.required' => 'Kendaraan ke wajib diisi',
                    'tipe.required' => 'Tipe wajib diisi',
                    'qty.required' => 'Qty wajib diisi',
                    'package.required' => 'Package wajib diisi',
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
                'package' => $request->package,
                'berat_trukpenuh' => $request->berat_trukpenuh,
                'berat_trukkosong' => $request->berat_trukkosong,
                'nopol' => $request->nopol,
                'driver' => $request->driver,
                'ktp' => $request->ktp,
                'keterangan' => $request->keterangan,
                'dibuat' => Auth::user()->nickname,
                'created_at' => date('Y-m-d H:i:s'),
            ]);
            // for ($i = 1; $i <= $request->qty; $i++) {
            //     // insert data penerimaanitm
            //     GudangpenerimaanitmModel::insert([
            //         'tanggal_kedatangan' => $request->tanggal_kedatangan,
            //         'kodepenerimaan' => $kodepenerimaan,
            //         'subkode' => $kodepenerimaan . '-' . sprintf("%03s", $i),
            //         'nourut' => sprintf("%03s", $i),
            //         'dibuat' => Auth::user()->nickname,
            //         'created_at' => date('Y-m-d H:i:s'),
            //     ]);
            // }
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
    public function getSupir(Request $request)
    {
        $getDriver = DaftarsupplierModel::where('id', $request->id)->first();
        $foto1 = $getDriver->foto1 ? asset('storage/file/pas/' . $getDriver->foto1) : asset('assets/static/pas.jpg');
        $foto2 = $getDriver->foto2 ? asset('storage/file/pas/' . $getDriver->foto2) : asset('assets/static/ktp.jpg');
        echo '
            <div class="row">
                <div class="col-md-6">
                    <label class="form-label">KTP</label>
                    <input type="hidden" name="namaSupir" id="namaSupir" value="' . $getDriver->nama . '">
                    <input type="text" name="ktp" id="ktp"
                        class="form-control mb-3" value="' . $getDriver->noid . '">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Operator</label>
                    <input type="text" name="operator" id="operator" class="form-control"
                        placeholder="Masukkan Nama Operator"
                        value="' . Auth::user()->nickname . '">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Pas Foto</label>
                    <img class="card-img-top" src="' . $foto1 . '"
                        style="width: 100%;max-width: 300px;max-height: 300px" />
                </div>
                <div class="col-md-6">
                    <label class="form-label">Foto KTP</label>
                    <img class="card-img-top" src="' . $foto2 . '"
                        style="width: 100%;max-width: 300px;max-height: 300px" />
                </div>
            </div>
        ';
    }
    public function storeVerifikasi(Request $request)
    {
        try {
            // Validasi untuk menanggulangi error
            $request->validate(
                [
                    'tanggal_kedatangan' => 'required',
                    'qty' => 'required',
                    'package' => 'required',
                    'berat_trukpenuh' => 'required',
                    'berat_trukkosong' => 'required',
                    'nopol' => 'required',
                    'driver' => 'required',
                    // 'signature64Operator' => 'required',
                    // 'signature64Driver' => 'required',
                    'ktp' => 'required',
                    'operator' => 'required',
                ],
                [
                    'tanggal_kedatangan.required' => 'Tanggal Kedatangan wajib diisi',
                    'qty.required' => 'Qty wajib diisi',
                    'package.required' => 'Package wajib diisi',
                    'berat_trukpenuh.required' => 'Berat Truck penuh wajib diisi',
                    'berat_trukkosong.required' => 'Berat Truck kosong wajib diisi',
                    'nopol' => 'Nopol Kendaraan wajib diisi',
                    'driver' => ' Pengemudi Tidak Boleh Kosong',
                    // 'signature64Operator' => 'Tanda tangan operator wajib diisi',
                    // 'signature64Driver' => ' Tanda tangan pengemudi wajib diisi',
                    'ktp' => 'KTP wajib diisi',
                    'operator' => 'Operator wajib diisi',
                ]
            );
            // ambil data kontrak
            $decrypted = Crypt::decryptString($request->idkontrak);
            $getKontrak = GudangpenerimaanModel::where('id', $decrypted)->first();

            $sign_op = null;
            $sign_drv = null;
            $path_op = public_path('sign/operator/');
            $path_drv = public_path('sign/driver/');
            $image_parts_op = explode(";base64,", $request->signedOperator);
            $image_parts_drv = explode(";base64,", $request->signedPengemudi);
            $image_type_aux_op = explode("image/", $image_parts_op[0]);
            $image_type_aux_drv = explode("image/", $image_parts_drv[0]);
            $image_type_op = $image_type_aux_op[1];
            $image_type_drv = $image_type_aux_drv[1];
            $image_base64_op = base64_decode($image_parts_op[1]);
            $image_base64_drv = base64_decode($image_parts_drv[1]);
            $filename_op = date('Ymdhis') . "-" . uniqid() . '.' . $image_type_op;
            $filename_drv = date('Ymdhis') . "-" . uniqid() . '.' . $image_type_drv;
            $sign_op = $path_op . $filename_op;
            $sign_drv = $path_drv . $filename_drv;
            file_put_contents($sign_op, $image_base64_op);
            file_put_contents($sign_drv, $image_base64_drv);

            // insert data penerimaan
            $up = GudangpenerimaanModel::where('id', $decrypted)->update([
                'tanggal_kedatangan' => $request->tanggal_kedatangan,
                'qty' => $request->qty,
                'package' => $request->package,
                'berat_trukpenuh' => $request->berat_trukpenuh,
                'berat_trukkosong' => $request->berat_trukkosong,
                'nopol' => $request->nopol,
                'driver' => $request->namaSupir,
                'operator' => $request->operator,
                'signDriver' => $filename_drv,
                'signOp' => $filename_op,
                'ktp' => $request->ktp,
                'verified' => 1,
                'status' => 2,
                'keterangan' => $request->keterangan,
                'dibuat' => Auth::user()->nickname,
                'created_at' => date('Y-m-d H:i:s'),
            ]);

            for ($i = 1; $i <= $request->qty; $i++) {
                // insert data penerimaanitm
                GudangpenerimaanitmModel::insert([
                    'tanggal_kedatangan' => $request->tanggal_kedatangan,
                    'kodepenerimaan' => $getKontrak->kodepenerimaan,
                    'subkode' => $getKontrak->kodepenerimaan . '-' . sprintf("%03s", $i),
                    'nourut' => sprintf("%03s", $i),
                    'dibuat' => Auth::user()->nickname,
                    'created_at' => date('Y-m-d H:i:s'),
                ]);
            }

            if ($up) {
                return response()->json('Penerimaan Berhasil Diverifikasi');
            }
        } catch (\Illuminate\Database\QueryException $e) {
            // DEBUG IN CASE OF ERROR
            dd($e);
            return response()->json('Penerimaan Berhasil Diverifikasi' . $e);
        }
    }

    public function printPenerimaan(Request $request)
    {
        $decrypted = Crypt::decryptString($request->id);
        $penerimaan = GudangpenerimaanModel::where('id', $decrypted)->first();
        $penerimaanItem = GudangpenerimaanitmModel::where('kodepenerimaan', $penerimaan->kodepenerimaan)->get();
        return view('products/00_print.print_penerimaan', ['penerimaan' => $penerimaan, 'penerimaanItem' => $penerimaanItem]);
    }
    public function printBarcode(Request $request)
    {
        $decrypted = Crypt::decryptString($request->kodepenerimaan);
        $penerimaanItem = GudangpenerimaanitmModel::where('kodepenerimaan', $decrypted)->get();
        return view('products/00_print.print_penerimaan_barcode', ['penerimaanItem' => $penerimaanItem]);
    }
}
