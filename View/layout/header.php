<?php
	// // start session
	// session_start();
	//
	// // set time for session timeout
	// $currentTime = time() + 25200;
	// $expired = 3600;
	//
	// // if session not set go to login page
	// if(!isset($_SESSION['user'])){
	// 	header("location:index.php");
	// }
	//
	// // if current time is more than session timeout back to login page
	// if($currentTime > $_SESSION['timeout']){
	// 	session_destroy();
	// 	header("location:index.php");
	// }
	//
	// // destroy previous session timeout and create new one
	// unset($_SESSION['timeout']);
	// $_SESSION['timeout'] = $currentTime + $expired;
include_once $_SERVER['DOCUMENT_ROOT'] . '/eLibrary/config/core.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/eLibrary/config/database.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/eLibrary/objects/buku.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/eLibrary/objects/jenis.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/eLibrary/objects/Admin.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/eLibrary/helper/login_checker.php';
admin_check();
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?php echo isset($title) ? strip_tags($title) : "Store Admin"; ?></title>
  <!-- BOOTSTRAP STYLES-->
  <link href="<?php echo $home_url . "view/assets/css/bootstrap.css" ?>" rel="stylesheet" />
  <!-- FONTAWESOME STYLES-->
  <link href="<?php echo $home_url . "view/assets/css/font-awesome.css" ?>" rel="stylesheet" />
  <!-- MORRIS CHART STYLES-->
  <link href="<?php echo $home_url . "view/assets/js/morris/morris-0.4.3.min.css" ?>" rel="stylesheet" />
  <!-- CUSTOM STYLES-->
  <link href="<?php echo $home_url . "view/assets/css/custom.css" ?>" rel="stylesheet" />
  <!-- GOOGLE FONTS-->
  <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
  <!-- TABLE STYLES-->
 <link href="<?php echo $home_url . "view/assets/js/dataTables/dataTables.bootstrap.css" ?>" rel="stylesheet" />
 <!-- Tinymce -->
 <script src="<?php echo $home_url . "view/assets/tinymce/tinymce.min.js" ?>" type="text/javascript"></script>
 <script type="text/javascript">
   tinymce.init({
     selector: '.editor',
     plugins: [
       'advlist autolink lists link image charmap print preview anchor textcolor',
       'searchreplace visualblocks code fullscreen',
       'insertdatetime media table paste code help wordcount'
     ],
     toolbar: 'undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help',
     content_css: [
       '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
       '//www.tiny.cloud/css/codepen.min.css'
     ]
   });
 </script>
 <!-- JQUERY SCRIPTS -->
 <script src="<?php echo $home_url . "view/assets/js/jquery-1.10.2.js" ?>"></script>
</head>

<body>
  <div id="wrapper">
    <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="<?php echo $home_url; ?>view/">E-Library</a>
      </div>
      <div style="color: white;
          padding: 15px 50px 5px 50px;
          float: right;
          font-size: 16px;"> Last access : 30 May 2014 &nbsp;
          <a href="<?php echo $home_url; ?>logout.php" class="btn btn-danger square-btn-adjust">Logout</a>
      </div>
    </nav>
    <!-- /. NAV TOP  -->

    <nav class="navbar-default navbar-side" role="navigation">
  <div class="sidebar-collapse">
    <ul class="nav" id="main-menu">
      <li>
        <a class="" href="<?php echo $home_url; ?>view/"><i class="fa fa-dashboard"></i> Dashboard</a>
      </li>

      <li>
      <a href="#"><i class="fa fa-group "></i> Anggota Perpustakaan<span class="fa arrow"></span></a>
      <ul class="nav nav-second-level">
        <li><a href="#">Data Anggota</a></li>
        <li><a href="#">Tambah Anggota</a></li>
      </ul>
      </li>

      <!-- Menu Buku  -->
      <li>
      <a href="#"><i class="fa fa-calendar "></i> Peminjaman Buku <span class="fa arrow"></span></a>
      <ul class="nav nav-second-level">
        <li><a href="#">Data Peminjaman Buku</a></li>
        <li><a href="#">Tambah Peminjaman buku</a></li>
      </ul>
      </li>

      <!-- Menu Buku  -->
      <li>
      <a href="#"><i class="fa fa-book "></i>Katalog Buku <span class="fa arrow"></span></a>
      <ul class="nav nav-second-level">
        <li><a href="<?php $home_url ?>buku/buku-list.php">Data Buku</a></li>
        <li><a href="<?php $home_url ?>buku/buku-add.php">Tambah buku</a></li>
        <li><a href="#">Data Jenis Buku</a></li>
        <li><a href="#">Kelola File Buku (E-book)</a></li>
      </ul>
      </li>

      <!-- Tabel usulan  -->
      <li>
      <a href="#"><i class="fa fa-upload "></i>  Usulan Buku<span class="fa arrow"></span></a>
      <ul class="nav nav-second-level">
        <li><a href="#">Data Usulan Buku</a></li>
        <li><a href="#">Tambah Usulan Buku</a></li>
      </ul>
      </li>

      <!-- Tabel Referensi  -->
      <!-- <li>
      <a href="#"><i class="fa fa-tags "></i> Tabel Referensi<span class="fa arrow"></span></a>
      <ul class="nav nav-second-level">
        <li><a href="#">Data Jenis Buku</a></li>
        <li><a href="#">Data Bahasa Buku</a></li>
        <li><a href="#">Data Link</a></li>
      </ul>
      </li> -->

      <!-- Menu User  -->
      <li>
      <a href="#"><i class="fa fa-user "></i> User/Admin<span class="fa arrow"></span></a>
      <ul class="nav nav-second-level">
        <li><a href="#">Data User</a></li>
        <li><a href="#">Tambah User</a></li>
      </ul>
      </li>

    </ul>

  </div>

</nav>
<!-- /. NAV SIDE  -->

<div id="page-wrapper">
  <div id="page-inner">
