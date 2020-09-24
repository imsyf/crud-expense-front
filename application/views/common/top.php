<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags-->
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  
  <!-- Title Page-->
  <title><?= $title ?></title>
  
  <!-- Fontfaces CSS-->
  <link href="<?= base_url() ?>assets/css/font-face.css" rel="stylesheet" media="all">
  <link href="<?= base_url() ?>assets/vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
  <link href="<?= base_url() ?>assets/vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
  <link href="<?= base_url() ?>assets/vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
  
  <!-- Bootstrap CSS-->
  <link href="<?= base_url() ?>assets/vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

  <!-- Vendor CSS-->
  <link href="<?= base_url() ?>assets/vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
  <link href="<?= base_url() ?>assets/vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
  <link href="<?= base_url() ?>assets/vendor/wow/animate.css" rel="stylesheet" media="all">
  <link href="<?= base_url() ?>assets/vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
  <link href="<?= base_url() ?>assets/vendor/slick/slick.css" rel="stylesheet" media="all">
  <link href="<?= base_url() ?>assets/vendor/select2/select2.min.css" rel="stylesheet" media="all">
  <link href="<?= base_url() ?>assets/vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">

  <!-- Main CSS-->
  <link href="<?= base_url() ?>assets/css/theme.css" rel="stylesheet" media="all">
</head>
<body class="animsition">

  <!-- PAGE WRAPPER -->
  <div class="page-wrapper">

    <!-- HEADER MOBILE -->
    <header class="header-mobile d-block d-lg-none">
      <div class="header-mobile__bar">
        <div class="container-fluid">
          <div class="header-mobile-inner">
            <a class="logo" href="<?= base_url() ?>">
              <img src="<?= base_url() ?>assets/images/logo.png" alt="Logo" />
            </a>
            <button class="hamburger hamburger--slider" type="button">
              <span class="hamburger-box">
                <span class="hamburger-inner"></span>
              </span>
            </button>
          </div>
        </div>
      </div>
      <nav class="navbar-mobile">
        <div class="container-fluid">
          <ul class="navbar-mobile__list list-unstyled">
            <li>
              <a href="<?= base_url() ?>"><i class="fas fa-tachometer-alt"></i>Dashboard</a>
            </li>
            <li>
              <a href="<?= base_url().'record/list' ?>"><i class="fas fa-chart-bar"></i>Records</a>
            </li>
            <li>
              <a href="<?= base_url().'record/add' ?>"><i class="fas fa-plus-square"></i>Add New Record</a>
            </li>
          </ul>
        </div>
      </nav>
    </header>
    <!-- END HEADER MOBILE-->

    <!-- MENU SIDEBAR -->
    <aside class="menu-sidebar d-none d-lg-block">
      <div class="logo">
        <a href="<?= base_url() ?>">
          <img src="<?= base_url() ?>assets/images/logo.png" alt="Logo" />
        </a>
      </div>
      <div class="menu-sidebar__content js-scrollbar1">
        <nav class="navbar-sidebar">
          <ul class="list-unstyled navbar__list">
            <li <?= $title == 'Dashboard' ? 'class="active"' : FALSE ?>>
              <a href="<?= base_url() ?>"><i class="fas fa-tachometer-alt"></i>Dashboard</a>
            </li>
            <li <?= $title == 'Records' ? 'class="active"' : FALSE ?>>
              <a href="<?= base_url().'record/list' ?>"><i class="fas fa-chart-bar"></i>Records</a>
            </li>
            <li <?= $title == 'Add New Record' ? 'class="active"' : FALSE ?>>
              <a href="<?= base_url().'record/add' ?>"><i class="fas fa-plus-square"></i>Add New Record</a>
            </li>
          </ul>
        </nav>
      </div>
    </aside>
    <!-- END MENU SIDEBAR -->

    <!-- PAGE CONTAINER -->
    <div class="page-container">

      <!-- HEADER DESKTOP -->
      <header class="header-desktop">
