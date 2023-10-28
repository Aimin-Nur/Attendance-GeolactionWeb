{{-- <!doctype html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="theme-color" content="#000000">
    <title>Absensi PT. Portal Indonesia</title>
    <meta name="description" content="Mobilekit HTML Mobile UI Kit">
    <meta name="keywords" content="bootstrap 4, mobile template, cordova, phonegap, mobile, html" />
    <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.png') }}" sizes="32x32">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/img/icon/192x192.png') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="manifest" href="__manifest.json">
</head>

<body class="bg-white">

    <!-- loader -->
    <div id="loader">
        <div class="spinner-border text-primary" role="status"></div>
    </div>
    <!-- * loader -->


    <!-- App Capsule -->
    <div id="appCapsule" class="pt-0">
        <div class="login-form mt-1">
            <div class="section">
                <img src="{{ asset('assets/img/login/login.webp') }}" alt="image" class="form-image">
            </div>
            <div class="section mt-1">
                <h2>Absensi Karyawan PT. Portal Indonesia</h3>
                <p>Silahkan Masukkan Email dan Password Anda</p>
            </div>
            <div class="section mt-1 mb-5">
                <?php
                    $gagalLogin = Session::get('warning');
                    if ($gagalLogin) {
                        echo '<div class="alert alert-outline-danger">' . $gagalLogin . '</div>';
                    }
                  ?>
                <form action="/LoginKaryawan" method="post">
                    @csrf
                    <div class="form-group boxed">
                        <div class="input-wrapper">
                            <input type="number" class="form-control" name="NIP" id="NIP" placeholder="Nomor Induk Karyawan">
                            <i class="clear-input">
                                <ion-icon name="close-circle"></ion-icon>
                            </i>
                        </div>
                    </div>

                    <div class="form-group boxed">
                        <div class="input-wrapper">
                            <input type="password" name="password" class="form-control" id="password1" placeholder="Password">
                            <i class="clear-input">
                                <ion-icon name="close-circle"></ion-icon>
                            </i>
                        </div>
                    </div>

                    <div class="form-links mt-2">
                        <div>
                            <a href="page-register.html">Register Now</a>
                        </div>
                        <div><a href="page-forgot-password.html" class="text-muted">Forgot Password?</a></div>
                    </div>

                    <div class="form-button-group">
                        <button type="submit" class="btn btn-primary btn-block btn-lg">Log in</button>
                    </div>

                </form>
            </div>
        </div>


    </div>
    <!-- * App Capsule -->



    <!-- ///////////// Js Files ////////////////////  -->
    <!-- Jquery -->
    <script src="{{ asset('assets/js/lib/jquery-3.4.1.min.js') }}"></script>
    <!-- Bootstrap-->
    <script src="{{ asset('assets/js/lib/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/lib/bootstrap.min.js') }}"></script>
    <!-- Ionicons -->
    <script type="module" src="https://unpkg.com/ionicons@5.0.0/dist/ionicons/ionicons.js"></script>
    <!-- Owl Carousel -->
    <script src="{{ asset('assets/js/plugins/owl-carousel/owl.carousel.min.js') }}"></script>
    <!-- jQuery Circle Progress -->
    <script src="{{ asset('assets/js/plugins/jquery-circle-progress/circle-progress.min.js') }}"></script>
    <!-- Base Js File -->
    <script src="{{ asset('assets/js/base.js') }}"></script>


</body>

</html> --}}

<!doctype html>
<!--
* Tabler - Premium and Open Source dashboard template with responsive and high quality UI.
* @version 1.0.0-beta19
* @link https://tabler.io
* Copyright 2018-2023 The Tabler Authors
* Copyright 2018-2023 codecalm.net Paweł Kuna
* Licensed under MIT (https://github.com/tabler/tabler/blob/master/LICENSE)
-->
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>Login Absensi Portal</title>
    <!-- CSS files -->
    <link href="{{asset('demo')}}/./dist/css/tabler.min.css?1684106062" rel="stylesheet"/>
    <link href="{{asset('demo')}}/./dist/css/tabler-flags.min.css?1684106062" rel="stylesheet"/>
    <link href="{{asset('demo')}}/./dist/css/tabler-payments.min.css?1684106062" rel="stylesheet"/>
    <link href="{{asset('demo')}}/./dist/css/tabler-vendors.min.css?1684106062" rel="stylesheet"/>
    <link href="{{asset('demo')}}/./dist/css/demo.min.css?1684106062" rel="stylesheet"/>
    <style>
      @import url('https://rsms.me/inter/inter.css');
      :root {
      	--tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
      }
      body {
      	font-feature-settings: "cv03", "cv04", "cv11";
      }
    </style>
  </head>
  <body  class=" d-flex flex-column">

<div class="page page-center">
    <div class="container container-normal py-4">
      <div class="row align-items-center g-4">
        <div class="col-lg">
          <div class="container-tight">
            <div class="text-center mb-4">
              <a href="." class="navbar-brand navbar-brand-autodark"><img src="{{asset('demo')}}/./static/portal-color.png" height="36" alt=""></a>
            </div>
            <div class="card card-md">
              <div class="card-body">
                <h2 class="h2 text-center mb-4">Absensi Karyawan PT. Portal Indonesia</h2>
                <?php
                    $gagalLogin = Session::get('warning');
                    if ($gagalLogin) {
                        echo '<div class="alert alert-danger">' . $gagalLogin . '</div>';
                    }
                ?>
                <form action="/LoginKaryawan" method="post">
                    @csrf
                  <div class="mb-3">
                    <label class="form-label">NIP</label>
                    <input type="number" name="NIP" id="NIP" placeholder="Nomor Induk Karyawan" class="form-control" placeholder="Nomor Induk Pegawai" autocomplete="off">
                  </div>
                  <div class="mb-2">
                    <label class="form-label">
                      Password
                      <span class="form-label-description">
                        <a href="./forgot-password.html">I forgot password</a>
                      </span>
                    </label>
                    <div class="input-group input-group-flat">
                      <input type="password" name="password" class="form-control"  placeholder="Password"  autocomplete="off">
                      <span class="input-group-text">
                        <a href="#" class="link-secondary" title="Show password" data-bs-toggle="tooltip"><!-- Download SVG icon from http://tabler-icons.io/i/eye -->
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" /></svg>
                        </a>
                      </span>
                    </div>
                  </div>
                  <div class="mb-2">
                    <label class="form-check">
                      <input type="checkbox" class="form-check-input"/>
                      <span class="form-check-label">Remember me on this device</span>
                    </label>
                  </div>
                  <div class="form-footer">
                    <button type="submit" class="btn btn-primary w-100">Login</button>
                  </div>
                </form>
              </div>
            </div>
            <div class="text-center text-muted mt-3">
              Don't have account yet? <a href="/portal" tabindex="-1">Sign up</a>
            </div>
          </div>
        </div>
        <div class="col-lg d-none d-lg-block">
          <img src="{{asset('demo')}}/./static/illustrations/undraw_secure_login_pdn4.svg" height="300" class="d-block mx-auto" alt="">
        </div>
      </div>
    </div>
  </div>

  @include('admin.layouts.script')