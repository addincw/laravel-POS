<!DOCTYPE html>
<!--
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.3.7
Version: 4.7.1
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
Renew Support: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>
        <meta charset="utf-8" />
        <title>@yield('judul-page')</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="Preview page of Metronic Admin Theme #1 for loading content via ajax" name="description" />
        <meta content="" name="author" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="{{ url('style/global/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ url('style/global/plugins/simple-line-icons/simple-line-icons.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ url('style/global/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ url('style/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="{{ url('style/global/css/components.min.css') }}" rel="stylesheet" id="style_components" type="text/css" />
        <link href="{{ url('style/global/css/plugins.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <link href="{{ url('style/layouts/layout/css/layout.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ url('style/layouts/layout/css/themes/darkblue.min.css') }}" rel="stylesheet" type="text/css" id="style_color" />
        <link href="{{ url('style/layouts/layout/css/custom.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- END THEME LAYOUT STYLES -->
        <!-- ADDITIONAL CSS -->
        @yield('css')
        <!-- END ADDITIONAL CSS -->
        <link rel="shortcut icon" href="favicon.ico" /> </head>
    <!-- END HEAD -->

    <body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white">
        <div class="page-wrapper">
            <!-- BEGIN HEADER -->
            @include('templates/header')
            <!-- END HEADER -->
            <!-- BEGIN HEADER & CONTENT DIVIDER -->
            <div class="clearfix"> </div>
            <!-- END HEADER & CONTENT DIVIDER -->
            <!-- BEGIN CONTAINER -->
            <div class="page-container">
                <!-- BEGIN SIDEBAR -->
                @include('templates/sidebar')
                <!-- END SIDEBAR -->
                <!-- BEGIN CONTENT -->
                <div class="page-content-wrapper">
                    <!-- BEGIN CONTENT BODY -->
                    <div class="page-content">
                        <!-- BEGIN PAGE HEADER-->
                        <!-- BEGIN PAGE BAR -->
                        <div class="page-bar" style="background-color:#ffb400; color:white">
                          <ul class="page-breadcrumb">
                            <li><span class="fa fa-info" style="color:white"></span></li>
                            <li><b>Website ini adalah prototype, sebagai gambaran fitur apa saja yang ada di website ini. Tidak semua fitur berfungsi penuh.</b>  </li>
                          </ul>
                            <!-- <ul class="page-breadcrumb">
                                <li>
                                    <a href="index.html">Home</a>
                                    <i class="fa fa-circle"></i>
                                </li>
                                <li>
                                    <span>Page Layouts</span>
                                </li>
                            </ul>
                            <div class="page-toolbar">
                                <div class="btn-group pull-right">
                                    <button type="button" class="btn btn-sm btn-danger">
                                      <i class="fa fa-arrow-left"></i>
                                       Kembali
                                    </button>
                                </div>
                            </div> -->
                        </div>
                        <!-- END PAGE BAR -->
                        <!-- BEGIN PAGE TITLE-->
                        <h1 class="page-title hidden-print">@yield('judul')
                            <small>@yield('small-judul')</small>
                        </h1>
                        <!-- END PAGE TITLE-->
                        <!-- END PAGE HEADER-->
                        <div class="page-content-body">
                          @if(Session::has('status-gagal'))
                              @if(is_array (Session::get('status-gagal')))
                                  @foreach(Session::get('status-gagal') as $value)
                                      <div class="alert alert-danger alert-dismissable">
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                        <strong>Gagal!</strong> {{ $value }}
                                      </div>
                                  @endforeach
                              @else
                              <div class="alert alert-danger alert-dismissable">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                <strong>Gagal!</strong> {{ Session::get('status-gagal') }}
                              </div>
                              @endif
                          @elseif(Session::has('status-berhasil'))
                            <div class="alert alert-success alert-dismissable">
                              <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                              <strong>Berhasil!</strong> {{ Session::get('status-berhasil') }}
                              @if(Session::has('link'))
                              @php
                                $link = Session::get('link');
                              @endphp
                              <a href="{{ url($link) }}">lihat nota</a>
                              @endif
                            </div>
                          @endif

                            <div class="note note-info hidden-print">
                                <p> @yield('keterangan-halaman') </p>
                            </div>
                            <div class="portlet light bordered">
                              @yield('header')
                                <div class="portlet-body">
                                  @yield('content')
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END CONTENT BODY -->
                </div>
                <!-- END CONTENT -->
            </div>
            <!-- END CONTAINER -->
            <!-- BEGIN FOOTER -->
            @include('templates/footer')
            <!-- END FOOTER -->
        </div>
        <!--[if lt IE 9]>
        <script src="../style/global/plugins/respond.min.js"></script>
        <script src="../style/global/plugins/excanvas.min.js"></script>
        <script src="../style/global/plugins/ie8.fix.min.js"></script>
        <![endif]-->
        <!-- BEGIN CORE PLUGINS -->
        <script src="{{ url('style/global/plugins/jquery.min.js') }}" type="text/javascript"></script>
        <script src="{{ url('style/global/plugins/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
        <script src="{{ url('style/global/plugins/js.cookie.min.js') }}" type="text/javascript"></script>
        <script src="{{ url('style/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js') }}" type="text/javascript"></script>
        <script src="{{ url('style/global/plugins/jquery.blockui.min.js') }}" type="text/javascript"></script>
        <script src="{{ url('style/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="{{ url('style/global/scripts/app.min.js') }}" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <script src="{{ url('style/layouts/layout/scripts/layout.min.js') }}" type="text/javascript"></script>
        <script src="{{ url('style/layouts/layout/scripts/demo.min.js') }}" type="text/javascript"></script>
        <script src="{{ url('style/layouts/global/scripts/quick-sidebar.min.js') }}" type="text/javascript"></script>
        <!-- END THEME LAYOUT SCRIPTS -->
        <!-- ADDITIONAL SCRIPT -->
        @yield('script')
        <!-- END ADDITIONAL SCRIPT -->
    </body>

</html>
