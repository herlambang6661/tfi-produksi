<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DaftartipeModel;
use App\Models\DaftarTipeSubKategoriModel;
use App\Models\DaftarwarnaModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use App\Models\GudangpenerimaanqrModel;
use App\Models\GudangpenerimaanitmModel;
use Carbon\Carbon;

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
            echo 'Formulir tidak boleh kosong 
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
                ->leftJoin('gudang_penerimaanitm as p', 'q.npb', '=', 'p.npb')
                ->orderBy('q.subkode', 'asc')
                ->get();
            echo '
            <input type="hidden" id="resultCommand" value=">> ' . count($hasil) . ' Item ditemukan">
            Hasil : <b>' . count($hasil) . '</b> Item untuk pencarian : "<i>' . ($noQR == "%%" ? "" : $request->noQR . ",") . ' ' . ($npb == "%%" ? "" : $request->npb . ",") . ' ' . ($idKontrak == "%%" ? "" : $request->idKontrak . ",") . ' ' . ($tipe == "%%" ? "" : $getType->nama . ",") . ' ' . ($kategori == "%%" ? "" : $getKategori->nama_kategori . ",") . ' ' . ($warna == "%%" ? "" : $getWarna->warna . ",") . ' ' . ($tanggal == "%%" ? "" : $request->tanggal . ",") . ' ' . ($supplier == "%%" ? "" : $request->supplier) . '</i>"
            <br>
            <div class="table-responsive" style="max-height: 250px;">
                <table class="text-nowrap table card-table table-vcenter" style="width:100%;color:black;text-transform:uppercase;font-size: 12px">
                    <thead class="fw-bold">
                        <tr>
                            <td style="width: 1%"></td>
                            <td style="width: 1%">KodeBale</td>
                            <td style="width: 1%">KodeKontrak</td>
                            <td style="width: 1%">NPB</td>
                            <td style="width: 1%">Berat</td>
                            <td style="width: 1%">Package</td>
                            <td style="width: 1%">Tipe</td>
                            <td style="width: 1%">Kategori</td>
                            <td style="width: 1%">Warna</td>
                            <td style="width: 1%">supplier</td>
                            <td class="text-center" style="width: 1%">Tgl Kedatangan</td>
                        </tr>
                    </thead>';
            if (count($hasil) == 0) {
                echo '
                <tbody>
                    <tr>
                        <td colspan="11" class="text-center fw-bold fst-italic">Tidak dapat menemukan data, silahkan gunakan kata kunci lain</td>
                    </tr>
                </tbody>
                ';
            } else {
                foreach ($hasil as $key) {
                    echo    '<tbody>';
                    echo            '<td class="text-center">
                                        <button type="button" class="btn btn-icon btn-blue tambahkebawah" data-id="' . $key->id . '" data-subkode="' . $key->subkode . '" data-tipe="' . $key->type . '" data-kategori="' . $key->kategori . '" data-warna="' . $key->warna . '" data-package="' . $key->package . '" data-beratsatuan="' . $key->berat_satuan . '" data-supplier="' . $key->supplier . '">
                                            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-download"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2" /><path d="M7 11l5 5l5 -5" /><path d="M12 4l0 12" /></svg>
                                        </button>
                                    </td>';
                    echo            '<td class="text-center fw-bold">' . $key->subkode . '</td>';
                    echo            '<td class="text-center">' . $key->kodekontrak . '</td>';
                    echo            '<td class="text-center">' . $key->npb . '</td>';
                    echo            '<td class="text-center">' . $key->berat_satuan . '</td>';
                    echo            '<td class="text-center">' . $key->package . '</td>';
                    echo            '<td class="text-center">' . $key->type . '</td>';
                    echo            '<td class="text-center">' . $key->kategori . '</td>';
                    echo            '<td class="text-center">' . $key->warna . '</td>';
                    echo            '<td class="text-center">' . $key->supplier . '</td>';
                    echo            '<td>' . Carbon::parse($key->tanggalPR)->format('d/m/Y') . ' </td>';
                    echo        '</tbody>';
                }
            }
            echo    '</table>
            </div>
        ';
        }
    }
}
