@extends('frontend.layouts.app')

@section('content')
    <div class="container">
        <h2 class="mb-4 text-primary">Pendaftaran Nikah</h2>
        <form id="nikahForm" action="{{ route('pendaftaran.storeNikah') }}" method="POST" enctype="multipart/form-data"
            class="rd-form">
            @csrf

            <!-- Data Pendaftar -->
            <h4 class="mt-4 mb-3 text-secondary">Data Pendaftar</h4>
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
                <textarea class="form-input" id="alamat_pendaftar" name="alamat_pendaftar" rows="3" placeholder=" " required></textarea>
                <label class="form-label" for="alamat_pendaftar">Alamat Lengkap Pendaftar</label>
                <small class="text-muted">Tulis alamat lengkap sesuai KTP (jalan, RT/RW, kelurahan, kecamatan,
                    kota/kabupaten)</small>
            </div>

            <!-- Data Pasangan -->
            <h4 class="mt-4 mb-3 text-secondary">Data Pasangan</h4>
            <div class="form-wrap">
                <div class="radio-group">
                    <label class="form-label-outside">Apakah pasangan Anda sesama jemaat gereja?</label>
                    <div class="radio-options mt-2">
                        <label class="radio-label">
                            <input type="radio" name="is_pasangan_jemaat" value="1" required>
                            <span class="radio-custom"></span>
                            Ya, sesama jemaat
                        </label>
                        <label class="radio-label">
                            <input type="radio" name="is_pasangan_jemaat" value="0" required>
                            <span class="radio-custom"></span>
                            Tidak, bukan jemaat
                        </label>
                    </div>
                </div>
            </div>

            <div class="form-wrap">
                <textarea class="form-input" id="alamat_pasangan" name="alamat_pasangan" rows="3" placeholder=" " required></textarea>
                <label class="form-label" for="alamat_pasangan">Alamat Lengkap Pasangan</label>
                <small class="text-muted">Tulis alamat lengkap pasangan sesuai KTP</small>
            </div>

            <!-- Select untuk Jemaat -->
            <div class="form-wrap" id="jemaat_pasangan_wrapper" style="display: none;">
                <select class="form-input" id="nomor_induk_jemaat_pasangan" name="nomor_induk_jemaat_pasangan">
                    <option value="">Pilih Jemaat Pasangan</option>
                </select>
                <label class="form-label-outside" for="nomor_induk_jemaat_pasangan">Pilih Jemaat Pasangan</label>
            </div>

            <!-- Input manual untuk non-jemaat -->
            <div id="manual_pasangan_wrapper" style="display: none;">
                <div class="form-wrap">
                    <input type="text" class="form-input" id="nama_pasangan" name="nama_pasangan" placeholder=" ">
                    <label class="form-label" for="nama_pasangan">Nama Lengkap Pasangan</label>
                </div>
                <div class="form-wrap">
                    <input type="text" class="form-input" id="nama_ayah_pasangan" name="nama_ayah_pasangan"
                        placeholder=" ">
                    <label class="form-label" for="nama_ayah_pasangan">Nama Ayah Pasangan</label>
                </div>
                <div class="form-wrap">
                    <input type="text" class="form-input" id="nama_ibu_pasangan" name="nama_ibu_pasangan"
                        placeholder=" ">
                    <label class="form-label" for="nama_ibu_pasangan">Nama Ibu Pasangan</label>
                </div>
            </div>

            <!-- Data Saksi -->
            <h4 class="mt-4 mb-3 text-secondary">Data Saksi</h4>
            <div class="form-wrap">
                <input type="text" class="form-input" id="saksi1" name="saksi1" placeholder=" " required>
                <label class="form-label" for="saksi1">Nama Saksi 1</label>
            </div>
            <div class="form-wrap">
                <input type="text" class="form-input" id="saksi2" name="saksi2" placeholder=" " required>
                <label class="form-label" for="saksi2">Nama Saksi 2</label>
            </div>

            <!-- Tanggal Pelaksanaan -->
            <div class="form-wrap">
                <input type="date" class="form-input" id="tanggal_pelaksanaan" name="tanggal_pelaksanaan" required>
                <label class="form-label-outside" for="tanggal_pelaksanaan">Tanggal Pelaksanaan Nikah</label>
            </div>

            <!-- Upload Dokumen -->
            <h4 class="mt-4 mb-3 text-secondary">Upload Dokumen Pendaftar</h4>
            <div class="form-wrap">
                <input type="file" class="form-input" id="kartu_keluarga" name="kartu_keluarga"
                    accept=".pdf,.jpg,.jpeg,.png" required>
                <label class="form-label-outside" for="kartu_keluarga">Kartu Keluarga (PDF, JPG, JPEG, PNG - Max
                    2MB)</label>
            </div>
            <div class="form-wrap">
                <input type="file" class="form-input" id="pas_foto" name="pas_foto" accept=".jpg,.jpeg,.png"
                    required>
                <label class="form-label-outside" for="pas_foto">Pas Foto (JPG, JPEG, PNG - Max 2MB)</label>
            </div>
            <div class="form-wrap">
                <input type="file" class="form-input" id="surat_baptis" name="surat_baptis"
                    accept=".pdf,.jpg,.jpeg,.png" required>
                <label class="form-label-outside" for="surat_baptis">Surat Baptis (PDF, JPG, JPEG, PNG - Max 2MB)</label>
            </div>
            <div class="form-wrap">
                <input type="file" class="form-input" id="surat_sidi" name="surat_sidi"
                    accept=".pdf,.jpg,.jpeg,.png" required>
                <label class="form-label-outside" for="surat_sidi">Surat Sidi (PDF, JPG, JPEG, PNG - Max 2MB)</label>
            </div>
            <div class="form-wrap">
                <input type="file" class="form-input" id="ktp" name="ktp" accept=".pdf,.jpg,.jpeg,.png"
                    required>
                <label class="form-label-outside" for="ktp">KTP (PDF, JPG, JPEG, PNG - Max 2MB)</label>
            </div>

            <!-- Upload Dokumen Pasangan -->
            <h4 class="mt-4 mb-3 text-secondary">Upload Dokumen Pasangan</h4>

            <div class="form-wrap">
                <input type="file" class="form-input" id="kartu_keluarga_pasangan" name="kartu_keluarga_pasangan"
                    accept=".pdf,.jpg,.jpeg,.png" required>
                <label class="form-label-outside" for="kartu_keluarga_pasangan">
                    Kartu Keluarga Pasangan (PDF, JPG, JPEG, PNG - Max 2MB)
                </label>
            </div>

            <div class="form-wrap">
                <input type="file" class="form-input" id="pas_foto_pasangan" name="pas_foto_pasangan"
                    accept=".jpg,.jpeg,.png" required>
                <label class="form-label-outside" for="pas_foto_pasangan">
                    Pas Foto Pasangan (JPG, JPEG, PNG - Max 2MB)
                </label>
            </div>

            <div class="form-wrap">
                <input type="file" class="form-input" id="surat_baptis_pasangan" name="surat_baptis_pasangan"
                    accept=".pdf,.jpg,.jpeg,.png" required>
                <label class="form-label-outside" for="surat_baptis_pasangan">
                    Surat Baptis Pasangan (PDF, JPG, JPEG, PNG - Max 2MB)
                </label>
            </div>

            <div class="form-wrap">
                <input type="file" class="form-input" id="surat_sidi_pasangan" name="surat_sidi_pasangan"
                    accept=".pdf,.jpg,.jpeg,.png" required>
                <label class="form-label-outside" for="surat_sidi_pasangan">
                    Surat Sidi Pasangan (PDF, JPG, JPEG, PNG - Max 2MB)
                </label>
            </div>

            <div class="form-wrap">
                <input type="file" class="form-input" id="ktp_pasangan" name="ktp_pasangan"
                    accept=".pdf,.jpg,.jpeg,.png" required>
                <label class="form-label-outside" for="ktp_pasangan">
                    KTP Pasangan (PDF, JPG, JPEG, PNG - Max 2MB)
                </label>
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
    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('nikahForm');
            const submitBtn = document.getElementById('submitBtn');
            const btnText = submitBtn.querySelector('.btn-text');
            const btnLoading = submitBtn.querySelector('.btn-loading');

            const nomorIndukInput = document.getElementById('nomor_induk_jemaat');
            const jemaatPasanganWrapper = document.getElementById('jemaat_pasangan_wrapper');
            const manualPasanganWrapper = document.getElementById('manual_pasangan_wrapper');
            const jemaatSelect = document.getElementById('nomor_induk_jemaat_pasangan');

            let isValidating = false;

            // Initialize Select2
            $(jemaatSelect).select2({
                placeholder: 'Cari dan pilih jemaat pasangan...',
                allowClear: true,
                width: '100%'
            });

            // Handle radio button change
            const radioButtons = document.querySelectorAll('input[name="is_pasangan_jemaat"]');
            radioButtons.forEach(radio => {
                radio.addEventListener('change', function() {
                    if (this.value === '1') {
                        // Show jemaat selection
                        jemaatPasanganWrapper.style.display = 'block';
                        manualPasanganWrapper.style.display = 'none';

                        // Load jemaat list
                        loadJemaatList();

                        // Clear manual inputs
                        document.getElementById('nama_pasangan').value = '';
                        document.getElementById('nama_ayah_pasangan').value = '';
                        document.getElementById('nama_ibu_pasangan').value = '';
                    } else {
                        // Show manual inputs
                        jemaatPasanganWrapper.style.display = 'none';
                        manualPasanganWrapper.style.display = 'block';

                        // Clear jemaat selection
                        $(jemaatSelect).val(null).trigger('change');
                    }
                });
            });

            function loadJemaatList() {
                const currentJemaat = nomorIndukInput.value;

                fetch(`{{ route('pendaftaran.getJemaatList') }}?current=${currentJemaat}`)
                    .then(response => response.json())
                    .then(data => {
                        // Clear existing options
                        $(jemaatSelect).empty();
                        $(jemaatSelect).append('<option value="">Pilih Jemaat Pasangan</option>');

                        // Add jemaat options
                        data.forEach(jemaat => {
                            const option = new Option(
                                `${jemaat.nama_lengkap} (${jemaat.nomor_induk_jemaat}) - ${jemaat.jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan'}`,
                                jemaat.nomor_induk_jemaat
                            );
                            $(jemaatSelect).append(option);
                        });

                        $(jemaatSelect).trigger('change');
                    })
                    .catch(error => {
                        console.error('Error loading jemaat list:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'Gagal memuat daftar jemaat',
                            confirmButtonColor: '#d33',
                            confirmButtonText: 'OK'
                        });
                    });
            }

            // Nomor induk validation
            nomorIndukInput.addEventListener('blur', function() {
                if (isValidating) return;

                const nomorInduk = this.value.trim();

                if (nomorInduk) {
                    isValidating = true;
                    checkNomorIndukExists(nomorInduk);
                }
            });

            // File size validation
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

            // Date validations
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

            // Form submission
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
                    'tempat_lahir', 'jenis_kelamin', 'nama_ayah', 'nama_ibu', 'saksi1', 'saksi2',
                    'alamat_pendaftar',
                    'kartu_keluarga', 'pas_foto', 'surat_baptis', 'surat_sidi', 'ktp', 'alamat_pasangan',
                    'kartu_keluarga_pasangan', 'pas_foto_pasangan',
                    'surat_baptis_pasangan', 'surat_sidi_pasangan', 'ktp_pasangan'
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

                // Validate partner selection
                const isPasanganJemaat = document.querySelector('input[name="is_pasangan_jemaat"]:checked');
                if (!isPasanganJemaat) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Pilihan Pasangan Belum Dipilih!',
                        text: 'Pilih apakah pasangan Anda sesama jemaat atau tidak',
                        confirmButtonColor: '#d33',
                        confirmButtonText: 'OK'
                    });
                    return false;
                }

                if (isPasanganJemaat.value === '1') {
                    // Validate jemaat selection
                    const jemaatPasangan = document.getElementById('nomor_induk_jemaat_pasangan');
                    if (!jemaatPasangan.value) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Jemaat Pasangan Belum Dipilih!',
                            text: 'Pilih jemaat pasangan dari daftar yang tersedia',
                            confirmButtonColor: '#d33',
                            confirmButtonText: 'OK'
                        });
                        return false;
                    }

                    // Check if same as applicant
                    if (jemaatPasangan.value === nomorIndukInput.value) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Pasangan Tidak Valid!',
                            text: 'Pasangan tidak boleh sama dengan pendaftar',
                            confirmButtonColor: '#d33',
                            confirmButtonText: 'OK'
                        });
                        return false;
                    }
                } else {
                    // Validate manual input fields
                    const manualFields = ['nama_pasangan', 'nama_ayah_pasangan', 'nama_ibu_pasangan'];
                    for (let field of manualFields) {
                        const input = document.getElementById(field);
                        if (!input.value.trim()) {
                            const label = input.previousElementSibling?.textContent || field;
                            Swal.fire({
                                icon: 'error',
                                title: 'Data Pasangan Belum Lengkap!',
                                text: `${label} harus diisi`,
                                confirmButtonColor: '#d33',
                                confirmButtonText: 'OK'
                            });
                            input.focus();
                            return false;
                        }
                    }
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
                                // Reset radio buttons and hide sections
                                jemaatPasanganWrapper.style.display = 'none';
                                manualPasanganWrapper.style.display = 'none';
                                $(jemaatSelect).val(null).trigger('change');
                            });
                        } else {
                            if (data.validation_error && data.errors) {
                                let errorMessages = [];
                                Object.values(data.errors).forEach(errorArray => {
                                    errorMessages.push(...errorArray);
                                });

                                Swal.fire({
                                    icon: 'error',
                                    title: 'Validasi Error!',
                                    text: errorMessages.join(', '),
                                    confirmButtonColor: '#d33',
                                    confirmButtonText: 'OK'
                                });
                            } else {
                                throw new Error(data.message || 'Terjadi kesalahan');
                            }
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

            // Session messages
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

        .radio-group {
            margin-bottom: 1rem;
        }

        .radio-options {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
        }

        .radio-label {
            display: flex;
            align-items: center;
            cursor: pointer;
            font-weight: 500;
            margin-bottom: 0;
        }

        .radio-label input[type="radio"] {
            display: none;
        }

        .radio-custom {
            width: 20px;
            height: 20px;
            border: 2px solid #ddd;
            border-radius: 50%;
            margin-right: 8px;
            position: relative;
            transition: border-color 0.3s ease;
        }

        .radio-label input[type="radio"]:checked+.radio-custom {
            border-color: #007bff;
        }

        .radio-label input[type="radio"]:checked+.radio-custom::after {
            content: '';
            width: 10px;
            height: 10px;
            background-color: #007bff;
            border-radius: 50%;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .select2-container {
            width: 100% !important;
        }

        .select2-selection {
            height: 50px !important;
            border: 1px solid #ddd !important;
            border-radius: 4px !important;
        }

        .select2-selection__rendered {
            line-height: 48px !important;
            padding-left: 12px !important;
        }

        .select2-selection__arrow {
            height: 48px !important;
        }

        h4.text-secondary {
            border-bottom: 2px solid #6c757d;
            padding-bottom: 8px;
            margin-bottom: 20px !important;
        }
    </style>
@endsection
