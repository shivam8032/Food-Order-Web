<?php
// include constants.php file here 
include('../config/constants.php');
//1. get the id of the admin to be deleted 
$id = $_GET['id'];


// 2.create sql query to delete the admin
$sql = "DELETE FROM tbl_admin WHERE id=$id";
//execute the query 
$res = mysqli_query($conn, $sql);
// check wheather the query executed successfully or not 
if ($res == true) {
    // query executed successfully and admin deleted 
    //echo"admin deleted";
    // create session variable to display message 
    $_SESSION['delete'] = "<div class='success'>Admin deleted successfully.</div>";
    //redirected to main admin admin page 
    header('location:' . SITEURL . 'admin/manage_admin.php');
} else {
    // failed to delete admin
    // echo"failed to elete admin";
    $$_SESSION['deleted'] = "<div class='error'>failed to deleted admin. try again later.</div> ";
    header('location:' . SITEURL . 'admin/manage_admin.php');
}
// 3.redirect to manage admin page with message (success/error)
