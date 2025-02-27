<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>
        <br><br>
        <?php
        //1.get the id of the selected admin
        $id = $_GET['id'];
        //2. create the sql query to  get the details

        $sql = "SELECT* FROM tbl_admin wHERE id=$id";
        // execte the query 
        
        $res = mysqli_query($conn, $sql);
        // check wheather the query is executed or not
        if($res==true)
        {
            // check wheather the data is available or not
            $count=mysqli_num_rows($res);
            // check wheather we have admin data or not
            if($count==1)
            {
                // get the details
               // echo "Admin Available";
               $row=mysqli_fetch_assoc($res);
               $full_name=$row['full_name'];
               $username=$row['username'];
            }
            else
            {
                //redirect to manage admin page 
                header('location:'.SITEURL.'admin/manage_admin.php');
            }

        }

        ?>
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>FULL NAME:</td>
                    <td>
                        <input type="text" name="full_name" value="<?php echo $full_name; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Username:</td>
                    <td>
                        <input type="text" name="username" value="<?php echo $username;?>">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden"name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="update" class=btn-secondary>

                    </td>
                </tr>
            </table>

        </form>
    </div>
</div>
<?php 
    // check wheather the submit button is clicked or not
    if(isset($_POST['submit']))
    {
        // echo"button clicked";
        // get all the values from form to update

         $id=$_POST['id'];
         $full_name=$_POST['full_name'];
         $username=$_POST['username'];

        // create a sql query to update the admin

        $sql="UPDATE tbl_admin SET
        full_name='$full_name',
        username='$username' 
        WHERE id='$id'
        ";
        // execute the query
        
        $res=mysqli_query($conn,$sql);
        // check wheather the query executed successfully or not

        if($res==true)
        {
            // query executed and admin updated
            $_SESSION['update']="<div class='success'>Admin updated successfully.</div>";
            header('location:'.SITEURL.'admin/manage_admin.php');
        }
        else{
            // failed to update admin
            $_SESSION['update']="<div class='error'>failed to  updated admin.</div>";
            // redirect to manage Admin page 
            header('location:'.SITEURL.'admin/manage_admin.php');

        }
        
    }

?>




<?php include('partials/footer.php'); ?>