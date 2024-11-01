<?php

namespace App\Http\Controllers\_01_Datatables\Gudang;

use App\Http\Controllers\Controller;
use App\Models\GudangpenerimaanitmModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ScanBarcodeList extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = GudangpenerimaanitmModel::all();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('products.03_gudang.scan_barcode');
    }
}
