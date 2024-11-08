<?php

namespace App\Http\Controllers;

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
}
