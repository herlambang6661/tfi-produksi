<?php

namespace App\Http\Controllers\_01_Datatables\Produksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use App\Models\ProduksipengebonanModel;
use App\Models\GudangpengolahanitmModel;
use Yajra\DataTables\Facades\DataTables;
use App\Models\ProduksipengebonanitmModel;

class PengebonanList extends Controller
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
            $data = ProduksipengebonanModel::whereBetween('tanggal', [$request->dari, $request->sampai])->where('status', '>', 0)->get();
            // $data = ProduksipengebonanitmModel::all();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('subkode', function ($row) {
                    $list = ProduksipengebonanitmModel::where('formproduksi', $row->formproduksi)->where('status', '>', 0)->get();
                    // substr("isi tulisan artikel", 0, 200) . "[..]";
                    return implode(', ', $list->pluck('subkode')->toArray());
                })
                ->editColumn('tanggal', function ($row) {
                    return date('d-m-Y', strtotime($row->tanggal));
                })
                ->addColumn('action', function ($row) {
                    if ($row->status == '1') {
                        $sttclass = '';
                    } else {
                        $sttclass = 'disabled cursor-not-allowed';
                    }
                    $btn = '
                        <div class="btn-list flex-nowrap">
                            <form method="GET" action="/produksi/pengebonan/edit/' . Crypt::encryptString($row->formproduksi) . '">
                                <input type="hidden" name="_token" value="' . csrf_token() . '">
                                <button type="submit" class="btn btn-link btn-icon loadings ">
                                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-report-search"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h5.697" /><path d="M18 12v-5a2 2 0 0 0 -2 -2h-2" /><path d="M8 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z" /><path d="M8 11h4" /><path d="M8 15h3" /><path d="M16.5 17.5m-2.5 0a2.5 2.5 0 1 0 5 0a2.5 2.5 0 1 0 -5 0" /><path d="M18.5 19.5l2.5 2.5" /></svg>
                                </button>
                            </form>
                            <button class="btn btn-link btn-icon align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown" aria-expanded="false">
                                <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-dots-vertical"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" /><path d="M12 19m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" /><path d="M12 5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" /></svg>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow" style="">
                                <span class="dropdown-header">Menu untuk ' . $row->formproduksi . '</span>
                                <form method="POST" action="/gudang/printPengolahan" target="_blank">
                                    <input type="hidden" name="_token" value="' . csrf_token() . '">
                                    <input type="hidden" name="id" value="' . Crypt::encryptString($row->kodeolah) . '">
                                    <button type="submit" class="dropdown-item loadings">
                                        <svg style="margin-right:5px;" xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-printer text-success"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2" /><path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4" /><path d="M7 13m0 2a2 2 0 0 1 2 -2h6a2 2 0 0 1 2 2v4a2 2 0 0 1 -2 2h-6a2 2 0 0 1 -2 -2z" /></svg>
                                        Print Formulir
                                    </button>
                                </form>
                                <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalViewItem" data-id="' . $row->formproduksi . '"">
                                    <svg style="margin-right:5px;" xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-clipboard-data"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2" /><path d="M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z" /><path d="M9 17v-4" /><path d="M12 17v-1" /><path d="M15 17v-2" /><path d="M12 17v-1" /></svg>
                                    Lihat Detail
                                </a>
                                <form method="GET" action="/produksi/pengebonan/verifikasi/' . Crypt::encryptString($row->formproduksi) . '">
                                    <input type="hidden" name="_token" value="' . csrf_token() . '">
                                    <button type="submit" class="dropdown-item loadings ' . $sttclass . '">
                                        <svg style="margin-right:5px;" xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="text-purple icon icon-tabler icons-tabler-outline icon-tabler-rosette-discount-check"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 7.2a2.2 2.2 0 0 1 2.2 -2.2h1a2.2 2.2 0 0 0 1.55 -.64l.7 -.7a2.2 2.2 0 0 1 3.12 0l.7 .7c.412 .41 .97 .64 1.55 .64h1a2.2 2.2 0 0 1 2.2 2.2v1c0 .58 .23 1.138 .64 1.55l.7 .7a2.2 2.2 0 0 1 0 3.12l-.7 .7a2.2 2.2 0 0 0 -.64 1.55v1a2.2 2.2 0 0 1 -2.2 2.2h-1a2.2 2.2 0 0 0 -1.55 .64l-.7 .7a2.2 2.2 0 0 1 -3.12 0l-.7 -.7a2.2 2.2 0 0 0 -1.55 -.64h-1a2.2 2.2 0 0 1 -2.2 -2.2v-1a2.2 2.2 0 0 0 -.64 -1.55l-.7 -.7a2.2 2.2 0 0 1 0 -3.12l.7 -.7a2.2 2.2 0 0 0 .64 -1.55v-1" /><path d="M9 12l2 2l4 -4" /></svg>
                                        Persetujuan
                                    </button>
                                </form>
                            </div>
                        </div>';
                    return $btn;
                })
                ->addColumn('formproduksi', function ($row) {
                    return '
                            <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalViewItem" data-id="' . $row->formproduksi . '"">
                                ' . $row->formproduksi . '
                            </a>
                    ';
                })
                ->addColumn('status', function ($row) {
                    if ($row->status == 0) {
                        return '
                            <span class="status status-dark status-lite border-red">
                                <span class="status-dot status-dot-animated"></span>
                                Canceled
                            </span>
                        ';
                    } else if ($row->status == 1) {
                        return '
                            <span class="status status-blue status-lite border-blue">
                                <span class="status-dot status-dot-animated"></span>
                                Open
                            </span>
                        ';
                    } else if ($row->status == 2) {
                        return '
                            <span class="status status-green status-lite border-green">
                                <span class="status-dot status-dot-animated"></span>
                                Verified
                            </span>
                        ';
                    } else if ($row->status == 3) {
                        return '
                            <span class="status status-green status-lite border-purple">
                                <span class="status-dot status-dot-animated"></span>
                                Close
                            </span>
                        ';
                    }
                })
                ->rawColumns(['action', 'status', 'subkode', 'formproduksi'])
                ->make(true);
        }

        return view('products.03_gudang.pengolahan');
    }
    // public function destroy($id)
    // {
    //     $getData = ProduksipengebonanModel::where('id', $id)->first();
    //     // $getItem = ProduksipengebonanitmModel::where('formproduksi', $getData->formproduksi)->get();
    //     // $getCount = ProduksipengebonanitmModel::where('formproduksi', $getData->formproduksi)->where('status', '=>', 1)->count();

    //     // if ($getCount <= 1) {
    //     ProduksipengebonanModel::where('id', '=', $id)->update([
    //         'status' => 0,
    //     ]);
    //     ProduksipengebonanItmModel::where('formproduksi',  $getData->formproduksi)->update([
    //         'status' => 0,
    //     ]);
    //     return response()->json('Record deleted successfully.');
    //     // } else {
    //     //     ProduksipengebonanModel::where('id', '=', $id)->update([
    //     //         'status' => 0,
    //     //     ]);
    //     //     return response()->json(['success' => 'Record deleted successfully.']);
    //     // }
    // }
}
