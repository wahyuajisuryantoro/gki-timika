@extends('frontend.layouts.app')

@section('content')
<div class="container my-5">
    <h1 class="text-center mb-4 font-weight-bold text-primary wow fadeInUp" data-wow-delay=".1s">{{ $kategori->nama_kategori }}</h1>
    <p class="text-center mb-5 text-secondary wow fadeInUp" data-wow-delay=".2s">Anggota organisasi dalam kategori ini</p>

    <div class="row justify-content-center">
        @foreach($kategori->anggota as $anggota)
            <div class="col-md-4 mb-4 wow fadeInUp" data-wow-delay=".{{ $loop->iteration * 2 }}s">
                <div class="card h-100 shadow-sm anggota-card">
                    @if($anggota->foto)
                        <img src="{{ asset('storage/' . $anggota->foto) }}" class="card-img-top" alt="{{ $anggota->nama }}">
                    @endif
                    <div class="card-body">
                        <h4 class="card-title text-primary">{{ $anggota->nama }}</h4>
                        <p class="card-text text-secondary">{{ $anggota->jabatan }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="text-center mt-5">
        <a href="{{ route('organisasi') }}" class="btn btn-primary wow fadeInUp" data-wow-delay=".3s">Kembali ke Kategori</a>
    </div>
</div>
@endsection

@push('styles')
<style>
    .anggota-card {
        transition: all 0.3s ease;
        border-color: var(--secondary);
    }
    .anggota-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 15px rgba(0,0,0,0.1) !important;
    }
    .btn-primary {
        background-color: var(--primary);
        border-color: var(--primary);
    }
    .btn-primary:hover {
        background-color: var(--secondary);
        border-color: var(--secondary);
    }
    .text-primary {
        color: var(--primary) !important;
    }
    .text-secondary {
        color: var(--secondary) !important;
    }
</style>
@endpush