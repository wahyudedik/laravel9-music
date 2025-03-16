@php
$notifHelper = new NotificationHelper;
//$getNotif    = $notifHelper->render();
try {
    $imagedata = base64_encode(file_get_contents(env('API_URL_TAKEL') . 'v1/uploader/get-file?referenceId='.Session::get('userInstansiId').'&type=logo-instansi&isPreview=true'));
    $logoInstansi = env('API_URL_TAKEL') . 'v1/uploader/get-file?referenceId='.Session::get('userInstansiId').'&type=logo-instansi&isPreview=true';
}
catch(Exception $e){
    $logoInstansi = asset('images/logo-default.png');

}
// dd($logoInstansi);
// dd(env('API_URL_TAKEL') . 'v1/uploader/get-file?referenceId='.Session::get('userInstansiId').'&type=logo-instansi&isPreview=true');
@endphp

<header class="header header-sticky mb-4">
    <div class="container-fluid">
        <button class="header-toggler px-md-0 me-md-3" type="button" id="toggleMenu" onclick="coreui.Sidebar.getInstance(document.querySelector('#sidebar')).toggle()">
            <i class="fa fa-angle-left"></i>
        </button>
        <ul class="header-nav ms-auto">
            <li class="nav-item text-end border-right" style="line-height: 1;border-right: 1px solid #DDD;padding-right: 15px;margin-right: 5px;padding-top: 5px;">
                <b>{{ Session::get('userName') }}</b> <br>
                <small class="text-muted">{{ Session::get('userRole') }}</small>
            </li>
            <li class="nav-item">
                <a class="nav-link pull-bs-canvas-right" href="javascript:void(0)" id="notif-button">
                  
                    <svg class="icon icon-lg">
                        <use xlink:href="{{asset('template/dist')}}/vendors/@coreui/icons/svg/free.svg#cil-bell"></use>
                    </svg>
                </a>
            </li>
        </ul>
        <ul class="header-nav ms-3">
            <li class="nav-item dropdown">
                <a class="nav-link py-0" data-coreui-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                    <!-- <div class="avatar avatar-md"> -->
                        <img class="" src={{$logoInstansi}} alt="Logo Menpan" height="50">
                    <!-- </div> -->
                </a>
                <div class="dropdown-menu dropdown-menu-end">
                    <!-- <a class="dropdown-item" href="#">
                        <svg class="icon me-2">
                            <use xlink:href="{{asset('template/dist')}}/vendors/@coreui/icons/svg/free.svg#cil-bell"></use>
                        </svg> Updates<span class="badge badge-sm bg-info ms-2">42</span>
                    </a> -->
                    <a class="dropdown-item" href="#">
                        <svg class="icon me-2">
                            <use xlink:href="{{asset('template/dist')}}/vendors/@coreui/icons/svg/free.svg#cil-user"></use>
                        </svg> Profil
                    </a>
                    <!-- <a class="dropdown-item" href="#">
                        <svg class="icon me-2">
                            <use xlink:href="{{asset('template/dist')}}/vendors/@coreui/icons/svg/free.svg#cil-settings"></use>
                        </svg> Settings
                    </a> -->
                    <a class="dropdown-item" href="/logout">
                        <svg class="icon me-2">
                            <use xlink:href="{{asset('template/dist')}}/vendors/@coreui/icons/svg/free.svg#cil-apps"></use>
                        </svg> Kembali Ke Portal
                    </a>
                    <a class="dropdown-item text-danger" href="https://spbe-dev.layanan.go.id/">
                        <svg class="icon me-2">
                            <use xlink:href="{{asset('template/dist')}}/vendors/@coreui/icons/svg/free.svg#cil-account-logout"></use>
                        </svg> Keluar
                    </a>
                </div>
            </li>
        </ul>
    </div>
    <div class="header-divider"></div>
    <div class="container-fluid">
        @yield('breadcrumb')
    </div>
</header>

<div class="bs-canvas bs-canvas-right position-fixed bg-light h-100">
    <header class="bs-canvas-header p-3 overflow-auto d-flex align-items-center border-bottom">
        <h5 class="d-inline-block mb-0">Notifikasi</h5>
        <a href="javascript:void(0);" class="btn btn-sm btn-secondary bs-canvas-close float-left close ms-auto" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </a>
    </header>
    <div class="bs-canvas-content px-3 py-3">
      
    </div>    
</div>
