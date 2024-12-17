<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use App\Models\Informasi;
use App\Models\Kebaktian;
use App\Models\OrganisasiAnggota;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $title = "Beranda";

        $anggotaData = OrganisasiAnggota::with('kategori')
            ->orderBy('urutan')
            ->get();
        $informasiData = Informasi::where('status', 'published')
            ->whereDate('tanggal_diterbitkan', '<=', now())
            ->whereDate('tanggal_kadaluarsa', '>', now())
            ->orWhereNull('tanggal_kadaluarsa')
            ->orderBy('tanggal_diterbitkan', 'desc')
            ->get();
        $galeriData = Galeri::where('aktif', true)
            ->orderBy('urutan')
            ->get();
        return view('frontend.home', compact('title', 'anggotaData', 'informasiData', 'galeriData'));
    }

    public function showKonten($id)
    {
        $title = "Kontent";
        $informasi = Informasi::findOrFail($id);
        return view('frontend.pages.showKontent', compact('title', 'informasi'));
    }

    public function kebaktian($jenis = null)
    {
        $title = "Kebaktian";
        if ($jenis) {
            $kebaktian = Kebaktian::where('jenis_kebaktian', $jenis)->get();
        } else {
            $kebaktian = Kebaktian::all();
        }
        return view('frontend.pages.kebaktian', compact('title', 'kebaktian', 'jenis'));
    }
}
