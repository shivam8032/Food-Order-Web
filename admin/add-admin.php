<?php include('partials/menu.php'); ?>

<div class="main content">
    <div class="wrapper">
        <h1>Add admin</h1>
        <br><br>
        <?php
        if(isset($_SESSION['add']))// checking wheather the session is set of not
        {
            echo$_SESSION['add'];// dsiplaying session message
            unset($_SESSION['add']);//removing session message
        }
        ?>
        <form action="" method="post">
            <table class="tbl-full">
                <tr>
                    <td>Full Name</td>
                    <td><input type="text" name="full_name" placeholder="Enter your name"></td>
                </tr>
                <tr>
                    <td>Username</td>
                    <td>
                        <input type="text" name="username" placeholder="Usernname">
                    </td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td>
                        <input type="password" name="password" placeholder="your password">
                    </td>

                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add admin" class="btn-secondary">

                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
<?php include('partials/footer.php'); ?>
<?php
// process the value from form and save it in database
// check whether the button is clicked or not 
if (isset($_POST['submit'])) {
    // button clicked
    // echo "button clicked";

    // 1. get the data from form
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $password = md5($_POST['password']); // password encrypt with md5 

    // 2.sql query to save the data into database
    $sql = "INSERT INTO TBL_admin SET
    full_name='$full_name',
    username='$username',
    password='$password'
    ";
    // 3. execute query and save data in database

    $res = mysqli_query($conn, $sql) or die(mysqli_error());
    // 4. check wheather the (query is executed) data is insertd or not and display appropriate message
    if ($res == TRUE) {
        // data inserted
        // echo data inserted;
        // create a session variable to display message
        $_SESSION['add']="Admin Added successfully";
        // redirect page to add admin
        header("location:".SITEURL.'admin/manage_admin.php');
    } else {

        // failed to inset  data
        // echo failed to insert data;
        // create a session variable to display message
        $_SESSION['add']="failed to Add Admin";
        // redirect page to add admin
        header("location:".SITEURL.'admin/add-admin.php');


    }
}

?>