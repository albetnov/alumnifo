<!--
=========================================================
* Soft UI Dashboard - v1.0.3
=========================================================

* Product Page: https://www.creative-tim.com/product/soft-ui-dashboard
* Copyright 2021 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://www.creative-tim.com/license)

* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/admin') }}/img/apple-icon.png">
    <link rel="icon" type="image/png" href="{{ asset('assets/admin') }}/img/favicon.png">
    <title>
        @yield('title')
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="{{ asset('assets/admin') }}/css/nucleo-icons.css" rel="stylesheet" />
    <link href="{{ asset('assets/admin') }}/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="{{ asset('assets/admin') }}/css/nucleo-svg.css" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="{{ asset('assets/admin') }}/css/soft-ui-dashboard.css?v=1.0.3" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/toastr/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fontawesome/css/all.min.css') }}">
    @livewireStyles
    @stack('styles')
</head>

<body class="g-sidenav-show  bg-gray-100">
