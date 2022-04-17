<?php
// Session start
ob_start();
session_start();

// site url (Constant)
define("SITEURL","http://localhost/food_restaurant/");

// database connection start
$hostname = "localhost";
$hostusername = "root";
$hostpassword = "";
$dbname = "food";
$db_connection = mysqli_connect($hostname, $hostusername, $hostpassword, $dbname);
// database connection end
?>