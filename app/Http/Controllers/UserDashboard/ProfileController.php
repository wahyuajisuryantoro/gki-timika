<?php

namespace App\Http\Controllers\UserDashboard;

use App\Models\Jemaat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
   public function index()
    {
        $title = "Profile Saya";
        $jemaat = null;
        
        if (session('jemaat_logged_in') && session('jemaat_data')) {
            $jemaat_data = session('jemaat_data');
            $jemaat = Jemaat::find($jemaat_data['id']);
        }
        
        if (!$jemaat) {
            return redirect()->route('auth.login')->with('error', 'Silakan login terlebih dahulu');
        }
        
        return view('user_dashboard.pages.profile.index', compact('title', 'jemaat'));
    }
}
