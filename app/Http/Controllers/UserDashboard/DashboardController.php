<?php

namespace App\Http\Controllers\UserDashboard;

use App\Models\Jemaat;
use App\Models\Informasi;
use App\Models\Kebaktian;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
     public function index()
    {
        $title = 'Dashboard Jemaat';
        
        // Get jemaat data from session (assuming stored during login)
        $jemaat = null;
        if (session('jemaat_logged_in') && session('jemaat_data')) {
            $jemaat_data = session('jemaat_data');
            $jemaat = Jemaat::find($jemaat_data['id']);
        }
        
        // Get latest announcements
        $pengumuman = Informasi::where('kategori', 'pengumuman')
            ->where('status', 'published')
            ->where('tanggal_diterbitkan', '<=', now())
            ->where(function($query) {
                $query->whereNull('tanggal_kadaluarsa')
                      ->orWhere('tanggal_kadaluarsa', '>=', now());
            })
            ->orderBy('tanggal_diterbitkan', 'desc')
            ->take(3)
            ->get();

        // Get upcoming kebaktian
        $kebaktian_mendatang = Kebaktian::where('tanggal', '>=', now())
            ->where('status', 'scheduled')
            ->orderBy('tanggal')
            ->take(3)
            ->get();

        // Get user's pendaftaran status
        $pendaftaran_active = null;
        if ($jemaat) {
            $pendaftaran_active = Pendaftaran::where('nomor_induk_jemaat', $jemaat->nomor_induk_jemaat)
                ->where('status_pendaftaran', 'pending')
                ->latest()
                ->first();
        }

        // Statistics
        $total_jemaat = Jemaat::where('status_keanggotaan', 'aktif')->count();
        $total_kebaktian_bulan_ini = Kebaktian::whereMonth('tanggal', Carbon::now()->month)
            ->whereYear('tanggal', Carbon::now()->year)
            ->count();

        return view('user_dashboard.pages.dashboard', compact(
            'title', 
            'jemaat', 
            'pengumuman', 
            'kebaktian_mendatang', 
            'pendaftaran_active',
            'total_jemaat',
            'total_kebaktian_bulan_ini'
        ));
    }
}
