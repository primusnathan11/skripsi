<!DOCTYPE html>
<!--[if IE 8 ]><html class="ie" xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<!--<![endif]-->

<head>
    <!-- Basic Page Needs -->
    <meta charset="UTF-8">
    <!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
    <title>BumiBaik</title>

    <meta name="author" content="themesflat.com">
    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <script type="text/javascript" src="https://app.midtrans.com/snap/snap.js" data-client-key="{{env('MIDTRANS_CLIENT_KEY')}}"></script>

    <!-- Boostrap style -->
    <link rel="stylesheet" type="text/css" href="{{ asset('landing/stylesheet/bootstrap.css') }}">

    <!-- Theme style -->
    <link rel="stylesheet" type="text/css" href="{{ asset('landing/stylesheet/style.css') }}">

    <!-- Reponsive -->
    <link rel="stylesheet" type="text/css" href="{{ asset('landing/stylesheet/responsive.css') }}">

    <!-- icoomon font -->
    <link rel="stylesheet" type="text/css" href="{{ asset('landing/stylesheet/icomoon.css') }}">

    <!-- Favicon and touch icons  -->
    <link href="{{ asset('landing/icon/Favicon.png') }}" rel="apple-touch-icon-precomposed">
    <link href="{{ asset('landing/icon/Favicon.png') }}" rel="apple-touch-icon-precomposed">
    <link href="{{ asset('landing/images/home/bumibaik.jpg') }}" rel="shortcut icon">

    <!-- anime -->
    <link rel="stylesheet" href="{{ asset('landing/stylesheet/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('css/leaflet.css') }}">

</head>

<body>
    <div class="boxed blog">
        <!-- Preloader -->
        <div class="preloader">
            <div class="clear-loading loading-effect-2">
                <span></span>
            </div>
        </div>

        <!-- top header -->
        <div class="top-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col md-4">
                        <div class="top-bar-left">
                        <p class="top-location" style="color: white;">Graha Polinema 4th Floor, Jl. Soekarno Hatta No.9, Malang City, East Java, Indonesia</p>
                        </div>
                    </div>
                    <div class="col md-8">
                        <div class="top-bar-right link-style3">
                            <a href="mailto:business@bumibaik.com" class="top-mail">business@bumibaik.com</a>
                            <ul class="widgets-nav-social text-white">
                                <li><a href="https://wa.me/6282130075758"  target="_blank"><i style="color: white !important;" class="fa fa-whatsapp"
                                    aria-hidden="true"></i></a>
                                </li>
                                <li><a href="https://instagram.com/bumi.baik" target="_blank"><i style="color: white !important;" class="fa fa-instagram" aria-hidden="true"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.top -->

        <!-- header -->
        <header id="header" class="header bg-color">
            <div class="container">
                <div class="row">
                    <div class="header-wrap-home1">
                        <div class="col-md-3 ">
                            <div class="inner-header">
                                <img src="{{ asset('landing/images/home/bumibaik.jpg') }}"
                                    width="100px" alt="images">
                                <!-- /logo -->

                                <div class="btn-menu">
                                    <span></span>
                                </div>
                                <!-- /mobile menu button -->
                            </div>
                        </div>

                        <div class="col-md-9 text-center">
                            <div class="nav-wrap">
                                <nav id="mainnav" class="mainnav">
                                    <ul class="menu">
                                        <li>
                                            <a href="{{ url('') }}" title="">Beranda</a>
                                        </li>
                                        <li>
                                            <a href="{{ url('/about') }}" title="">Tentang</a>
                                            <!-- /.sub-menu -->
                                        </li>
                                        <li>
                                            <a href="{{ url('/service') }}" title="">Layanan</a>

                                            <!-- /.sub-menu -->
                                        </li>

                                        <li>
                                            <a href="{{ route('get.blog') }}" title="">Berita</a>
                                            <!-- /.sub-menu -->
                                        </li>
                                        <li>
                                            <a href="{{ url('/contact') }}" title="">Kontak</a>
                                        </li>
                                        <li>
                                            <a href="{{ url('/donate') }}" title="">Donasi</a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <!-- header right -->
                </div>
            </div>

        </header>
        <!-- /header -->
