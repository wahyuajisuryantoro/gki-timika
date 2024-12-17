<section class="section section-lg bg-default">
    <div class="container">
        <div class="pre-title text-center wow fadeInUp" data-wow-delay=".1s">Galeri</div>
        <h2 class="wow fadeInUp text-center" data-wow-delay=".2s">Koleksi Galeri Gereja</h2>
        <div class="row row-narrow-50 row-40 row-xl">
            @foreach($galeriData as $galeri)
            <div class="col-lg-6 wow fadeInUp" data-wow-delay=".3s">
                <div class="thumbnail-classic">
                    <a class="thumbnail-classic__media" href="#">
                        <img src="{{ asset('storage/' . $galeri->gambar) }}" alt="{{ $galeri->judul }}" width="610" height="458" />
                    </a>
                    <h3><a href="#">{{ $galeri->judul }}</a></h3>
                    <a class="location" href="#">
                        <span class="icon mdi-map-marker mdi"></span>{{ $galeri->lokasi }}
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<section class="section section-vide section-lg video-wrap vide" data-vide-bg="{{ asset('assets/video/video-1')}}">
    <div class="container text-center context-dark">
        <div class="h1">"Karena begitu besar kasih Allah akan dunia ini"</div>
        <p class="text-sm">Yohanes 3:16</p>
    </div>
</section>
