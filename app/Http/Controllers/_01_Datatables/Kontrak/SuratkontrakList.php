<?php

namespace App\Http\Controllers\_01_Datatables\Kontrak;

use Illuminate\Http\Request;
use App\Models\SuratkontrakModel;
use App\Http\Controllers\Controller;
use App\Models\SuratkontrakitmModel;
use Yajra\DataTables\Facades\DataTables;

class SuratkontrakList extends Controller
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
            $data = SuratkontrakitmModel::where('status', '>', 0)->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    // $btn = '
                    //         <a href="javascript:void(0);" class="btn btn-azure btn-sm btn-icon" data-bs-toggle="modal" data-bs-target="#modal-edit-supplier" data-id="' . $row->id . '">
                    //             <svg xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="1.5"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-edit"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" /><path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" /><path d="M16 5l3 3" /></svg>
                    //         </a>
                    //         ';
                    if ($row->status == 1) {
                        $btn = '<div class="btn-list flex-nowrap">
                                <form method="POST" action="printPermintaan" target="_blank">
                                    <input type="hidden" name="_token" value="' . csrf_token() . '">
                                    <input type="hidden" name="noform" value="' . $row->noform . '">
                                    <button type="submit" class="btn btn-sm btn-link btn-icon">
                                        <i class="fa-solid fa-print" style="margin-right:5px;"></i>
                                    </button>
                                </form>
                                <button class="btn btn-sm btn-link align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown" aria-expanded="false">
                                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="1.5"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-dots-vertical"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" /><path d="M12 19m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" /><path d="M12 5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" /></svg>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end" style="">
                                    <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modal-detail-kontrak" data-id="' . $row->noform . '" data-id_kontrak="' . $row->id_kontrak . '">
                                        <svg style="margin-right:5px;" xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="1.5"  stroke-linecap="round"  stroke-linejoin="round"  class="icon text-green icon-tabler icons-tabler-outline icon-tabler-file-search"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 3v4a1 1 0 0 0 1 1h4" /><path d="M12 21h-5a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v4.5" /><path d="M16.5 17.5m-2.5 0a2.5 2.5 0 1 0 5 0a2.5 2.5 0 1 0 -5 0" /><path d="M18.5 19.5l2.5 2.5" /></svg>
                                        Lihat Surat Kontrak
                                    </a>
                                    <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modal-detail-kontrak" data-id="' . $row->id . '" data-id_kontrak="' . $row->id_kontrak . '">
                                        <svg style="margin-right:5px;" xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-cloud-download"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M19 18a3.5 3.5 0 0 0 0 -7h-1a5 4.5 0 0 0 -11 -2a4.6 4.4 0 0 0 -2.1 8.4" /><path d="M12 13l0 9" /><path d="M9 19l3 3l3 -3" /></svg>
                                        Unduh Surat Kontrak
                                    </a>
                                    <a href="#" class="dropdown-item remove" data-id="' . $row->id . '" data-nama="' . $row->id_kontrak . '" data-kode="' . $row->tanggal . '">
                                        <svg style="margin-right:5px;" xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon text-danger icon-tabler icons-tabler-outline icon-tabler-trash"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                                        Hapus Surat Kontrak
                                    </a>
                                </div>
                        </div>';
                    } else {
                        $btn = '<div class="btn-list flex-nowrap">
                                <form method="POST" action="printPermintaan" target="_blank">
                                    <input type="hidden" name="_token" value="' . csrf_token() . '">
                                    <input type="hidden" name="noform" value="' . $row->noform . '">
                                    <button type="submit" class="btn btn-sm btn-link btn-icon">
                                        <i class="fa-solid fa-print" style="margin-right:5px;"></i>
                                    </button>
                                </form>
                                <button class="btn btn-sm btn-link align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown" aria-expanded="false">
                                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="1.5"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-dots-vertical"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" /><path d="M12 19m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" /><path d="M12 5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" /></svg>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end" style="">
                                    <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modal-detail-kontrak" data-id="' . $row->noform . '" data-id_kontrak="' . $row->id_kontrak . '">
                                        <svg style="margin-right:5px;" xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="1.5"  stroke-linecap="round"  stroke-linejoin="round"  class="icon text-green icon-tabler icons-tabler-outline icon-tabler-file-search"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 3v4a1 1 0 0 0 1 1h4" /><path d="M12 21h-5a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v4.5" /><path d="M16.5 17.5m-2.5 0a2.5 2.5 0 1 0 5 0a2.5 2.5 0 1 0 -5 0" /><path d="M18.5 19.5l2.5 2.5" /></svg>
                                        Lihat Surat Kontrak
                                    </a>
                                    <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modal-detail-kontrak" data-id="' . $row->id . '" data-id_kontrak="' . $row->id_kontrak . '">
                                        <svg style="margin-right:5px;" xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-cloud-download"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M19 18a3.5 3.5 0 0 0 0 -7h-1a5 4.5 0 0 0 -11 -2a4.6 4.4 0 0 0 -2.1 8.4" /><path d="M12 13l0 9" /><path d="M9 19l3 3l3 -3" /></svg>
                                        Unduh Surat Kontrak
                                    </a>
                                    <a href="#" class="dropdown-item disabled" >
                                        <svg style="margin-right:5px;" xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon text-danger icon-tabler icons-tabler-outline icon-tabler-trash disabled"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                                        Hapus Surat Kontrak
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
                ->addColumn('supplier', function ($row) {
                    $SK = SuratkontrakModel::where('noform', $row->noform)->first();
                    return $SK->supplier;
                })
                ->editColumn('tanggal', function ($row) {
                    return date('d-m-Y', strtotime($row->tanggal));
                })
                ->rawColumns(['action', 'status'])
                ->make(true);
        }

        return view('products.02_kontrak.kontrak');
    }
    public function destroy($id)
    {
        // $getData = DB::table('permintaanitm')->where('kodeseri', '=', $id)->first();
        // $getCount = DB::table('permintaanitm')->where('noform', '=', $getData->noform)->count();

        // if ($getCount <= 1) {
        //     DB::table('permintaanitm')->where('kodeseri', '=', $id)->delete();
        SuratkontrakitmModel::where('id', '=', $id)->update([
            'status' => 0,
        ]);
        return response()->json('Record deleted successfully.');
        // } else {
        //     DB::table('permintaanitm')->where('kodeseri', '=', $id)->delete();
        //     return response()->json(['success' => 'Record deleted successfully.']);
        // }
    }
}
