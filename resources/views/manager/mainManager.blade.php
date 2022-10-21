<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sarpras IT</title>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/simple-datatables/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous">
    </script>
    <style>
        .bg-1 {
    background-color: #9ec5fe !important;
}
.bg-2 {
    background-color: #6ea8fe !important;
}
.bg-3 {
    background-color: #3d8bfd !important;
}
.bg-4 {
    background-color: #0d6efd !important;
}
.bg-5{
    background-color: #087990 !important;
}
.bg-6{
    background-color: #087990 !important;
}
.bg-7{
    background-color: #ffc107 !important;
}
.bg-8{
    background-color: #984c0c !important;
}
.bg-9{
    background-color: #3d0a91 !important;
}
    </style>
</head>

<body>
    <div id="app">
        <div id="sidebar" class='active'>
            <div class="sidebar-wrapper active">
                <div class="sidebar-header">
                    <h2>SAR - IT</h2>
                </div>
                <div class="sidebar-menu">
                    <ul class="menu">
                        {{-- section 1 --}}
                        <li class='sidebar-title'>Main Menu</li>
                        <li class="sidebar-item  @yield('home')">
                            <a href="{{ url('home') }}" class='sidebar-link'>
                                <i data-feather="home" width="20"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        {{-- <li class="sidebar-item  @yield('datauser')">
                            <a href="{{ url('showuser') }}" class='sidebar-link'>
                                <i data-feather="user" width="20"></i>
                                <span>Data User</span>
                            </a>

                        </li> --}}
                        {{--end section --}}
                        {{-- section 2 --}}
                        <li class='sidebar-title'>Forms &amp; Tables</li>
                        <li class="sidebar-item  @yield('dataWaitAccManager')">
                            <a href="{{ url('dataWaitAccManager') }}" class='sidebar-link'>
                                <i data-feather="clock" width="20"></i>
                                <span>Req Pegajuan</span>
                            </a>
                        </li>

                        <li class="sidebar-item  has-sub @yield('formPengajuan') @yield('formPengembalian')">
                            <a href="#" class='sidebar-link'>
                                <i data-feather="file-text" width="20"></i>
                                <span>Form</span>
                            </a>
                            <ul class="submenu ">

                                <li>
                                    <a href="{{ url('showFormPengajuanManager') }}">
                                        <span>Form Pengajuan</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ url('showFormPengembalianManager') }}">
                                        <span>Form Pengembalian</span>
                                    </a>
                                </li>


                            </ul>

                        </li>

                        <li
                            class="sidebar-item  has-sub @yield('showDataPengajuanSayaAtasan') @yield('dataPengajuanDivisi') @yield('showDataPengadaanSayaAtasan') @yield('showDataPengadaanDivisi')">
                            <a href="#" class='sidebar-link'>
                                <i data-feather="folder" width="20"></i>
                                <span>Data</span>
                            </a>
                            <ul class="submenu ">
                                <li>
                                    <a href="{{ url('showDataPengajuanSayaManager') }}">Pengajuan Saya</a>
                                </li>

                                <li>
                                    <a href="{{ url('dataPengajuanDivisiManager') }}">Pengajuan Divisi</a>
                                </li>

                            </ul>

                        </li>
                        <li class="sidebar-item  @yield('showAnggotaDivisi')">
                            <a href="{{ url('showAnggotaDivisiManager') }}" class='sidebar-link'>
                                <i data-feather="database" width="20"></i>
                                <span>Data divisi</span>
                            </a>
                        </li>

                        {{-- end section --}}
                    </ul>
                </div>
                <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
            </div>
        </div>
        @include('sweetalert::alert')
        <div id="main">
            <nav class="navbar navbar-header navbar-expand navbar-light">
                <a class="sidebar-toggler" href="#"><span class="navbar-toggler-icon"></span></a>
                <button class="btn navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav d-flex align-items-center navbar-light ms-auto">

                        <li class="dropdown">
                            <a href="#" data-bs-toggle="dropdown"
                                class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                                <div class="avatar me-1">
                                    <img src="assets/images/avatar/avatar-0.png" alt="" srcset="">
                                </div>
                                <div class="d-none d-md-block d-lg-inline-block">Hi, {{ session('username') }}</div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="#"><i data-feather="user"></i> Account</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ url('Logout') }}"><i data-feather="log-out"></i>
                                    Logout</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>

            <div class="main-content container-fluid">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h4>@yield('hal')</h4>

                        </div>
                        <div class="col-12 col-md-6 order-md-2 mb-3 order-first">
                            <nav aria-label="breadcrumb" class='breadcrumb-header'>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ url('home') }}">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">@yield('hal')</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                @yield('content')

            </div>
            <footer>
                <div class="footer clearfix mb-0 text-muted">
                    <div class="float-start">
                        <p>{{ date('Y') }} &copy; IT - SD</p>
                    </div>
                    <div class="float-end">
                        <p>PT Sinar Metrindo Perkasa
                        </p>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="{{ asset('assets/js/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>
    <script src="{{ asset('assets/vendors/simple-datatables/simple-datatables.js') }}"></script>
    <script src="{{ asset('assets/js/vendors.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    @yield('script')
</body>

</html>