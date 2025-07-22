 <div class="side-nav vertical-menu nav-menu-light scrollable">
     <ul class="nav-menu">
         <li class="nav-menu-item router-link-active">
             <a href="{{route('dashboard.jemaat')}}">
                 <i class="feather icon-home"></i>
                 <span class="nav-menu-item-title">Dashboard</span>
             </a>
         </li>
         <li class="nav-group-title">Pendaftaran</li>
         <li class="nav-submenu">
             <a class="nav-submenu-title">
                 <i class="feather icon-box"></i>
                 <span>Informasi Pendaftaran</span>
                 <i class="nav-submenu-arrow"></i>
             </a>
             <ul class="nav-menu menu-collapse">
                 <li class="nav-menu-item">
                     <a href="{{route('informasi.baptis')}}">Baptis</a>
                 </li>
                 <li class="nav-menu-item">
                     <a href="{{route('informasi.nikah')}}">Nikah</a>
                 </li>
                 <li class="nav-menu-item">
                     <a href="{{route('informasi.sidi')}}">Sidi</a>
                 </li>
             </ul>
         </li>
          <li class="nav-group-title">Keluarga</li>
           <li class="nav-menu-item router-link-active">
             <a href="{{route('dashboard.keluarga')}}">
                 <i class="feather icon-users display"></i>
                 <span class="nav-menu-item-title">Informasi Keluarga</span>
             </a>
         </li>
           <li class="nav-group-title">Profile</li>
            <li class="nav-menu-item router-link-active">
             <a href="{{route('dashboard.profile')}}">
                 <i class="feather icon-user"></i>
                 <span class="nav-menu-item-title">Profile Saya</span>
             </a>
         </li>
     </ul>
 </div>
