<?php

namespace App\Http\Controllers;

use App\Models\Jemaat;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert;

class PendaftaranController extends Controller
{
    public function sidi()
    {
        $title = "Pendaftaran Sidi";
        return view('frontend.pages.pendaftaran.sidi', compact('title'));
    }

    public function baptis()
    {
        $title = "Pendaftaran Baptis";
        return view('frontend.pages.pendaftaran.baptis', compact('title'));
    }

    public function nikah()
    {
        $title = "Pendaftaran Nikah";
        return view('frontend.pages.pendaftaran.nikah', compact('title'));
    }

    public function storeSidi(Request $request)
    {
        try {
            $validated = $request->validate([
                'nomor_induk_jemaat' => 'required|exists:tbl_jemaat,nomor_induk_jemaat',
                'nama_lengkap' => 'required|string|max:255',
                'tanggal_lahir' => 'required|date',
                'tempat_lahir' => 'required|string|max:255',
                'jenis_kelamin' => 'required|in:L,P',
                'nama_ayah' => 'required|string|max:255',
                'nama_ibu' => 'required|string|max:255',
                'tanggal_pelaksanaan' => 'required|date',
                'kartu_keluarga' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
                'pas_foto' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            ]);

            $pendaftaran = new Pendaftaran();
            $pendaftaran->nomor_induk_jemaat = $request->nomor_induk_jemaat;
            $pendaftaran->jenis_pendaftaran = 'sidi';
            $pendaftaran->nama_lengkap = $request->nama_lengkap;
            $pendaftaran->tanggal_lahir = $request->tanggal_lahir;
            $pendaftaran->tempat_lahir = $request->tempat_lahir;
            $pendaftaran->jenis_kelamin = $request->jenis_kelamin;
            $pendaftaran->nama_ayah = $request->nama_ayah;
            $pendaftaran->nama_ibu = $request->nama_ibu;
            $pendaftaran->tanggal_pendaftaran = now();
            $pendaftaran->tanggal_pelaksanaan = $request->tanggal_pelaksanaan;
            $pendaftaran->status_pendaftaran = 'pending';

            if ($request->hasFile('kartu_keluarga')) {
                $pendaftaran->kartu_keluarga = $request->file('kartu_keluarga')->store('kartu_keluarga', 'public');
            }

            if ($request->hasFile('pas_foto')) {
                $pendaftaran->pas_foto = $request->file('pas_foto')->store('pas_foto', 'public');
            }

            $pendaftaran->save();

            Alert::success('Sukses', 'Pendaftaran Sidi berhasil diajukan');
        } catch (\Exception $e) {
            Alert::error('Error', 'Terjadi kesalahan');
            return redirect()->back()->withInput();
        }
        return redirect()->route('pendaftaran.sidi');
    }


    public function storeBaptis(Request $request)
    {
        Log::info('Pendaftaran Baptis dimulai');

        try {
            $validated = $request->validate([
                'nomor_induk_jemaat' => 'required|exists:tbl_jemaat,nomor_induk_jemaat',
                'nama_lengkap' => 'required|string|max:255',
                'tanggal_lahir' => 'required|date',
                'tempat_lahir' => 'required|string|max:255',
                'jenis_kelamin' => 'required|in:L,P',
                'nama_ayah' => 'required|string|max:255',
                'nama_ibu' => 'required|string|max:255',
                'tanggal_pelaksanaan' => 'required|date',
                'kartu_keluarga' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
                'pas_foto' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            ]);
            $pendaftaran = new Pendaftaran();
            $pendaftaran->nomor_induk_jemaat = $request->nomor_induk_jemaat;
            $pendaftaran->jenis_pendaftaran = 'baptis';
            $pendaftaran->nama_lengkap = $request->nama_lengkap;
            $pendaftaran->tanggal_lahir = $request->tanggal_lahir;
            $pendaftaran->tempat_lahir = $request->tempat_lahir;
            $pendaftaran->jenis_kelamin = $request->jenis_kelamin;
            $pendaftaran->nama_ayah = $request->nama_ayah;
            $pendaftaran->nama_ibu = $request->nama_ibu;
            $pendaftaran->tanggal_pendaftaran = now();
            $pendaftaran->tanggal_pelaksanaan = $request->tanggal_pelaksanaan;
            $pendaftaran->status_pendaftaran = 'pending';

            if ($request->hasFile('kartu_keluarga')) {
                $pendaftaran->kartu_keluarga = $request->file('kartu_keluarga')->store('kartu_keluarga', 'public');
            }

            if ($request->hasFile('pas_foto')) {
                $pendaftaran->pas_foto = $request->file('pas_foto')->store('pas_foto', 'public');
            }

            $pendaftaran->save();

            Alert::success('Sukses', 'Pendaftaran Baptis berhasil diajukan');
            Log::info('Pendaftaran Baptis selesai', ['status' => 'success']);
        } catch (\Exception $e) {
            Alert::error('Error', 'Terjadi kesalahan: ' . $e->getMessage());
            Log::error('Pendaftaran Baptis gagal', ['error' => $e->getMessage()]);
            return redirect()->back()->withInput();
        }

        return redirect()->route('pendaftaran.baptis');
    }

