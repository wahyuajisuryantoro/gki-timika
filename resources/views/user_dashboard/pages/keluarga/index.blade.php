@extends('user_dashboard.layouts.dashboard')

@section('content')
<div class="container-fluid">
    
    <!-- Page Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="fw-bold mb-1">
                        <i class="feather icon-users me-2"></i>
                        Data Keluarga
                    </h4>
                    <p class="text-muted mb-0">Informasi lengkap anggota keluarga Anda</p>
                </div>
            </div>
        </div>
    </div>

    @if($keluarga)
    <!-- Family Info Card -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h5 class="card-title mb-2">
                                <i class="feather icon-home me-2 text-primary"></i>
                                {{ $keluarga->nama_kepala_keluarga }}
                            </h5>
                            <div class="row">
                                <div class="col-sm-6">
                                    <p class="mb-1">
                                        <i class="feather icon-map-pin me-2" style="width: 16px; height: 16px;"></i>
                                        <small class="text-muted">Alamat:</small><br>
                                        <span class="ms-4">{{ $keluarga->alamat }}</span>
                                    </p>
                                    <p class="mb-1">
                                        <i class="feather icon-phone me-2" style="width: 16px; height: 16px;"></i>
                                        <small class="text-muted">Telepon:</small> {{ $keluarga->nomor_telepon }}
                                    </p>
                                </div>
                                <div class="col-sm-6">
                                    <p class="mb-1">
                                        <i class="feather icon-hash me-2" style="width: 16px; height: 16px;"></i>
                                        <small class="text-muted">NIK:</small> {{ $keluarga->nomor_induk_keluarga }}
                                    </p>
                                    <p class="mb-1">
                                        <i class="feather icon-map me-2" style="width: 16px; height: 16px;"></i>
                                        <small class="text-muted">Kota:</small> {{ $keluarga->kota }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 text-center">
                            <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                                <span class="fw-bold text-primary h4 mb-0">{{ $anggota_keluarga->count() }}</span>
                            </div>
                            <p class="text-muted small mb-0 mt-2">Anggota Keluarga</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Family Members List -->
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-transparent border-0">
                    <h5 class="card-title mb-0">
                        <i class="feather icon-users me-2"></i>
                        Daftar Anggota Keluarga
                    </h5>
                </div>
                <div class="card-body p-0">
                    @if($anggota_keluarga->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="border-0">Foto</th>
                                    <th class="border-0">Nama Lengkap</th>
                                    <th class="border-0">Jenis Kelamin</th>
                                    <th class="border-0">Tanggal Lahir</th>
                                    <th class="border-0">Status</th>
                                    <th class="border-0">Baptis/Sidi</th>
                                    <th class="border-0">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($anggota_keluarga as $anggota)
                                <tr>
                                    <td class="align-middle">
                                        @if($anggota->foto)
                                            <img src="{{ asset('storage/' . $anggota->foto) }}" 
                                                 alt="{{ $anggota->nama_lengkap }}"
                                                 class="rounded-circle" 
                                                 style="width: 40px; height: 40px; object-fit: cover;">
                                        @else
                                            <div class="bg-secondary rounded-circle d-flex align-items-center justify-content-center text-white" style="width: 40px; height: 40px;">
                                                <i class="feather icon-user" style="width: 20px; height: 20px;"></i>
                                            </div>
                                        @endif
                                    </td>
                                    <td class="align-middle">
                                        <div>
                                            <h6 class="mb-0">{{ $anggota->nama_lengkap }}</h6>
                                            <small class="text-muted">{{ $anggota->nomor_induk_jemaat }}</small>
                                        </div>
                                    </td>
                                    <td class="align-middle">
                                        <span class="badge {{ $anggota->jenis_kelamin == 'L' ? 'bg-primary' : 'bg-info' }}">
                                            {{ $anggota->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
                                        </span>
                                    </td>
                                    <td class="align-middle">
                                        {{ $anggota->tanggal_lahir->format('d M Y') }}
                                        <br>
                                        <small class="text-muted">{{ $anggota->tanggal_lahir->age }} tahun</small>
                                    </td>
                                    <td class="align-middle">
                                        @php
                                            $statusClass = match($anggota->status_keanggotaan) {
                                                'aktif' => 'bg-success',
                                                'tidak_aktif' => 'bg-warning',
                                                'meninggal' => 'bg-dark',
                                                'pindah' => 'bg-secondary',
                                                default => 'bg-light text-dark'
                                            };
                                        @endphp
                                        <span class="badge {{ $statusClass }}">
                                            {{ ucwords(str_replace('_', ' ', $anggota->status_keanggotaan)) }}
                                        </span>
                                    </td>
                                    <td class="align-middle">
                                        <div class="d-flex gap-1">
                                            @if($anggota->tanggal_baptis)
                                                <span class="badge bg-primary" title="Sudah Baptis">
                                                    <i class="feather icon-droplet" style="width: 12px; height: 12px;"></i>
                                                </span>
                                            @endif
                                            @if($anggota->tanggal_sidi)
                                                <span class="badge bg-success" title="Sudah Sidi">
                                                    <i class="feather icon-check-circle" style="width: 12px; height: 12px;"></i>
                                                </span>
                                            @endif
                                        </div>
                                    </td>
                                   
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <div class="text-center py-5 text-muted">
                        <i class="feather icon-users display-6 opacity-25 mb-3"></i>
                        <p class="mb-0">Belum ada data anggota keluarga</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @else
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center py-5">
                    <i class="feather icon-alert-circle display-6 text-warning mb-3"></i>
                    <h5>Data Keluarga Tidak Ditemukan</h5>
                    <p class="text-muted">Silakan hubungi admin untuk memperbarui data keluarga Anda.</p>
                </div>
            </div>
        </div>
    </div>
    @endif

</div>
@endsection
