<?php

namespace App\Http\Controllers;

use Dompdf\Dompdf;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\SuratkontrakModel;
use App\Models\DaftarsupplierModel;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use App\Models\GudangpenerimaanModel;
use Illuminate\Support\Facades\Crypt;
use App\Models\GudangpenerimaanitmModel;
use App\Http\Controllers\_01_Datatables\Kontrak\SuratkontrakList;
use App\Models\DaftarJenisModel;
use App\Models\SuratkontrakitmModel;

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
            $data = SuratkontrakitmModel::where('tipe', 'LIKE', "%$search%")
                ->where('status', '>', 0)
                ->orderBy('tipe')
                ->get();
        } else {
            $data = SuratkontrakitmModel::where('status', '>', 0)->get();
        }
        return Response()->json($data);
    }

    public function getTipeByKode(Request $request)
    {
        $getTipe = SuratkontrakitmModel::where('id', $request->id)->get();
        foreach ($getTipe as $key => $value) {
            echo $value->tipe;
        }
    }

    public function getJeniss()
    {
        $jenisData = DaftarJenisModel::select('id', 'nama_jenis')->get();
        return response()->json($jenisData);
    }

    public function storePenerimaan(Request $request)
    {
        try {
            // Validasi untuk menanggulangi error
            $request->validate(
                [
                    'tanggal' => 'required',
                    'nopol' => 'required',
                    'nik' => 'required',
                    'driver' => 'required',
                ],
                [
                    'tanggal.required' => 'Tanggal Kedatangan wajib diisi',
                    'nopol.required' => 'Nomor Polisi wajib diisi',
                    'nik.required' => 'NIK KTP wajib diisi',
                    'driver.required' => 'Pengemudi wajib diisi',
                ]
            );
            //generate noform
            $checknpb = GudangpenerimaanModel::orderBy('npb', 'desc')->first();
            if ($checknpb) {
                $y = substr($checknpb->npb, 0, 3);
                if ($y == 'P' . date('y')) {
                    $query = GudangpenerimaanModel::where(
                        'npb',
                        'like',
                        '%' . 'P' . date('y') . '%'
                    )->orderBy('npb', 'desc')->first();
                    $noUrut = (int) substr($query->npb, -4);
                    $noUrut++;
                    $char = 'P' . date('y');
                    $kode_npb = $char . sprintf("%04s", $noUrut);
                } else {
                    $kode_npb = 'P' . date('y') . "0001";
                }
            } else {
                $kode_npb = 'P' . date('y') . "0001";
            }
            // insert data penerimaan
            GudangpenerimaanModel::insert([
                'tanggal' => $request->tanggal,
                'npb' => $kode_npb,
                'nopol' => $request->nopol,
                'ktp' => $request->nik,
                'driver' => $request->driver,
                'operator' => Auth::user()->nickname,
                'keterangan' => $request->keterangan,
                'dibuat' => Auth::user()->nickname,
                'created_at' => date('Y-m-d H:i:s'),
            ]);
            // insert data penerimaan item
            for ($i = 0; $i < count($request->id); $i++) {
                $dataKontrak = SuratkontrakitmModel::findOrFail($request->id[$i]);
                // $dataKontrak = SuratkontrakitmModel::where('id', $request->id[$i])->first();
                GudangpenerimaanitmModel::insert([
                    'tanggal' => $request->tanggal,
                    'npb' => $kode_npb,
                    'kodekontrak' => $dataKontrak->id_kontrak,
                    'tipe' => $dataKontrak->tipe,
                    'kategori' => $dataKontrak->kategori,
                    'warna' => $dataKontrak->warna,
                    'qty' => $request->qty[$i],
                    'package' => '',
                    // 'berat_trukpenuh' => '',
                    // 'berat_trukkosong' => '',
                    'dibuat' => Auth::user()->nickname,
                    'created_at' => date('Y-m-d H:i:s'),
                ]);

                $dataKontrak->update([
                    'status' => 2,
                    'updated_at' => now(),
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
        return view('products/00_print.print_penerimaan_qrcode', ['penerimaanItem' => $penerimaanItem]);
        // $pdf = Pdf::loadView('pdf.invoice', $penerimaanItem);
        // return $pdf->download('invoice.pdf');
        // $data = [
        //     'title' => 'Welcome to ItSolutionStuff.com',
        //     'date' => date('m/d/Y'),
        //     'penerimaanItem' => $penerimaanItem,
        // ];
        // $pdf = PDF::loadView('products/00_print.print_penerimaan_barcode', $data);
        // return $pdf->download('itsolutionstuff.pdf');


        // $dompdf = new Dompdf();
        // $dompdf->loadHtml('<h1>hello world</h1>');
        // $dompdf->render();
        // $dompdf->stream("", ["Attachment" => false]);
    }

    public function scanner()
    {
        return view('products.03_gudang.scan_barcode', [
            'active' => 'Scanner',
            'judul' => 'Scanner Barcode',
        ]);
    }

    public function checkPenerimaan(Request $request)
    {
        if ($request->jml <= 0) {
            echo '<center><iframe src="https://lottie.host/embed/94d605b9-2cc4-4d11-809a-7f41357109b0/OzwBgj9bHl.json" width="300px" height="300px"></iframe></center>';
            echo "<center>Tidak ada data yang dipilih</center>";
        } else {
            echo '
                <div class="row">
                    <div class="col-md-6 mb-2">
                        <label class="form-label">Tanggal</label>
                        <input type="date" name="tanggal" id="tanggal" class="form-control" value="' . date("Y-m-d") . '">
                    </div>
                    <div class="col-md-6 mb-2">
                        <label class="form-label">No. Pol. Kendaraan</label>
                        <input type="text" name="nopol" id="nopol" class="form-control" Placeholder="Cth: E 123 ABC">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">NIK KTP</label>
                        <input type="text" name="nik" id="nik" class="form-control" placeholder="16 Karakter NIK dalam KTP">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Nama Supir</label>
                        <input type="text" name="driver" id="driver" class="form-control" placeholder="Nama Supir">
                    </div>
                </div>
                <table class="table table-transparent table-responsive">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 1%"></th>
                            <th class="text-center" style="width: 1%">No. Form</th>
                            <th>Product</th>
                            <th class="text-center" style="width: 15%">Berat (Kg)</th>
                            <th class="text-center" style="width: 15%">Qty</th>
                        </tr>
                    </thead>
                    <tbody>
                    ';
            $z = 1;
            for ($i = 0; $i < $request->jml; $i++) {
                $data = SuratkontrakitmModel::where('id_kontrak', $request->id[$i])->first();
                echo '
                        <tr>
                            <td class="text-center">' . $z . '</td>
                            <td class="text-center"><strong>' . $data->noform . '</strong></td>
                            <td>
                                <p class="strong mb-1">' . substr($data->id_kontrak, 0, 3) . '-' . substr($data->id_kontrak, 3, 5) . '</p>
                                <div class="text-secondary">' . $data->tipe . ' ' . $data->kategori . ' ' . $data->warna . '</div>
                            </td>
                            <td class="text-center" style="vertical-align: baseline;">
                                <span class="badge badge-outline text-dark">' . $data->berat . '</span>
                            </td>
                            <td class="text-center">
                                <input type="hidden" name="id[]" value="' . $data->id . '">
                                <input type="number" min="1" name="qty[]" id="qty" class="form-control" value="0">
                            </td>
                        </tr>
                        ';
                $z++;
            }
            echo '
                    </tbody>
                </table>
                <div class="row">
                    <div class="col-md-12 mt-0">
                        <label class="form-label">Catatan</label>
                        <textarea name="keterangan" id="keterangan" class="form-control"></textarea>
                    </div>
                </div>
            ';
        }
    }
}
