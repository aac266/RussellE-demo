<?php
  session_start();
  include_once dirname(__DIR__, 3) . '/config/url.php';
	if (!isset($_SESSION['username'])) {
	  header('location: index.php');
	  exit();
	}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="author" content="RussellE">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <?php 
    $title = basename($_SERVER['PHP_SELF'], '.php');
    $title = explode('-',$title);
    $title = ucfirst($title[1]);
  ?>
  <title><?= $title; ?> | Guest Panel</title>
  <link rel="stylesheet" href="<?= $assets_url ?>/lib/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?= $assets_url ?>/lib/datatable/datatables.min.css">
  <link rel="stylesheet" href="<?= $assets_url ?>/lib/fontawesome/css/all.min.css">
  <style type="text/css">
  .guest-nav {
    min-height: 100vh;
    width: 220px;
    overflow: hidden;
    background-color: #343a40;
  }

  .guest-link {
    background-color: #343a40;
  }

  .guest-link:hover,
  .nav-active {
    background-color: #212529;
    text-decoration: none;
  }

  </style>
  <script src="<?= $assets_url ?>/lib/jquery-3.4.1.min.js"></script>
  <script src="<?= $assets_url ?>/lib/bootstrap/js/bootstrap.bundle.min.js" defer></script>
  <script src="<?= $assets_url ?>/lib/datatable/datatables.min.js" defer></script>
  <script src="<?= $assets_url ?>/lib/sweetalert2.all.min.js" defer></script>
  <script type="text/javascript">
  $(document).ready(function() {
    $("#close-nav").click(function() {
      $(".guest-nav").animate({
        'width': '0'
      });
    });
    $("#open-nav").click(function() {
      $(".guest-nav").animate({
        'width': '220px'
      });
    });

  });
  </script>
</head>

<body>
  <div class="container-fluid">
    <div class="row">
      <div class="guest-nav p-0">
        <h4 class="text-light text-center p-2">Guest Teacher<a href="#" class="text-light float-right" id="close-nav"><i class="fas fa-times"></i></a></h4>
        <div class="list-group list-group-flush">
          <a href="<?= $base_url ?>/guest/guest-dashboard.php" class="list-group-item text-light guest-link <?= (basename($_SERVER['PHP_SELF']) == 'guest-dashboard.php') ? 'nav-active' : ''; ?>"><i class="fas fa-chart-pie"></i>&nbsp;&nbsp;Dashboard</a>

          <a href="<?= $base_url ?>/guest/guest-documents.php" class="list-group-item text-light guest-link <?= (basename($_SERVER['PHP_SELF']) == 'guest-documents.php') ? 'nav-active' : ''; ?>"><i class="fas fa-upload"></i>&nbsp;&nbsp;Documents</a>

          <a href="<?= $base_url ?>/guest/guest-feedback.php" class="list-group-item text-light guest-link <?= (basename($_SERVER['PHP_SELF']) == 'guest-feedback.php') ? 'nav-active' : ''; ?>"><i class="fas fa-comment"></i>&nbsp;&nbsp;Feedback</a>

          <a href="<?= $base_url ?>/guest/guest-notification.php" class="list-group-item text-light guest-link <?= (basename($_SERVER['PHP_SELF']) == 'guest-notification.php') ? 'nav-active' : ''; ?>"><i class="fas fa-bell"></i>&nbsp;&nbsp;Notification&nbsp;<span id="showNotificationCheck"></span></a>

        </div>
      </div>
      <div class="col">
        <div class="row">
          <div class="col-lg-12 bg-danger pt-2 justify-content-between d-flex">
            <a href="#" class="text-white" id="open-nav">
              <h3><i class="fas fa-bars"></i></h3>
            </a>
            <h4 class="text-light"><?= $title; ?></h4>
            <a href="<?= $base_url ?>/guest/assets/php/logout.php" class="text-light mt-1"><i class="fas fa-sign-out-alt"></i>&nbsp;Logout</a>
          </div>
        </div>
