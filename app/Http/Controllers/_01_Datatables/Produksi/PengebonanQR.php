<?php

namespace App\Http\Controllers\_01_Datatables\Produksi;

use Carbon\Carbon;
use Endroid\QrCode\QrCode;
use Illuminate\Http\Request;
use App\Models\DaftartipeModel;
use App\Models\DaftarwarnaModel;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Endroid\QrCode\Writer\PngWriter;
use App\Models\GudangpenerimaanModel;
use Illuminate\Support\Facades\Crypt;
use App\Models\GudangpenerimaanqrModel;
use Yajra\DataTables\Facades\DataTables;
use App\Models\DaftarTipeSubKategoriModel;

class PengebonanQR extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

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
                $data = DB::table('gudang_penerimaanqrcode as q')
                    ->where('q.usable', '999999')
                    ->get();
            } else {
                // if ($request->editForm == 1) {
                // } else {
                $data = DB::table('gudang_penerimaanqrcode as q')
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
                // }
            }

            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('tanggal', function ($row) {
                    return date('d-m-Y', strtotime($row->tanggal));
                })
                ->addColumn('action', function ($row) {
                    return '
                            <td class="text-center">
                                <button type="button" class="btn btn-icon btn-blue tambahkebawah" data-id="' . $row->id . '" data-subkode="' . $row->subkode . '" data-tipe="' . $row->type . '" data-kategori="' . $row->kategori . '" data-warna="' . $row->warna . '" data-package="' . $row->package . '" data-beratsatuan="' . $row->berat_satuan . '" data-supplier="' . $row->supplier . '">
                                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-download"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2" /><path d="M7 11l5 5l5 -5" /><path d="M12 4l0 12" /></svg>
                                </button>
                            </td>';
                })
                ->rawColumns(['action', 'status', 'select_orders', 'qrcode', 'usable'])
                ->make(true);
        }

        return view('products.03_gudang.penerimaan');
    }
    public function destroy($id)
    {
        // $getData = DB::table('permintaanitm')->where('kodeseri', '=', $id)->first();
        // $getCount = DB::table('permintaanitm')->where('noform', '=', $getData->noform)->count();

        // if ($getCount <= 1) {
        //     DB::table('permintaanitm')->where('kodeseri', '=', $id)->delete();
        GudangpenerimaanModel::where('id', '=', $id)->update([
            'status' => 0,
        ]);
        return response()->json('Record deleted successfully.');
        // } else {
        //     DB::table('permintaanitm')->where('kodeseri', '=', $id)->delete();
        //     return response()->json(['success' => 'Record deleted successfully.']);
        // }
    }
}
