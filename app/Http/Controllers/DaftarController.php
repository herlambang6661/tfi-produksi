<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\DaftartipeModel;
use App\Models\DaftarwarnaModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;

class DaftarController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        date_default_timezone_set('Asia/Jakarta');
        setlocale(LC_TIME, 'id_ID');
        \Carbon\Carbon::setLocale('id');
    }
    public function tipe()
    {
        return view('products.01_daftar.tipe', [
            'active' => 'Tipe',
            'judul' => 'Tipe Packaging',
        ]);
    }

    public function storeTipe(Request $request)
    {
        $request->validate(
            [
                'nama' => 'required',
                'kode' => 'required|unique:daftar_tipe|min:1|max:2|string',
            ],
            [
                'nama.required' => 'Masukkan Nama Tipe',
                'kode.required' => 'Kode Tidak Boleh Kosong',
                'kode.unique' => 'Kode "' . $request->kode . '" Sudah dipakai, Tidak Boleh Sama',
                'kode.min' => 'Kode Minimal 1 Karakter',
                'kode.max' => 'Kode Maksimal 2 Karakter',
                'kode.string' => 'Kode Harus Berupa String',
            ]
        );
        try {
            $ins = DaftartipeModel::insert([
                'kode' => $request->kode,
                'nama' => $request->nama,
                'dibuat' => Auth::user()->nickname,
                'created_at' => date('Y-m-d H:i:s'),
            ]);
            if ($ins) {
                $arr = 'Data Tipe telah berhasil disimpan';
            }
            return Response()->json($arr);
        } catch (\Illuminate\Database\QueryException $e) {
            dd($e);
            $arr = array('msg' => 'Something goes to wrong. Please try later. ' . $e, 'status' => false);
        }
    }
    public function storeWarna(Request $request)
    {
        $request->validate(
            [
                'kodetipe' => 'required',
                'warna' => 'required',
            ],
            [
                'kodetipe.required' => 'Masukkan Tipe',
                'warna.required' => 'Warna Tidak Boleh Kosong',
            ]
        );
        try {
            $tipe = DaftartipeModel::where('id', $request->kodetipe)->first();
            $ins = DaftarwarnaModel::insert([
                'id_tipe' => $tipe->id,
                'kode' => $tipe->kode,
                'warna' => $request->warna,
                'dibuat' => Auth::user()->nickname,
                'created_at' => date('Y-m-d H:i:s'),
            ]);
            if ($ins) {
                $arr = 'Data Tipe telah berhasil disimpan';
            }
            return Response()->json($arr);
        } catch (\Illuminate\Database\QueryException $e) {
            dd($e);
            $arr = array('msg' => 'Something goes to wrong. Please try later. ' . $e, 'status' => false);
        }
    }

    public function getkodetipe(Request $request)
    {
        if ($request->has('q')) {
            $search = $request->q;
            $kabag = DaftartipeModel::where('nama', 'LIKE', "%$search%")->orWhere('kode', 'LIKE', "%$search%")
                ->orderBy('nama')
                ->get();
        } else {
            $kabag = DaftartipeModel::all();
        }
        return Response()->json($kabag);
    }

    public function viewEdittipe(Request $request)
    {
        $data = DaftartipeModel::where('id', $request->id)->first();
        echo '
            <input type="hidden" name="_token" value="' . csrf_token() . '">
            <input type="hidden" name="id" value="' . $request->id . '">
            <div class="modal-body">
                <div class="card-stamp card-stamp-lg">
                    <div class="card-stamp-icon bg-primary">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Nama Tipe</label>
                    <input type="text" class="form-control border border-dark" name="nama"
                        id="Editnama" placeholder="Contoh: Flake, Popcorn" onchange="fetchKarEdit()"
                        onkeydown="if (event.keyCode == 13)  fetchKarEdit()"
                        style="text-transform: capitalize;" value="' . $data->nama . '">
                </div>
                <div class="mb-3">
                    <label class="form-label">Kode</label>
                    <input type="text" class="form-control border border-dark" name="kode"
                        id="Editkode" placeholder="Kode dibuat otomatis setelah nama tipe dibuat"
                        style="text-transform: uppercase;" value="' . $data->kode . '">
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" id="submitEditTipe" class="btn btn-primary ms-auto">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="icon icon-tabler icon-tabler-device-floppy" width="24" height="24"
                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" />
                        <path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                        <path d="M14 4l0 4l-6 0l0 -4" />
                    </svg>
                    Simpan
                </button>
            </div>
        ';
    }
    public function viewEditwarna(Request $request)
    {
        $data = DaftarwarnaModel::where('id', $request->id)->first();
        $dataTipe = DaftartipeModel::where('id', $data->id_tipe)->first();
        echo '
            <input type="hidden" name="_token" value="' . csrf_token() . '">
            <input type="hidden" name="id" value="' . $request->id . '">
            <div class="modal-body">
                <div class="card-stamp card-stamp-lg">
                    <div class="card-stamp-icon bg-purple">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Kode Tipe</label>
                    <style>
                        #select2-kodetipe-container {
                            border: 1px solid black;
                        }
                    </style>
                    <script>
                        $(".select2kodetipeedit").select2({
                            dropdownParent: $("#modal-edit-warna"),
                            language: "id",
                            width: "100%",
                            height: "100%",
                            placeholder: "Pilih Tipe",
                            ajax: {
                                url: "/getkodetipe",
                                dataType: "json",
                                processResults: function(response) {
                                    return {
                                        results: $.map(response, function(item) {
                                            return {
                                                text: item.kode + " - " + item.nama,
                                                id: item.id,
                                            }
                                        })
                                    };
                                },
                                cache: true
                            },
                        });
                    </script>
                    <select name="kodetipe" id="kodetipe" class="form-select select2kodetipeedit"
                        data-select2-id="kodetipe" tabindex="-1" aria-hidden="true">
                        <option value="' . $dataTipe->id . '" selected="selected">' . $dataTipe->kode . ' - ' . $dataTipe->nama . '</option> 
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Warna</label>
                    <input type="text" class="form-control border border-dark" name="warna"
                        id="Editwarna" style="text-transform: uppercase;" value="' . $data->warna . '">
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" id="submitEditWarna" class="btn btn-primary ms-auto">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="icon icon-tabler icon-tabler-device-floppy" width="24" height="24"
                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" />
                        <path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                        <path d="M14 4l0 4l-6 0l0 -4" />
                    </svg>
                    Simpan
                </button>
            </div>
        ';
    }

    public function storeEditTipe(Request $request)
    {
        $product = DaftartipeModel::findOrFail($request->id);
        try {
            $request->validate(
                [
                    'nama' => 'required',
                    'kode' => 'required|min:1|max:2|string',
                ],
                [
                    'nama.required' => 'Masukkan Nama Tipe',
                    'kode.required' => 'Kode Tidak Boleh Kosong',
                    'kode.min' => 'Kode Minimal 1 Karakter',
                    'kode.max' => 'Kode Maksimal 2 Karakter',
                    'kode.string' => 'Kode Harus Berupa String',
                ]
            );

            $upd = $product->update([
                'kode' => $request->kode,
                'nama' => $request->nama,
                'dibuat' => Auth::user()->nickname,
                'updated_at' => date('Y-m-d H:i:s'),
            ]);

            if ($upd) {
                $arr = 'Data Tipe telah berhasil diubah';
            }
            return Response()->json($arr);
        } catch (\Illuminate\Database\QueryException $e) {
            dd($e);
            $arr = array('msg' => 'Something goes to wrong. Please try later. ' . $e, 'status' => false);
        }
    }
    public function storeEditWarna(Request $request)
    {
        try {
            $request->validate(
                [
                    'kodetipe' => 'required',
                    'warna' => 'required',
                ],
                [
                    'kodetipe.required' => 'Masukkan Kode Tipe',
                    'warna.required' => 'Warna Tidak Boleh Kosong',
                ]
            );

            $product = DaftarwarnaModel::findOrFail($request->id);
            $dataTipe = DaftartipeModel::where('id', $request->kodetipe)->first();

            $upd = $product->update([
                'id_tipe' => $dataTipe->id,
                'kode' => $dataTipe->kode,
                'warna' => $request->warna,
                'dibuat' => Auth::user()->nickname,
                'updated_at' => date('Y-m-d H:i:s'),
            ]);

            if ($upd) {
                $arr = 'Data Warna telah berhasil diubah';
            }
            return Response()->json($arr);
        } catch (\Illuminate\Database\QueryException $e) {
            dd($e);
            $arr = array('msg' => 'Something goes to wrong. Please try later. ' . $e, 'status' => false);
        }
    }
}
