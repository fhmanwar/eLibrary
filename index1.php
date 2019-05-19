<?php
// core configuration
include_once "config/core.php";

// set page title
$page_title="Index";

// include login checker
$require_login=true;
include_once "helper/login_checker.php";
login_checker();

// // include page header HTML
// include 'View/layout/head.php';
// include 'View/layout/header.php';
// include 'View/layout/nav.php';
// echo "<div class='col-md-12'>";

    // // content once logged in
    // echo "<div class='alert alert-info'>";
    //     echo "Content when logged in will be here. For example, your premium products or services.";
    // echo "</div>";
    // to prevent undefined index notice
    $action = isset($_GET['action']) ? $_GET['action'] : "";

    // if login was successful
    if($action=='login_success'){
        header("Location: {$home_url}View/index.php");
        // echo "<div class='alert alert-info'>";
        //     // echo "<strong>Hi " . $_SESSION['firstname'] . ", welcome back!</strong>";
        //     echo "<strong>welcome back!</strong>";
        // echo "</div>";
    }

    // if user is already logged in, shown when user tries to access the login page
    else if($action=='already_logged_in'){
        echo "<div class='alert alert-info'>";
            echo "<strong>You are already logged in.</strong>";
        echo "</div>";
        //header("Location: {$home_url}View/index.php");
    }

//     // content once logged in
//     echo "<div class='alert alert-info'>";
//         echo "Content when logged in will be here. For example, your premium products or services.";
//     echo "</div>";

// echo "</div>";

// // footer HTML and JavaScript codes
// include 'View/layout/nav.php';
?>
