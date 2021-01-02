<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') {{ strtoupper($contact->contact_name) }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Prompt&display=swap" rel="stylesheet">

    <!-- Icons -->
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
        integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
</head>

<body id="page-top" class="d-flex flex-column">
    <div id="page-content">
        <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm">
            <div class="container-fluid">
                @guest
                <a class="navbar-brand" href="{{ url('/') }}">
                    <span class="text-uppercase">{{ $contact->contact_name }}</span>
                    <img src="{{ asset('image/manage_web/'.$contact->contact_logo)}}" width="20" height="20" class="d-inline-block align-top">
                </a>
                @endguest
                @auth
                @if (Auth::user()->type == 'Admin')
                <a class="navbar-brand" href="{{ route('dashboard.admin') }}">
                    <span class="text-uppercase">{{ $contact->contact_name }}</span>
                    <img src="{{ asset('image/logo.png')}}" width="20" height="20" class="d-inline-block align-top">
                </a>
                @elseif (Auth::user()->type == 'Deliveryman')
                <a class="navbar-brand" href="{{ route('dashboard.deliveryman') }}">
                    <span class="text-uppercase">{{ $contact->contact_name }}</span>
                    <img src="{{ asset('image/logo.png')}}" width="20" height="20" class="d-inline-block align-top">
                </a>
                @elseif (Auth::user()->type == 'Member')
                <a class="navbar-brand" href="{{ url('/') }}">
                    <span class="text-uppercase">{{ $contact->contact_name }}</span>
                    <img src="{{ asset('image/logo.png')}}" width="20" height="20" class="d-inline-block align-top">
                </a>
                @endif
                @endauth

                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/') }}">@lang("หน้าแรก")</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/articles') }}">@lang("บทความ")</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/about_us') }}">@lang("เกี่ยวกับเรา")</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/contact_us') }}">@lang("ติดต่อเรา")</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ $contact->contact_facebook_link }}" target="_blank">
                                <i class="fab fa-facebook-square"></i> @lang("ร้านค้า")
                            </a>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">@lang("เข้าสู่ระบบ")</a>
                        </li>
                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">@lang("สมัครสมาชิก")</a>
                        </li>
                        @endif
                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                @auth
                                @if (Auth::user()->type == 'Member')
                                <a class="dropdown-item"
                                    href="{{route('change_personal_info.show', Auth::user()->id )}}">@lang("แก้ไขข้อมูลส่วนตัว")</a>
                                <a class="dropdown-item" href="{{route('my_lists.index')}}">@lang("รายการสุนัขของฉัน")</a>
                                @endif
                                @endauth

                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                    <span class="text-danger">@lang("ออกจากระบบ")</span>
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main>
            @yield('content')
        </main>
    </div>

    <footer id="sticky-footer" class="py-3 bg-dark text-white-50">
        <div class="container text-right">
            <small class="mb-0">
                <i class="fab fa-facebook-f"></i>
                <a href="{{ $contact->contact_facebook_link }}" target="_blank">{{ $contact->contact_facebook }}</a>
            </small><br>
            <small class="mb-0">
                <i class="fas fa-map-marker-alt"></i></i> 
                <a href="{{ $contact->contact_google_map_link }}" target="_blank">{{ $contact->contact_address }}</a>
            </small><br>
            <small class="mb-0"><i class="fas fa-mobile"></i> {{ $contact->contact_tel_no }}</<i></small>
        </div>
        <div class="container text-left">
            <p>
                <img src="{{ asset('image/th_flag.jpg') }}" width="20px"> <small class="mb-0"><a href="lang/th">ภาษาไทย</a></small> | 
                <img src="{{ asset('image/en_flag.png') }}" width="20px"> <small class="mb-0"><a href="lang/en">English</a></small> 
            </p>
        </div>
        <div class="container text-center">
            <hr>
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
        // Scroll to Top Button
        $(document).scroll(function () {
            var scrollDistance = $(this).scrollTop();
            if (scrollDistance > 100) {
                $(".scroll-to-top").fadeIn();
            } else {
                $(".scroll-to-top").fadeOut();
            }
        });

        // Dropdown จังหวัด
        $('.province').change(function () {
            if ($(this).val() != '') {
                var select = $(this).val();
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: "{{ route('orders.dropdown_province') }}",
                    method: "POST",
                    data: {
                        select: select,
                        _token: _token
                    },
                    success: function (result) {
                        $('.amphures').html(result);
                    }
                })
            }
        });
        $('.amphures').change(function () {
            if ($(this).val() != '') {
                var select = $(this).val();
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: "{{ route('orders.dropdown_amphures') }}",
                    method: "POST",
                    data: {
                        select: select,
                        _token: _token
                    },
                    success: function (result) {
                        $('.districts').html(result);
                    }
                })
            }
        });
        $('.districts').change(function () {
            if ($(this).val() != '') {
                var select = $(this).val();
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: "{{ route('orders.dropdown_zip_code') }}",
                    method: "POST",
                    data: {
                        select: select,
                        _token: _token
                    },
                    success: function (result) {
                        $('.zip_code').html(result);
                    }
                })
            }
        });

    </script>
</body>

</html>
