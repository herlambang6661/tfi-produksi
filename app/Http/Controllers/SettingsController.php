<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        date_default_timezone_set('Asia/Jakarta');
        setlocale(LC_TIME, 'id_ID');
        \Carbon\Carbon::setLocale('id');
    }

    public function pengguna()
    {
        $users = User::where('username', '!=', 'Administrator')->get();
        $totalUsers = $users->count();

        return view('products.06_setting.pengguna', [
            'users' => $users,
            'totalUsers' => $totalUsers,
            'judul' => 'List Pengguna',
            'active' => 'Pengguna',
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'stb' => 'required',
            'nickname' => 'required',
            'username' => 'required',
            'password' => 'required',
            'role' => 'required',
            'telp' => 'required',
        ]);

        $users = new User();

        $users->stb = $request->input('stb');
        $users->nickname = $request->input('nickname');
        $users->username = $request->input('username');
        $users->password = Hash::make($request->password);
        $users->role = $request->input('role');
        $users->telp = $request->input('telp');
        $users->save();

        if ($users->save()) {
            return redirect()->back()->with('success', 'Data pengguna berhasil di tambahkan');
        } else {
            return redirect()->back()->with('error', 'Data pengguna gagal ditambahkan, silahkan coba kembali');
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'stb' => 'required',
            'nickname' => 'required',
            'username' => 'required',
            'role' => 'required',
            'telp' => 'required',
        ]);

        $users = User::find($id);

        $users->stb = $request->input('stb');
        $users->nickname = $request->input('nickname');
        $users->username = $request->input('username');
        $users->role = $request->input('role');
        $users->telp = $request->input('telp');
        $users->save();

        if ($users->save()) {
            return redirect()->back()->with('success', 'Data pengguna berhasil di update');
        } else {
            return redirect()->back()->with('error', 'Data pengguna gagal diupdate, silahkan coba kembali');
        }
    }

    public function reset(Request $request, $id)
    {
        $request->validate([
            'password' => 'required|min:5|confirmed',
        ]);
        $user = User::findOrFail($id);
        $user->password = bcrypt($request->password);
        $user->save();

        if ($user->save()) {
            return redirect()->back()->with('success', 'Data password pengguna berhasil di update');
        } else {
            return redirect()->back()->with('error', 'Data password pengguna gagal diupdate, silahkan coba kembali');
        }
    }

    public function destroy($id)
    {
        $users = User::find($id);
        if ($users->delete()) {
            return redirect()->back()->with('success', 'Data pengguna berhasil di hapus');
        } else {
            return redirect()->back()->with('error', 'Data pengguna gagal di tambahkan, silahkan coba kembali');
        }
    }

    public function logActivity()
    {
        return view('products.06_setting.logActivity', [
            'judul' => 'Activity Log',
            'active' => 'Log',
        ]);
    }

    public function viewLog(Request $request)
    {
        $data = ActivityLog::with('user')->where('id', $request->id)->first(); // Eager load relasi user

        echo '
        <input type="hidden" name="_token" value="' . csrf_token() . '">
        <input type="hidden" name="id" value="' . $request->id . '">
        <div class="modal-body">
            <div class="card-stamp card-stamp-lg">
                <div class="card-stamp-icon bg-primary">
                    <i class="fa-solid fa-pen-to-square"></i>
                </div>
            </div>
            <div class="table-responsive scrollbar">
                <table class="table fs--1 mb-0 table-bordered" style="border: #c3c6c9;">
                    <thead>
                        <tr>
                            <th class="sort pe-1 align-middle white-space-nowrap bg-100 text-900">Tgl Record</th>
                            <td class="sort pe-1 align-middle white-space-nowrap">
                                ' . \Carbon\Carbon::parse($data->updated_at)->translatedFormat('l, d F Y H:i:s') . ' WIB
                            </td>
                        </tr>
                        <tr>
                            <th class="sort pe-1 align-middle white-space-nowrap bg-100 text-900">User</th>
                            <td class="sort pe-1 align-middle white-space-nowrap">' . ($data->user ? $data->user->username : 'Unknown') . '</td> <!-- Mengambil username dari relasi -->
                        </tr>
                        <tr>
                            <th class="sort pe-1 align-middle white-space-nowrap bg-100 text-900">No Hp</th>
                            <td class="sort pe-1 align-middle white-space-nowrap">' . ($data->user ? $data->user->telp : 'Unknown') . '</td>
                        </tr>
                        <tr>
                            <th class="sort pe-1 align-middle white-space-nowrap bg-100 text-900">Action</th>
                            <td class="sort pe-1 align-middle white-space-nowrap">' . $data->action . '</td>
                        </tr>
                        <tr>
                            <th class="sort pe-1 align-middle white-space-nowrap bg-100 text-900">IP Address</th>
                            <td class="sort pe-1 align-middle white-space-nowrap">' . $data->ip_address . '</td>
                        </tr>
                        <tr>
                            <th class="sort pe-1 align-middle white-space-nowrap bg-100 text-900">Description</th>
                            <td class="sort pe-1 align-middle white-space-nowrap">' . $data->description . '</td>
                        </tr>
                        <tr>
                            <th class="sort pe-1 align-middle white-space-nowrap bg-100 text-900">Status</th>
                            <td class="sort pe-1 align-middle white-space-nowrap">' . $data->status_code . '</td>
                        </tr>
                        <tr>
                            <th class="sort pe-1 align-middle white-space-nowrap bg-100 text-900">Status Description</th>
                            <td class="sort pe-1 align-middle white-space-nowrap">' . $data->status_description . '</td>
                        </tr>
                        <tr>
                            <th class="sort pe-1 align-middle white-space-nowrap bg-100 text-900">Browser</th>
                            <td class="sort pe-1 align-middle white-space-nowrap">' . $data->user_agent . '</td>
                        </tr>
                        <tr>
                            <th class="sort pe-1 align-middle white-space-nowrap bg-100 text-900">Request</th>
                            <td class="sort pe-1 align-middle white-space-nowrap">
                                <pre style="font-size: 12px;">' . json_encode(json_decode($data->request_data), JSON_PRETTY_PRINT) . '</pre>
                            </td>
                        </tr>
                    </thead>
                </table>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
            </div>
        ';
    }
}
