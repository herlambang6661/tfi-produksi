<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        Auth::check();
        date_default_timezone_set('Asia/Jakarta');
        setlocale(LC_TIME, 'id_ID');
        \Carbon\Carbon::setLocale('id');
    }
    public function dashboard()
    {
        if (Auth::check()) {
            return view('products.dashboard', [
                'active' => 'Dashboard',
                'judul' => 'Dashboard',
            ]);
        }
        return redirect("/")->withErrors(['error' => 'Opps! You do not have access'])->withInput();
    }
}
