@extends('frontend.layouts.app')

@section('content')
<div class="container my-5">
    <h1 class="text-center mb-4 font-weight-bold text-primary wow fadeInUp" data-wow-delay=".1s">
        @if($jenis)
            Kebaktian {{ ucfirst($jenis) }}
        @else
            Daftar Kebaktian
        @endif
    </h1>

    <div class="row justify-content-center">
        @forelse($kebaktian as $k)
        <div class="col-md-4 mb-4 wow fadeInUp" data-wow-delay=".{{ $loop->iteration * 2 }}s">
            <div class="card h-100 shadow-sm kebaktian-card">
                <img src="{{ asset('storage/' . $k->anggota->foto) }}" alt="{{ $k->anggota->nama }}" class="card-img-top kebaktian-foto" data-toggle="modal" data-target="#kebaktianModal{{ $k->id_kebaktian }}">
                <div class="card-body">
                    <h4 class="card-title text-primary" data-toggle="modal" data-target="#kebaktianModal{{ $k->id_kebaktian }}">{{ $k->nama_kebaktian }}</h4>
                    <p class="card-text text-secondary">
                        <strong>Pengisi Kebaktian:</strong> {{ $k->anggota->nama }}
                    </p>
                    <p class="card-text text-secondary">
                        <strong>Tanggal:</strong> {{ date('d M Y', strtotime($k->tanggal)) }}
                    </p>
                    <p class="card-text text-secondary">
                        <strong>Waktu Mulai:</strong> {{ date('H:i', strtotime($k->waktu_mulai)) }}
                        <br>
                        <strong>Waktu Selesai:</strong> {{ date('H:i', strtotime($k->waktu_selesai)) }}
                    </p>
                    <p class="card-text text-secondary">
                        <strong>Lokasi:</strong> {{ $k->lokasi }}
                    </p>
                </div>
            </div>
        </div>

            <!-- Modal -->
            <div class="modal fade" id="kebaktianModal{{ $k->id_kebaktian }}" tabindex="-1" role="dialog" aria-labelledby="kebaktianModalLabel{{ $k->id_kebaktian }}" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-primary" id="kebaktianModalLabel{{ $k->id_kebaktian }}">{{ $k->nama_kebaktian }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="text-center mb-4">
                                <img src="{{ asset('storage/' . $k->anggota->foto) }}" alt="{{ $k->anggota->nama }}" class="img-fluid rounded-circle pendeta-foto">
                                <h5 class="text-primary mt-3">{{ $k->anggota->nama }}</h5>
                                <p class="text-secondary">Pendeta</p>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <strong class="text-secondary">Jenis</strong>
                                    <span class="text-primary">{{ $k->jenis_kebaktian }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <strong class="text-secondary">Tanggal</strong>
                                    <span class="text-primary">{{ $k->tanggal }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <strong class="text-secondary">Waktu</strong>
                                    <span class="text-primary">{{ $k->waktu_mulai }} - {{ $k->waktu_selesai }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <strong class="text-secondary">Lokasi</strong>
                                    <span class="text-primary">{{ $k->lokasi }}</span>
                                </li>
                                <li class="list-group-item">
                                    <strong class="text-secondary">Deskripsi</strong>
                                    <p class="text-primary mt-2">{{ $k->deskripsi }}</p>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <strong class="text-secondary">Status</strong>
                                    <span class="badge badge-primary px-3 py-2">{{ $k->status }}</span>
                                </li>
                            </ul>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <p class="text-center">Tidak ada kebaktian yang ditemukan.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection