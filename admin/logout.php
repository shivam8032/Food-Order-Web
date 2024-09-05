<?php 
    // include constant.php for siterul
    include('../config/constants.php');
    // 1.destroy the session
    session_destroy(); // unset $_session['user']
    // redirect the login page
    header('location:'.SITEURL.'admin/login.php');
?>