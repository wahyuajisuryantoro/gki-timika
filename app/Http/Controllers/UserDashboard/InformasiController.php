<?php

namespace App\Http\Controllers\UserDashboard;

use App\Models\Jemaat;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InformasiController extends Controller
{
    public function informasiSidi(Request $request)
    {
        $title = 'Informasi Sidi';
        $jemaatData = session('jemaat_data');
        $nomorInduk = $jemaatData['nomor_induk'];
        $jemaat = Jemaat::where('nomor_induk_jemaat', $nomorInduk)->first();
        $pendaftaranSidi = Pendaftaran::where('nomor_induk_jemaat', $nomorInduk)
            ->where('jenis_pendaftaran', 'sidi')
            ->orderBy('tanggal_pendaftaran', 'desc')
            ->get();
        $statusSidi = [
            'sudah_sidi' => !is_null($jemaat->tanggal_sidi),
            'tanggal_sidi' => $jemaat->tanggal_sidi,
            'bisa_daftar' => is_null($jemaat->tanggal_sidi),
            'ada_pendaftaran_aktif' => $pendaftaranSidi->whereIn('status_pendaftaran', ['pending', 'approved'])->isNotEmpty()
        ];
        $umur = $jemaat->tanggal_lahir ? $jemaat->tanggal_lahir->age : 0;
        return view('user_dashboard.pages.informasi.sidi', compact(
            'title',
            'jemaat',
            'pendaftaranSidi',
            'statusSidi',
            'umur'
        ));
    }

    public function informasiBaptis(Request $request)
    {
        $title = 'Informasi Baptis';
        $jemaatData = session('jemaat_data');
        $nomorInduk = $jemaatData['nomor_induk'];
        $jemaat = Jemaat::where('nomor_induk_jemaat', $nomorInduk)->first();
        $pendaftaranBaptis = Pendaftaran::where('nomor_induk_jemaat', $nomorInduk)
            ->where('jenis_pendaftaran', 'baptis')
            ->orderBy('tanggal_pendaftaran', 'desc')
            ->get();
        $statusBaptis = [
            'sudah_baptis' => !is_null($jemaat->tanggal_baptis),
            'tanggal_baptis' => $jemaat->tanggal_baptis,
            'bisa_daftar' => is_null($jemaat->tanggal_baptis),
            'ada_pendaftaran_aktif' => $pendaftaranBaptis->whereIn('status_pendaftaran', ['pending', 'approved'])->isNotEmpty()
        ];
        $umur = $jemaat->tanggal_lahir ? $jemaat->tanggal_lahir->age : 0;
        return view('user_dashboard.pages.informasi.baptis', compact(
            'title',
            'jemaat',
            'pendaftaranBaptis',
            'statusBaptis',
            'umur'
        ));
    }

    public function informasiNikah(Request $request)
    {
        $title = 'Informasi Nikah';
        $jemaatData = session('jemaat_data');
        $nomorInduk = $jemaatData['nomor_induk'];
        $jemaat = Jemaat::where('nomor_induk_jemaat', $nomorInduk)->first();
        $pendaftaranNikah = Pendaftaran::where('nomor_induk_jemaat', $nomorInduk)
            ->where('jenis_pendaftaran', 'nikah')
            ->orderBy('tanggal_pendaftaran', 'desc')
            ->get();
        $umur = $jemaat->tanggal_lahir ? $jemaat->tanggal_lahir->age : 0;
        $sudahBaptis = !is_null($jemaat->tanggal_baptis);
        $sudahSidi = !is_null($jemaat->tanggal_sidi);
        $statusNikah = [
            'sudah_menikah' => $jemaat->status_pernikahan === 'menikah',
            'status_pernikahan' => $jemaat->status_pernikahan,
            'memenuhi_syarat_umur' => $umur >= 18,
            'sudah_baptis' => $sudahBaptis,
            'sudah_sidi' => $sudahSidi,
            'bisa_daftar' => ($umur >= 18) && $sudahBaptis && $sudahSidi && ($jemaat->status_pernikahan !== 'menikah'),
            'ada_pendaftaran_aktif' => $pendaftaranNikah->whereIn('status_pendaftaran', ['pending', 'approved'])->isNotEmpty()
        ];

        return view('user_dashboard.pages.informasi.nikah', compact(
            'title',
            'jemaat',
            'pendaftaranNikah',
            'statusNikah',
            'umur'
        ));
    }
}
