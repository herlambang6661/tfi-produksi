<?php

namespace App\Http\Controllers\_01_Datatables\Gudang;

use Illuminate\Http\Request;
use App\Models\SuratkontrakModel;
use App\Http\Controllers\Controller;
use App\Models\GudangpenerimaanitmModel;
use App\Models\GudangpenerimaanModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\Facades\DataTables;

class PenerimaanList extends Controller
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
            if ($request->status == '*') {
                $data = GudangpenerimaanitmModel::whereBetween('tanggal', [$request->dari, $request->sampai])->get();
            } else {
                $data = GudangpenerimaanitmModel::where('status', $request->status)->whereBetween('tanggal', [$request->dari, $request->sampai])->get();
            }

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    if ($row->status == 2) { // <== Status : needed approval
                        $btn = '
                            <div class="btn-list flex-nowrap">                                
                                <form method="GET" action="/gudang/penerimaan/verifikasi/' . Crypt::encryptString($row->npb) . '">
                                    <input type="hidden" name="_token" value="' . csrf_token() . '">
                                    <button type="submit" class="btn btn-sm btn-link btn-icon" onclick="loadingOverlay()">
                                        <i class="fa-solid fa-check"></i>
                                    </button>
                                </form>
                                <button class="btn btn-sm btn-link align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown" aria-expanded="false">
                                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="1.5"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-dots-vertical"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" /><path d="M12 19m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" /><path d="M12 5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" /></svg>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end" style="">
                                    <form method="GET" action="/gudang/penerimaan/verifikasi/' . Crypt::encryptString($row->npb) . '">
                                        <input type="hidden" name="_token" value="' . csrf_token() . '">
                                        <button type="submit" class="dropdown-item" onclick="loadingOverlay()">
                                            <svg style="margin-right:5px;" xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon text-green icon-tabler icons-tabler-outline icon-tabler-checkup-list"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2" /><path d="M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z" /><path d="M9 14h.01" /><path d="M9 17h.01" /><path d="M12 16l1 1l3 -3" /></svg>
                                            Menyetujui
                                        </button>
                                    </form>
                                    <a href="' . route('detail.penerimaan', ['id' => $row->npb]) . '" class="dropdown-item" data-id="' . $row->npb . '" data-id="' . $row->id . '">
                                        <svg style="margin-right:5px;" xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="1.5"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-file-search"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 3v4a1 1 0 0 0 1 1h4" /><path d="M12 21h-5a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v4.5" /><path d="M16.5 17.5m-2.5 0a2.5 2.5 0 1 0 5 0a2.5 2.5 0 1 0 -5 0" /><path d="M18.5 19.5l2.5 2.5" /></svg>
                                        Lihat Detail Form
                                    </a>
                                    <a href="#" class="dropdown-item remove" data-id="' . $row->id . '" data-nama="' . $row->kodekontrak . '" data-kode="' . Carbon::parse($row->tanggal)->isoFormat('D MMMM Y') . '">
                                        <svg style="margin-right:5px;" xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon text-danger icon-tabler icons-tabler-outline icon-tabler-transform"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 6a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" /><path d="M21 11v-3a2 2 0 0 0 -2 -2h-6l3 3m0 -6l-3 3" /><path d="M3 13v3a2 2 0 0 0 2 2h6l-3 -3m0 6l3 -3" /><path d="M15 18a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" /></svg>
                                        Batal Inputan
                                    </a>
                                </div>
                            </div>
                        ';
                    } elseif ($row->status == 3) { // <== Status : signed
                        $btn = '<div class="btn-list flex-nowrap">
                                <form method="GET" action="/gudang/penerimaan/printQrcode/' . Crypt::encryptString($row->kodekontrak) . '">
                                    <input type="hidden" name="_token" value="' . csrf_token() . '">
                                    <button type="submit" class="btn btn-sm btn-link btn-icon" onclick="loadingOverlay()">
                                        <i class="fa-solid fa-qrcode"></i>
                                    </button>
                                </form>
                                <button class="btn btn-sm btn-link align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown" aria-expanded="false">
                                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="1.5"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-dots-vertical"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" /><path d="M12 19m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" /><path d="M12 5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" /></svg>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end" style="">
                                    <form method="GET" action="/gudang/penerimaan/printQrcode/' . Crypt::encryptString($row->kodekontrak) . '">
                                        <input type="hidden" name="_token" value="' . csrf_token() . '">
                                        <button type="submit" class="dropdown-item" onclick="loadingOverlay()">
                                            <svg style="margin-right:5px;" xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-qrcode text-primary"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 4m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" /><path d="M7 17l0 .01" /><path d="M14 4m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" /><path d="M7 7l0 .01" /><path d="M4 14m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" /><path d="M17 7l0 .01" /><path d="M14 14l3 0" /><path d="M20 14l0 .01" /><path d="M14 14l0 3" /><path d="M14 20l3 0" /><path d="M17 17l3 0" /><path d="M20 17l0 3" /></svg>
                                            Print Barcode
                                        </button>
                                    </form>
                                    <a href="' . route('detail.penerimaan', ['id' => $row->npb]) . '" class="dropdown-item" data-id="' . $row->npb . '" data-id="' . $row->id . '">
                                        <svg style="margin-right:5px;" xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="1.5"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-file-search"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 3v4a1 1 0 0 0 1 1h4" /><path d="M12 21h-5a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v4.5" /><path d="M16.5 17.5m-2.5 0a2.5 2.5 0 1 0 5 0a2.5 2.5 0 1 0 -5 0" /><path d="M18.5 19.5l2.5 2.5" /></svg>
                                        Lihat Detail Form
                                    </a>
                                </div>
                        </div>';
                    }
                    return $btn;
                })
                ->addColumn('status', function ($row) {
                    // 0 = deleted, 1 = open, 2 = needed approval, 3 = signed, 4 = closed
                    if ($row->status == 0) {
                        return '
                            <span class="status status-dark status-lite">
                                <span class="status-dot status-dot-animated"></span>
                                Canceled
                            </span>
                        ';
                    } else if ($row->status == 1) {
                        return '
                            <span class="status status-blue status-lite">
                                <span class="status-dot status-dot-animated"></span>
                                Open
                            </span>
                        ';
                    } else if ($row->status == 2) {
                        return '
                            <span class="status status-red status-lite">
                                <span class="status-dot status-dot-animated"></span>
                                Need Approval
                            </span>
                        ';
                    } else if ($row->status == 3) {
                        return '
                            <span class="status status-green status-lite">
                                <span class="status-dot status-dot-animated"></span>
                                Signed
                            </span>
                        ';
                    } else if ($row->status == 4) {
                        return '
                            <span class="status status-yellow status-lite">
                                <span class="status-dot status-dot-animated"></span>
                                Closed
                            </span>
                        ';
                    }
                })
                ->editColumn('tanggal', function ($row) {
                    return date('d-m-Y', strtotime($row->tanggal));
                })
                ->rawColumns(['action', 'status'])
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
