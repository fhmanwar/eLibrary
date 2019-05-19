<?php

function login_checker()
{
    // login checker for 'customer' access level

    // if access level was not 'Admin', redirect him to login page
    if(isset($_SESSION['akses_level']) && $_SESSION['akses_level']=="Admin"){
        header("Location: {$home_url}View/?action=logged_in_as_admin");
    }

    // if $require_login was set and value is 'true'
    else if(isset($require_login) && $require_login==true){
        // if user not yet logged in, redirect to login page
        if(!isset($_SESSION['akses_level'])){
            header("Location: {$home_url}?action=please_login");
        }
    }

    // if it was the 'login' or 'register' or 'sign up' page but the customer was already logged in
    else if(isset($page_title) && ($page_title=="Login" || $page_title=="Sign Up")){
        // if user not yet logged in, redirect to login page
        // header("Location: {$home_url}index.php?action=already_logged_in");
        if(isset($_SESSION['akses_level']) && $_SESSION['akses_level']!="Admin"){
            header("Location: {$home_url}?action=already_logged_in");
        }
    }

    else{
        // no problem, stay on current page
    }
}

function admin_check()
{
    // login checker for 'admin' access level

    // if the session value is empty, he is not yet logged in, redirect him to login page
    if(empty($_SESSION['logged_in'])){
        header("Location: {$home_url}?action=not_yet_logged_in");
    }

    // if access level was not 'Admin', redirect him to login page
    else if($_SESSION['access_level']!="Admin"){
        header("Location: {$home_url}?action=not_admin");
    }

    else{
        // no problem, stay on current page
    }
}
?>