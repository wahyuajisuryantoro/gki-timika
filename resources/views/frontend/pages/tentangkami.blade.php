@extends('frontend.layouts.app')
@section('content')
    <section class="breadcrumbs-custom bg-image" style="background-image: url(images/breadcrumbs-bg-1.jpg)"
        data-preset='{"title":"Breadcrumbs","category":"header","reload":false,"id":"breadcrumbs"}'>
        <div class="container">
            <div class="h1 breadcrumbs-custom-title text-primary">Tentang Kami</div>
            <ul class="breadcrumbs-custom-path">
                <li><a href="{{ route('home') }}">Beranda</a></li>
                <li class="active">Tentang Kami</li>
            </ul>
        </div>
    </section>
    <section class="section section-lg bg-default">
        <div class="container">
            <div class="row text-justifyr">
                <div class="col-xl-8 col-lg-10">
                    <div class="pre-title wow fadeInLeft" data-wow-delay=".1s">Sejarah</div>
                    <h2 class="wow fadeInRight" data-wow-delay=".2s">Berdirinya Jemaat GKI Ebenhezer Timika</h2>
                    <p class="text-sm wow fadeInUp" data-wow-delay=".3s">Berdirinya Jemaat GKI Ebenhaezer Timika, demikianpun Klasis GKI Mimika dapat dibilang "bukanlah hasil pekabaran injil" yang nyata-nyata, melainkan berawal dari kaum profesional yang kehadirannya di Timika masing-masing bekerja sebagai petani tradisional dan buruh  sebagai dampak kehadiran PT Freeport  McMoran di Tembagapura tahun 1973.</p>
                    <p class="text-sm wow fadeInUp" data-wow-delay=".4s">Masing-masing mereka adalah orang-orang Kristen yang berasal baik dari Papua (di luar Timika), juga dari beberapa daerah di Indonesia, seperti: Toraja/Sulawesi Selatan, Manado/Sulawesi Utara, Timor, Key, dan Maluku Tenggara jauh (1974 – 1981).</p>
                    <p class="text-sm wow fadeInUp" data-wow-delay=".5s">Jadi berdirinya jemaat GKI Ebenhaezer Timika dan Klasis GKI Mimika adalah hasil dari pengembangan dan pewartaan Injil Yesus Kristus yang tidak kelihatan melalui kerja kaum profesi tradisioanal di Timika, sebagai akibat hadirnya PT FI di Tembagapura dan pemekaran pemerintahan kabupaten Fak-fak wilayah Mimika di Timika  (1982).</p>
                    <p class="text-sm wow fadeInUp" data-wow-delay=".6s">Jemaat GKI Ebenhaezer merupakan jemaat GKI yang pertama ada di Timika setelah, jemaat GKI Imanuel Kokonao, Sola fide Mapuru jaya dan Efata Uta di wilayah Mimika. dengan Pdt. Yafeth Samber, STh sebagai vicaris (1984) dan pendeta yang pertama (1985).</p>
                    <p class="text-sm wow fadeInUp" data-wow-delay=".7s">Maka Jemaat GKI Ebenhaezer Timika,dinyatakan berdiri sebagai jemaat Mandiri pada tanggal, 13 Mei 1984, sebagai buah sulung dari terbentuknya GKI di Wilayah Mimika.</p>
                    <p class="text-sm wow fadeInUp" data-wow-delay=".8s">Jemaat GKI Ebenhaezer Timika memiliki keunikan tersendiri, karena berada di pusat kota Timika dan dikategorikan sebagai jemaat heterogen serta memiliki wilayah pelayanan yang kecil, namun padat kependudukannya, olehnya berdasarkan hasil Sidang Klasis GKI Mimika ke-VI tahun 2017, disahkan dan ditetapkan sebagai Jemaat Sentrum di Klasis Mimika-Kabupaten Mimika.</p>
                </div>
            </div>
        </div>
    </section>
    <section class="section section-lg bg-default">
        <div class="container">
            <div class="row row-narrow-50 align-items-center row-30">
                <div class="col-lg-7 wow fadeInLeft" data-wow-delay=".2s">
                    <div class="inset-xl-right-60"><img src="{{ asset('assets/images/gereja-1.png') }}" alt="" width="660"
                            height="495" />
                    </div>
                </div>
                <div class="col-lg-5 wow fadeInRight" data-wow-delay=".3s">
                    <h2>Bangunan Awal GKI Ebenhaezer</h2>
                    <p>Gambar ini menunjukkan bangunan awal GKI Ebenhaezer Timika yang diresmikan pada tanggal 13 Mei 1984. Gedung gereja ini merupakan hasil dari kerja keras dan dedikasi jemaat awal yang sebagian besar terdiri dari karyawan PT Freeport Indonesia, PNS, dan anggota TNI/Polri. Bangunan sederhana ini menjadi saksi bisu lahirnya komunitas Kristen di Timika dan cikal bakal berkembangnya Klasis GKI Mimika. Meskipun sederhana, gedung ini memiliki arti penting sebagai titik awal perjumpaan jemaat dengan Tuhan di tanah Mimika, yang kemudian melahirkan nama "Ebenhaezer" yang berarti "sampai di sini Tuhan menolong kita".</p>
                </div>
            </div>
        </div>
    </section>
    <section class="section section-lg bg-default">
        <div class="container">
            <div class="row row-narrow-50 align-items-center row-30 flex-xl-row-reverse">
                <div class="col-lg-7 wow fadeInRight" data-wow-delay=".2s">
                    <div class="inset-xl-left-60"><img src="{{ asset('assets/images/pendeta.png') }}" alt="" width="660"
                            height="495" />
                    </div>
                </div>
                <div class="col-lg-5 wow fadeInLeft" data-wow-delay=".3s">
                    <div class="pre-title">KETUA PENDETA</div>
                    <h2>Pdt Dina F. Yoltuwu,S.Th,M.Mis</h2>
                    <div class="quote-italic">“SHALOM”</div>
                    <div class="text-justify">
                        <p>Yang terhormat dan terkasih dalam Tuhan Yesus Kristus, Majelis Jemaat, Unsur Unsur Jemaat,  Tua tua Jemaat dan seluruh Warga Jemaat GKI Ebenhaezer Timika di Kabupaten Mimika, Papua Tengah, serta seluruh Warga Kristen di Tanah Papua,          
                            Dengan hati yang penuh syukur, saya, selaku Ketua Jemaat GKI Ebenhaezer Timika, mengajak kita semua untuk memulai sambutan ini dengan memuliakan Tuhan Yesus Kristus. Dialah Sang Pemelihara kehidupan kita, yang melalui kasih dan anugerah-Nya telah menjadikan kita seperti yang kita ada hari ini, dan memanggil kita untuk menjalankan perintah-Nya, yaitu mengasihi sesama sebagaimana Dia mengasihi kita.</p>
                        
                        <p>Selamat datang di Website Jemaat GKI Ebenhaezer Timika, yang kami hadirkan sebagai wujud tanggung jawab kami dalam mengadaptasi pelayanan Gereja dengan perkembangan dunia teknologi yang terus berkembang pesat. Jemaat GKI Ebenhaezer Timika adalah jemaat pionir yang sejak tahun 1984 telah setia membawa kabar baik Injil Yesus Kristus di Kabupaten Mimika, Tanah Papua. Dalam perjalanan waktu, Gereja kita terus berkembang, namun tetap teguh dalam komitmen untuk memuliakan nama Tuhan.</p>
                        
                        <p>Di tengah derasnya arus perkembangan teknologi dan ilmu pengetahuan, Gereja ditantang untuk beradaptasi dan memanfaatkan kemajuan ini, tanpa mengesampingkan nilai-nilai alkitabiah yang menjadi fondasi iman kita. Kita menyadari bahwa teknologi memberikan kita kesempatan luar biasa untuk memperluas jangkauan pelayanan, memperdalam pemahaman firman Tuhan, serta mempererat hubungan antarjemaat. namun, kita juga harus berhati-hati agar tidak terseret oleh pengaruh dunia yang menjauhkan kita dari nilai-nilai rohani yang telah Tuhan ajarkan melalui Kitab Suci.</p>
                        
                        <p>Oleh karena itu, melalui website ini, kami berharap dapat memberikan pelayanan yang tidak hanya mengikuti perkembangan zaman, tetapi juga tetap berpegang teguh pada nilai-nilai Injil dan ajaran Kristus. Kita dipanggil untuk menjadi terang dunia, menjaga agar nilai-nilai iman kita tidak tergantikan oleh kemajuan duniawi, melainkan menjadi dasar yang kokoh dalam menghadapi tantangan zaman.</p>
                        
                        <p>Kami berharap seluruh Warga Jemaat dapat memanfaatkan website ini sebagai sarana untuk terus bertumbuh dalam iman, terlibat aktif dalam pelayanan, dan mengikuti perkembangan yang ada dengan tetap mempertahankan nilai-nilai rohani kita. Jika ada kekurangan, dengan rendah hati kami mengundang saran dan masukan konstruktif agar pelayanan kami semakin sempurna di hadapan Tuhan.</p>
                        
                        <p>Ucapan terima kasih kami sampaikan kepada Tim Multimedia Jemaat GKI Ebenhaezer Timika, PHMJ, Majelis Jemaat, serta seluruh unsur jemaat yang terlibat dalam mewujudkan website ini. Kiranya segala usaha kita ini membawa kemuliaan hanya bagi Tuhan Yesus, yang memelihara kita senantiasa.</p>
                        
                        <p>Segala kemuliaan hanya bagi Tuhan Yesus.</p>
                        
                        <div class="quote-italic">“TUHAN YESUS MEBERKATI KITA SEMUA!!”</div>
                    </div>
                    
                </div>
            </div>
        </div>
    </section>
@endsection
