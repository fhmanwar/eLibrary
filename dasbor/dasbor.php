<?php
// start session
session_start();

// set time for session timeout
$currentTime = time() + 25200;
$expired = 3600;

// if session not set go to login page
if(!isset($_SESSION['user'])){
  header("location:../index.php");
}

// if current time is more than session timeout back to login page
if($currentTime > $_SESSION['timeout']){
  session_destroy();
  header("location:../index.php");
}

// destroy previous session timeout and create new one
unset($_SESSION['timeout']);
$_SESSION['timeout'] = $currentTime + $expired;

include('layout/head.php');
include('layout/header.php');
include('layout/nav.php');

include_once('../model/connect.php');
include_once('../helper/functions.php');

//Total order count
$sql_order = "SELECT COUNT(*) as num FROM tbl_reservation";
$total_order = mysqli_query($connect, $sql_order);
$total_order = mysqli_fetch_array($total_order);
$total_order = $total_order['num'];

//Total category count
$sql_category = "SELECT COUNT(*) as num FROM tbl_category";
$total_category = mysqli_query($connect, $sql_category);
$total_category = mysqli_fetch_array($total_category);
$total_category = $total_category['num'];

//Total menu count
$sql_menu = "SELECT COUNT(*) as num FROM tbl_menu";
$total_menu = mysqli_query($connect, $sql_menu);
$total_menu = mysqli_fetch_array($total_menu);
$total_menu = $total_menu['num'];

?>

<div id="content" class="container col-md-12">

  <div class="col-md-12">
  	<h1>Dashboard</h1>
  	<hr/>
  </div>

  <div class="row">
    <!-- Berita -->
    <div class="col-md-4 col-sm-6 col-xs-6">
      <div class="panel panel-back noti-box">
        <span class="icon-box bg-color-red set-icon">
          <i class="fa fa-newspaper-o"></i>
        </span>
        <div class="text-box" >
          <p class="main-text"><?php echo $total_menu ?></p>
          <p class="text-muted"><a href="#">Berita</a></p>
        </div>
      </div>
    </div>

    <!-- Produk -->
    <div class="col-md-4 col-sm-6 col-xs-6">
      <div class="panel panel-back noti-box">
      <span class="icon-box bg-color-red set-icon">
          <i class="fa fa-book"></i>
      </span>
      <div class="text-box" >
          <p class="main-text"><?php echo $total_menu ?></p>
          <p class="text-muted"><a href="#">Buku</a></p>
      </div>
      </div>
      </div>

    <!-- User -->
    <div class="col-md-4 col-sm-6 col-xs-6">
      <div class="panel panel-back noti-box">
        <span class="icon-box bg-color-red set-icon">
          <i class="fa fa-user"></i>
        </span>
        <div class="text-box" >
          <p class="main-text"><?php echo $total_menu ?></p>
          <p class="text-muted"><a href="#">User</a></p>
        </div>
      </div>
    </div>


    <!-- Kategori Berita -->
    <div class="col-md-4 col-sm-6 col-xs-6">
      <div class="panel panel-back noti-box">
        <span class="icon-box bg-color-red set-icon">
          <i class="fa fa-tags"></i>
        </span>
        <div class="text-box" >
          <p class="main-text"><?php echo $total_menu ?></p>
          <p class="text-muted"><a href="#">Kategori Berita</a></p>
        </div>
      </div>
    </div>

  </div>
</div>



<?php include('layout/footer.php') ?>
