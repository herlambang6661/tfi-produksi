<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\DaftartipeModel;
use App\Models\DaftarwarnaModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use App\Models\GudangpenerimaanqrModel;
use App\Models\ProduksipengebonanModel;
use App\Models\GudangpenerimaanitmModel;
use App\Models\DaftarTipeSubKategoriModel;
use App\Models\ProduksipengebonanitmModel;

class ProduksiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        date_default_timezone_set('Asia/Jakarta');
        setlocale(LC_TIME, 'id_ID');
        \Carbon\Carbon::setLocale('id');
    }
    public function pengebonan()
    {
        return view('products.04_produksi.pengebonan', [
            'active' => 'Pengebonan',
            'judul' => 'Pengebonan',
        ]);
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
                if ($itmQR->usable == '1') {
                    // if ($itmQR->status == 4) {
                    //     return response()->json([
                    //         'success' => false,
                    //         'message' => 'Tidak Dapat Diproses',
                    //         'detail' => 'Package Sudah Pernah Diproses',
                    //     ]);
                    // } else {
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
                    // }
                } else {
                    return response()->json([
                        'success' => false,
                        'message' => 'Tidak Dapat Diproses',
                        'detail' => 'Package Belum Berupa Jumbo Bag',
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

    public function filterItem(Request $request)
    {
        if (!$request->noQR) {
            $noQR = '%%';
        } else {
            $noQR = '%' . $request->noQR . '%';
        }
        if (!$request->idKontrak) {
            $idKontrak = '%%';
        } else {
            $idKontrak = '%' . $request->idKontrak . '%';
        }
        if (!$request->npb) {
            $npb = '%%';
        } else {
            $npb = '%' . $request->npb . '%';
        }
        if (!$request->supplier) {
            $supplier = '%%';
        } else {
            $supplier = '%' . $request->supplier . '%';
        }
        if (!$request->tanggal) {
            $tanggal = '%%';
        } else {
            $tanggal = '%' . $request->tanggal . '%';
        }
        if (!$request->tipe) {
            $tipe = '%%';
        } else {
            $getType = DaftartipeModel::select('nama')->where('id', $request->tipe)->first();
            $tipe = '%' . $getType->nama . '%';
        }
        if (!$request->kategori) {
            $kategori = '%%';
        } else {
            $getKategori = DaftarTipeSubKategoriModel::select('nama_kategori')->where('id', $request->kategori)->first();
            $kategori = '%' . $getKategori->nama_kategori . '%';
        }
        if (!$request->warna) {
            $warna = '%%';
        } else {
            $getWarna = DaftarwarnaModel::select('warna')->where('id', $request->warna)->first();
            $warna = '%' . $getWarna->warna . '%';
        }
        if ($noQR == "%%" && $idKontrak == "%%" && $npb == "%%" && $supplier == "%%" && $tanggal == "%%" && $tipe == "%%" && $kategori == "%%" && $warna == "%%") {
            echo '
                <input type="hidden" id="resultCommand" value=">> Tidak Dapat Menemukan Data, Formulir filter kosong">
            ';
        } else {
            $hasil = DB::table('gudang_penerimaanqrcode as q')
                ->select('q.*', 'p.kategori', 'p.warna', 'p.supplier', 'p.tanggal as tanggalPR')
                ->where('q.usable', '1')
                ->where('q.status', '1')
                ->where('q.subkode', 'like', $noQR)
                ->where('q.npb', 'like', $npb)
                ->where('q.kodeKontrak', 'like',  $idKontrak)
                ->where('q.type', 'like', $tipe)
                ->where('p.kategori', 'like', $kategori)
                ->where('p.warna', 'like', $warna)
                ->where('p.tanggal', 'like', $tanggal)
                ->where('p.supplier', 'like', $supplier)
                ->leftJoin('gudang_penerimaanitm as p', 'q.kodekontrak', '=', 'p.kodekontrak')
                ->orderBy('q.subkode', 'asc')
                ->get();
            echo '
            <input type="hidden" id="resultCommand" value=">> ' . count($hasil) . ' Item ditemukan">
        ';
        }
    }

    public function storedataPengebonan(Request $request)
    {
        try {
            // generate form
            $getForm = ProduksipengebonanModel::where('formproduksi', 'like', 'PR' . date('y') . '%')->where('status', '>', 0)->latest('id')->first();
            if ($getForm != null) {
                $nformulir = $getForm->formproduksi;
                $noUrutForm = (int) substr($nformulir, -5);
                $noUrutForm++;
                $nomorform = 'PR' . date('y') . sprintf("%05s", $noUrutForm);
            } else {
                $nomorform = "PR" . date('y') . "00001";
            }
            ProduksipengebonanModel::create([
                'tanggal' => $request->tanggal,
                'formproduksi' => $nomorform,
                'operator' => $request->operator,
                'dibuat' => Auth::user()->nickname,
                'created_at' => date('Y-m-d H:i:s'),
            ]);
            for ($i = 0; $i < count($request->id_item); $i++) {
                // generate kodeproduksi
                $getCode = ProduksipengebonanitmModel::where('kodeproduksi', 'like',  date('y') . '%')->where('status', '>', 0)->latest('id')->first();
                if ($getCode != null) {
                    $codeProduct = $getCode->kodeproduksi;
                    $noUrutKode = (int) substr($codeProduct, -5);
                    $noUrutKode++;
                    $code = date('y') . sprintf("%05s", $noUrutKode);
                } else {
                    $code = date('y') . "00001";
                }
                $getItem = GudangpenerimaanqrModel::where('id', $request->id_item[$i])->first();
                $getdesc = GudangpenerimaanitmModel::where('npb', $getItem->npb)->first();
                $insert = ProduksipengebonanitmModel::create([
                    'tanggal' => $request->tanggal,
                    'formproduksi' => $nomorform,
                    'kodeproduksi' => $code,
                    'subkode' => $getItem->subkode,
                    'package' => $getItem->package,
                    'type' => $getItem->type,
                    'kategori' => $getdesc->kategori,
                    'warna' => $getdesc->warna,
                    'berat' => $getItem->berat_satuan,
                    'operator' => $request->operator,
                    'dibuat' => Auth::user()->nickname,
                    'created_at' => date('Y-m-d H:i:s'),
                ]);

                $update = GudangpenerimaanqrModel::where('id', $request->id_item[$i])->update([
                    'status' => 2, //ganti status menjadi diproses, tetapi belum diproduksi karena menunggu persetujuan produksi
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);
            }
            return response()->json([
                'success' => true,
                'message' => 'Data Pengebonan telah berhasil disimpan',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }
}
