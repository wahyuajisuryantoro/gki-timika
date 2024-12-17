@extends('frontend.layouts.app')

@section('content')
<div class="container my-5">
    <h1 class="text-center mb-4 font-weight-bold text-primary wow fadeInUp" data-wow-delay=".1s">Daftar Organisasi</h1>
    <p class="text-center mb-5 text-secondary wow fadeInUp" data-wow-delay=".2s">Berbagai daftar kategori organisasi dalam gereja kami</p>

    <div class="row justify-content-center">
        @foreach($kategoriList as $kategori)
            <div class="col-md-4 mb-4 wow fadeInUp" data-wow-delay=".{{ $loop->iteration * 2 }}s">
                <div class="card h-100 shadow-sm kategori-card">
                    <div class="card-body d-flex flex-column">
                        <h3 class="card-title text-center mb-3 text-primary">{{ $kategori->nama_kategori }}</h3>
                        <p class="card-text flex-grow-1 text-dark">{{ Str::limit($kategori->deskripsi, 100) }}</p>
                        <a href="{{ route('organisasi.anggota', $kategori->id) }}" class="btn btn-outline-primary mt-3 align-self-center">Lihat Anggota</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection

@push('styles')
<style>
    .kategori-card {
        transition: all 0.3s ease;
        border-color: var(--secondary);
    }
    .kategori-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 15px rgba(0,0,0,0.1) !important;
    }
    .kategori-card:hover .card-body {
        background-color: var(--primary);
        color: var(--white) !important;
    }
    .kategori-card:hover .card-title {
        color: var(--secondary) !important;
    }
    .kategori-card:hover .btn-outline-primary {
        background-color: var(--secondary);
        color: var(--white);
        border-color: var(--secondary);
    }
    .btn-outline-primary {
        color: var(--primary);
        border-color: var(--primary);
    }
    .btn-outline-primary:hover {
        background-color: var(--primary);
        color: var(--white);
    }
    .text-primary {
        color: var(--primary) !important;
    }
    .text-secondary {
        color: var(--secondary) !important;
    }
</style>
@endpush