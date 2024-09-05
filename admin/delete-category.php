<?php
// inclde constants file 
include('../config/constants.php');
// echo "Delete page";
// check wheather the id and image_name value is set or not 
if (isset($_GET['id']) and isset($_GET['image_name'])) {
    // get the value and delete
    //echo "get value and delete";
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];
    // remove the physical image file is available 
    if ($image_name != "") {
        // image is availabele. so remove it 
        $path = "../images/category/" . $image_name;
        // remove the image 
        $remove = unlink($path);
        // if failed to remove image then add an error message and stop the process
        if ($remove == false) {
            // set the session message
            $_SESSION['remove'] = "<div class='error'>failed to remove category image.</div>";
            // redirect to manage _category page 
            header('location:' . SITEURL . 'admin/manage_category.php');
            // stop the process
            die();
        }
    }
    // Delete data from database
    // sql query delete data from database
    $sql = "DELETE FROM tbl_category WHERE id=$id";
    // execute the query
    $res = mysqli_query($conn, $sql);
    // check whaether the data is deleted from database or not 
    if ($res == true) {
        // set success message and redirect  
        $_SESSION['delete'] = "<div class='success'>category deleted successfully .</div>";
        // redirect to manage _category page 
        header('location:' . SITEURL . 'admin/manage_category.php');
    } else {
        // set fail message and redirecs
        $_SESSION['remove'] = "<div class='error'>failed to delete category.</div>";
        // redirect to manage _category page 
        header('location:' . SITEURL . 'admin/manage_category.php');
    }
} else {
    // redirect to manage category page 
    header('location' . SITEURL . 'admin/manage_category.php');
}
