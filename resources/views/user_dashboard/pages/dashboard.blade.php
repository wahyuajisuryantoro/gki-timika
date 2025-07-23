@extends('user_dashboard.layouts.dashboard')

@section('content')
<div class="container-fluid">
    
    <!-- Welcome Card -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 bg-primary text-white">
                <div class="card-body p-4">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h3 class="card-title mb-2">
                                <i class="feather icon-sun me-2"></i>
                                Selamat Datang, {{ $jemaat->nama_lengkap ?? 'Jemaat' }}!
                            </h3>
                            <p class="card-text mb-0 opacity-75">
                                Semoga hari ini menjadi berkat bagi Anda dan keluarga. Tetap semangat dalam pelayanan!
                            </p>
                        </div>
                        <div class="col-md-4 text-md-end">
                            <i class="feather icon-heart display-4 opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-md-6 col-lg-3 mb-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center">
                    <div class="text-primary mb-2">
                        <i class="feather icon-users display-6"></i>
                    </div>
                    <h4 class="fw-bold">{{ number_format($total_jemaat) }}</h4>
                    <p class="text-muted mb-0">Total Jemaat Aktif</p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3 mb-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center">
                    <div class="text-success mb-2">
                        <i class="feather icon-calendar display-6"></i>
                    </div>
                    <h4 class="fw-bold">{{ $total_kebaktian_bulan_ini }}</h4>
                    <p class="text-muted mb-0">Kebaktian Bulan Ini</p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3 mb-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center">
                    <div class="text-warning mb-2">
                        <i class="feather icon-file-text display-6"></i>
                    </div>
                    <h4 class="fw-bold">
                        {{ $pendaftaran_active ? '1' : '0' }}
                    </h4>
                    <p class="text-muted mb-0">Pendaftaran Aktif</p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3 mb-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center">
                    <div class="text-info mb-2">
                        <i class="feather icon-bell display-6"></i>
                    </div>
                    <h4 class="fw-bold">{{ $pengumuman->count() }}</h4>
                    <p class="text-muted mb-0">Pengumuman Aktif</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Pengumuman Terbaru -->
        <div class="col-lg-6 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-transparent border-0 pb-0">
                    <h5 class="card-title mb-0">
                        <i class="feather icon-megaphone me-2 text-primary"></i>
                        Pengumuman Terbaru
                    </h5>
                </div>
                <div class="card-body">
                    @if($pengumuman->count() > 0)
                        @foreach($pengumuman as $item)
                            <div class="d-flex align-items-start mb-3 {{ !$loop->last ? 'border-bottom pb-3' : '' }}">
                                <div class="flex-shrink-0 me-3">
                                    <div class="bg-primary rounded-circle p-2">
                                        <i class="feather icon-info text-white" style="width: 16px; height: 16px;"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-1">{{ $item->judul }}</h6>
                                    <p class="text-muted small mb-1">
                                        {{ Str::limit(strip_tags($item->konten), 80) }}
                                    </p>
                                    <small class="text-primary">
                                        <i class="feather icon-clock" style="width: 12px; height: 12px;"></i>
                                        {{ $item->tanggal_diterbitkan->format('d M Y') }}
                                    </small>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="text-center py-4 text-muted">
                            <i class="feather icon-inbox display-6 opacity-25 mb-2"></i>
                            <p class="mb-0">Belum ada pengumuman terbaru</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Kebaktian Mendatang -->
        <div class="col-lg-6 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-transparent border-0 pb-0">
                    <h5 class="card-title mb-0">
                        <i class="feather icon-calendar me-2 text-success"></i>
                        Kebaktian Mendatang
                    </h5>
                </div>
                <div class="card-body">
                    @if($kebaktian_mendatang->count() > 0)
                        @foreach($kebaktian_mendatang as $kebaktian)
                            <div class="d-flex align-items-start mb-3 {{ !$loop->last ? 'border-bottom pb-3' : '' }}">
                                <div class="flex-shrink-0 me-3">
                                    <div class="bg-success rounded-circle p-2">
                                        <i data-feather="calendar" class="text-white" style="width: 16px; height: 16px;"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-1">{{ $kebaktian->nama_kebaktian }}</h6>
                                    <p class="text-muted small mb-1">
                                        <i data-feather="map-pin" style="width: 12px; height: 12px;"></i>
                                        {{ $kebaktian->lokasi }}
                                    </p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <small class="text-success">
                                            <i data-feather="clock" style="width: 12px; height: 12px;"></i>
                                            {{ $kebaktian->tanggal->format('d M Y') }} • 
                                            {{ date('H:i', strtotime($kebaktian->waktu_mulai)) }}
                                        </small>
                                        <span class="badge bg-light text-dark">{{ ucfirst($kebaktian->jenis_kebaktian) }}</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="text-center py-4 text-muted">
                            <i data-feather="calendar-x" class="display-6 opacity-25 mb-2"></i>
                            <p class="mb-0">Belum ada jadwal kebaktian</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Status Pendaftaran (if exists) -->
    @if($pendaftaran_active)
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm border-start border-warning border-4">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h6 class="card-title mb-2">
                                <i data-feather="clock" class="me-2 text-warning"></i>
                                Status Pendaftaran Anda
                            </h6>
                            <p class="mb-2">
                                Pendaftaran <strong>{{ ucfirst($pendaftaran_active->jenis_pendaftaran) }}</strong> 
                                sedang dalam proses review
                            </p>
                            <small class="text-muted">
                                Diajukan pada: {{ $pendaftaran_active->tanggal_pendaftaran->format('d M Y H:i') }}
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection