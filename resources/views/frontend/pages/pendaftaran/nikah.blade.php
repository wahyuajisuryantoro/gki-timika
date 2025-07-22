@extends('frontend.layouts.app')

@section('content')
    <div class="container">
        <h2 class="mb-4 text-primary">Pendaftaran Nikah</h2>
        <form id="nikahForm" action="{{ route('pendaftaran.storeNikah') }}" method="POST" enctype="multipart/form-data"
            class="rd-form">
            @csrf
            <div class="form-wrap">
                <input type="text" class="form-input" id="nomor_induk_jemaat" name="nomor_induk_jemaat" placeholder=" "
                    required>
                <label class="form-label" for="nomor_induk_jemaat">Nomor Induk Jemaat</label>
                <small class="text-muted">Masukkan nomor induk jemaat yang terdaftar</small>
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
                <input type="date" class="form-input" id="tanggal_pelaksanaan" name="tanggal_pelaksanaan" required>
                <label class="form-label-outside" for="tanggal_pelaksanaan">Tanggal Pelaksanaan Nikah</label>
            </div>
            <div class="form-wrap">
                <input type="file" class="form-input" id="kartu_keluarga" name="kartu_keluarga"
                    accept=".pdf,.jpg,.jpeg,.png" required>
                <label class="form-label-outside" for="kartu_keluarga">Kartu Keluarga (PDF, JPG, JPEG, PNG - Max
                    2MB)</label>
            </div>
            <div class="form-wrap">
                <input type="file" class="form-input" id="pas_foto" name="pas_foto" accept=".jpg,.jpeg,.png" required>
                <label class="form-label-outside" for="pas_foto">Pas Foto (JPG, JPEG, PNG - Max 2MB)</label>
            </div>
            <div class="form-wrap">
                <input type="file" class="form-input" id="surat_baptis" name="surat_baptis" accept=".pdf,.jpg,.jpeg,.png"
                    required>
                <label class="form-label-outside" for="surat_baptis">Surat Baptis (PDF, JPG, JPEG, PNG - Max 2MB)</label>
            </div>
            <div class="form-wrap">
                <input type="file" class="form-input" id="surat_sidi" name="surat_sidi" accept=".pdf,.jpg,.jpeg,.png"
                    required>
                <label class="form-label-outside" for="surat_sidi">Surat Sidi (PDF, JPG, JPEG, PNG - Max 2MB)</label>
            </div>
            <div class="form-wrap">
                <input type="file" class="form-input" id="ktp" name="ktp" accept=".pdf,.jpg,.jpeg,.png"
                    required>
                <label class="form-label-outside" for="ktp">KTP (PDF, JPG, JPEG, PNG - Max 2MB)</label>
            </div>
            <button type="submit" class="btn btn-primary" id="submitBtn">
                <span class="btn-text">Daftar Nikah</span>
                <span class="btn-loading" style="display: none;">
                    <i class="fas fa-spinner fa-spin"></i> Memproses...
                </span>
            </button>
        </form>
    </div>
@endsection

