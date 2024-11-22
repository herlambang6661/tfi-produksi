<?php

namespace App\Http\Controllers\_01_Datatables\Produksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use App\Models\GudangpengolahanitmModel;
use App\Models\ProduksipengebonanitmModel;
use Yajra\DataTables\Facades\DataTables;

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
            $data = ProduksipengebonanitmModel::whereBetween('tanggal', [$request->dari, $request->sampai])->get();
            // $data = ProduksipengebonanitmModel::all();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('subkode', function ($row) {
                    $list = GudangpengolahanitmModel::where('kodeolah', $row->kodeolah)->get();

                    return implode(', ', $list->pluck('kodekontrak')->toArray());
                })
                ->editColumn('tanggal', function ($row) {
                    return date('d-m-Y', strtotime($row->tanggal));
                })
                ->addColumn('action', function ($row) {
                    if ($row->status == 1) {
                        $sttclass = '';
                    } elseif ($row->status == 3) {
                        $sttclass = 'disabled';
                    }
                    $btn = '
                        <div class="btn-list flex-nowrap">
                            <form method="GET" action="/gudang/pengolahan/proses/' . Crypt::encryptString($row->kodeolah) . '">
                                <input type="hidden" name="_token" value="' . csrf_token() . '">
                                <button type="submit" class="btn btn-link btn-icon" onclick="loadingOverlay()" ' . $sttclass . '>
                                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-a-b-2"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M16 21h3c.81 0 1.48 -.67 1.48 -1.48l.02 -.02c0 -.82 -.69 -1.5 -1.5 -1.5h-3v3z" /><path d="M16 15h2.5c.84 -.01 1.5 .66 1.5 1.5s-.66 1.5 -1.5 1.5h-2.5v-3z" /><path d="M4 9v-4c0 -1.036 .895 -2 2 -2s2 .964 2 2v4" /><path d="M2.99 11.98a9 9 0 0 0 9 9m9 -9a9 9 0 0 0 -9 -9" /><path d="M8 7h-4" /></svg>
                                </button>
                            </form>
                            <button class="btn btn-link btn-icon align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown" aria-expanded="false">
                                <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-dots-vertical"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" /><path d="M12 19m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" /><path d="M12 5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" /></svg>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow" style="">
                                <span class="dropdown-header">Menu untuk ' . $row->kodeolah . '</span>
                                <form method="GET" action="/gudang/pengolahan/proses/' . Crypt::encryptString($row->kodeolah) . '">
                                    <input type="hidden" name="_token" value="' . csrf_token() . '">
                                    <button type="submit" class="dropdown-item" onclick="loadingOverlay()" ' . $sttclass . '>
                                        <svg style="margin-right:5px;" xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-a-b-2 text-primary"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M16 21h3c.81 0 1.48 -.67 1.48 -1.48l.02 -.02c0 -.82 -.69 -1.5 -1.5 -1.5h-3v3z" /><path d="M16 15h2.5c.84 -.01 1.5 .66 1.5 1.5s-.66 1.5 -1.5 1.5h-2.5v-3z" /><path d="M4 9v-4c0 -1.036 .895 -2 2 -2s2 .964 2 2v4" /><path d="M2.99 11.98a9 9 0 0 0 9 9m9 -9a9 9 0 0 0 -9 -9" /><path d="M8 7h-4" /></svg>
                                        Proses Pengolahan
                                    </button>
                                </form>
                                <form method="POST" action="/gudang/printPengolahan" target="_blank">
                                    <input type="hidden" name="_token" value="' . csrf_token() . '">
                                    <input type="hidden" name="id" value="' . Crypt::encryptString($row->kodeolah) . '">
                                    <button type="submit" class="dropdown-item" onclick="loadingOverlay()">
                                        <svg style="margin-right:5px;" xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-printer text-success"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2" /><path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4" /><path d="M7 13m0 2a2 2 0 0 1 2 -2h6a2 2 0 0 1 2 2v4a2 2 0 0 1 -2 2h-6a2 2 0 0 1 -2 -2z" /></svg>
                                        Print Formulir
                                    </button>
                                </form>
                                <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modal-detail-penerimaan" data-id="' . $row->npb . '" data-id="' . $row->id . '">
                                    <svg style="margin-right:5px;" xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="1.5"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-file-search"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 3v4a1 1 0 0 0 1 1h4" /><path d="M12 21h-5a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v4.5" /><path d="M16.5 17.5m-2.5 0a2.5 2.5 0 1 0 5 0a2.5 2.5 0 1 0 -5 0" /><path d="M18.5 19.5l2.5 2.5" /></svg>
                                    Lihat Detail Form
                                </a>
                            </div>
                        </div>';
                    return $btn;
                })
                ->addColumn('status', function ($row) {
                    if ($row->status == 0) {
                        return '
                            <span class="status status-dark status-lite border-dark">
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
                            <span class="status status-red status-lite border-red">
                                <span class="status-dot status-dot-animated"></span>
                                Processed
                            </span>
                        ';
                    } else if ($row->status == 3) {
                        return '
                            <span class="status status-green status-lite border-green">
                                <span class="status-dot status-dot-animated"></span>
                                Close
                            </span>
                        ';
                    }
                })
                ->rawColumns(['action', 'status', 'subkode'])
                ->make(true);
        }

        return view('products.03_gudang.pengolahan');
    }
    public function destroy($id)
    {
        // $getData = DB::table('permintaanitm')->where('kodeseri', '=', $id)->first();
        // $getCount = DB::table('permintaanitm')->where('noform', '=', $getData->noform)->count();

        // if ($getCount <= 1) {
        //     DB::table('permintaanitm')->where('kodeseri', '=', $id)->delete();
        ProduksipengebonanitmModel::where('id', '=', $id)->update([
            'status' => 0,
        ]);
        return response()->json('Record deleted successfully.');
        // } else {
        //     DB::table('permintaanitm')->where('kodeseri', '=', $id)->delete();
        //     return response()->json(['success' => 'Record deleted successfully.']);
        // }
    }
}
