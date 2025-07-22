@extends('user_dashboard.layouts.dashboard')

@section('content')
<div class="card">
    <div class="container-fluid">
        <div class="row content-min-height">
            <div class="col">
                <div class="card-body">
                    <div class="mb-4 d-md-flex align-items-center justify-content-between">
                        <div>
                            <h4>Informasi Personal</h4>
                            <p>Info akun anda yang terdaftar sebagai jemaat</p>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col" style="max-width: 200px;">
                            <div class="mb-3">
                                @if($jemaat->foto)
                                    <img class="img-fluid w-100 rounded" 
                                         src="{{ asset('storage/' . $jemaat->foto) }}"
                                         alt="Foto {{ $jemaat->nama_lengkap }}">
                                @else
                                    <img class="img-fluid w-100 rounded" 
                                         src="assets/images/avatars/thumb-1.jpg"
                                         alt="upload avatar">
                                @endif
                            </div>
                            
                        </div>
                        <div class="col-md">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th class="py-4">Nama Lengkap</th>
                                        <td class="py-4">{{ $jemaat->nama_lengkap }}</td>
                                    </tr>
                                    <tr>
                                        <th class="py-4">Nomor Induk</th>
                                        <td class="py-4">{{ $jemaat->nomor_induk_jemaat }}</td>
                                    </tr>
                                    <tr>
                                        <th class="py-4">Email</th>
                                        <td class="py-4">{{ $jemaat->email ?: '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th class="py-4">Phone</th>
                                        <td class="py-4">{{ $jemaat->nomor_telepon ?: '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th class="py-4">Pekerjaan</th>
                                        <td class="py-4">{{ $jemaat->pekerjaan ?: '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th class="py-4">Gender</th>
                                        <td class="py-4">{{ $jemaat->jenis_kelamin == 'L' ? 'Male' : 'Female' }}</td>
                                    </tr>
                                    <tr>
                                        <th class="py-4">Birthday</th>
                                        <td class="py-4">{{ $jemaat->tanggal_lahir->format('d/m/Y') }}</td>
                                    </tr>
                                    <tr>
                                        <th class="py-4">Address</th>
                                        <td class="py-4">{{ $jemaat->alamat_rumah }}</td>
                                    </tr>
                                    <tr>
                                        <th class="py-4">Tempat Lahir</th>
                                        <td class="py-4">{{ $jemaat->tempat_lahir }}</td>
                                    </tr>
                                    <tr>
                                        <th class="py-4">Status Keanggotaan</th>
                                        <td class="py-4">{{ ucwords(str_replace('_', ' ', $jemaat->status_keanggotaan)) }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection