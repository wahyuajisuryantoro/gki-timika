@extends('user_dashboard.layouts.dashboard')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <!-- Header Section -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body bg-gradient-nikah text-white"
                        style="background: linear-gradient(135deg, #ff9a9e 0%, #fecfef 50%, #fecfef 100%);">
                        <div class="row align-items-center">
                            <div class="col-md-8">
                                <h4 class="mb-1">
                                    <i class="feather icon-heart me-2"></i>
                                    Informasi Status Pernikahan
                                </h4>
                                <p class="mb-0 opacity-75">Pantau status dan riwayat pendaftaran pernikahan Anda</p>
                            </div>
                            <div class="col-md-4 text-end">
                                <div class="d-flex align-items-center justify-content-end">
                                    <div class="avatar avatar-circle bg-white text-danger me-3"
                                        style="width: 50px; height: 50px;">
                                        <i class="feather icon-user" style="font-size: 24px;"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-0">{{ $jemaat->nama_lengkap }}</h6>
                                        <small class="opacity-75">{{ $jemaat->nomor_induk_jemaat }}</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!-- Status Card -->
                    <div class="col-md-4 mb-4">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-body text-center">
                                @if ($statusNikah['sudah_menikah'])
                                    <div class="mb-3">
                                        <div class="avatar avatar-circle bg-danger text-white mx-auto"
                                            style="width: 80px; height: 80px;">
                                            <i class="feather icon-heart" style="font-size: 36px;"></i>
                                        </div>
                                    </div>
                                    <h5 class="text-danger mb-2">Sudah Menikah</h5>
                                    <p class="text-muted mb-3">Status pernikahan Anda saat ini:</p>
                                    <div class="bg-light rounded p-3">
                                        <h6 class="mb-0">{{ ucfirst($statusNikah['status_pernikahan']) }}</h6>
                                    </div>
                                @else
                                    <div class="mb-3">
                                        <div class="avatar avatar-circle bg-{{ $statusNikah['bisa_daftar'] ? 'success' : 'warning' }} text-white mx-auto"
                                            style="width: 80px; height: 80px;">
                                            <i class="feather icon-{{ $statusNikah['bisa_daftar'] ? 'check' : 'clock' }}"
                                                style="font-size: 36px;"></i>
                                        </div>
                                    </div>

                                    @if ($statusNikah['bisa_daftar'])
                                        <h5 class="text-success mb-2">Dapat Menikah</h5>
                                        <p class="text-muted mb-3">Anda memenuhi semua persyaratan untuk menikah di gereja
                                        </p>
                                        @if (!$statusNikah['ada_pendaftaran_aktif'])
                                            <a href="{{ route('pendaftaran.nikah') }}" class="btn btn-danger">
                                                <i class="feather icon-plus me-1"></i>
                                                Daftar Nikah
                                            </a>
                                        @else
                                            <div class="alert alert-info">
                                                <small>Anda sudah memiliki pendaftaran yang sedang diproses</small>
                                            </div>
                                        @endif
                                    @else
                                        <h5 class="text-warning mb-2">Belum Memenuhi Syarat</h5>
                                        <p class="text-muted mb-3">Silakan lengkapi persyaratan di bawah:</p>
                                        <div class="text-start">
                                            <div class="d-flex align-items-center mb-2">
                                                <i
                                                    class="feather icon-{{ $statusNikah['memenuhi_syarat_umur'] ? 'check text-success' : 'x text-danger' }} me-2"></i>
                                                <small>Umur minimal 18 tahun ({{ $umur }} tahun)</small>
                                            </div>
                                            <div class="d-flex align-items-center mb-2">
                                                <i
                                                    class="feather icon-{{ $statusNikah['sudah_baptis'] ? 'check text-success' : 'x text-danger' }} me-2"></i>
                                                <small>Sudah Baptis</small>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <i
                                                    class="feather icon-{{ $statusNikah['sudah_sidi'] ? 'check text-success' : 'x text-danger' }} me-2"></i>
                                                <small>Sudah Sidi</small>
                                            </div>
                                        </div>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Informasi Personal -->
                    <div class="col-md-8 mb-4">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-header bg-transparent border-0">
                                <h6 class="mb-0">
                                    <i class="feather icon-info me-2"></i>
                                    Informasi Personal
                                </h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="text-muted small">Nama Lengkap</label>
                                            <h6 class="mb-0">{{ $jemaat->nama_lengkap }}</h6>
                                        </div>
                                        <div class="mb-3">
                                            <label class="text-muted small">Tempat, Tanggal Lahir</label>
                                            <h6 class="mb-0">{{ $jemaat->tempat_lahir }},
                                                {{ $jemaat->tanggal_lahir->format('d F Y') }}</h6>
                                        </div>
                                        <div class="mb-3">
                                            <label class="text-muted small">Umur</label>
                                            <h6 class="mb-0">{{ $umur }} tahun</h6>
                                        </div>
                                        <div class="mb-3">
                                            <label class="text-muted small">Status Pernikahan</label>
                                            <span
                                                class="badge bg-{{ $jemaat->status_pernikahan == 'menikah' ? 'danger' : 'secondary' }}">
                                                {{ ucfirst($jemaat->status_pernikahan) }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="text-muted small">Jenis Kelamin</label>
                                            <h6 class="mb-0">
                                                {{ $jemaat->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</h6>
                                        </div>
                                        <div class="mb-3">
                                            <label class="text-muted small">Status Baptis</label>
                                            @if ($jemaat->tanggal_baptis)
                                                <h6 class="mb-0 text-success">
                                                    <i class="feather icon-check me-1"></i>
                                                    Sudah Baptis ({{ $jemaat->tanggal_baptis->format('d F Y') }})
                                                </h6>
                                            @else
                                                <h6 class="mb-0 text-danger">
                                                    <i class="feather icon-x me-1"></i>
                                                    Belum Baptis
                                                </h6>
                                            @endif
                                        </div>
                                        <div class="mb-3">
                                            <label class="text-muted small">Status Sidi</label>
                                            @if ($jemaat->tanggal_sidi)
                                                <h6 class="mb-0 text-success">
                                                    <i class="feather icon-check me-1"></i>
                                                    Sudah Sidi ({{ $jemaat->tanggal_sidi->format('d F Y') }})
                                                </h6>
                                            @else
                                                <h6 class="mb-0 text-danger">
                                                    <i class="feather icon-x me-1"></i>
                                                    Belum Sidi
                                                </h6>
                                            @endif
                                        </div>
                                        <div class="mb-3">
                                            <label class="text-muted small">Status Keanggotaan</label>
                                            <span
                                                class="badge bg-{{ $jemaat->status_keanggotaan == 'aktif' ? 'success' : 'secondary' }}">
                                                {{ ucfirst($jemaat->status_keanggotaan) }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Info Pernikahan -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="card border-0 shadow-sm">
                            <div class="card-header bg-transparent border-0">
                                <h6 class="mb-0">
                                    <i class="feather icon-book-open me-2"></i>
                                    Tentang Pernikahan Gereja
                                </h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="text-center mb-3">
                                            <div class="avatar avatar-circle bg-danger text-white mx-auto mb-2"
                                                style="width: 60px; height: 60px;">
                                                <i class="feather icon-heart" style="font-size: 24px;"></i>
                                            </div>
                                            <h6>Makna Pernikahan</h6>
                                            <p class="text-muted small">Pernikahan adalah ikatan kudus yang diberkati Allah
                                                antara pria dan wanita</p>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="text-center mb-3">
                                            <div class="avatar avatar-circle bg-primary text-white mx-auto mb-2"
                                                style="width: 60px; height: 60px;">
                                                <i class="feather icon-check-square" style="font-size: 24px;"></i>
                                            </div>
                                            <h6>Persyaratan</h6>
                                            <p class="text-muted small">Minimal 18 tahun, sudah baptis dan sidi, serta
                                                mengikuti konseling pra-nikah</p>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="text-center mb-3">
                                            <div class="avatar avatar-circle bg-success text-white mx-auto mb-2"
                                                style="width: 60px; height: 60px;">
                                                <i class="feather icon-file-text" style="font-size: 24px;"></i>
                                            </div>
                                            <h6>Dokumen</h6>
                                            <p class="text-muted small">KTP, KK, surat baptis, surat sidi, dan pas foto
                                                terbaru</p>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="text-center mb-3">
                                            <div class="avatar avatar-circle bg-warning text-white mx-auto mb-2"
                                                style="width: 60px; height: 60px;">
                                                <i class="feather icon-calendar" style="font-size: 24px;"></i>
                                            </div>
                                            <h6>Proses</h6>
                                            <p class="text-muted small">Konseling pra-nikah, persiapan administrasi, dan
                                                upacara pemberkatan</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Riwayat Pendaftaran -->
                @if ($pendaftaranNikah->count() > 0)
                    <div class="row">
                        <div class="col-12">
                            <div class="card border-0 shadow-sm">
                                <div class="card-header bg-transparent border-0">
                                    <h6 class="mb-0">
                                        <i class="feather icon-file-text me-2"></i>
                                        Riwayat Pendaftaran Pernikahan
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>Tanggal Daftar</th>
                                                    <th>Tanggal Pelaksanaan</th>
                                                    <th>Status</th>
                                                    <th>Catatan</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($pendaftaranNikah as $pendaftaran)
                                                    <tr>
                                                        <td>
                                                            <div>
                                                                <h6 class="mb-0">
                                                                    {{ $pendaftaran->tanggal_pendaftaran->format('d M Y') }}
                                                                </h6>
                                                                <small
                                                                    class="text-muted">{{ $pendaftaran->tanggal_pendaftaran->format('H:i') }}</small>
                                                            </div>
                                                        </td>
                                                        <td>{{ $pendaftaran->tanggal_pelaksanaan->format('d M Y') }}</td>
                                                        <td>
                                                            @switch($pendaftaran->status_pendaftaran)
                                                                @case('pending')
                                                                    <span class="badge bg-warning">
                                                                        <i class="feather icon-clock me-1"></i>
                                                                        Menunggu
                                                                    </span>
                                                                @break

                                                                @case('approved')
                                                                    <span class="badge bg-success">
                                                                        <i class="feather icon-check me-1"></i>
                                                                        Disetujui
                                                                    </span>
                                                                @break

                                                                @case('rejected')
                                                                    <span class="badge bg-danger">
                                                                        <i class="feather icon-x me-1"></i>
                                                                        Ditolak
                                                                    </span>
                                                                @break

                                                                @case('completed')
                                                                    <span class="badge bg-danger">
                                                                        <i class="feather icon-check-circle me-1"></i>
                                                                        Selesai
                                                                    </span>
                                                                @break
                                                            @endswitch
                                                        </td>
                                                        <td>
                                                            @if ($pendaftaran->catatan)
                                                                <span
                                                                    class="text-muted">{{ Str::limit($pendaftaran->catatan, 50) }}</span>
                                                            @else
                                                                <span class="text-muted">-</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <button type="button" class="btn btn-sm btn-outline-danger"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#detailModal{{ $pendaftaran->id_pendaftaran }}">
                                                                <i class="feather icon-eye me-1"></i>
                                                                Detail
                                                            </button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Detail (untuk setiap pendaftaran) -->
                    @foreach ($pendaftaranNikah as $pendaftaran)
                        <div class="modal fade" id="detailModal{{ $pendaftaran->id_pendaftaran }}" tabindex="-1">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Detail Pendaftaran Pernikahan</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="text-muted small">Tanggal Pendaftaran</label>
                                                    <p class="mb-0">
                                                        {{ $pendaftaran->tanggal_pendaftaran->format('d F Y H:i') }}</p>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="text-muted small">Tanggal Pelaksanaan</label>
                                                    <p class="mb-0">
                                                        {{ $pendaftaran->tanggal_pelaksanaan->format('d F Y') }}</p>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="text-muted small">Status</label>
                                                    <p class="mb-0">
                                                        @switch($pendaftaran->status_pendaftaran)
                                                            @case('pending')
                                                                <span class="badge bg-warning">Menunggu Konfirmasi</span>
                                                            @break

                                                            @case('approved')
                                                                <span class="badge bg-success">Disetujui</span>
                                                            @break

                                                            @case('rejected')
                                                                <span class="badge bg-danger">Ditolak</span>
                                                            @break

                                                            @case('completed')
                                                                <span class="badge bg-danger">Selesai</span>
                                                            @break
                                                        @endswitch
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="text-muted small">Nama Ayah</label>
                                                    <p class="mb-0">{{ $pendaftaran->nama_ayah }}</p>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="text-muted small">Nama Ibu</label>
                                                    <p class="mb-0">{{ $pendaftaran->nama_ibu }}</p>
                                                </div>
                                                @if ($pendaftaran->catatan)
                                                    <div class="mb-3">
                                                        <label class="text-muted small">Catatan</label>
                                                        <p class="mb-0">{{ $pendaftaran->catatan }}</p>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        <!-- Dokumen yang diupload -->
                                        <div class="row mt-3">
                                            <div class="col-12">
                                                <h6 class="text-muted">Dokumen yang Diupload:</h6>
                                                <div class="row">
                                                    @if ($pendaftaran->kartu_keluarga)
                                                        <div class="col-md-6 mb-2">
                                                            <div class="d-flex align-items-center">
                                                                <i class="feather icon-file me-2 text-primary"></i>
                                                                <span class="small">Kartu Keluarga</span>
                                                            </div>
                                                        </div>
                                                    @endif
                                                    @if ($pendaftaran->pas_foto)
                                                        <div class="col-md-6 mb-2">
                                                            <div class="d-flex align-items-center">
                                                                <i class="feather icon-image me-2 text-success"></i>
                                                                <span class="small">Pas Foto</span>
                                                            </div>
                                                        </div>
                                                    @endif
                                                    @if ($pendaftaran->surat_baptis)
                                                        <div class="col-md-6 mb-2">
                                                            <div class="d-flex align-items-center">
                                                                <i class="feather icon-file-text me-2 text-info"></i>
                                                                <span class="small">Surat Baptis</span>
                                                            </div>
                                                        </div>
                                                    @endif
                                                    @if ($pendaftaran->surat_sidi)
                                                        <div class="col-md-6 mb-2">
                                                            <div class="d-flex align-items-center">
                                                                <i class="feather icon-file-text me-2 text-warning"></i>
                                                                <span class="small">Surat Sidi</span>
                                                            </div>
                                                        </div>
                                                    @endif
                                                    @if ($pendaftaran->ktp)
                                                        <div class="col-md-6 mb-2">
                                                            <div class="d-flex align-items-center">
                                                                <i class="feather icon-credit-card me-2 text-danger"></i>
                                                                <span class="small">KTP</span>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Tutup</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
@endsection
@section('style')
    <style>
        .bg-gradient-nikah {
            background: linear-gradient(135deg, #ff9a9e 0%, #fecfef 50%, #fecfef 100%) !important;
        }

        .card {
            border-radius: 12px;
            transition: transform 0.2s ease-in-out;
        }

        .card:hover {
            transform: translateY(-2px);
        }

        .avatar {
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
        }

        .table th {
            font-weight: 600;
            color: #6c757d;
            border-bottom: 2px solid #dee2e6;
        }

        .badge {
            font-size: 0.75rem;
            padding: 0.375rem 0.75rem;
        }

        .modal-content {
            border-radius: 12px;
            border: none;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .text-danger {
            color: #dc3545 !important;
        }

        .bg-danger {
            background-color: #dc3545 !important;
        }
    </style>
@endsection
