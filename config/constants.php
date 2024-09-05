<?php
// start session
session_start();
// creat constants to store non repeating values
define('SITEURL','http://localhost/food_order/') ;
define('LOCALHOST','localhost');
define('DB_USERNAME','root');
define('DB_PASSWORD','');
define('DB_NAME','food_order');

 $conn = mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD,DB_NAME) or die(mysqli_error());// database connection
 $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error());// selecting database
?>