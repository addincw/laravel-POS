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
        <title>STARTECH | Point Of Sales</title>
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
        <link href="{{ url('style/pages/css/login.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- END THEME LAYOUT STYLES -->
        <link rel="shortcut icon" href="favicon.ico" /> </head>
    <!-- END HEAD -->

    <body class="login">
      <!-- BEGIN LOGO -->
      <div class="logo">
          <a href="#">
              <b class="logo-default" style="color:white; font-size:20px">Point Of Sales</b>
              <!-- <img src="{{url('style/pages/img/logo-big.png')}}" alt="" />  -->
            </a>
      </div>
      <!-- END LOGO -->
      <!-- BEGIN LOGIN -->
      <div class="content">
          <!-- BEGIN LOGIN FORM -->
          <form class="login-form" action="{{ route('login') }}" method="post">
              {{ csrf_field() }}
              <h3 class="form-title font-green">Sign In</h3>
              <div class="alert alert-danger display-hide">
                  <button class="close" data-close="alert"></button>
                  <span> Enter any username and password. </span>
              </div>
              <div class="form-group">
                  <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                  <label class="control-label visible-ie8 visible-ie9">Username</label>
                  <input class="form-control form-control-solid placeholder-no-fix" id="username" type="username" autocomplete="off" placeholder="username" name="username" /> </div>
              <div class="form-group">
                  <label class="control-label visible-ie8 visible-ie9">Password</label>
                  <input class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="password" /> </div>
              <div class="form-group">
                  <button type="submit" class="btn green uppercase" style="width:100%">Login</button>
              </div>
          </form>
          <!-- END LOGIN FORM -->
      </div>
      <div class="copyright">  2018 &copy; STARTECH &nbsp;|&nbsp; ariqmuhammadi@gmail.com / addincendekia@gmail.com </div>
        <!--[if lt IE 9]>
        <script src="../style/global/plugins/respond.min.js"></script>
        <script src="../style/global/plugins/excanvas.min.js"></script>
        <script src="../style/global/plugins/ie8.fix.min.js"></script>
        <![endif]-->
        <!-- BEGIN CORE PLUGINS -->
        <script src="{{ url('style/global/plugins/jquery.min.js') }}" type="text/javascript"></script>
        <script src="{{ url('style/global/plugins/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
        <script src="{{ url('style/global/plugins/js.cookie.min.js') }}" type="text/javascript"></script>
        <script src="{{ url('style/global/plugins/jquery.blockui.min.js') }}" type="text/javascript"></script>
        <script src="{{ url('style/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="{{ url('style/global/scripts/app.min.js') }}" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
    </body>

</html>
