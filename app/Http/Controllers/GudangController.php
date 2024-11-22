<?php

namespace App\Http\Controllers;

use Svg\Tag\Rect;
use Dompdf\Dompdf;
use Illuminate\Http\Request;
use App\Models\DaftartipeModel;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\DaftarJenisModel;
use App\Models\DaftarwarnaModel;
use App\Models\SuratkontrakModel;
use PHPUnit\Event\Code\Throwable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use App\Models\SuratkontrakitmModel;
use Illuminate\Support\Facades\Auth;
use App\Models\GudangpenerimaanModel;
use App\Models\GudangpengolahanModel;
use Illuminate\Support\Facades\Crypt;
use App\Models\GudangpenerimaanqrModel;
use App\Models\GudangpenerimaanitmModel;
use App\Models\GudangpengolahanitmModel;
use App\Models\DaftarTipeSubKategoriModel;

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
                $getSupplier = SuratkontrakModel::select('supplier')->where('noform', $dataKontrak->noform)->first();
                // $dataKontrak = SuratkontrakitmModel::where('id', $request->id[$i])->first();
                GudangpenerimaanitmModel::insert([
                    'tanggal' => $request->tanggal,
                    'npb' => $kode_npb,
                    'kodekontrak' => $dataKontrak->id_kontrak,
                    'tipe' => $dataKontrak->tipe,
                    'kategori' => $dataKontrak->kategori,
                    'warna' => $dataKontrak->warna,
                    'berat' => $request->berat[$i],
                    'qty' => $request->qty[$i],
                    'supplier' => $getSupplier->supplier,
                    'status' => 2,
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
        $verifikasi = GudangpenerimaanModel::where('npb', $decrypted)->first();
        $verifikasiItm = GudangpenerimaanitmModel::where('npb', $decrypted)->get();
        return view('products.03_gudang.verifikasi', [
            'active' => 'Penerimaan',
            'judul' => 'Verifikasi kedatangan',
            'verifikasi' => $verifikasi,
            'verifikasiItm' => $verifikasiItm,
        ]);
    }
    public function printQrcode($id)
    {
        $decrypted = Crypt::decryptString($id);
        // $form = GudangpenerimaanModel::where('npb', $decrypted)->first();
        $formItem = GudangpenerimaanitmModel::where('kodekontrak', $decrypted)->get();
        $formQR = GudangpenerimaanqrModel::where('kodekontrak', $decrypted)->get();
        return view('products.03_gudang.printQR', [
            'active' => 'Penerimaan',
            'judul' => 'Print Qrcode',
            'kodekontrak' => $decrypted,
            'formItem' => $formItem,
            'formQR' => $formQR,
        ]);
    }
    public function getPackage(Request $request)
    {
        if ($request->has('q')) {
            $search = $request->q;
            $pkg = DaftarJenisModel::where('nama_jenis', 'LIKE', "%$search%")
                ->orderBy('nama_jenis')
                ->get();
        } else {
            $pkg = DaftarJenisModel::all();
        }
        return Response()->json($pkg);
    }
    public function storeVerifikasi(Request $request)
    {
        try {
            // Validasi untuk menanggulangi error
            $request->validate(
                [
                    'tanggal' => 'required',
                    'nopol' => 'required',
                    'ktp' => 'required',
                    'driver' => 'required',
                    'operator' => 'required',
                    'idkontrak' => 'required',
                ],
                [
                    'tanggal.required' => 'Tanggal Kedatangan wajib diisi',
                    'nopol.required' => 'Nomor Polisi wajib diisi',
                    'ktp.required' => 'Nomor KTP wajib diisi',
                    'driver.required' => 'Nama Supir wajib diisi',
                    'operator.required' => 'Operator wajib diisi',
                    'idkontrak.required' => 'Nomor Kontrak wajib diisi',
                ]
            );
            // ambil data kontrak
            $decrypted = Crypt::decryptString($request->idkontrak);

            $sign_op = null;
            $sign_drv = null;
            $path_op = public_path('sign/operator/');
            $path_drv = public_path('sign/driver/');
            $image_parts_op = explode(";base64,", $request->signedOperator);
            $image_parts_drv = explode(";base64,", $request->signedPengemudi);
            $image_type_aux_op = explode("image/", $image_parts_op[0]);
            $image_type_aux_drv = explode("image/", $image_parts_drv[0]);
            if (!array_key_exists(1, $image_type_aux_op)) {
                return response()->json(['msg' => 'Tanda Tangan Operator wajib diisi', 'status' => false]);
            }
            if (!array_key_exists(1, $image_type_aux_drv)) {
                return response()->json(['msg' => 'Tanda Tangan Driver wajib diisi', 'status' => false]);
            }
            $image_type_op = $image_type_aux_op[1];
            $image_type_drv = $image_type_aux_drv[1];
            $image_base64_op = base64_decode($image_parts_op[1]);
            $image_base64_drv = base64_decode($image_parts_drv[1]);
            $filename_op = 'operator-' . $decrypted . "-" . date('Ymdhis') . '.' . $image_type_op;
            $filename_drv = 'driver-' . $decrypted . "-" . date('Ymdhis') . '.' . $image_type_drv;
            $sign_op = $path_op . $filename_op;
            $sign_drv = $path_drv . $filename_drv;
            file_put_contents($sign_op, $image_base64_op);
            file_put_contents($sign_drv, $image_base64_drv);

            for ($i = 0; $i < count($request->idItm); $i++) {
                if ($request->statusDel[$i] == '1') {
                    // update data penerimaanitm dengan status 0
                    GudangpenerimaanitmModel::where('id', $request->idItm[$i])->update([
                        'status' => 0,
                        'dibuat' => Auth::user()->nickname,
                        'updated_at' => date('Y-m-d H:i:s'),
                    ]);
                } else {
                    // update data penerimaanitm dengan status 3 dan verifikasi
                    GudangpenerimaanitmModel::where('id', $request->idItm[$i])->update([
                        'tanggal' => $request->tanggal,
                        'qty' => $request->qty[$i],
                        'package' => $request->jenis[$i],
                        'kedatangan_ke' => $request->kedatangan_ke[$i],
                        'berat' => $request->berat[$i],
                        'berat_trukpenuh' => $request->berat_penuh[$i],
                        'berat_trukkosong' => $request->berat_kosong[$i],
                        'verified' => 1,
                        'status' => 3,
                        'dibuat' => Auth::user()->nickname,
                        'updated_at' => date('Y-m-d H:i:s'),
                    ]);
                    $dataItmKontrak = GudangpenerimaanitmModel::where('id', $request->idItm[$i])->first();

                    // UNDONE, Compare berat kedatangan dengan berat kontrak 
                    $dataSurat = SuratkontrakitmModel::where('id_kontrak', $dataItmKontrak->kodekontrak)->first();
                    if ($dataSurat->berat == $dataItmKontrak->berat) {
                        # code...
                    }
                    if (stripos($request->jenis[$i], 'Jumbo Bag') !== FALSE) {
                        $usable = 1;
                    } else {
                        $usable = 0;
                    }

                    $urut = 1;
                    for ($j = 0; $j < $request->qty[$i]; $j++) {
                        // insert data penerimaan QRCode
                        GudangpenerimaanqrModel::insert([
                            'tanggal' => $request->tanggal,
                            'npb' => $request->npb,
                            'kodekontrak' => $dataItmKontrak->kodekontrak,
                            'subkode' => $dataItmKontrak->kodekontrak . "-" .  $request->kedatangan_ke[$i] . "-" . sprintf("%03s", $urut),
                            'nourut' => sprintf("%03s", $urut),
                            'berat_satuan' => ($request->berat_penuh[$i] - $request->berat_kosong[$i]) / $request->qty[$i],
                            'berat_total' => $request->berat_penuh[$i] - $request->berat_kosong[$i],
                            'qty_total' => $request->qty[$i],
                            'type' => $dataItmKontrak->tipe,
                            'package' => $request->jenis[$i],
                            'usable' => $usable,
                            'dibuat' => Auth::user()->nickname,
                            'created_at' => now(),
                        ]);
                        $urut++;
                    }
                }
            }

            // insert data penerimaan
            $up = GudangpenerimaanModel::where('npb', $decrypted)->update([
                'tanggal' => $request->tanggal,
                'nopol' => $request->nopol,
                'ktp' => $request->ktp,
                'driver' => $request->driver,
                'operator' => $request->operator,
                'signDriver' => $filename_drv,
                'signOp' => $filename_op,
                'keterangan' => $request->keterangan,
                'verified' => 1,
                'status' => 2,
                'dibuat' => Auth::user()->nickname,
                'updated_at' => date('Y-m-d H:i:s'),
            ]);

            if ($up) {
                return response()->json(['msg' => 'Penerimaan Berhasil Diverifikasi', 'status' => true]);
                // return response()->json('Penerimaan Berhasil Diverifikasi');
            }
        } catch (\Illuminate\Database\QueryException $e) {
            // DEBUG IN CASE OF ERROR
            // dd($e);
            return response()->json(['msg' => 'Error ' . $e, 'status' => false]);
            // return response()->json('Penerimaan Berhasil Diverifikasi' . $e);
        }
    }

    public function printPenerimaan(Request $request)
    {
        $decrypted = Crypt::decryptString($request->id);
        $penerimaan = GudangpenerimaanModel::where('npb', $decrypted)->first();
        $penerimaanItem = GudangpenerimaanitmModel::where('npb', $decrypted)->get();
        return view('products/00_print.print_penerimaan', ['penerimaan' => $penerimaan, 'penerimaanItem' => $penerimaanItem]);
    }
    public function printBarcode($id)
    {
        $decrypted = Crypt::decryptString($id);
        $penerimaanItem = GudangpenerimaanqrModel::where('kodekontrak', $decrypted)->get();
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
                    <script>
                        $("#nik").on("change", function() {
                            var nik = $(this).val();
                            $.ajax({
                                url: "/getdriver",
                                data: {
                                    nik: nik,
                                },
                                type: "POST",
                                beforeSend: function() {
                                    $("#driver").val("Memeriksa Data...");
                                    $("#driver").prop("disabled", true);
                                    $("#driver").addClass("cursor-not-allowed");
                                },
                                success: function(response) {
                                    $("#driver").val(response);
                                    $("#driver").prop("disabled", false);
                                    $("#driver").removeClass("cursor-not-allowed");
                                },
                                error: function(data) {
                                    $("#driver").val("");
                                    $("#driver").prop("disabled", false);
                                }
                            });
                        });
                    </script>
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
                                <input type="number" min="1" name="berat[]" class="form-control" value="' . $data->berat . '">
                            </td>
                            <td class="text-center">
                                <input type="hidden" name="id[]" value="' . $data->id . '">
                                <input type="number" min="1" name="qty[]" class="form-control" value="0">
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

    public function getdriver(Request $request)
    {
        try {
            $driver = GudangpenerimaanModel::where('ktp', $request->nik)->latest()->first();
            return $driver->driver;
        } catch (\Throwable $th) {
            return '';
        }
    }

    public function getDecryptKode(Request $request)
    {
        try {
            if ($request->type == 'scan') {
                $decrypted = Crypt::decryptString($request->keyword);
            } elseif ($request->type == 'text') {
                $decrypted = $request->keyword;
            }
            $itmQR = GudangpenerimaanqrModel::where('subkode', $decrypted)->first();
            $itmPR = GudangpenerimaanitmModel::where('npb', $itmQR->npb)->first();
            // return $kode->subkode;
            if (empty($itmQR)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Kode Tidak Dikenali',
                    'detail' => 'Cek kembali QRcode yang Anda Scan',
                ]);
            } else {
                if ($itmQR->usable == '0') {
                    if ($itmQR->status == 4) {
                        return response()->json([
                            'success' => false,
                            'message' => 'Tidak Dapat Diproses',
                            'detail' => 'Package Sudah Pernah Diproses',
                        ]);
                    } else {
                        return response()->json([
                            'success' => true,
                            'message' => 'Kode Ditemukan',
                            'id' => $itmQR->id,
                            'npb' => $itmQR->npb,
                            'kodekontrak' => $itmQR->kodekontrak,
                            'subkode' => $itmQR->subkode,
                            'nourut' => $itmQR->nourut,
                            'beratsatuan' => $itmQR->berat_satuan,
                            'package' => $itmQR->package,
                            'tipe' => $itmQR->type,
                            'kategori' => $itmPR->kategori,
                            'warna' => $itmPR->warna,
                            'supplier' => $itmPR->supplier,
                        ]);
                    }
                } else {
                    return response()->json([
                        'success' => false,
                        'message' => 'Tidak Dapat Diproses',
                        'detail' => 'Package Sudah Berupa Jumbo Bag',
                    ]);
                }
            }
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Kode Tidak Dikenali',
                'detail' => 'Cek kembali QRcode yang Anda Scan',
            ]);
        }
    }

    public function cancelOrder(Request $request)
    {
        SuratkontrakitmModel::where('id', '=', $request->id)->update([
            'status' => $request->status,
        ]);

        return response()->json('Record canceled successfully');
    }

    public function detailPenerimaan(Request $request)
    {
        $verifikasi = GudangpenerimaanModel::where('npb', $request->id)->first();
        $verifikasiItm = GudangpenerimaanitmModel::where('npb', $request->id)->get();

        if ($verifikasi) {
            echo '
            <input type="hidden" id="id" name="id" value="' . $verifikasi->id . '">
            <style type="text/css">
                @media screen {
                    div#headerPrint {
                        display: none;
                    }
                }
                @media print {
                    div#headerPrint {
                        display: block;
                    }
                }
                #modalContent {
                    padding: 20px; /* Adds padding around all content */
                }
                #headerPrint {
                    font-style: italic;
                    margin-bottom: 10px;
                    text-align: left;
                }
                .detail-section {
                    margin-bottom: 15px;
                    padding: 0 10px;
                }
                .detail-item {
                    margin-bottom: 5px;
                    display: flex;
                    flex-direction: column;
                }
                .detail-item label {
                    font-weight: bold;
                    margin-bottom: 2px;
                }
                .detail-item p {
                    margin: 0;
                }
                table {
                    width: 100%;
                    margin-top: 20px;
                    border-collapse: collapse;
                }
                table th, table td {
                    padding: 10px;
                    border: 1px solid #ddd;
                }
                table th {
                    background-color: #e9f5e9;
                    font-weight: bold;
                    text-align: center;
                }
                table td {
                    text-align: center;
                }
                .signature-table {
                    margin-top: 20px;
                    border: 1px solid #000;
                    width: 100%;
                }
                .signature-table td {
                    padding: 10px;
                    border: 1px solid #000;
                    text-align: center;
                }
                .signature-table img {
                    max-height: 60px;
                    margin-top: 5px;
                    display: block;
                }
            </style>

            <div id="modalContent">

                <div class="detail-section">
                    <div class="detail-item">
                        <label class="form-label">Nomor Penerimaan Barang: ' . $verifikasi->npb . '</label>
                    </div>
                    <div class="detail-item">
                        <label class="form-label">Tanggal: ' . $verifikasi->tanggal . '</label>
                    </div>
                    <div class="detail-item">
                        <label class="form-label">Nopol: ' . $verifikasi->nopol . '</label>
                    </div>
                    <div class="detail-item">
                        <label class="form-label">NIK KTP: ' . $verifikasi->ktp . '</label>
                    </div>
                    <div class="detail-item">
                        <label class="form-label">Pengemudi: ' . $verifikasi->driver . '</label>
                    </div>
                    <div class="detail-item">
                        <label class="form-label">Operator: ' . $verifikasi->operator . '</label>
                    </div>
                    <div class="detail-item">
                        <label class="form-label">Catatan: ' . nl2br(htmlspecialchars($verifikasi->keterangan)) . '</label>
                    </div>
                </div>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Berat (Kontrak)</th>
                            <th>Berat Truk Penuh</th>
                            <th>Berat Truk Kosong</th>
                            <th>Qty</th>
                            <th>Kedatangan Ke</th>
                            <th>Jenis Satuan</th>
                        </tr>
                    </thead>
                    <tbody>';

            foreach ($verifikasiItm as $no => $data) {
                echo '
                        <tr>
                            <td>' . $data->berat . '</td>
                            <td>' . $data->berat_trukpenuh . '</td>
                            <td>' . $data->berat_trukkosong . '</td>
                            <td>' . $data->qty . '</td>
                            <td>' . $data->kedatangan_ke . '</td>
                            <td>' . $data->package . '</td>
                        </tr>';
            }

            echo '
                    </tbody>
                </table>

                <table class="signature-table">
                    <tr>
                        <td style="width: 30%; text-align: center;">
                            <b>Diserahkan Oleh</b><br>
                            <img src="' . asset('sign/driver/' . $verifikasi->signDriver) . '" alt="Sign Driver" style="display: block; margin: auto;"><br>
                            ' . $verifikasi->driver . '
                        </td>
                        <td style="width: 30%; text-align: center;">
                            <b>Diterima Oleh</b><br>
                            <img src="' . asset('sign/operator/' . $verifikasi->signOp) . '" alt="Sign Operator" style="display: block; margin: auto;"><br>
                            ' . $verifikasi->operator . '
                        </td>
                        <td style="width: 40%; text-align: center;">
                            <b>Mengetahui</b><br>
                            <p style="margin-top: 50px;">____________________</p>
                        </td>
                    </tr>
                </table>
            </div>';
        } else {
            echo '<div>Data not found.</div>';
        }
    }
    public function checkPrintQR(Request $request) {}
    public function pengolahan(Request $request)
    {
        return view('products.03_gudang.pengolahan', [
            'active' => 'Pengolahan',
            'judul' => 'Pengolahan Bahan Baku',
        ]);
    }
    public function storePengolahan(Request $request)
    {
        try {
            // Validasi untuk menanggulangi error
            $request->validate(
                [
                    'tanggal' => 'required',
                    'operator' => 'required',
                    'id_item' => 'required',
                ],
                [
                    'tanggal.required' => 'Tanggal Proses wajib diisi',
                    'operator.required' => 'Operator',
                    'id_item.required' => 'Tidak ada barang yang di scan',
                ]
            );
            //generate noform
            $checkkodeolah = GudangpengolahanModel::orderBy('kodeolah', 'desc')->first();
            if ($checkkodeolah) {
                $y = substr($checkkodeolah->kodeolah, 0, 3);
                if ($y == 'O' . date('y')) {
                    $query = GudangpengolahanModel::where(
                        'kodeolah',
                        'like',
                        '%' . 'O' . date('y') . '%'
                    )->orderBy('kodeolah', 'desc')->first();
                    $noUrut = (int) substr($query->kodeolah, -4);
                    $noUrut++;
                    $char = 'O' . date('y');
                    $kode_olah = $char . sprintf("%04s", $noUrut);
                } else {
                    $kode_olah = 'O' . date('y') . "0001";
                }
            } else {
                $kode_olah = 'O' . date('y') . "0001";
            }
            // insert data Pengolahan
            GudangpengolahanModel::insert([
                'tanggal' => $request->tanggal,
                'kodeolah' => $kode_olah,
                'operator' => $request->operator,
                'dibuat' => Auth::user()->nickname,
                'created_at' => date('Y-m-d H:i:s'),
            ]);
            // insert data Pengolahan item
            for ($i = 0; $i < count($request->id_item); $i++) {
                $dataBales = GudangpenerimaanqrModel::where('id', $request->id_item[$i])->first();
                GudangpengolahanitmModel::insert([
                    'tanggal' => $request->tanggal,
                    'kodeolah' => $kode_olah,
                    'kodekontrak' => $dataBales->subkode,
                    'package' => $dataBales->package,
                    'berat' => $dataBales->berat_satuan,
                    'operator' => $request->operator,
                    'dibuat' => Auth::user()->nickname,
                    'created_at' => date('Y-m-d H:i:s'),
                ]);
                // update Gudang penerimaanqr
                GudangpenerimaanqrModel::where('id', $request->id_item[$i])->update(['status' => '2', 'kodeolah' => $kode_olah, 'updated_at' => date('Y-m-d H:i:s')]); //change status to processed
            }
            $arr = array('msg' => 'Data Pengolahan telah berhasil disimpan. Kode Olah : ' . $kode_olah . '', 'status' => true);
            return Response()->json($arr);
        } catch (\Illuminate\Database\QueryException $e) {
            // DEBUG IN CASE OF ERROR
            // dd($e);
            $arr = array('msg' => 'Something goes to wrong. Please try later. ' . $e, 'status' => false);
        }
    }

    public function prosesPengolahan($id)
    {
        $decrypted = Crypt::decryptString($id);
        $pengolahan = GudangpengolahanModel::where('kodeolah', $decrypted)->first();
        // $pengolahanItm = GudangpengolahanitmModel::where('kodeolah', $decrypted)->get();
        $pengolahanItm = DB::table('gudang_pengolahanitm as o')
            ->select('o.id', 'o.kodekontrak', 'o.package', 'o.berat', 'p.type', 'q.kategori', 'q.warna', 'p.id as id_qr')
            ->where('o.kodeolah', $decrypted)
            ->leftJoin('gudang_penerimaanqrcode as p', 'o.kodekontrak', '=', 'p.subkode')
            ->leftJoin('gudang_penerimaanitm as q', 'p.kodekontrak', '=', 'q.kodekontrak')
            ->get();
        return view('products.03_gudang.pengolahanProses', [
            'active' => 'Pengolahan',
            'judul' => 'Proses Pengolahan Bahan Baku',
            'pengolahan' => $pengolahan,
            'pengolahanItm' => $pengolahanItm,
        ]);
    }

    public function storeFixPengolahan(Request $request)
    {
        // Validasi untuk menanggulangi error
        $request->validate(
            [
                'tipe' => 'required',
                'kategori' => 'required',
                'warna' => 'required',
                'berat' => 'required',
                'qty' => 'required',
                'satuan' => 'required',
                'kedatangan' => 'required',
            ],
            [
                'tipe.required' => 'Kolom Tipe Tidak Boleh Kosong',
                'kategori.required' => 'Kolom Kategori Tidak Boleh Kosong',
                'warna.required' => 'Kolom Warna Tidak Boleh Kosong',
                'berat.required' => 'Kolom Berat Tidak Boleh Kosong',
                'qty.required' => 'Kolom Qty Tidak Boleh Kosong',
                'satuan.required' => 'Kolom Satuan Tidak Boleh Kosong',
                'kedatangan.required' => 'Kolom Kedatangan Tidak Boleh Kosong',
            ]
        );
        try {
            $Pengolahan = GudangpengolahanModel::where('id',  $request->id_pengolahan)->first();
            $list_bahanBaku = GudangpengolahanitmModel::where('kodeolah', $Pengolahan->kodeolah)->get();
            // =================================================================================
            // =================================================================================
            // ============================ Surat Kontrak dan Kontrak Item =====================
            // =================================================================================
            // =================================================================================
            //generate noform
            $checknoform = SuratkontrakModel::where('olahan', '1')->latest('noform')->first();
            if ($checknoform) {
                $y = substr($checknoform->noform, 1, 2);
                if (date('y') == $y) {
                    $query = SuratkontrakModel::where(
                        'noform',
                        'like',
                        '%L' . date('y') . '%'
                    )->orderBy('noform', 'desc')->first();
                    $noUrut = (int) substr($query->noform, -4);
                    $noUrut++;
                    $char = 'L' . date('y-');
                    $kode_noform = $char . sprintf("%04s", $noUrut);
                } else {
                    $kode_noform = 'L' . date('y-') . "0001";
                }
            } else {
                $kode_noform = 'L' . date('y-') . "0001";
            }

            SuratkontrakModel::insert([
                'entitas' => 'TFI',
                'noform' => $kode_noform,
                'tanggal' => $request->tanggal,
                'supplier' => 'Tantra Fiber Industri. PT',
                'dibeli' => '',
                'keterangan' => 'Hasil Olahan Bahan Baku dari ' . implode(', ', $list_bahanBaku->pluck('kodekontrak')->toArray()),
                'lock' => 1,
                'olahan' => 1,
                'dibuat' => Auth::user()->nickname,
                'created_at' => date('Y-m-d H:i:s'),
            ]);

            // for ($i = 0; $i < count($request->tipe); $i++) {
            $gettipe        = DaftartipeModel::where('id', $request->tipe)->first();
            $getkategori    = DaftarTipeSubKategoriModel::where('id', $request->kategori)->first();
            $getwarna       = DaftarwarnaModel::where('id', $request->warna)->first();
            $character = $gettipe->kode . $getkategori->kode_kategori . $getwarna->kode_warna . date('y');

            // generate kodeseri. ex: WBP24001, FBP24001
            $getkodeseri = SuratkontrakitmModel::where('id_kontrak', 'like', '%' . $character . '%')->where('status', '>', 0)->latest('id_kontrak')->first();
            if ($getkodeseri) {
                $kdseri = $getkodeseri->id_kontrak;
                $noUrutKodeseri = (int) substr($kdseri, -3);
                $noUrutKodeseri++;
                $kdseri = $character . sprintf("%03s", $noUrutKodeseri);
            } else {
                $kdseri = $character . "001";
            }
            SuratkontrakitmModel::insert([
                'noform' => $kode_noform,
                'id_kontrak' => $kdseri,
                'tanggal' => $request->tanggal,
                'tipe' => $gettipe->nama,
                'kategori' => $getkategori->nama_kategori,
                'warna' => $getwarna->warna,
                'berat' => $request->berat,
                'harga' => 0,
                'status' => 99, // 99 = proccessed result
                'lock' => 1, // 1 = this item has been locked and can't be deleted
                'dibuat' => Auth::user()->nickname,
                'created_at' => date('Y-m-d H:i:s'),
            ]);
            // }

            // =================================================================================
            // =================================================================================
            // ============================ Penerimaan dan Penerimaan Item =====================
            // =================================================================================
            // =================================================================================
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
                    $char_penerimaan = 'P' . date('y');
                    $kode_npb = $char_penerimaan . sprintf("%04s", $noUrut);
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
                // 'nopol' => $request->nopol,
                // 'ktp' => $request->nik,
                // 'driver' => $request->driver,
                'operator' => Auth::user()->nickname,
                'keterangan' => 'Hasil Olahan Bahan Baku dari ' . implode(', ', $list_bahanBaku->pluck('kodekontrak')->toArray()),
                'status' => 2,
                'verified' => 1,
                'dibuat' => Auth::user()->nickname,
                'created_at' => date('Y-m-d H:i:s'),
            ]);
            // insert data penerimaan item
            GudangpenerimaanitmModel::insert([
                'tanggal' => $request->tanggal,
                'npb' => $kode_npb,
                'kodekontrak' => $kdseri,
                'tipe' => $gettipe->nama,
                'kategori' => $getkategori->nama_kategori,
                'warna' => $getwarna->warna,
                'berat' => $request->berat,
                'qty' => $request->qty,
                'package' => $request->satuan,
                'kedatangan_ke' => $request->kedatangan,
                'supplier' => 'Tantra Fiber Industri. PT',
                'verified' => 1,
                'status' => 99, // 99 = hasil olahan / processed result
                'dibuat' => Auth::user()->nickname,
                'created_at' => date('Y-m-d H:i:s'),
            ]);
            $urut = 1;
            for ($a = 0; $a < $request->qty; $a++) {
                GudangpenerimaanqrModel::insert([
                    'tanggal' => $request->tanggal,
                    'npb' => $kode_npb,
                    'kodekontrak' => $kdseri,
                    'subkode' => $kdseri . "-" .  $request->kedatangan . "-" . sprintf("%03s", $urut),
                    'nourut' => sprintf("%03s", $urut),
                    'berat_satuan' => $request->berat / $request->qty,
                    'berat_total' => $request->berat,
                    'qty_total' => $request->qty,
                    'package' => $request->satuan,
                    'type' => $gettipe->nama,
                    'usable' => 1,
                    'status' => 1,
                    'dibuat' => Auth::user()->nickname,
                    'created_at' => now(),
                ]);
                $urut++;
            }
            for ($i = 0; $i < count($request->id_bahanBaku); $i++) {
                $updateOldQR = GudangpenerimaanqrModel::where('id',  $request->id_bahanBaku[$i])->update([
                    'kodeolah' => $Pengolahan->kodeolah,
                    'kode_berubah' => $kdseri,
                    'status' => 4, // 4 = closed can't be used cause it has been processed
                    'updated_at' => now(),
                ]);
            }
            $updatePengolahan = GudangpengolahanModel::where('id',  $request->id_pengolahan)->update([
                'status' => 3, // 3 = closed
                'updated_at' => now(),
            ]);
            $updatePengolahanItm = GudangpengolahanitmModel::where('kodeolah',  $Pengolahan->kodeolah)->update([
                'status' => 3, // 3 = closed
                'updated_at' => now(),
            ]);

            $arr = array('msg' => 'Data Pengolahan telah berhasil Diproses. Kode berubah menjadi : ' . $kdseri . '', 'status' => true);
            return Response()->json($arr);
        } catch (Throwable $e) {
            // DEBUG IN CASE OF ERROR
            // dd($e);
            $arr = array('msg' => 'Something goes to wrong. Please try later. ' . $e, 'status' => false);
            return Response()->json($arr);
        }
    }
}
