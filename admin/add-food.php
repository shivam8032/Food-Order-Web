<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add food</h1>
        <br><br>
        <?php
        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        ?>
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <input type="text" name="title" placeholder="title of the Food">
                </tr>
                <tr>
                    <td>Description</td>
                    <td><textarea name="description" cols="30" rows="5" placeholder="Description of the food"></textarea>
                    </td>
                </tr>
                <tr>
                    <td>price:</td>
                    <td>
                        <input type="number" name="price">
                    </td>
                </tr>
                <tr>
                    <td>select Image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>category:</td>
                    <td>
                        <select name="category">
                            <?php
                            // create php code to display categories from database
                            // create sql to get all active categories from database
                            $sql = "SELECT *FROM tbl_category WHERE active='Yes'";
                            $res = mysqli_query($conn, $sql);
                            // count rows to check wheather we have categories or not 
                            $count = mysqli_num_rows($res);
                            // if count is grater than 0 we have categories ese we do not have categories 
                            if ($count > 0) {
                                // we have categories
                                while ($row = mysqli_fetch_array($res)) {
                                    // get the details of categories 
                                    $id = $row['id'];
                                    $title = $row['title'];
                            ?>
                                    <option value="<?php echo $id; ?>"><?php echo $title; ?></option>
                                <?php
                                }
                            } else {
                                // we do not have category 
                                ?>
                                <option value="0">no category found</option>
                            <?php
                            }
                            ?>






                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Featured:</td>
                    <td>
                        <input type="radio" name="featured" value="Yes">Yes
                        <input type="radio" name="featured" value="No">No

                    </td>
                </tr>
                <tr>
                    <td>Active:</td>
                    <td>
                        <input type="radio" name="active" value="Yes">Yes
                        <input type="radio" name="active" value="No">No

                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Food" class="btn-secondary">
                    </td>
                </tr>

            </table>
        </form>
        <?php
        //check wheather the button is clicked or not 
        if(isset($_POST['submit']))
        {
            // add food in the database 
            // echo "clicked ";
            // 1. get the data from form
            $title=$_POST['title'];
            $description+$_POST['description'];
            $price=$_POST['price'];
            $category=$_POST['category'];
            // check wheather radion button for featured and active are checked or not 
            if(isset($_POST['featured']))
            {
                $featured=$_POST['featured'];
            }
            else
            {
                $featured="No";// setting the default value 
            }
            if(isset($_POST['active']))
            {
                $active=$_POST['active'];
            }
            else
            {
                $active="No";// setting the default value 
            }


            // 2. upload the image if selected 
            // check wheather the select image is clicked or not 
            if(isset($_FILES['image']['name']))
            {
                $image_name=$_FILES['image']['name'];

                if($image_name!="")
                {
                    // image is selected
                    // rename the image 
                    // get the extension selected image (jpg,png,etc.) shivam choudhary.jpg
                    $ext=end(explode('.',$image_name));
                    $image_name="Food-Name-".rand(0000,9999).".".$ext;
                    // upload the image 
                    // get the src and dst path 
                    // source path 
                    $src=$_FILES['image']['tmp_name'];
                    // destination path for the image to be uploaded
                    $dst="../images/food/".$image_name;
                    // finally upload the food page 
                    $upload=move_uploaded_file($src,$dst);
                    // check wheather image uploaded or not 
                    if($upload==false)
                    {
                        // failed to upload the image
                        // redirect to Add food page with error message
                        
                        $_SESSION['upload']="<div class='error'>Failed to upload image.</div> ";
                        header('location:'.SITEURL>'admin/add-food.php');
                        // stop the process

                        die();
                    }
                }
            }
            
            // 3. insert into database 
            // create a database query to save  or add food
            // for numerical value we do not nedd to pass value inside quotes but for string it sis compulsory
            $sql2 = "INSERT INTO tbl_food SET
                title='$title', 
                description='$description',
                price=$price,
                image_name='$image_name',
                category_id=$category,
                featured='$featured',
                active='$active'
                ";
            // execute the query 
            $res2 = mysqli_query($conn, $sql2);
            // check wheather data inserted or not
            // 4. redirect with message to manage food page   
            if ($res2 == true) {
                // data inserted successfully
                $_SESSION['add'] = "<div class='success'>Food Added successfully.</div>";
                header('location:' . SITEURL . 'admin/manage_food.php');
            } else {
                $_SESSION['add'] = "<div class='error'>Failed to Add Food.</div>";
                header('location:' . SITEURL . 'admin/manage_food.php');
            }
        }
            // 4. redirect with messageto manage food page 
        

        ?>
        <?php
        // check wheather the button is clicked or not 
        ?>





    </div>
</div>


<?php include('partials/footer.php'); ?>