<?php
    //Include database.php for siteurl
    include("../config/database.php");
    //Step 1: Distroy the session
    session_destroy(); //Unset $_SESSION["user]
    //Step 2: Redirect to login page
    header("location:".SITEURL."admin/login.php");
?>