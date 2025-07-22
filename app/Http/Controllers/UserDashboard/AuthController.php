<?php

namespace App\Http\Controllers\UserDashboard;

use App\Models\Jemaat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function loginUser()
    {
        if (Session::get('jemaat_logged_in')) {
            return redirect()->route('dashboard.jemaat');
        }
        return view('user_dashboard.pages.auth.login');
    }

     public function authenticateUser(Request $request)
    {
        try {
            $request->validate([
                'nomor_induk_jemaat' => 'required|string'
            ], [
                'nomor_induk_jemaat.required' => 'Nomor induk jemaat wajib diisi'
            ]);

            $jemaat = Jemaat::where('nomor_induk_jemaat', $request->nomor_induk_jemaat)->first();

            if (!$jemaat) {
                if ($request->ajax()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Nomor induk jemaat tidak terdaftar dalam sistem'
                    ], 404);
                }
                return redirect()->back()->with('error', 'Nomor induk jemaat tidak terdaftar dalam sistem');
            }

            if ($jemaat->status_keanggotaan !== 'aktif') {
                if ($request->ajax()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Status keanggotaan tidak aktif. Silakan hubungi admin gereja'
                    ], 403);
                }
                return redirect()->back()->with('error', 'Status keanggotaan tidak aktif. Silakan hubungi admin gereja');
            }
            
            Session::put('jemaat_logged_in', true);
            Session::put('jemaat_data', [
                'id' => $jemaat->id_jemaat,
                'nomor_induk' => $jemaat->nomor_induk_jemaat,
                'nama_lengkap' => $jemaat->nama_lengkap,
                'email' => $jemaat->email,
                'foto' => $jemaat->foto
            ]);

            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Login berhasil',
                    'redirect_url' => route('dashboard.jemaat')
                ]);
            }

            return redirect()->route('dashboard.jemaat')->with('success', 'Selamat datang, ' . $jemaat->nama_lengkap);

        } catch (\Illuminate\Validation\ValidationException $e) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'validation_error' => true,
                    'errors' => $e->errors()
                ], 422);
            }
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Terjadi kesalahan sistem'
                ], 500);
            }
            return redirect()->back()->with('error', 'Terjadi kesalahan sistem');
        }
    }

    public function logoutUser(Request $request)
    {
        try {
            Session::forget('jemaat_logged_in');
            Session::forget('jemaat_data');
            Session::flush();
            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Logout berhasil',
                    'redirect_url' => route('login.jemaat')
                ]);
            }

            return redirect()->route('login.jemaat')->with('success', 'Anda telah berhasil logout');

        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Terjadi kesalahan saat logout'
                ], 500);
            }
            return redirect()->back()->with('error', 'Terjadi kesalahan saat logout');
        }
    }
}