@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('nikahForm');
            const submitBtn = document.getElementById('submitBtn');
            const btnText = submitBtn.querySelector('.btn-text');
            const btnLoading = submitBtn.querySelector('.btn-loading');


            const nomorIndukInput = document.getElementById('nomor_induk_jemaat');
            let isValidating = false;

            nomorIndukInput.addEventListener('blur', function() {
                if (isValidating) return;

                const nomorInduk = this.value.trim();

                if (nomorInduk) {
                    isValidating = true;
                    checkNomorIndukExists(nomorInduk);
                }
            });


            const fileInputs = document.querySelectorAll('input[type="file"]');
            fileInputs.forEach(input => {
                input.addEventListener('change', function() {
                    const file = this.files[0];
                    if (file) {
                        const maxSize = 2 * 1024 * 1024;
                        if (file.size > maxSize) {
                            Swal.fire({
                                icon: 'error',
                                title: 'File Terlalu Besar!',
                                text: 'Ukuran file maksimal 2MB',
                                confirmButtonColor: '#d33',
                                confirmButtonText: 'OK'
                            });
                            this.value = '';
                        }
                    }
                });
            });


            const tanggalLahir = document.getElementById('tanggal_lahir');
            const tanggalPelaksanaan = document.getElementById('tanggal_pelaksanaan');

            tanggalLahir.addEventListener('change', function() {
                const birthDate = new Date(this.value);
                const today = new Date();
                const age = today.getFullYear() - birthDate.getFullYear();

                if (age < 18) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Peringatan Umur',
                        text: 'Umur minimal untuk nikah adalah 18 tahun',
                        confirmButtonColor: '#f39c12',
                        confirmButtonText: 'OK'
                    });
                }
            });

            tanggalPelaksanaan.addEventListener('change', function() {
                const selectedDate = new Date(this.value);
                const today = new Date();
                today.setHours(0, 0, 0, 0);

                if (selectedDate <= today) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Tanggal Tidak Valid!',
                        text: 'Tanggal pelaksanaan harus lebih dari hari ini',
                        confirmButtonColor: '#d33',
                        confirmButtonText: 'OK'
                    });
                    this.value = '';
                }
            });


            form.addEventListener('submit', function(e) {
                e.preventDefault();

                if (!validateForm()) {
                    return false;
                }


                Swal.fire({
                    title: 'Konfirmasi Pendaftaran',
                    text: 'Apakah data yang Anda masukkan sudah benar?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Daftarkan!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        submitForm();
                    }
                });
            });

            function checkNomorIndukExists(nomorInduk) {
                const formData = new FormData();
                formData.append('_token', '{{ csrf_token() }}');
                formData.append('nomor_induk_jemaat', nomorInduk);
                formData.append('validate_only', 'true');

                fetch('{{ route('pendaftaran.storeNikah') }}', {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.validation_error && data.errors && data.errors.nomor_induk_jemaat) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Nomor Induk Tidak Valid!',
                                text: data.errors.nomor_induk_jemaat[0],
                                confirmButtonColor: '#d33',
                                confirmButtonText: 'OK'
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error checking nomor induk:', error);
                    })
                    .finally(() => {
                        isValidating = false;
                    });
            }

            function validateForm() {
                const requiredFields = [
                    'nomor_induk_jemaat', 'nama_lengkap', 'tanggal_lahir', 'tanggal_pelaksanaan',
                    'tempat_lahir', 'jenis_kelamin', 'nama_ayah', 'nama_ibu',
                    'kartu_keluarga', 'pas_foto', 'surat_baptis', 'surat_sidi', 'ktp'
                ];

                for (let field of requiredFields) {
                    const input = document.getElementById(field);
                    if (!input.value.trim()) {
                        const label = input.previousElementSibling?.textContent || field;
                        Swal.fire({
                            icon: 'error',
                            title: 'Field Wajib Kosong!',
                            text: `${label} harus diisi`,
                            confirmButtonColor: '#d33',
                            confirmButtonText: 'OK'
                        });
                        input.focus();
                        return false;
                    }
                }


                const nomorIndukValue = document.getElementById('nomor_induk_jemaat').value.trim();
                if (!nomorIndukValue) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Nomor Induk Kosong!',
                        text: 'Nomor induk jemaat harus diisi',
                        confirmButtonColor: '#d33',
                        confirmButtonText: 'OK'
                    });
                    return false;
                }

                return true;
            }

            function submitForm() {

                submitBtn.disabled = true;
                btnText.style.display = 'none';
                btnLoading.style.display = 'inline-block';


                const formData = new FormData(form);

                fetch(form.action, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Pendaftaran Berhasil!',
                                text: 'Pendaftaran nikah Anda telah berhasil diajukan',
                                confirmButtonColor: '#3085d6',
                                confirmButtonText: 'OK'
                            }).then(() => {

                                form.reset();
                            });
                        } else {
                            throw new Error(data.message || 'Terjadi kesalahan');
                        }
                    })
                    .catch(error => {
                        Swal.fire({
                            icon: 'error',
                            title: 'Pendaftaran Gagal!',
                            text: error.message || 'Terjadi kesalahan saat memproses pendaftaran',
                            confirmButtonColor: '#d33',
                            confirmButtonText: 'OK'
                        });
                    })
                    .finally(() => {
                        submitBtn.disabled = false;
                        btnText.style.display = 'inline-block';
                        btnLoading.style.display = 'none';
                    });
            }

            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: '{{ session('success') }}',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'OK'
                });
            @endif

            @if (session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: '{{ session('error') }}',
                    confirmButtonColor: '#d33',
                    confirmButtonText: 'OK'
                });
            @endif

            @if ($errors->any())
                let errorMessages = [];
                @foreach ($errors->all() as $error)
                    errorMessages.push('{{ $error }}');
                @endforeach

                Swal.fire({
                    icon: 'error',
                    title: 'Validasi Error!',
                    text: errorMessages.join(', '),
                    confirmButtonColor: '#d33',
                    confirmButtonText: 'OK'
                });
            @endif
        });
    </script>

    <style>
        .btn-loading {
            color: #fff;
        }

        .form-wrap small {
            display: block;
            margin-top: 5px;
            font-size: 0.875rem;
        }

        .swal2-popup {
            font-size: 1rem;
        }
    </style>
@endsection
