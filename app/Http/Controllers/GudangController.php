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
use App\Models\GudangpenerimaanqrModel;
use App\Models\SuratkontrakitmModel;
use Svg\Tag\Rect;

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

                    $urut = 1;
                    for ($j = 0; $j < $request->qty[$i]; $j++) {
                        // insert data penerimaan QRCode
                        GudangpenerimaanqrModel::insert([
                            'tanggal' => $request->tanggal,
                            'npb' => $request->npb,
                            'kodekontrak' => $dataItmKontrak->kodekontrak,
                            'subkode' => $dataItmKontrak->kodekontrak . "-" .  $request->kedatangan_ke[$i] . "-" . sprintf("%03s", $urut),
                            'nourut' => sprintf("%03s", $j),
                            'berat_satuan' => ($request->berat_penuh[$i] - $request->berat_kosong[$i]) / $request->qty[$i],
                            'berat_total' => $request->berat_penuh[$i] - $request->berat_kosong[$i],
                            'qty_total' => $request->qty[$i],
                            'type' => $dataItmKontrak->tipe,
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

    public function cancelOrder(Request $request)
    {
        SuratkontrakitmModel::where('id', '=', $request->id)->update([
            'status' => $request->status,
        ]);

        return response()->json('Record canceled successfully');
    }
}
