<?php
error_reporting(0);
ob_start();
session_start();
include "config/koneksi.php";
include "config/fungsi_alert.php";
?>
<!DOCTYPE html>
<html>
  <style>
      /* Custom CSS for login button in the top-right corner */
    .navbar-custom-menu {
      float: right;
    }

    .navbar-nav {
      margin: 7.5px -15px;
    }

    .navbar-nav > li {
      float: left;
      margin: 0;
    }

    .navbar-nav > li > a {
      padding-top: 10px;
      padding-bottom: 10px;
    }
    .main-sidebar,
    .left-side {
        position: absolute;
        top: 0;
        left: 0;
        padding-top: 1px;
        min-height: 100%;
        width: 230px;
        z-index: 810;
        -webkit-transition: -webkit-transform .3s ease-in-out, width .3s ease-in-out;
        -moz-transition: -moz-transform .3s ease-in-out, width .3s ease-in-out;
        -o-transition: -o-transform .3s ease-in-out, width .3s ease-in-out;
        transition: transform .3s ease-in-out, width .3s ease-in-out
    }
    .konci{
      font-size:20px;
      text-align:center;
      padding-top:20px;
      margin-bottom:20px;
    }

    .sidebar-menu {
      margin-top: 50px; /* Menambahkan margin atas sebesar 20px pada menu */
    }
    .footer{
      padding-top:20px;
    }

  </style>
  
<head>

    <!--Link utama folder aplikasi di htdocs-->
    <base href="http://localhost/sistempakar/">
    <!--<base href="http://localhost/sistempakar/CF2/">-->

    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link href="css/font-awesome-4.2.0/font-awesome-4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="css/owl-carousel/owl.carousel.css" rel="stylesheet"  media="all">
    <link href="css/owl-carousel/owl.theme.css" rel="stylesheet"  media="all">
    <link href="css/magnific-popup.css" type="text/css" rel="stylesheet" media="all">
    <link href="css/font.css" rel="stylesheet" type="text/css"  media="all">
    <link href="css/fontello.css" rel="stylesheet" type="text/css"  media="all">
    <link href="css/main.css" rel="stylesheet" type="text/css" media="all">
    <link rel="stylesheet" href="css/paging.css" type="text/css" media="screen">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="aset/bootstrap.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="aset/AdminLT.css">
	<link rel="stylesheet" href="aset/cinta.css">
    <link rel="stylesheet" href="aset/Ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="aset/skins/_all-skins.min.css">
    <link rel="stylesheet" href="aset/custom.css">
    <link rel="stylesheet" href="aset/icheck/green.css">
    <!-- jQuery 2.1.4 -->
    <script src="aset/jQuery-2.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="aset/bootstrap.js"></script>
    <script src="aset/icheck/icheck.js"></script>
    <script src="aset/ckeditor/ckeditor.js"></script>
    <script src="aset/Flot/jquery.flot.js"></script>
    <!-- FLOT RESIZE PLUGIN - allows the chart to redraw when the window is resized -->
    <script src="aset/Flot/jquery.flot.resize.js"></script>
    <!-- FLOT PIE PLUGIN - also used to draw donut charts -->
    <script src="aset/Flot/jquery.flot.pie.js"></script>
    <!-- FLOT CATEGORIES PLUGIN - Used to draw bar charts -->
    <script src="aset/Flot/jquery.flot.categories.js"></script> 
    <!-- AdminLTE App -->
    <script src="aset/app.js"></script>

  </head>
  <body id="sistempakar" class="hold-transition skin-purple-light sidebar-mini">
    <div class="wrapper">
      <!-- Main Header -->
      <header class="nav">

        <!-- Header Navbar -->
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>

          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- Move your login button here -->
                <li class="dropdown messages-menu">
                  <a <?php if ($module == "formlogin") echo 'class="active"'; ?> href="formlogin">
                      <i class="fa fa-sign-in"></i> <span>Login</span>
                  </a>
                </li>
                <?php
                  if (isset($_SESSION['username']) && isset($_SESSION['password'])) {
                ?>
                  <li class="dropdown user user-menu">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                      <i class="fa fa-user"></i>
                         <?php echo ucfirst($_SESSION['username']); ?>
                        <span class="hidden-xs"><?php echo $user; ?></span>
                      </a>
                      <ul class="dropdown-menu">
                        <!-- User image -->
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-right">
                              <a class="btn btn-default btn-flat" href="JavaScript: confirmIt('Anda yakin akan logout dari aplikasi ?','logout.php','','','','u','n','Self','Self')" onMouseOver="self.status = ''; return true" onMouseOut="self.status = ''; return true">
                                  <i class="fa fa-sign-out"></i> <span>LogOut</span>
                              </a>
                            </div>
                        </li>
                      </ul>
                  </li>
                <?php } ?>
            </ul>
          </div>

      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar Menu -->
          <p class="konci">SISTEM PAKAR</p>
          <ul class="sidebar-menu">
            <!-- Optionally, you can add icons to the links -->
            <?php include "menu.php"; ?>
        </section>
        <!-- /.sidebar -->
      </aside>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper" style="min-height: 310px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        </section>
        <!-- Main content -->
        <section class="content">
          <div class="box">
            <div class="box-body">
                <?php include "content.php"; ?>		
            </div>
          </div>
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <!-- Main Footer -->
      <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
            <div class="col-md-12 text-center">
                    &copy; 2023 Sistem pakar Certainty factor
                    <p>Inovatif, Akurat, dan Terpercaya</p>
            </div>
                <div class="col-md-12 text-center">
                    <h3>Follow Us</h3>
                    <p>Stay connected with us on social media.</p>
                    <ul class="social-icons">
                        <a href="#" target="_blank"><i class="fa fa-facebook">Yoga penebas meki  </i></a>
                        <a href="#" target="_blank"><i class="fa fa-twitter">@Yoga  </i></a>
                        <a href="#" target="_blank"><i class="fa fa-instagram">yoga-cans</i></a>
                    </ul>
                </div>
                <div class="col-md-4">
                    <!-- Additional content or links -->
                </div>
                <div class="col-md-4">
                    <!-- Additional content or links -->
                </div>
            </div>
        </div>
    </footer>
  </body></html>
<?php            ob_end_flush();
?>