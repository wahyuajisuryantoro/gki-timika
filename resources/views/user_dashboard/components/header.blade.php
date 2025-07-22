<div class="header-text-dark header-nav layout-vertical">
    <div class="header-nav-wrap">
        <div class="header-nav-left">
            <div class="header-nav-item desktop-toggle">
                <div class="header-nav-item-select cursor-pointer">
                    <i class="nav-icon feather icon-menu icon-arrow-right"></i>
                </div>
            </div>
            <div class="header-nav-item mobile-toggle">
                <div class="header-nav-item-select cursor-pointer">
                    <i class="nav-icon feather icon-menu icon-arrow-right"></i>
                </div>
            </div>
        </div>
        <div class="header-nav-right">
            @if(session('jemaat_logged_in'))
            <div class="header-nav-item">
                <div class="dropdown header-nav-item-select nav-profile">
                    <div class="toggle-wrapper" id="nav-profile-dropdown" data-bs-toggle="dropdown">
                        <div class="avatar avatar-circle d-flex align-items-center justify-content-center bg-primary text-white"
                            style="width: 35px; height: 35px;">
                            <i class="feather icon-user" style="font-size: 18px;"></i>
                        </div>
                        <span class="fw-bold mx-1">{{ session('jemaat_data.nama_lengkap') }}</span>
                        <i class="feather icon-chevron-down"></i>
                    </div>
                    <div class="dropdown-menu dropdown-menu-end">
                        <div class="nav-profile-header">
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-circle d-flex align-items-center justify-content-center bg-primary text-white">
                                    <i class="feather icon-user" style="font-size: 24px;"></i>
                                </div>
                                <div class="d-flex flex-column ms-1">
                                    <span class="fw-bold text-dark">{{ session('jemaat_data.nama_lengkap') }}</span>
                                    <span class="font-size-sm">{{ session('jemaat_data.nomor_induk') }}</span>
                                </div>
                            </div>
                        </div>
                        <form action="{{route('logout.user')}}" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit" class="dropdown-item border-0 bg-transparent w-100 text-start">
                                <div class="d-flex align-items-center">
                                    <i class="font-size-lg me-2 feather icon-power"></i>
                                    <span>Sign Out</span>
                                </div>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>