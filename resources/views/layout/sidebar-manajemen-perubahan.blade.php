@php
    use App\Helpers\AuthHelper;
    $auth = new AuthHelper;
@endphp
<div class="sidebar sidebar-light sidebar-fixed" id="sidebar">
    <div class="sidebar-brand d-none d-md-flex" style="background-image: url('/custome/img/sidebar-bg.png');background-size:cover">
        <div class="sidebar-brand-full" alt="CoreUI Logo">
            <a href="/logout">
                <img alt="..." width="200" height="46" src="{{asset('custome/img/full-logo-spbe.png')}}">
            </a>
        </div>
        <div class="sidebar-brand-narrow" alt="CoreUI Logo">
            <a href="/logout">
                <img alt="..." width="46" height="46" src="{{asset('custome/img/logo-spbe.png')}}">
            </a>
        </div>
    </div>
    <ul class="sidebar-nav" data-coreui="navigation" data-simplebar="">
        <li class="nav-title">Manajemen Perubahan</li>
        @if ($auth->hasAuth([1,2,10,25,23,24,32,33,34,35]))
            @if($auth->hasAuth([32,33]))
            <li class="nav-item">
                <a class="nav-link @yield('manajemen-perubahan')" href="/manajemen-perubahan/satuan-kerja">
                    <i class="nav-icon fa fa-home"></i>Dashboard
                </a>
            </li>
            @endif

            @if($auth->hasAuth([34,35]))
            <li class="nav-item">
                <a class="nav-link @yield('manajemen-perubahan')" href="/manajemen-perubahan/ippd">
                    <i class="nav-icon fa fa-home"></i>Dashboard
                </a>
            </li>
            @endif

            @if($auth->hasAuth([10]))
            <li class="nav-item">
                <a class="nav-link @yield('manajemen-perubahan')" href="/manajemen-perubahan/koordinator-spbe">
                    <i class="nav-icon fa fa-home"></i>Dashboard
                </a>
            </li>
            @endif

            @if($auth->hasAuth([1,2,25]))
            <li class="nav-item">
                <a class="nav-link @yield('manajemen-perubahan')" href="/manajemen-perubahan/kemenpan-rb">
                    <i class="nav-icon fa fa-home"></i>Dashboard
                </a>
            </li>
            @endif
        @else
            <li class="nav-item">
                <a class="nav-link @yield('manajemen-perubahan') disabled" href="/manajemen-perubahan/kemenpan-rb">
                    <i class="nav-icon fa fa-home"></i>Dashboard
                </a>
            </li>
        @endif
        @if ($auth->hasAuth([1,2,23,24,32,33,34,35]))
            <li class="nav-item">
                <a class="nav-link @yield('perencanaan')" href="/manajemen-perubahan/perencanaan">
                    <i class="nav-icon fa fa-file-lines"></i> Perencanaan
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link @yield('analisa')" href="/manajemen-perubahan/analisa">
                    <i class="nav-icon fa fa-magnifying-glass-chart"></i> Analisa
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link @yield('pengembangan')" href="/manajemen-perubahan/pengembangan">
                    <i class="nav-icon fa-sharp fa-solid fa-arrow-up-right-dots"></i>Pengembangan
                </a>
            </li>
            <li class="nav-item"><a class="nav-link @yield('implementasi')" href="/manajemen-perubahan/implementasi">
                <i class="nav-icon fa-solid fa-file-circle-check"></i>Implementasi</a>
            </li>
            <li class="nav-item"><a class="nav-link @yield('pemantauan')" href="/manajemen-perubahan/pemantauan-dan-evaluasi">
                <i class="nav-icon fa-solid fa-list-check"></i>Pemantauan dan  <br> Evaluasi</a>
            </li>
            <li class="nav-item"><a class="nav-link @yield('laporan')" href="/manajemen-perubahan/laporan-manajemen-perubahan">
                <i class="nav-icon fa fa-file-contract"></i>Laporan Manajemen <br> Perubahan</a>
            </li>
        @else
            @if (!$auth->hasAuth([10,25]))
                <li class="nav-item">
                    <a class="nav-link @yield('perencanaan') disabled" href="/manajemen-perubahan/perencanaan">
                        <i class="nav-icon fa fa-file-lines"></i> Perencanaan
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @yield('analisa') disabled" href="/manajemen-perubahan/analisa">
                        <i class="nav-icon fa fa-magnifying-glass-chart"></i> Analisa
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @yield('pengembangan') disabled" href="/manajemen-perubahan/pengembangan">
                        <i class="nav-icon fa-sharp fa-solid fa-arrow-up-right-dots"></i>Pengembangan
                    </a>
                </li>
                <li class="nav-item"><a class="nav-link @yield('implementasi') disabled" href="/manajemen-perubahan/implementasi">
                    <i class="nav-icon fa-solid fa-file-circle-check"></i>Implementasi</a>
                </li>
                <li class="nav-item"><a class="nav-link @yield('pemantauan') disabled" href="/manajemen-perubahan/pemantauan-dan-evaluasi">
                    <i class="nav-icon fa-solid fa-list-check"></i>Pemantauan dan  <br> Evaluasi</a>
                </li>
                <li class="nav-item"><a class="nav-link @yield('laporan') disabled" href="/manajemen-perubahan/laporan-manajemen-perubahan">
                    <i class="nav-icon fa fa-file-contract"></i>Laporan Manajemen <br> Perubahan</a>
                </li>
            @endif
        @endif
    </ul>
    <button class="sidebar-toggler" type="button" data-coreui-toggle="unfoldable"></button>
</div>
