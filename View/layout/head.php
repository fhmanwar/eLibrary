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

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Free Bootstrap Admin Template : Binary Admin</title>
  <!-- BOOTSTRAP STYLES-->
  <link href="../assets/css/bootstrap.css" rel="stylesheet" />
  <!-- FONTAWESOME STYLES-->
  <link href="../assets/css/font-awesome.css" rel="stylesheet" />
  <!-- MORRIS CHART STYLES-->
  <link href="../assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
  <!-- CUSTOM STYLES-->
  <link href="../assets/css/custom.css" rel="stylesheet" />
  <!-- GOOGLE FONTS-->
  <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
  <!-- TABLE STYLES-->
 <link href="../assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
 <!-- Tinymce -->
 <script src="../assets/tinymce/tinymce.min.js" type="text/javascript"></script>
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
 <script src="../assets/js/jquery-1.10.2.js"></script>
</head>

<body>
  <div id="wrapper">
