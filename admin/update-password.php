<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>change password</h1>
        <br><br>
        <?php
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        }
        ?>
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>current password:</td>
                    <td>
                        <input type="password" name="current_password" placeholder="current password">
                    </td>
                </tr>
                <tr>
                    <td>new password:</td>
                    <td>
                        <input type="password" name="new_password" placeholder="new password">
                    </td>
                </tr>
                <tr>
                    <td>Confirm password</td>
                    <td>
                        <input type="password" name="confirm_password" placeholder="confirm password">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">

                        <input type="submit" name="submit" value="change password" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

    </div>
</div>
<?php
// check wheather the submit button is clicked or not
if (isset($_POST['submit'])) {
    // echo"clicked";
    // 1.get the data from form

    $id = $_POST['id'];
    $current_password = md5($_POST['current_password']);
    $new_password = md5($_POST['new_password']);
    $confirm_password = md5($_POST['confirm_password']);

    // 2. check wheather the user with current id and current password exist or not 

    $sql= "SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";

    // execute the query

    $res = mysqli_query($conn, $sql);
    if ($res == true) {
        $count = mysqli_num_rows($res);
        if ($count == 1) {
            // user exists AND password can be change 
            // echo "User found";
            // check wheather the new password and confirm match or not 
            if ($new_password == $confirm_password) {
                // update the password
                //  echo "password match";
                $sql2="UPDATE tbl_admin SET
                password='$new_password'
                WHERE id=$id
                ";
                // execute the query
                $res2=mysqli_query($conn,$sql2);
                // check wheather the query executed or not 
                if($res2==true)
                {
                    // display success message 
                    $_SESSION['change-pwd'] = "<div class='success'>Password changed successfully.</div>";
                    header('location:'.SITEURL.'admin/manage_admin.php');
                }
                else
                {
                    //  display error message 
                    // redirect to manage main page with error message
                    $_SESSION['change-pwd'] = "<div class='success'>FAILED to change the password .</div>";
                    //  redirect the user  
                    header('location:'.SITEURL.'admin/manage_admin.php');
                }

            } 
            else 
            {
                //  display error message 
                // redirect to manage main page with error message
                $_SESSION['pwd-not-match'] = "<div class='error'>Password did not match.</div>";
                //  redirect the user 
                // redirect to manage main page with error message                header('location:' . SITEURL . 'admin/manage_admin.php');
                
            }
        }
        else {
            // user does not exists AND set message and Redirect 
            $_SESSION['user-not-found'] = "<div class='error'>user not found.</div>";
            // redirect the user 
            header('location:' . SITEURL . 'admin/manage_admin.php');
        }
    }
    // 3. check wheather the new password and confirm password match or not 
    // 4. change password if all above is true  
}
?>
<?php include('partials/footer.php'); ?>