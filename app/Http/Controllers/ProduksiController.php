<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\DaftartipeModel;
use App\Models\DaftarwarnaModel;
use PHPUnit\Event\Code\Throwable;
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
            'active' => 'Planning',
            'judul' => 'Production Planning',
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
    public function getEditDecryptKode(Request $request)
    {
        try {
            if ($request->type == 'scan') {
                $decrypted = Crypt::decryptString($request->keyword);
            } elseif ($request->type == 'text') {
                $decrypted = $request->keyword;
            }
            $itmQR = GudangpenerimaanqrModel::where('subkode', $decrypted)->where('status', '>', '0')->first();
            // return $kode->subkode;
            if (empty($itmQR)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Kode Tidak Dikenali',
                    'detail' => 'Cek kembali QRcode yang Anda Scan',
                ]);
            } else {
                if ($itmQR->usable == '1') {
                    if ($itmQR->status == '1') {
                        // can be processed
                        $itmPR = GudangpenerimaanitmModel::where('npb', $itmQR->npb)->where('kodekontrak', $itmQR->kodekontrak)->where('status', '>', 0)->first();
                        $getDataForm = ProduksipengebonanModel::where('formproduksi', $request->formproduksi)->where('status', '>', 0)->first(); // generate kodeproduksi
                        $getCode = ProduksipengebonanitmModel::where('kodeproduksi', 'like',  date('y') . '%')->where('status', '>', 0)->latest('id')->first();
                        if ($getCode != null) {
                            $codeProduct = $getCode->kodeproduksi;
                            $noUrutKode = (int) substr($codeProduct, -5);
                            $noUrutKode++;
                            $code = date('y') . sprintf("%05s", $noUrutKode);
                        } else {
                            $code = date('y') . "00001";
                        }
                        $getItemBon = ProduksipengebonanitmModel::where('subkode', $decrypted)->where('formproduksi', $request->formproduksi)->first();
                        if (!$getItemBon) {
                            $insert = ProduksipengebonanitmModel::create([
                                'tanggal' => $getDataForm->tanggal,
                                'formproduksi' => $request->formproduksi,
                                'kodeproduksi' => $code,
                                'subkode' => $itmQR->subkode,
                                'package' => $itmQR->package,
                                'type' => $itmQR->type,
                                'kategori' => $itmPR->kategori,
                                'warna' => $itmPR->warna,
                                'berat' => $itmQR->berat_satuan,
                                'operator' => $getDataForm->operator,
                                'supplier' => $itmPR->supplier,
                                'dibuat' => Auth::user()->nickname,
                                'created_at' => date('Y-m-d H:i:s'),
                            ]);
                        } else {
                            $update = ProduksipengebonanitmModel::where('subkode', $decrypted)->update([
                                'status' => 1, //ganti status menjadi diproses, tetapi belum diproduksi karena menunggu persetujuan produksi
                                'updated_at' => date('Y-m-d H:i:s'),
                            ]);
                        }

                        $update = GudangpenerimaanqrModel::where('subkode', $decrypted)->where('status', '>', 0)->update([
                            'status' => 2, //ganti status menjadi diproses, tetapi belum diproduksi karena menunggu persetujuan produksi
                            'updated_at' => date('Y-m-d H:i:s'),
                        ]);

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
                    } else {
                        // can't be processed
                        return response()->json([
                            'success' => false,
                            'message' => 'Tidak Dapat Diproses',
                            'detail' => 'Package Sudah Digunakan',
                        ]);
                    }
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
                'detail' => 'Cek kembali QRcode yang Anda Scan ' . $th,
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
                $getItem = GudangpenerimaanqrModel::where('id', $request->id_item[$i])->where('status', '>', 0)->first();
                $getdesc = GudangpenerimaanitmModel::where('npb', $getItem->npb)->where('kodekontrak', substr($getItem->subkode, 0, 8))->where('status', '>', 0)->first();
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
                    'supplier' => $getdesc->supplier,
                    'dibuat' => Auth::user()->nickname,
                    'created_at' => date('Y-m-d H:i:s'),
                ]);

                $update = GudangpenerimaanqrModel::where('id', $request->id_item[$i])->where('status', '>', 0)->update([
                    'status' => 2, //ganti status menjadi diproses, tetapi belum diproduksi karena menunggu persetujuan produksi
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);
            }
            return response()->json([
                'success' => true,
                'message' => 'Data Production Planning telah berhasil disimpan',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function detailPengebonan(Request $request)
    {
        $pengebonan = ProduksipengebonanModel::where('formproduksi', $request->id)->where('status', '>', 0)->first();
        $pengebonanItm = ProduksipengebonanitmModel::where('formproduksi', $request->id)->where('status', '>', 0)->get();
        $summary1 = DB::table('produksi_pengebonanitm AS A')
            ->selectRaw('DISTINCT B.kodekontrak, COUNT(A.subkode) AS jb, SUM(A.berat) as b_total, COUNT(A.warna) as t_warna')
            ->leftjoin('gudang_penerimaanqrcode AS B', 'A.subkode', '=', 'B.subkode')
            ->groupBy('B.kodekontrak')
            ->where('A.formproduksi', $request->id)
            ->where('A.status', '>', 0)
            ->get();
        $pluck = implode(', ', $pengebonanItm->pluck('subkode')->toArray());
        if ($pengebonan->status == '1') {
            $lock = "";
            $alert = "";
        } else {
            $lock = "disabled cursor-not-allowed";
            $alert =
                '
                <div class="modal-body py-1 px-1">
                    <div class="alert alert-success" role="alert">
                        <div class="d-flex">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon alert-icon"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M5 12l5 5l10 -10"></path></svg>
                        </div>
                        <div>
                            <h4 class="alert-title">Terverifikasi</h4>
                            <div class="text-secondary">Formulir sudah diverifikasi, silahkan lanjutkan ke proses selanjutnya. <br>Formulir sudah di mode <i>Read Only</i>.</div>
                        </div>
                        </div>
                    </div>
                </div>
            ';
        }
        $ArWarna = array(
            "green" => "Hijau",
            "red" => "Merah",
            "blue" => "Biru",
            "yellow" => "Kuning",
            "purple" => "Ungu",
            "black" => "Hitam",
            "white" => "Putih",
            "brown" => "Coklat",
            "orange" => "Oranye",
            "white" => "Clear",
            "purple" => "Mambo",
        );
        $hexWarna = array(
            "#58d68d" => "Hijau",
            "#C70039" => "Merah",
            "#7DF9FF" => "Biru",
            "#f7dc6f " => "Kuning",
            "#af7ac5" => "Ungu",
            "#17202a" => "Hitam",
            "#f8f9f9 " => "Putih",
            "#dc7633" => "Coklat",
            "#f39c12" => "Oranye",
            "#eaf2f8" => "Clear",
            "#7d3c98" => "Mambo",
        );

        if ($pengebonan) {
            // $totalSummary1 = $summary1->sum('b_total');
            echo '
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-database-search">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M4 6c0 1.657 3.582 3 8 3s8 -1.343 8 -3s-3.582 -3 -8 -3s-8 1.343 -8 3" />
                                <path d="M4 6v6c0 1.657 3.582 3 8 3m8 -3.5v-5.5" />
                                <path d="M4 12v6c0 1.657 3.582 3 8 3" />
                                <path d="M18 18m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                                <path d="M20.2 20.2l1.8 1.8" />
                            </svg>
                            Detail Formulir ' . $pengebonan->formproduksi . '
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    
                    ' . $alert . '
                    <div class="modal-body py-1 px-1">
                        <div class="row">
                            <div class="col-md-6 text-center">
                                <div id="chart2"></div>
                            </div>
                            <div class="col-md-6">
                                <div id="chart"></div>
                            </div>
                            <div class="col-md-12">
                                <div class="card border">
                                    <table class="table table-vcenter card-table text-nowrap">
                                        <thead>
                                            <tr>
                                                <th class="w-1 text-center">ID Kontrak</th>
                                                <th class="w-1 text-center">Jumbo Bag</th>
                                                <th class="w-1 text-start">Berat Total</th>
                                                <th class="w-1 text-center">%</th>
                                                <th class="w-1 text-start">Warna</th>
                                            </tr>
                                        </thead>
                                        <tbody>';
            $arrPercentage = array();
            $labelWarna = array();
            $seriesWarna = array();
            foreach ($summary1 as $key) {
                $arrPercentage[] = round((($key->b_total * 100) / $summary1->sum('b_total')), 2);
                array_push($labelWarna, $this->getWarnaFromIDKontrak($key->kodekontrak));
                array_push($seriesWarna, $key->jb);

                echo '
                                            <tr>
                                                <td class="text-center">' . $key->kodekontrak . '</td>
                                                <td class="text-center">' . $key->jb . '</td>
                                                <td class="text-start">' . $key->b_total . ' KG</td>
                                                <td class="text-center">' . round((($key->b_total * 100) / $summary1->sum('b_total')), 2) . ' %</td>
                                                <td class="text-center">' . $this->getWarnaFromIDKontrak($key->kodekontrak) . '</td>
                                            </tr>
                                            ';
            }
            echo ' 
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th colspan="2" class="text-end">Total</th>
                                                <th class="text-start">' . $summary1->sum('b_total') . ' KG</th>
                                                <th class="text-start">' . array_sum($arrPercentage) .
                ' %</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                            <script>
                                var options = {
                                    series: [';
            foreach ($seriesWarna as $key => $value) {
                echo $value . ',';
            }
            echo '
                                    ],
                                    colors: [';
            foreach ($labelWarna as $key => $value) {
                echo '"' . array_search($value, $hexWarna) . '",';
            }
            echo '
                                    ],
                                    stroke: {
                                        width: 4
                                    },
                                    dataLabels: {
                                        enabled: true,
                                        style: {
                                            colors: ["#f2f3f4"]
                                        },
                                        background: {
                                            enabled: true,
                                            foreColor: "#2e4053",
                                            borderWidth: 0
                                        }
                                    },
                                    chart: {
                                        width: 350,
                                        type: "pie",
                                    },
                                    labels: [';
            foreach ($labelWarna as $key => $value) {
                echo '"' . $value . '",';
            }
            echo '
                                    ],
                                    responsive: [{
                                        breakpoint: 480,
                                        options: {
                                            chart: {
                                                width: 200
                                            },
                                            legend: {
                                                position: "bottom"
                                            }
                                        }
                                    }]
                                };

                                var chart = new ApexCharts(document.querySelector("#chart"), options);
                                var chart2 = new ApexCharts(document.querySelector("#chart2"), options);
                                chart.render();
                                chart2.render();
                            </script>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <form method="GET" action="/produksi/pengebonan/edit/' . Crypt::encryptString($pengebonan->formproduksi) . '">
                            <input type="hidden" name="_token" value="' . csrf_token() . '">
                            <button class="btn btn-azure">
                                <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-edit"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" /><path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" /><path d="M16 5l3 3" /></svg>
                                Lihat Detail Formulir
                            </button>
                        </form>
                        <button type="button" class="btn btn-link link-secondary ms-auto"
                            data-bs-dismiss="modal">
                            Kembali
                        </button>
                    </div>
                </div>
            ';
        } else {
            echo '<div>Data not found.</div>';
        }
    }

    private function getWarnaFromIDKontrak($id)
    {
        $get = GudangpenerimaanitmModel::where('kodekontrak', $id)->where('status', '>', 0)->first();
        return $get->warna;
    }
    private function getTipeFromIDKontrak($id)
    {
        $get = GudangpenerimaanitmModel::where('kodekontrak', $id)->where('status', '>', 0)->first();
        return $get->tipe;
    }

    public function deletePengebonan(Request $request)
    {
        if ($request->tipeHapus == "form") {
            ProduksipengebonanModel::where('id', '=', $request->id)->update([
                'status' => 0,
            ]);
            ProduksipengebonanItmModel::where('formproduksi',  $request->noform)->update([
                'status' => 0,
            ]);
            return response()->json('Nomor Formulir ' . $request->noform . ' berhasil dihapus.');
        } elseif ($request->tipeHapus == "item") {
            // $getData = ProduksipengebonanModel::where('formproduksi', $request->noform)->first();
            // $getItem = ProduksipengebonanitmModel::where('formproduksi', $getData->formproduksi)->get();
            ProduksipengebonanitmModel::where('id', $request->id)->update([
                'status' => 0,
            ]);
            $getCount = ProduksipengebonanitmModel::where('formproduksi', $request->noform)->where('status', '>', 0)->count();
            if ($getCount == 0) {
                ProduksipengebonanModel::where('formproduksi', $request->noform)->update([
                    'status' => 0,
                ]);
            }
            return response()->json('Item berhasil dihapus.' . $getCount);
        }
    }
    public function deleteAllItemPengebonan(Request $request)
    {
        // ProduksipengebonanModel::where('id', '=', $request->id)->update([
        //     'status' => 0,
        // ]);
        ProduksipengebonanItmModel::where('formproduksi',  $request->noform)->update([
            'status' => 0,
        ]);

        $getItems = ProduksipengebonanItmModel::where('formproduksi',  $request->noform)->get();
        foreach ($getItems as $key) {
            GudangpenerimaanqrModel::where('subkode', $key->subkode)->update([
                'status' => 1,
            ]);
        }
        return response()->json('Nomor Formulir ' . $request->noform . ' berhasil dihapus.');
    }

    public function editPengebonan($id)
    {
        $decrypted = Crypt::decryptString($id);
        $pengebonan = ProduksipengebonanModel::where('formproduksi', $decrypted)->where('status', '>', 0)->first();
        $pengebonanItem = DB::table('produksi_pengebonanitm as a')
            ->select('a.*', 'b.id as idQR')
            ->join('gudang_penerimaanqrcode as b', 'a.subkode', '=', 'b.subkode')
            ->where('a.formproduksi', $decrypted)
            ->where('b.status', '>', 0)
            ->get();

        $summary1 = DB::table('produksi_pengebonanitm AS A')
            ->selectRaw('DISTINCT B.kodekontrak, COUNT(A.subkode) AS jb, SUM(A.berat) as b_total, COUNT(A.warna) as t_warna, A.warna')
            ->leftjoin('gudang_penerimaanqrcode AS B', 'A.subkode', '=', 'B.subkode')
            ->groupBy('B.kodekontrak', 'A.warna')
            ->where('A.formproduksi', $decrypted)
            ->where('A.status', '>', 0)
            ->get();
        $summary2 = DB::table('produksi_pengebonanitm AS A')
            ->selectRaw('B.type, COUNT(A.subkode) AS jb')
            ->leftjoin('gudang_penerimaanqrcode AS B', 'A.subkode', '=', 'B.subkode')
            ->groupBy('B.type')
            ->where('A.formproduksi', $decrypted)
            ->where('A.status', '>', 0)
            ->get();

        $ArWarna = [
            'green' => 'Hijau',
            'red' => 'Merah',
            'blue' => 'Biru',
            'yellow' => 'Kuning',
            'purple' => 'Ungu',
            'black' => 'Hitam',
            'white' => 'Putih',
            'brown' => 'Coklat',
            'orange' => 'Oranye',
            'white' => 'Clear',
            'purple' => 'Mambo',
        ];
        $hexWarna = [
            '#58d68d' => 'Hijau',
            '#C70039' => 'Merah',
            '#0096FF' => 'Biru',
            '#f7dc6f ' => 'Kuning',
            '#af7ac5' => 'Ungu',
            '#17202a' => 'Hitam',
            '#f8f9f9 ' => 'Putih',
            '#dc7633' => 'Coklat',
            '#f39c12' => 'Oranye',
            '#C70039' => 'Clear',
            '#7d3c98' => 'Mambo',
        ];

        $labelWarna = array();
        $seriesWarna = array();
        $langWarna = array();
        $labelTipe = array();
        $seriesTipe = array();
        foreach ($summary1 as $key) {
            array_push($labelWarna, $this->getWarnaFromIDKontrak($key->kodekontrak));
            array_push($seriesWarna, $key->jb);
            array_push($langWarna, array_search($this->getWarnaFromIDKontrak($key->kodekontrak), $hexWarna));
        }
        foreach ($summary2 as $key) {
            array_push($labelTipe, $key->type);
            array_push($seriesTipe, $key->jb);
        }

        // Summary

        $arrPercentage = array();
        // foreach ($summary1 as $key) {
        //     $arrPercentage[] = round((($key->b_total * 100) / $summary1->sum('b_total')), 2);
        //     array_push($labelWarna, $this->getWarnaFromIDKontrak($key->kodekontrak));
        //     array_push($seriesWarna, $key->jb);

        //     echo '
        //                                     <tr>
        //                                         <td class="text-center">' . $key->kodekontrak . '</td>
        //                                         <td class="text-center">' . $key->jb . '</td>
        //                                         <td class="text-start">' . $key->b_total . ' KG</td>
        //                                         <td class="text-center">' . round((($key->b_total * 100) / $summary1->sum('b_total')), 2) . ' %</td>
        //                                         <td class="text-center">' . $this->getWarnaFromIDKontrak($key->kodekontrak) . '</td>
        //                                     </tr>
        //                                     ';
        // }
        $S_total = $summary1->sum('b_total');

        // Summary
        return view('products/04_produksi.pengebonanEdit', [
            'active' => 'Planning',
            'judul' => 'Edit Production Planning',
            'pengebonan' => $pengebonan,
            'pengebonanItem' => $pengebonanItem,
            'labelWarna' => $labelWarna,
            'seriesWarna' => $seriesWarna,
            'langWarna' => $langWarna,
            'labelTipe' => $labelTipe,
            'seriesTipe' => $seriesTipe,
            'S_total' => $S_total,
            'summary1' => $summary1,
        ]);
    }

    public function deletePengebonanExists(Request $request)
    {
        try {
            $getData = ProduksipengebonanitmModel::where('kodeproduksi', $request->kodeproduksi)->first();
            GudangpenerimaanqrModel::where('subkode', $getData->subkode)->update([
                'status' => 1,
            ]);

            ProduksipengebonanitmModel::where('id', $request->id)->delete();
            return response()->json('Item berhasil dihapus.');
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json('Item gagal dihapus. ' . $e->getMessage());
        }
    }

    public function storedataEditPengebonan(Request $request)
    {
        try {
            ProduksipengebonanModel::where('formproduksi', $request->nomorform)->update([
                'tanggal' => $request->tanggal,
                'operator' => $request->operator,
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
            for ($i = 0; $i < count($request->id_item); $i++) {
                if ($request->oldKodeproduksi[$i]) {
                    # do nothing
                } else {
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
                        'formproduksi' => $request->nomorform,
                        'kodeproduksi' => $code,
                        'subkode' => $getItem->subkode,
                        'package' => $getItem->package,
                        'type' => $getItem->type,
                        'kategori' => $getdesc->kategori,
                        'warna' => $getdesc->warna,
                        'berat' => $getItem->berat_satuan,
                        'operator' => $request->operator,
                        'supplier' => $getdesc->supplier,
                        'dibuat' => Auth::user()->nickname,
                        'created_at' => date('Y-m-d H:i:s'),
                    ]);
                    $update = GudangpenerimaanqrModel::where('id', $request->id_item[$i])->update([
                        'status' => 2, //ganti status menjadi diproses, tetapi belum diproduksi karena menunggu persetujuan produksi
                        'updated_at' => date('Y-m-d H:i:s'),
                    ]);
                }
            }
            return response()->json([
                'success' => true,
                'message' => 'Data Production Planning telah berhasil disimpan',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function verifikasiPengebonan($id)
    {
        $decrypted = Crypt::decryptString($id);
        $pengebonan = ProduksipengebonanModel::where('formproduksi', $decrypted)->first();
        $pengebonanItem = DB::table('produksi_pengebonanitm as a')
            // ->select('a.*', 'b.id as idQR')
            // ->join('gudang_penerimaanqrcode as b', 'a.subkode', '=', 'b.subkode')
            ->where('a.formproduksi', $decrypted)
            ->get();
        return view('products/04_produksi.pengebonanVerifikasi', [
            'active' => 'Planning',
            'judul' => 'Verifikasi Production Planning',
            'pengebonan' => $pengebonan,
            'pengebonanItem' => $pengebonanItem,
        ]);
    }

    public function prosesVerifikasiPengebonan(Request $request)
    {
        try {
            ProduksipengebonanModel::where('formproduksi', $request->nomorform)->update([
                'status' => 2,
                'verifikator' => $request->verifikator,
                'tanggal_verifikasi' => now(),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
            for ($i = 0; $i < count($request->idItem); $i++) {
                $update = ProduksipengebonanitmModel::where('id', $request->idItem[$i])->update([
                    'status' => 2, //ganti status menjadi approved, tidak bisa diubah dan dihapus
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);
            }
            return response()->json([
                'success' => true,
                'message' => 'Data Production Planning telah berhasil diverifikasi',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function checkDeletePengebonanItems(Request $request)
    {
        echo '
            <div class="modal-status bg-danger"></div>
            <div class="modal-body text-center py-4">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon mb-2 text-danger icon-lg"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 9v4"></path><path d="M10.363 3.591l-8.106 13.534a1.914 1.914 0 0 0 1.636 2.871h16.214a1.914 1.914 0 0 0 1.636 -2.87l-8.106 -13.536a1.914 1.914 0 0 0 -3.274 0z"></path><path d="M12 16h.01"></path></svg>
                <h3 class="modal-title">Apakah anda yakin?</h3>
                <div>Anda akan menghapus ' . $request->jml . ' data yang anda pilih.</div>
                <input type="hidden" name="jml" value="' . $request->jml . '">
                ';
        foreach ($request->id as $key) {
            echo '
                    <input type="hidden" name="subkode[]" value="' . $key . '">
                    ';
        }
        echo '
            </div>
            <div class="modal-footer py-0">
                <button type="submit" class="btn btn-link text-red me-auto" id="idDeleteSelected">Ya, Hapus ' . $request->jml . ' data</button>
                <button type="button" class="btn btn-link link-secondary" data-bs-dismiss="modal">Batal</button>
            </div>
            ';
    }

    public function prosesDeleteSelected(Request $request)
    {
        try {
            for ($i = 0; $i < $request->jml; $i++) {
                $update = ProduksipengebonanitmModel::where('subkode', $request->subkode[$i])->update([
                    'status' => 0,
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);
                $updateQR = GudangpenerimaanqrModel::where('subkode', $request->subkode[$i])
                    ->where('status', '>', 0)
                    ->update([
                        'status' => 1,
                        'updated_at' => date('Y-m-d H:i:s'),
                    ]);
            }
            return response()->json([
                'success' => true,
                'message' => 'Data telah berhasil dihapus',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }
}
