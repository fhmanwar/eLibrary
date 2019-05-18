<?php
// show error reporting
error_reporting(E_ALL);

// start php session
session_start();

// set your default time-zone
date_default_timezone_set('Asia/Indonesia');

// home page url
$home_url="http://localhost/eLibrary/";

// page given in URL parameter, default page is one
$page = isset($_GET['page']) ? $_GET['page'] : 1;

// set number of records per page
$records_per_page = 5;

// calculate for the query LIMIT clause
$from_record_num = ($records_per_page * $page) - $records_per_page;


//access key to access API
$access_key = "12345";

//google play url
$gplay_url = "https://play.google.com/store/apps/details?id=your.package.com";

// email configuration
$admin_email = "youremail@gmail.com";
$email_subject = "Notification of changes to account information!";
$change_message = "You have change your admin info such as email and or password.";
$reset_message = "Your new password is ";

//order notification configuration
$reservation_subject = "New Order Notification!";
$reservation_message = "There is new order, please check Admin Panel.";

//copyright
$copyright = "";
?>
