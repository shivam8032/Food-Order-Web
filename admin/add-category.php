<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>ADD category</h1>
        <br><br>
        <?php

        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }

        ?>
        <br><br>

        <!-- Add category form starts -->
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>title:</td>
                    <td>
                        <input type="text" name="title" placeholder="category title">
                    </td>
                </tr>
                <tr>
                    <td>select image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>featured:</td>
                    <td>
                        <input type="radio" name="featured" value="Yes"> Yes
                        <input type="radio" name="featured" value="NO"> No
                    </td>
                </tr>
                <tr>
                    <td>Active</td>
                    <td>
                        <input type="radio" name="active" value="Yes">Yes
                        <input type="radio" name="active" value="No">No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add category" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
        <!-- Add category form ends -->
        <?php
        // check wheather the submit button is clicked or not 
        if (isset($_POST['submit'])) {
            // echo"Clicked";
            // get the value from category Form
            $title = $_POST['title'];
            // for radio input we need to check wheather the button is selected or not 
            if (isset($_POST['featured'])) {
                // get the value from form 
                $featured = $_POST['featured'];
            } else {
                // set the Default value 
                $featured = "No";
            }
            if (isset($_POST['active'])) {
                $active = $_POST['active'];
            } else {
                $active = "No";
            }
            // check wheather the image is seleted or not and get the omage name accordingly
            // print_r($_FILES['image']);
            // die();// break the code here 
            if (isset($_FILES['image']['name'])) {
                // upload the image 
                // to upload the img we need source path and destination path 
                $image_name = $_FILES['image']['name'];
                // upload image only if image is selected 
                if ($image_name != "") {


                    // Auto rename our image 
                    // get the extension of our image (jpg,png,etc)e.g."specialfood1.one.jpg"
                    $ext = end(explode('.', $image_name));
                    // rename the image
                    $image_name = "Food_category_" . rand(000, 999) . '.' . $ext; // e.g. Food_category_834.jpg

                    $source_path = $_FILES['image']['tmp_name'];
                    $destination_path = "../images/category/" . $image_name;
                    // finally uplaod the image 
                    $upload = move_uploaded_file($source_path, $destination_path);
                    // check wheather the img is uploaded or not 
                    // and if the img is not upload then we will stop the process and redirect with error message 
                    if ($upload == false) {
                        // set messsage 
                        $_SESSION['upload'] = "<div class='error'>failed to upload image.</div>";
                        // redirect to add category page 
                        header('location:' . SITEURL . 'admin/add-category.php');
                        // stop the process
                        die();
                    }
                }
            } else {
                // dont upload the image nad set the image value blank
                $image_name = "";
            }


            // 2. create sql query to insert category into database 
            $sql = "INSERT INTO tbl_category SET
                title='$title',
                image_name='$image_name',
                featured='$featured',
                active='$active'
                ";
            // 3.execute the query and save the data
            $res = mysqli_query($conn, $sql);
            // 4. check wheather the query executed or not and data addede or not
            if ($res == true) {
                // query executed and category added
                $_SESSION['add'] = "<div class='success'>category added successfully.</div>";
                header('location:' . SITEURL . 'admin/manage_category.php');
            } else {
                // failed to added the category 
                $_SESSION['add'] = "<div class='error'>failed to added category.</div>";
                header('location:' . SITEURL . 'admin/add-category.php');
            }
        }
        ?>
    </div>
</div>


<?php include('partials/footer.php'); ?>