<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login Jemaat - GKI EBENHAEZER</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('assets_dashboard/images/logo/favicon.ico') }}">

    <!-- Core css -->
    <link href="{{ asset('assets_dashboard/css/app.min.css') }}" rel="stylesheet">
    
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.7.32/sweetalert2.min.css">

</head>

<body>
    <div class="auth-full-height d-flex flex-row align-items-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="card shadow-lg">
                        <div class="card-body">
                            <div class="m-2">
                                
                                <div class="text-center mb-4">
                                    <h4 class="mt-3 mb-1">Login Jemaat</h4>
                                    <p class="text-muted">Masukkan nomor induk jemaat Anda</p>
                                </div>
                                <form id="loginForm" action="{{ route('authenticate.jemaat') }}" method="POST">
                                    @csrf
                                    <div class="form-group mb-3">
                                        <label class="form-label">No Induk Jemaat</label>
                                        <input type="text" 
                                               class="form-control" 
                                               id="nomor_induk_jemaat" 
                                               name="nomor_induk_jemaat" 
                                               placeholder="Contoh: J20250603588"
                                               required />
                                        <small class="text-muted">Masukkan nomor induk jemaat yang terdaftar</small>
                                    </div>

                                    <button type="submit" class="btn btn-primary w-100" id="loginBtn">
                                        <span class="btn-text">Masuk</span>
                                        <span class="btn-loading" style="display: none;">
                                            <span class="spinner-border spinner-border-sm me-2"></span>
                                            Memproses...
                                        </span>
                                    </button>
                                </form>
                                <div class="text-center mt-3">
                                    <a href="{{ route('home') }}" class="text-muted">
                                        <i class="mdi mdi-arrow-left"></i> Kembali ke Beranda
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Core Vendors JS -->
    <script src="{{ asset('assets_dashboard/js/vendors.min.js') }}"></script>
    
    <!-- SweetAlert2 JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.7.32/sweetalert2.min.js"></script>

    <!-- Core JS -->
    <script src="{{ asset('assets_dashboard/js/app.min.js') }}"></script>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('loginForm');
        const loginBtn = document.getElementById('loginBtn');
        const btnText = loginBtn.querySelector('.btn-text');
        const btnLoading = loginBtn.querySelector('.btn-loading');
        const nomorIndukInput = document.getElementById('nomor_induk_jemaat');

        // Validasi input nomor induk saat blur
        nomorIndukInput.addEventListener('blur', function() {
            const value = this.value.trim();
            if (value && value.length < 5) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Nomor Induk Terlalu Pendek',
                    text: 'Pastikan nomor induk jemaat Anda benar',
                    confirmButtonColor: '#f39c12',
                    confirmButtonText: 'OK'
                });
            }
        });

        // Handle form submission
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const nomorInduk = nomorIndukInput.value.trim();
            
            // Validasi input
            if (!nomorInduk) {
                Swal.fire({
                    icon: 'error',
                    title: 'Field Kosong!',
                    text: 'Nomor induk jemaat harus diisi',
                    confirmButtonColor: '#d33',
                    confirmButtonText: 'OK'
                });
                nomorIndukInput.focus();
                return;
            }

            // Tampilkan loading
            loginBtn.disabled = true;
            btnText.style.display = 'none';
            btnLoading.style.display = 'inline-block';

            // Submit form via AJAX
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
                        title: 'Login Berhasil!',
                        text: data.message,
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        window.location.href = data.redirect_url;
                    });
                } else {
                    throw new Error(data.message || 'Terjadi kesalahan');
                }
            })
            .catch(error => {
                let errorMessage = 'Terjadi kesalahan saat login';
                
                if (error.message) {
                    errorMessage = error.message;
                }

                Swal.fire({
                    icon: 'error',
                    title: 'Login Gagal!',
                    text: errorMessage,
                    confirmButtonColor: '#d33',
                    confirmButtonText: 'OK'
                });
            })
            .finally(() => {
                loginBtn.disabled = false;
                btnText.style.display = 'inline-block';
                btnLoading.style.display = 'none';
            });
        });

        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK'
            });
        @endif
        
        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '{{ session('error') }}',
                confirmButtonColor: '#d33',
                confirmButtonText: 'OK'
            });
        @endif
        
        @if($errors->any())
            let errorMessages = [];
            @foreach($errors->all() as $error)
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

</body>

</html>