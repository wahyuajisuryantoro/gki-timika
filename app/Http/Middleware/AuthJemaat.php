<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class AuthJemaat
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Debug: Log semua session data
        Log::info('AuthJemaat Middleware Check', [
            'session_id' => session()->getId(),
            'jemaat_logged_in' => Session::get('jemaat_logged_in'),
            'jemaat_data_exists' => Session::has('jemaat_data'),
            'all_session' => Session::all()
        ]);

        // Cek apakah jemaat sudah login
        if (!Session::get('jemaat_logged_in')) {
            Log::warning('AuthJemaat: Jemaat not logged in');
            
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Anda harus login terlebih dahulu',
                    'redirect_url' => route('login.jemaat')
                ], 401);
            }
            
            return redirect()->route('login.jemaat')
                ->with('error', 'Silakan login terlebih dahulu untuk mengakses halaman ini');
        }

        // Cek apakah data jemaat masih ada di session
        $jemaatData = Session::get('jemaat_data');
        
        // Perbaikan: Cek lebih detail struktur data
        if (!$jemaatData || !is_array($jemaatData) || !isset($jemaatData['id'])) {
            Log::warning('AuthJemaat: Invalid jemaat data', [
                'jemaat_data' => $jemaatData,
                'is_array' => is_array($jemaatData),
                'has_id' => isset($jemaatData['id']) ?? false
            ]);
            
            // Hapus session yang corrupt
            Session::forget(['jemaat_logged_in', 'jemaat_data']);
            
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Session expired, silakan login kembali',
                    'redirect_url' => route('login.jemaat')
                ], 401);
            }
            
            return redirect()->route('login.jemaat')
                ->with('error', 'Session Anda telah berakhir, silakan login kembali');
        }

        // Debug: Log successful validation
        Log::info('AuthJemaat: Session valid', [
            'jemaat_id' => $jemaatData['id'],
            'jemaat_name' => $jemaatData['nama_lengkap'] ?? 'Unknown'
        ]);

        // Tambahkan data jemaat ke request untuk kemudahan akses
        $request->merge(['jemaat' => $jemaatData]);

        return $next($request);
    }
}