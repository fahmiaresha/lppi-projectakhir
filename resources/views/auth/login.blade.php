<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <link rel="icon" type="image/png" href="{{ asset('asset/admin/img/unair.png') }}">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="Halaman Login Toko Bagus" />
    <link rel="shortcut icon" href="{{ url('assets/media/image/favicon.ico') }}" />

    <script>
        addEventListener("load", function() {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css" />
    <!-- Custom Theme files -->
    <link href="{{ asset('asset/slide-login/css/style.css') }}" rel="stylesheet" type="text/css" media="all" />
    <link href="{{ asset('asset/slide-login/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" media="all" />
    <!-- //Custom Theme files -->

    <link rel="stylesheet" type="text/css" href="{{ asset('asset/Login_v18/vendor/bootstrap/css/bootstrap.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('asset/Login_v18/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('asset/Login_v18/fonts/Linearicons-Free-v1.0.0/icon-font.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('asset/Login_v18/vendor/animate/animate.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('asset/Login_v18/vendor/css-hamburgers/hamburgers.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('asset/Login_v18/vendor/animsition/css/animsition.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('asset/Login_v18/vendor/select2/select2.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('asset/Login_v18/vendor/daterangepicker/daterangepicker.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('asset/Login_v18/css/util.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('asset/Login_v18/css/main.css') }}">
    <link href="//fonts.googleapis.com/css?family=Hind:300,400,500,600,700" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

    <!-- custom login google -->
    <!-- Minified CSS and JS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>

</head>

<body>
    <!-- main -->
    <div class="w3layouts-main">
        <div class="bg-layer">
            <h1 class="animate__animated animate__bounceInDown" style=" animation-duration: 3s;">
                <font color="white"><strong>Admin</strong></font>
            </h1>
            <div class="header-main animate__animated animate__fadeInDown" style=" animation-duration: 3s;">
                <div class="main-icon">
                    <span class="fa fa-eercast"></span>
                </div>
                <div class="header-left-bottom">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="wrap-input100 validate-input" data-validate="Username is required">
                            <input class="input100" type="email" name="email" style="color:white;" required>
                            <span class="focus-input100"></span>
                            <span class="label-input100">Email</span>
                        </div>
                        @error('email')
                        <font size="3">
                            <script>
                                Swal.fire({
                                    timer: 2000,
                                    icon: 'error',
                                    title: 'Maaf',
                                    text: 'Email atau Password Salah !',
                                })
                            </script>
                        </font>
                        @enderror
                        <div class="wrap-input100 validate-input" data-validate="Password is required">
                            <input class="input100" type="password" name="password" style="color:white;" required>
                            <span class="focus-input100"></span>
                            <span class="label-input100">Password</span>
                        </div>

                        <div class="col-md-6">
                            @error('password')
                            <font size="3">
                                <script>
                                    Swal.fire({
                                        timer: 2000,
                                        icon: 'error',
                                        title: 'Maaf',
                                        text: 'Email atau Password Salah !',
                                    })
                                </script>
                            </font>
                            @enderror

                            @if (session('akun_tidak_aktif'))
                            <font size="3">
                                <script>
                                    Swal.fire({
                                        timer: 2000,
                                        icon: 'error',
                                        title: 'Maaf',
                                        text: 'Akun anda tidak aktif !',
                                    })
                                </script>
                            </font>
                            @endif
                        </div>
                        <div class="container-login100-form-btn">
                            <button type="submit" class="login100-form-btn">
                                Log In
                            </button>
                        </div>
                    </form>

                </div>
                <div class="coba mt-3" style="text-align: right;">
                    <a href="/register" target="_blank">
                        <font size="2" style="color:skyblue">Register Account</font>
                    </a>
                </div>

            </div>


            <!-- copyright -->

            <div class="copyright animate__animated animate__fadeInUp" style=" animation-duration: 3s;">
                <p>© {{ date('Y') }} Fahmi Aresha . All rights reserved</p>
            </div>
            <!-- //copyright -->
        </div>
    </div>
    <!-- //main -->

</body>

</html>