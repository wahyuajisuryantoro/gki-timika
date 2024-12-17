<!--Posts-->
<section class="section section-lg bg-default">
    <div class="container container-custom">
        <div class="row row-narrow-66 row-40">
            @foreach($informasiData as $informasi)
            <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay=".{{ $loop->iteration }}s">
                <div class="post-classic">
                    <div class="post-classic__media">
                        <a href="{{ route('informasi.show', $informasi->id_informasi) }}">
                            <img src="{{ asset('storage/' . $informasi->gambar) }}" alt="{{ $informasi->judul }}" width="530" height="370" />
                        </a>
                    </div>
                    <div class="post-classic__caption">
                        <span class="post-info">{{ $informasi->kategori }}, {{ $informasi->tanggal_diterbitkan->format('F d, Y') }}</span>
                        <h3 class="post-title">
                            <a href="{{ route('informasi.show', $informasi->id_informasi) }}">
                                {{ \Illuminate\Support\Str::limit(strip_tags($informasi->judul), 100) }}
                            </a>
                        </h3>
                        <a class="btn btn-icon btn-icon-right btn-transparent btn-svg" href="{{ route('informasi.show', $informasi->id_informasi) }}">
                            <span class="svg-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="10" viewbox="0 0 18 10">
                                    <path d="M13 10V6H0V4H13V0L18 5L13 10Z" fill=""></path>
                                </svg>
                            </span>
                            <span>Read More</span>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>