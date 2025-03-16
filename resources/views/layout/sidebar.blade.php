@php
use App\Helpers\AuthHelper;
$auth = new AuthHelper;
@endphp

<div class="sidebar sidebar-light sidebar-fixed" id="sidebar">
    <div class="sidebar-brand d-none d-md-flex" style="background-image: url('/custome/img/sidebar-bg.png');background-size:cover">
        <div class="sidebar-brand-full" alt="CoreUI Logo">
            <a href="/logout" style="background: burlywood;
    padding: 10px;
    border-radius: 4px;
    font-weight: 600;
    text-decoration: none;">
                PLAY LIST APP
            </a>
        </div>
        <div class="sidebar-brand-narrow" alt="CoreUI Logo">
            <a href="/logout">
                <img alt="..." width="46" height="46" src="{{asset('custome/img/logo-spbe.png')}}">
            </a>
        </div>
    </div>
    <ul class="sidebar-nav" data-coreui="navigation" data-simplebar="">

   
        <li class="nav-item">
            <a class="nav-link" href="/satuan-kerja">
                <i class="nav-icon fa fa-home"></i>Dashboard
            </a>
        </li>
   

  

            <li class="nav-title">Manajemen Risiko</li>
            <li class="nav-item">
                <a class="nav-link @yield('pencatatan')" href="/pencatatan-dan-pelaporan/periodik">
                    <i class="nav-icon fas fa-book-open"></i>For Composer 
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link @yield('budaya')" href="/budaya-sadar-risiko">
                    <i class="nav-icon material-symbols-outlined">psychology</i>Rilis Lagu 
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link @yield('penetapan')" href="/penetapan-konteks-risiko">
                    <i class="nav-icon fas fa-paste"></i> List lagu 
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link @yield('penilaian')" href="/penilaian-risiko">
                    <i class="nav-icon fas fa-clipboard"></i> Fitur Claim/Umclaim
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link @yield('penanganan')" href="/penanganan-risiko">
                    <i class="nav-icon fas fa-hands-holding"></i> Fitur Unclaim
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link @yield('komunikasi')" href="/komunikasi-dan-konsultasi">
                    <i class="nav-icon fas fa-comments"></i> Analytic
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link @yield('pemantauan')" href="/pemantauan-dan-reviu-risiko/triwulan">
                    <i class="nav-icon fas fa-eye"></i> Saldo
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link @yield('dokumentasi')" href="/dokumentasi-proses-manajemen-risiko">
                    <i class="nav-icon fas fa-file-lines"></i> Report
                </a>
            </li>
       
    </ul>
    <!-- <button class="sidebar-toggler" type="button" data-coreui-toggle="unfoldable"></button> -->
</div>
