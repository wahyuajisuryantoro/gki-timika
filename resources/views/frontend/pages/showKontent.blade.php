@extends('frontend.layouts.app')

@section('content')
    <section class="section section-lg bg-default">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <article class="post-full">
                        <header class="post-header text-center">
                            <h1 class="post-title">{{ $informasi->judul }}</h1>
                            <div class="post-meta">
                                <span class="post-date">{{ $informasi->tanggal_diterbitkan->format('F d, Y') }}</span>
                                <span class="post-author">oleh {{ $informasi->penulis }}</span>
                                <span class="post-category">{{ $informasi->kategori }}</span>
                            </div>
                        </header>

                        @if ($informasi->gambar)
                            <figure class="post-featured-image">
                                <img src="{{ asset('storage/' . $informasi->gambar) }}" alt="{{ $informasi->judul }}"
                                    class="img-fluid">
                            </figure>
                        @endif

                        <h4>
                            <div class="post-content">
                               {!! $informasi->konten !!}
                            </div>
                        </h4>
                        <footer class="post-footer">
                            <div class="post-tags">
                                <span class="tag">{{ $informasi->kategori }}</span>
                            </div>
                            <div class="post-share">
                                <!-- Tambahkan tombol share sosial media jika diperlukan -->
                            </div>
                        </footer>
                    </article>
                </div>
            </div>
        </div>
    </section>
@endsection
