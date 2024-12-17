@extends('frontend.layouts.app')

@section('content')
    <div class="container">
        <h2 class="mb-4 text-primary">Pendaftaran Sidi</h2>
        <form action="{{ route('pendaftaran.storeSidi') }}" method="POST" enctype="multipart/form-data" class="rd-form">
            @csrf
            <div class="form-wrap">
                <input type="text" class="form-input" id="nomor_induk_jemaat" name="nomor_induk_jemaat" placeholder=" " required>
                <label class="form-label" for="nomor_induk_jemaat">Nomor Induk Jemaat</label>
            </div>
            <div class="form-wrap">
                <input type="text" class="form-input" id="nama_lengkap" name="nama_lengkap" placeholder=" " required>
                <label class="form-label" for="nama_lengkap">Nama Lengkap</label>
            </div>
            <div class="form-wrap">
                <input type="date" class="form-input" id="tanggal_lahir" name="tanggal_lahir" required>
                <label class="form-label-outside" for="tanggal_lahir">Tanggal Lahir</label>
            </div>
            <div class="form-wrap">
                <input type="date" class="form-input" id="tanggal_pelaksanaan" name="tanggal_pelaksanaan" required>
                <label class="form-label-outside" for="tanggal_pelaksanaan">Tanggal Pelaksanaan Sidi</label>
            </div>
            <div class="form-wrap">
                <input type="text" class="form-input" id="tempat_lahir" name="tempat_lahir" placeholder=" " required>
                <label class="form-label" for="tempat_lahir">Tempat Lahir</label>
            </div>
            <div class="form-wrap">
                <select class="form-input" id="jenis_kelamin" name="jenis_kelamin" required>
                    <option value="" disabled selected>Pilih Jenis Kelamin</option>
                    <option value="L">Laki-laki</option>
                    <option value="P">Perempuan</option>
                </select>
                <label class="form-label" for="jenis_kelamin">Jenis Kelamin</label>
            </div>
            <div class="form-wrap">
                <input type="text" class="form-input" id="nama_ayah" name="nama_ayah" placeholder=" " required>
                <label class="form-label" for="nama_ayah">Nama Ayah</label>
            </div>
            <div class="form-wrap">
                <input type="text" class="form-input" id="nama_ibu" name="nama_ibu" placeholder=" " required>
                <label class="form-label" for="nama_ibu">Nama Ibu</label>
            </div>
            <div class="form-wrap">
                <input type="file" class="form-input" id="kartu_keluarga" name="kartu_keluarga" accept=".pdf,.jpg,.jpeg,.png" required>
                <label class="form-label-outside" for="kartu_keluarga">Kartu Keluarga</label>
            </div>
            <div class="form-wrap">
                <input type="file" class="form-input" id="pas_foto" name="pas_foto" accept=".jpg,.jpeg,.png" required>
                <label class="form-label-outside" for="pas_foto">Pas Foto</label>
            </div>
            <button type="submit" class="btn btn-primary">Daftar</button>
        </form>
    </div>
@endsection
