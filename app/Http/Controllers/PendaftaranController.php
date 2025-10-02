<?php

namespace App\Http\Controllers;

use DateTime;
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

            if ($request->has('validate_only')) {
                $request->validate([
                    'nomor_induk_jemaat' => [
                        'required',
                        'exists:tbl_jemaat,nomor_induk_jemaat'
                    ],
                ], [
                    'nomor_induk_jemaat.required' => 'Nomor induk jemaat wajib diisi',
                    'nomor_induk_jemaat.exists' => 'Nomor induk jemaat tidak terdaftar dalam sistem',
                ]);

                return response()->json(['success' => true, 'message' => 'Nomor induk valid']);
            }


            $validated = $request->validate([
                'nomor_induk_jemaat' => [
                    'required',
                    'exists:tbl_jemaat,nomor_induk_jemaat'
                ],
                'nama_lengkap' => 'required|string|max:255',
                'tanggal_lahir' => 'required|date|before:today',
                'tempat_lahir' => 'required|string|max:255',
                'jenis_kelamin' => 'required|in:L,P',
                'nama_ayah' => 'required|string|max:255',
                'nama_ibu' => 'required|string|max:255',
                'tanggal_pelaksanaan' => 'required|date|after:today',
                'kartu_keluarga' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
                'pas_foto' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            ], [
                'nomor_induk_jemaat.required' => 'Nomor induk jemaat wajib diisi',
                'nomor_induk_jemaat.exists' => 'Nomor induk jemaat tidak terdaftar dalam sistem',
                'tanggal_lahir.before' => 'Tanggal lahir harus sebelum hari ini',
                'tanggal_pelaksanaan.after' => 'Tanggal pelaksanaan harus setelah hari ini',
                'kartu_keluarga.max' => 'Ukuran file kartu keluarga maksimal 2MB',
                'pas_foto.max' => 'Ukuran file pas foto maksimal 2MB',
            ]);


            $existingRegistration = Pendaftaran::where('nomor_induk_jemaat', $request->nomor_induk_jemaat)
                ->where('jenis_pendaftaran', 'sidi')
                ->whereIn('status_pendaftaran', ['pending', 'approved'])
                ->first();

            if ($existingRegistration) {
                if ($request->ajax()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Anda sudah pernah mendaftar sidi sebelumnya'
                    ]);
                }
                return redirect()->back()->withInput()->with('error', 'Anda sudah pernah mendaftar sidi sebelumnya');
            }


            $birthDate = new \DateTime($request->tanggal_lahir);
            $today = new \DateTime();
            $age = $today->diff($birthDate)->y;

            if ($age < 12) {
                if ($request->ajax()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Umur minimal untuk sidi adalah 12 tahun'
                    ]);
                }
                return redirect()->back()->withInput()->with('error', 'Umur minimal untuk sidi adalah 12 tahun');
            }

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

            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Pendaftaran sidi berhasil diajukan'
                ]);
            }

            return redirect()->route('pendaftaran.sidi')->with('success', 'Pendaftaran Sidi berhasil diajukan');

        } catch (\Illuminate\Validation\ValidationException $e) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'validation_error' => true,
                    'message' => 'Validasi gagal',
                    'errors' => $e->errors()
                ], 422);
            }
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            Log::error('Pendaftaran Sidi gagal', ['error' => $e->getMessage()]);

            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Terjadi kesalahan: ' . $e->getMessage()
                ], 500);
            }

            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function storeBaptis(Request $request)
    {
        Log::info('Pendaftaran Baptis dimulai');

        try {

            if ($request->has('validate_only')) {
                $request->validate([
                    'nomor_induk_jemaat' => [
                        'required',
                        'exists:tbl_jemaat,nomor_induk_jemaat'
                    ],
                ], [
                    'nomor_induk_jemaat.required' => 'Nomor induk jemaat wajib diisi',
                    'nomor_induk_jemaat.exists' => 'Nomor induk jemaat tidak terdaftar dalam sistem',
                ]);

                return response()->json(['success' => true, 'message' => 'Nomor induk valid']);
            }


            $validated = $request->validate([
                'nomor_induk_jemaat' => [
                    'required',
                    'exists:tbl_jemaat,nomor_induk_jemaat'
                ],
                'nama_lengkap' => 'required|string|max:255',
                'tanggal_lahir' => 'required|date|before:today',
                'tempat_lahir' => 'required|string|max:255',
                'jenis_kelamin' => 'required|in:L,P',
                'nama_ayah' => 'required|string|max:255',
                'nama_ibu' => 'required|string|max:255',
                'tanggal_pelaksanaan' => 'required|date|after:today',
                'kartu_keluarga' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
                'pas_foto' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            ], [
                'nomor_induk_jemaat.required' => 'Nomor induk jemaat wajib diisi',
                'nomor_induk_jemaat.exists' => 'Nomor induk jemaat tidak terdaftar dalam sistem',
                'tanggal_lahir.before' => 'Tanggal lahir harus sebelum hari ini',
                'tanggal_pelaksanaan.after' => 'Tanggal pelaksanaan harus setelah hari ini',
                'kartu_keluarga.max' => 'Ukuran file kartu keluarga maksimal 2MB',
                'pas_foto.max' => 'Ukuran file pas foto maksimal 2MB',
            ]);


            $existingRegistration = Pendaftaran::where('nomor_induk_jemaat', $request->nomor_induk_jemaat)
                ->where('jenis_pendaftaran', 'baptis')
                ->whereIn('status_pendaftaran', ['pending', 'approved'])
                ->first();

            if ($existingRegistration) {
                if ($request->ajax()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Anda sudah pernah mendaftar baptis sebelumnya'
                    ]);
                }
                return redirect()->back()->withInput()->with('error', 'Anda sudah pernah mendaftar baptis sebelumnya');
            }



            $birthDate = new \DateTime($request->tanggal_lahir);
            $today = new \DateTime();
            $age = $today->diff($birthDate)->y;


            if ($age > 80) {
                if ($request->ajax()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Silakan hubungi admin untuk pendaftaran baptis'
                    ]);
                }
                return redirect()->back()->withInput()->with('error', 'Silakan hubungi admin untuk pendaftaran baptis');
            }

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

            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Pendaftaran baptis berhasil diajukan'
                ]);
            }

            return redirect()->route('pendaftaran.baptis')->with('success', 'Pendaftaran Baptis berhasil diajukan');

        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Pendaftaran Baptis validasi gagal', ['error' => $e->errors()]);

            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'validation_error' => true,
                    'message' => 'Validasi gagal',
                    'errors' => $e->errors()
                ], 422);
            }
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            Log::error('Pendaftaran Baptis gagal', ['error' => $e->getMessage()]);

            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Terjadi kesalahan: ' . $e->getMessage()
                ], 500);
            }

            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function storeNikah(Request $request)
    {
        try {
            if ($request->has('validate_only')) {
                $request->validate([
                    'nomor_induk_jemaat' => [
                        'required',
                        'exists:tbl_jemaat,nomor_induk_jemaat'
                    ],
                ], [
                    'nomor_induk_jemaat.required' => 'Nomor induk jemaat wajib diisi',
                    'nomor_induk_jemaat.exists' => 'Nomor induk jemaat tidak terdaftar dalam sistem',
                ]);

                return response()->json(['success' => true, 'message' => 'Nomor induk valid']);
            }
            $rules = [
                'nomor_induk_jemaat' => [
                    'required',
                    'exists:tbl_jemaat,nomor_induk_jemaat'
                ],
                'nama_lengkap' => 'required|string|max:255',
                'tanggal_lahir' => 'required|date|before:today',
                'tempat_lahir' => 'required|string|max:255',
                'jenis_kelamin' => 'required|in:L,P',
                'nama_ayah' => 'required|string|max:255',
                'nama_ibu' => 'required|string|max:255',
                'saksi1' => 'required|string|max:255',
                'saksi2' => 'required|string|max:255',
                'tanggal_pelaksanaan' => 'required|date|after:today',

                'alamat_pendaftar' => 'required|string|max:500',
                'alamat_pasangan' => 'required|string|max:500',


                // Dokumen pendaftar
                'kartu_keluarga' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
                'pas_foto' => 'required|image|mimes:jpg,jpeg,png|max:2048',
                'surat_baptis' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
                'surat_sidi' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
                'ktp' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',

                // Status pasangan
                'is_pasangan_jemaat' => 'required|boolean',

                // Dokumen pasangan
                'kartu_keluarga_pasangan' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
                'ktp_pasangan' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
                'surat_baptis_pasangan' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
                'surat_sidi_pasangan' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
                'pas_foto_pasangan' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            ];

            if ($request->is_pasangan_jemaat == '1') {
                $rules['nomor_induk_jemaat_pasangan'] = 'required|exists:tbl_jemaat,nomor_induk_jemaat|different:nomor_induk_jemaat';
            } else {
                $rules['nama_pasangan'] = 'required|string|max:255';
                $rules['nama_ayah_pasangan'] = 'required|string|max:255';
                $rules['nama_ibu_pasangan'] = 'required|string|max:255';
            }

            $messages = [
                'nomor_induk_jemaat.required' => 'Nomor induk jemaat wajib diisi',
                'nomor_induk_jemaat.exists' => 'Nomor induk jemaat tidak terdaftar dalam sistem',
                'tanggal_lahir.before' => 'Tanggal lahir harus sebelum hari ini',
                'tanggal_pelaksanaan.after' => 'Tanggal pelaksanaan harus setelah hari ini',
                'kartu_keluarga.max' => 'Ukuran file kartu keluarga maksimal 2MB',
                'pas_foto.max' => 'Ukuran file pas foto maksimal 2MB',
                'surat_baptis.max' => 'Ukuran file surat baptis maksimal 2MB',
                'surat_sidi.max' => 'Ukuran file surat sidi maksimal 2MB',
                'ktp.max' => 'Ukuran file KTP maksimal 2MB',
                'kartu_keluarga_pasangan.max' => 'Ukuran file KK pasangan maksimal 2MB',
                'ktp_pasangan.max' => 'Ukuran file KTP pasangan maksimal 2MB',
                'surat_baptis_pasangan.max' => 'Ukuran file surat baptis pasangan maksimal 2MB',
                'surat_sidi_pasangan.max' => 'Ukuran file surat sidi pasangan maksimal 2MB',
                'pas_foto_pasangan.max' => 'Ukuran file pas foto pasangan maksimal 2MB',
                'nomor_induk_jemaat_pasangan.required' => 'Nomor induk jemaat pasangan wajib dipilih',
                'nomor_induk_jemaat_pasangan.exists' => 'Nomor induk jemaat pasangan tidak terdaftar',
                'nomor_induk_jemaat_pasangan.different' => 'Nomor induk jemaat pasangan harus berbeda dengan pendaftar',
                'nama_pasangan.required' => 'Nama pasangan wajib diisi',
                'nama_ayah_pasangan.required' => 'Nama ayah pasangan wajib diisi',
                'nama_ibu_pasangan.required' => 'Nama ibu pasangan wajib diisi',
                'saksi1.required' => 'Saksi 1 wajib diisi',
                'saksi2.required' => 'Saksi 2 wajib diisi',
                'alamat_pendaftar.required' => 'Alamat pendaftar wajib diisi',
                'alamat_pasangan.required' => 'Alamat pasangan wajib diisi',
            ];

            $validated = $request->validate($rules, $messages);
            $existingRegistration = Pendaftaran::where('nomor_induk_jemaat', $request->nomor_induk_jemaat)
                ->where('jenis_pendaftaran', 'nikah')
                ->whereIn('status_pendaftaran', ['pending', 'approved'])
                ->first();

            if ($existingRegistration) {
                if ($request->ajax()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Anda sudah pernah mendaftar nikah sebelumnya'
                    ]);
                }
                return redirect()->back()->withInput()->with('error', 'Anda sudah pernah mendaftar nikah sebelumnya');
            }
            $birthDate = new DateTime($request->tanggal_lahir);
            $today = new \DateTime();
            $age = $today->diff($birthDate)->y;

            if ($age < 18) {
                if ($request->ajax()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Umur minimal untuk nikah adalah 18 tahun'
                    ]);
                }
                return redirect()->back()->withInput()->with('error', 'Umur minimal untuk nikah adalah 18 tahun');
            }
            $pendaftaran = new Pendaftaran();
            $pendaftaran->nomor_induk_jemaat = $request->nomor_induk_jemaat;
            $pendaftaran->jenis_pendaftaran = 'nikah';
            $pendaftaran->nama_lengkap = $request->nama_lengkap;
            $pendaftaran->tanggal_lahir = $request->tanggal_lahir;
            $pendaftaran->tempat_lahir = $request->tempat_lahir;
            $pendaftaran->jenis_kelamin = $request->jenis_kelamin;
            $pendaftaran->nama_ayah = $request->nama_ayah;
            $pendaftaran->nama_ibu = $request->nama_ibu;
            $pendaftaran->saksi1 = $request->saksi1;
            $pendaftaran->saksi2 = $request->saksi2;
            $pendaftaran->tanggal_pendaftaran = now();
            $pendaftaran->tanggal_pelaksanaan = $request->tanggal_pelaksanaan;
            $pendaftaran->status_pendaftaran = 'pending';
            $pendaftaran->alamat_pendaftar = $request->input('alamat_pendaftar');
            $pendaftaran->alamat_pasangan = $request->input('alamat_pasangan');


            if ($request->is_pasangan_jemaat == '1') {
                $pendaftaran->nomor_induk_jemaat_pasangan = $request->nomor_induk_jemaat_pasangan;
                $pendaftaran->nama_pasangan = null;
                $pendaftaran->nama_ayah_pasangan = null;
                $pendaftaran->nama_ibu_pasangan = null;
            } else {
                $pendaftaran->nama_pasangan = $request->nama_pasangan;
                $pendaftaran->nama_ayah_pasangan = $request->nama_ayah_pasangan;
                $pendaftaran->nama_ibu_pasangan = $request->nama_ibu_pasangan;
                $pendaftaran->nomor_induk_jemaat_pasangan = null;
            }

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

            if ($request->hasFile('kartu_keluarga_pasangan')) {
                $pendaftaran->kartu_keluarga_pasangan = $request->file('kartu_keluarga_pasangan')
                    ->store('kartu_keluarga_pasangan', 'public');
            }
            if ($request->hasFile('ktp_pasangan')) {
                $pendaftaran->ktp_pasangan = $request->file('ktp_pasangan')
                    ->store('ktp_pasangan', 'public');
            }
            if ($request->hasFile('surat_baptis_pasangan')) {
                $pendaftaran->surat_baptis_pasangan = $request->file('surat_baptis_pasangan')
                    ->store('surat_baptis_pasangan', 'public');
            }
            if ($request->hasFile('surat_sidi_pasangan')) {
                $pendaftaran->surat_sidi_pasangan = $request->file('surat_sidi_pasangan')
                    ->store('surat_sidi_pasangan', 'public');
            }
            if ($request->hasFile('pas_foto_pasangan')) {
                $pendaftaran->pas_foto_pasangan = $request->file('pas_foto_pasangan')
                    ->store('pas_foto_pasangan', 'public');
            }

            $pendaftaran->save();

            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Pendaftaran nikah berhasil diajukan'
                ]);
            }

            return redirect()->route('pendaftaran.nikah')->with('success', 'Pendaftaran Nikah berhasil diajukan');

        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Pendaftaran Nikah validasi gagal', ['error' => $e->errors()]);

            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'validation_error' => true,
                    'message' => 'Validasi gagal',
                    'errors' => $e->errors()
                ], 422);
            }
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            Log::error('Pendaftaran Nikah gagal', ['error' => $e->getMessage()]);

            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Terjadi kesalahan: ' . $e->getMessage()
                ], 500);
            }

            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function getJemaatList(Request $request)
    {
        $currentJemaat = $request->get('current');

        $jemaat = Jemaat::where('status_keanggotaan', 'aktif')
            ->when($currentJemaat, function ($query, $currentJemaat) {
                return $query->where('nomor_induk_jemaat', '!=', $currentJemaat);
            })
            ->select('nomor_induk_jemaat', 'nama_lengkap', 'jenis_kelamin')
            ->orderBy('nama_lengkap')
            ->get();

        return response()->json($jemaat);
    }
}
