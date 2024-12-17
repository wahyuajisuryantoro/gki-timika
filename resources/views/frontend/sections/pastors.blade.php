<section class="section section-lg bg-primary">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <h2 class="text-center text-white mb-5">Pengurus Gereja</h2>
                
                <div class="swiper-container swiper-slider swiper-style-1" data-swiper='{"autoplay":{"delay":4567},"effect":"fade"}'>
                    <div class="swiper-wrapper">
                        @foreach($anggotaData as $anggota)
                        <div class="swiper-slide context-dark">
                            <div class="swiper-slide-caption text-center text-lg-left">
                                <div class="row justify-content-center">
                                    <div class="col-xl-10 p-xl-0">
                                        <div class="row justify-content-center row-20 align-items-center flex-column flex-md-row">
                                            <div class="col-lg-3 p-xl-0">
                                                <div class="avatar-circle">
                                                    <img src="{{ asset('storage/' . $anggota->foto) }}" alt="{{ $anggota->nama }}" class="img-fluid rounded-circle" />
                                                </div>
                                            </div>
                                            <div class="col-lg-9 inset-left-110">
                                                <div class="h3">{{ $anggota->nama }}</div>
                                                <div class="author-position">{{ $anggota->jabatan }}</div>
                                                <div class="text-italic">{{ $anggota->kategori->nama_kategori }}</div>
                                                <p class="mt-3">{{ $anggota->deskripsi ?? 'Deskripsi tidak tersedia' }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="swiper-pagination"></div>
                    <div class="swiper-button-prev">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="10" viewbox="0 0 18 10" fill="">
                            <path d="M5 10V6H18V4H5V0L0 5L5 10Z" fill=""></path>
                        </svg>
                    </div>
                    <div class="swiper-button-next">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="10" viewbox="0 0 18 10" fill="">
                            <path d="M5 10V6H18V4H5V0L0 5L5 10Z" fill=""></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>