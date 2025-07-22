<?php

namespace App\Http\Controllers\UserDashboard;

use App\Models\Jemaat;
use App\Models\Keluarga;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class KeluargaController extends Controller
{
    public function index()
    {
        $title = 'Data Keluarga';
        
        // Get jemaat data from session
        $jemaat = null;
        $keluarga = null;
        $anggota_keluarga = collect();
        
        if (session('jemaat_logged_in') && session('jemaat_data')) {
            $jemaat_data = session('jemaat_data');
            $jemaat = Jemaat::find($jemaat_data['id']);
            
            if ($jemaat) {
                // Get keluarga data
                $keluarga = Keluarga::find($jemaat->id_keluarga);
                
                // Get all family members
                $anggota_keluarga = Jemaat::where('id_keluarga', $jemaat->id_keluarga)
                    ->orderBy('tanggal_lahir')
                    ->get();
            }
        }
        
        return view('user_dashboard.pages.keluarga.index', compact(
            'title', 
            'jemaat', 
            'keluarga', 
            'anggota_keluarga'
        ));
    }
}
