<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Models\GudangpenerimaanqrModel;
use App\Models\GudangpenerimaanitmModel;

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
}