    public function storeNikah(Request $request)
    {
        try {
            $validated = $request->validate([
                'nomor_induk_jemaat' => 'required|exists:tbl_jemaat,nomor_induk_jemaat',
                'nama_lengkap' => 'required|string|max:255',
                'tanggal_lahir' => 'required|date',
                'tempat_lahir' => 'required|string|max:255',
                'jenis_kelamin' => 'required|in:L,P',
                'nama_ayah' => 'required|string|max:255',
                'nama_ibu' => 'required|string|max:255',
                'tanggal_pelaksanaan' => 'required|date',
                'kartu_keluarga' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
                'pas_foto' => 'required|image|mimes:jpg,jpeg,png|max:2048',
                'surat_baptis' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
                'surat_sidi' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
                'ktp' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            ]);
    
            $pendaftaran = new Pendaftaran();
            $pendaftaran->nomor_induk_jemaat = $request->nomor_induk_jemaat;
            $pendaftaran->jenis_pendaftaran = 'nikah';
            $pendaftaran->nama_lengkap = $request->nama_lengkap;
            $pendaftaran->tanggal_lahir = $request->tanggal_lahir;
            $pendaftaran->tempat_lahir = $request->tempat_lahir;
            $pendaftaran->jenis_kelamin = $request->jenis_kelamin;
            $pendaftaran->nama_ayah = $request->nama_ayah;
            $pendaftaran->nama_ibu = $request->nama_ibu;
            $pendaftaran->tanggal_pendaftaran = now();
            $pendaftaran->tanggal_pelaksanaan = $request->tanggal_pelaksanaan;
            $pendaftaran->status_pendaftaran = 'pending';
    
            if ($request->hasFile('kartu_keluarga')) {
                $pendaftaran->kartu_keluarga = $request->file('kartu_keluarga')->store('kartu_keluarga', 'public');
            }
            if ($request->hasFile('pas_foto')) {
                $pendaftaran->pas_foto = $request->file('pas_foto')->store('pas_foto', 'public');
            }
            if ($request->hasFile('surat_baptis')) {
                $pendaftaran->surat_baptis = $request->file('surat_baptis')->store('surat_baptis', 'public');
            }
            if ($request->hasFile('surat_sidi')) {
                $pendaftaran->surat_sidi = $request->file('surat_sidi')->store('surat_sidi', 'public');
            }
            if ($request->hasFile('ktp')) {
                $pendaftaran->ktp = $request->file('ktp')->store('ktp', 'public');
            }
    
            $pendaftaran->save();
    
            Alert::success('Sukses', 'Pendaftaran Nikah berhasil diajukan');
            Log::info('Pendaftaran Nikah selesai', ['status' => 'success']);
        } catch (\Exception $e) {
            Alert::error('Error', 'Terjadi kesalahan: ' . $e->getMessage());
            Log::error('Pendaftaran Nikah gagal', ['error' => $e->getMessage()]);
            return redirect()->back()->withInput();
        }
    
        return redirect()->route('pendaftaran.nikah');
    }
}
