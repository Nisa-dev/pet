<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ strtoupper($contact->contact_name) }} - {{ strtoupper('Manage') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Prompt&display=swap" rel="stylesheet">

    <!-- Icons -->
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
        integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
</head>

<body id="page-top" class="d-flex flex-column">
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <div class="bg-white border-right shadow" id="sidebar-wrapper">
            <div class="sidebar-heading bg-main"><a class="text-decoration-none text-white text-uppercase"
                    href="{{ url('/') }}">{{ $contact->contact_name }} <br><small>Deliveryman Manage</small></a></div>
            <div class="list-group list-group-flush">
                <ul class="navbar-nav">
                    <li class="nav-item list-group-item list-group-item-action bg-white">
                        <a class="btn btn-link text-decoration-none text-dark"
                            href="{{ route('dashboard.deliveryman') }}" role="button">
                            <i class="fas fa-tachometer-alt"></i> แดชบอร์ด
                        </a>
                    </li>
                    <li class="nav-item list-group-item list-group-item-action bg-white">
                        <small class="text-decoration-none text-main">จัดการจัดส่งสินค้า</small><br>
                        <a class="btn btn-link text-decoration-none text-dark"
                            href="{{ url('/deliveryman/manage_orders') }}" role="button">
                            <i class="fas fa-truck"></i> รายการจัดส่งสินค้า
                        </a>
                        <a class="btn btn-link text-decoration-none text-dark" href="{{ url('/deliveryman/manage_transports') }}" role="button">
                            <i class="fas fa-map"></i> จัดการช่องทางจัดส่ง
                        </a>
                        <a class="btn btn-link text-decoration-none text-dark" href="{{ url('/deliveryman/manage_expenses') }}"
                                role="button">
                                <i class="fas fa-dollar-sign fa-fw"></i> การเงินธุรกิจ
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- End Sidebar -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow border-bottom">
                <div class="container-fluid">
                    <button class="btn btn-lg btn-link" id="menu-toggle"><span
                            class="navbar-toggler-icon"></span></button>
                    <button class="navbar-toggler border-0" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto">
                            <!-- Authentication Links -->
                            @if ($new_order != null || $error_order != null)
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-bell"></i> <sup><span
                                            class="badge badge-danger">{{$new_order + $error_order}}</span></sup>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    @if ($new_order != '0')
                                    <a class="dropdown-item"
                                        href="{{ route('manage_orders.index_deliveryman_sort_status','0') }}">รายการจัดส่งใหม่
                                        <sup><span class="badge badge-danger">{{$new_order}}</span></sup></a>
                                    @endif
                                    @if ($error_order != '0')
                                    <a class="dropdown-item"
                                        href="{{ route('manage_orders.index_deliveryman_sort_status','2') }}">รายการจัดส่งผิดพลาด
                                        <sup><span class="badge badge-danger">{{$error_order}}</span></sup></a>
                                    @endif
                                </div>
                            </li>
                            @endif

                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                        <span class="text-danger">ออกจากระบบ</span>
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <main class="py-4">
                @yield('content')
            </main>
        </div>
    </div>

    <footer id="sticky-footer" class="py-4 bg-dark text-white-50">
        <div class="container text-center">
            <p class="mb-0">&copy; Copyright 2019 by {{ $contact->contact_name }}. All Rights Reserved.</p>
        </div>
    </footer>

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-chevron-circle-up fa-3x"></i>
    </a>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    <script>
            // Sidebar Toggle
            $("#menu-toggle").click(function (e) {
                e.preventDefault();
                $("#wrapper").toggleClass("toggled");
            });
            // Scroll to Top Button
            $(document).scroll(function () {
                var scrollDistance = $(this).scrollTop();
                if (scrollDistance > 100) {
                    $(".scroll-to-top").fadeIn();
                } else {
                    $(".scroll-to-top").fadeOut();
                }
            });
    
            // Example starter JavaScript for disabling form submissions if there are invalid fields
            (function () {
                'use strict';
                window.addEventListener('load', function () {
                    // Fetch all the forms we want to apply custom Bootstrap validation styles to
                    var forms = document.getElementsByClassName('needs-validation');
                    // Loop over them and prevent submission
                    var validation = Array.prototype.filter.call(forms, function (form) {
                        form.addEventListener('submit', function (event) {
                            if (form.checkValidity() === false) {
                                event.preventDefault();
                                event.stopPropagation();
                            }
                            form.classList.add('was-validated');
                        }, false);
                    });
                }, false);
            })();
        </script>

</body>

</html>
