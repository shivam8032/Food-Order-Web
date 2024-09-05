<?php
    // include constants page
    include('../config/constants.php');
    // echo "Delete food Page";
    if(isset($_GET['id'])&& isset($_GET['image_name']))// either use && or (AND) 
    {   
        // process to delete
        //echo "process to delete";
        // 1.get id and image Name
        $id=$_GET['id'];
        $image_name=$_GET['image_name'];
        // 2. remove the image if availabel
        // check wheather the image is available or not delete only if available 
        if($image_name!="")
        {
            // It has image and need to remove from folder
            // get the image paath 
            $path="../images/food/".$image_name;
            $remove=unlink($path);
            // check wheather the image is removed or not 
            if($remove==false)
            {
                // failed to remove image 
                $_SESSION['upload']="<div class='error'>Failed to remove image file.</div>";
                // redirect to manage food
                header('location:'.SITEURL.'admin/manage_food.php');
                // stop the process of deleting food
                die();
            }
        }
        // 3. delete food from database 
        $sql="DELETE FROM tbl_food WHERE id=$id";
        // execute the query 
        $res=mysqli_query($conn,$sql);
        // check wheather the query executed or not and set the session message respectively
        // 4 redirect to manage food with session manage 
        if($res==true)
        {
            $_SESSION['delete']="<div class='success'>Food deleted successfully.</div>";
            header('location:'.SITEURL.'admin/manage_food.php');
        }
        else
        {
            $_SESSION['delete']="<div class='error'>Failed to delete Food.</div>";
            header('location:'.SITEURL.'admin/manage_food.php');
        }
        
    }
    else
    {
        // redirect to manage food page 
        // echo "redirect";
        $_SESSION['unauthorize']="<div class='error'>unauthorized Access.</div>";
        header('location:'.SITEURL.'admin/manage_food.php');
    }
?>
