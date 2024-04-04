<?php 
    //Include constants.php for SITEURL
    include('constants.php');

    //Destroy the session
    session_destroy();

    //Redirect to login page
    header('location:'.SITEURL.'admin/login.php')

?>