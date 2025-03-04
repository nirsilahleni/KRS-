<!DOCTYPE html>
<html lang="en">
  <head>
    <!--  Title -->
    <title>{{ siteSetting("site_name") }} | @yield("title")</title>
    <!--  Required Meta Tag -->
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="handheldfriendly" content="true" />
    <meta name="MobileOptimized" content="width" />
    <meta name="description" content="{{siteSetting("site_description")}}" />
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/images/logos/krs.ico') }}" />
    <meta name="author" content="" />
    <meta name="keywords" content="Mordenize" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!--  Favicon -->
    <link rel="shortcut icon" type="image/png" href="{{asset("assets/images/logos/icon_ERPL.ico")}}" />
    <!-- Core Css -->
    <link  id="themeColors"  rel="stylesheet" href="{{asset("landing/css/style.css")}}" />
    <link  id="themeColors"  rel="stylesheet" href="{{asset("landing/css/app.css")}}" />
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
  </head>
  <body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
        @yield('content')
    </div>
    @include('layouts.partials.landing-footer')
    <!--  Import Js Files -->
    <script src="{{asset("assets/libs/jquery/dist/jquery.min.js")}}"></script>
    <script src="{{asset("assets/libs/simplebar/dist/simplebar.min.js")}}"></script>
    <script src="{{asset("assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js")}}"></script>
    <!--  core files -->
    <script src="{{asset("assets/js/app.min.js")}}"></script>
    <script src="{{asset("assets/js/app.init.js")}}"></script>
    <script src="{{asset("assets/js/app-style-switcher.js")}}"></script>
    <script src="{{asset("assets/js/sidebarmenu.js")}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="{{asset("assets/js/custom.js")}}"></script>
  </body>
</html>
