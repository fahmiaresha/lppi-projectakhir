<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>@yield('title')</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ url('assets/media/image/favicon.ico') }}" />

    <!-- Main css -->
    <link rel="stylesheet" href="{{ url('vendors/bundle.css') }}" type="text/css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Google font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

    <!-- animate -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <style>
        .badge-notif {
            position: relative;
        }

        .badge-notif[data-badge]:after {
            content: attr(data-badge);
            position: absolute;
            top: -10px;
            right: -10px;
            font-size: .7em;
            background: #e53935;
            color: white;
            width: 18px;
            height: 18px;
            text-align: center;
            line-height: 18px;
            border-radius: 50%;
        }
    </style>
    @yield('head')

    <link rel="stylesheet" href="{{ url('assets/css/app.min.css') }}" type="text/css">
</head>


<body class="dark scrollable-layout">
    <div class="preloader">
        <div class="preloader-icon"></div>
        <span>Loading...</span>
    </div>
    <div class="sidebar-group">
    </div>
    <div class="layout-wrapper">

        <!-- Header -->
        <div class="header d-print-none">
            <div class="header-container">
                <div class="header-left">
                    <div class="navigation-toggler">
                        <a href="#" data-action="navigation-toggler">
                            <i data-feather="menu"></i>
                        </a>
                    </div>

                    <div class="header-logo">
                        <a href="{{ url('/home') }}">
                            <!-- <img class="logo" src="{{ url('assets/media/image/logo.png') }}" alt="logo"> -->
                            <img class="logo" src="{{ url('assets/media/image/favicon.ico') }}" alt="logo">
                            <h4 class="logo mt-3 ml-2" style="color:white">Fahmi Store</h4>
                        </a>
                    </div>
                </div>

                <div class="header-body">
                    <div class="header-body-left">
                        <ul class="navbar-nav">
                            <li class="nav-item mr-3">
                                <div class="header-search-form">
                                    <form>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <button class="btn">
                                                    <i data-feather="search"></i>
                                                </button>
                                            </div>
                                            <input type="text" class="form-control" placeholder="Search">
                                            <div class="input-group-append">
                                                <button class="btn header-search-close-btn">
                                                    <i data-feather="x"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </li>

                        </ul>
                    </div>

                    <div class="header-body-right">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a href="#" class="nav-link mobile-header-search-btn" title="Search">
                                    <i data-feather="search"></i>
                                </a>
                            </li>

                            <li class="nav-item dropdown d-none d-md-block">
                                <a href="#" class="nav-link" title="Fullscreen" data-toggle="fullscreen">
                                    <i class="maximize" data-feather="maximize"></i>
                                    <i class="minimize" data-feather="minimize"></i>
                                </a>
                            </li>
                            <li class="nav-item dropdown">
                                <figure class="avatar avatar-sm">
                                    <img src="{{ url('assets/media/image/user/man_avatar3.jpg') }}" class="rounded-circle" alt="avatar">
                                </figure>
                                <span class="ml-2 d-sm-inline d-none">{{ auth()->user()->name }}</span>
                                </a>
                            </li>


                        </ul>
                    </div>
                </div>

                <ul class="navbar-nav ml-auto">
                    <li class="nav-item header-toggler">
                        <a href="#" class="nav-link">
                            <i data-feather="arrow-down"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- ./ Header -->

        <!-- SIDEBARR -->
        <!-- Content wrapper -->
        <div class="content-wrapper">
            <!-- begin::navigation -->
            <div class="navigation">
                <div class="navigation-header">
                    <span>Navigation</span>
                    <a href="#">
                        <i class="ti-close"></i>
                    </a>
                </div>
                <div class="navigation-menu-body">
                    <ul>
                        <li>
                            <a @if(request()->segment(1) == '/home') class="active" @endif href="{{ route('home') }}">
                                <span class="nav-link-icon">
                                <i class="fas fa-chart-line"></i>
                                </span>
                                <span>Dashboard</span>
                            </a>
                        </li>


                        <li>
                            <a @if(request()->segment(1) == 'category') class="active" @endif href="{{ route('category.index') }}">
                                <span class="nav-link-icon">
                                <i class="fas fa-box"></i>
                                </span>
                                <span>Kategori</span>
                            </a>
                        </li>
                        <li>
                            <a @if(request()->segment(1) == 'product') class="active" @endif href="{{ route('product.index') }}">
                                <span class="nav-link-icon">
                                <i class="fas fa-shopping-bag"></i>
                                </span>
                                <span>Produk</span>
                            </a>
                        </li>

                        <li>
                            <a @if(request()->segment(1) == 'order') class="active" @endif href="{{ route('order.index') }}">
                                <span class="nav-link-icon">
                                    <i class="fa fa-cart-plus" style="margin-left:-2px;"></i>
                                </span>
                                <span>Pesanan</span>
                            </a>
                        </li>

                        <li>
                            <a @if(request()->segment(1) == 'laporan') class="active" @endif href="{{ route('laporan.index') }}">
                                <span class="nav-link-icon">
                                    <i class="fa fa-bar-chart"></i>
                                </span>
                                <span>Laporan</span>
                            </a>
                        </li>
                        <li>
                            <a onclick="tampil_logout()">
                                <span class="nav-link-icon">
                                    <i class="fas fa-sign-out-alt"></i>
                                </span>
                                <span>Logout</span>
                                <form id="logoutForm" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </a>
                        </li>


                    </ul>
                </div>
            </div>
            <!-- end::navigation -->
            <!-- end::SIDEBAR -->


            <!-- Content body -->
            <div class="content-body">

                <!-- KONTEN -->
                <div class="content @yield('parentClassName')">
                    @yield('content')
                </div>
                <!-- .KONTEN -->

                <!-- Footer -->
                <footer class="content-footer">
                    <div>© {{ date('Y') }} - Fahmi Aresha . All rights reserved</div>
                    <!-- <div>
                    <nav class="nav">
                        <a href="https://themeforest.net/licenses/standard" class="nav-link">Licenses</a>
                        <a href="#" class="nav-link">Change Log</a>
                        <a href="#" class="nav-link">Get Help</a>
                    </nav> -->
            </div>
            </footer>
            <!-- ./ Footer -->


        </div>
        <!-- ./ Content body -->
    </div>
    <!-- ./ Content wrapper -->
    </div>
    <!-- ./ Layout wrapper -->

    <!-- Main scripts -->
    <script src="{{ url('vendors/bundle.js') }}"></script>

    <!-- App scripts -->
    <script src="{{ url('assets/js/app.min.js') }}"></script>

    @yield('script')


    <script>
        function tampil_logout(event) {
            swal({
                title: 'Apakah Anda Ingin Logout ?',
                text: "Session Akan Di Reset !",
                icon: 'warning',
                showCancelButton: true,
                buttons: true,
                dangerMode: true,

            }).then((result) => {
                if (result) {
                    swal("Anda Berhasil Logout!", {
                        icon: "success",
                    });
                    tampil_link();
                }
            })
        }

        function tampil_link() {
            document.getElementById('logoutForm').submit();
        }
    </script>
</body>

</html>