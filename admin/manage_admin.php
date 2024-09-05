<?php include('partials/menu.php'); ?>

<!--main content section starts -->
<div class="main-content">
    <div class="wrapper">
        <h1>Manage admin</h1>
        <br /><br />
        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add']; //displaying session message
            unset($_SESSION['add']); // removing session message
        }
        if (isset($_SESSION['delete'])) {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }

        if(isset($_SESSION['update']))
        {
            echo $_SESSION['update'];
            unset($_SESSION['update']);

        }
        if(isset($_SESSION['user-not-found'])) 
        {
            echo $_SESSION['user-not-found'];
            unset($_SESSION['user-not-found']);
        }
        if(isset($_SESSION['pwd-not-match'])) 
        {
            echo $_SESSION['pwd-not-match'];
            unset($_SESSION['pwd-not-match']);
        }
        if(isset($_SESSION['change-pwd'])) 
        {
            echo $_SESSION['change-pwd'];
            unset($_SESSION['change-pwd']);
        }

        ?>
        <br />
        <!--Button to Add Admin-->
        <a href="add-admin.php" class="btn-primary">Add Admin</a>
        <br /><br /><br />
        <table class="tbl-full">
            <tr>
                <th>S.N</th>
                <th>Full Name</th>
                <th>Username</th>
                <th>Action</th>

            </tr>
            <?php
            $sql = "SELECT *FROM TBL_admin";
            // execute the query
            $res = mysqli_query($conn, $sql);
            // check wheather the query is executed or not
            if ($res == TRUE) {
                // count row to check wheather we have data in database or not 
                $count = mysqli_num_rows($res);
                $sn = 1; // create the variable and assingned the value
                // check the num of rows

                if ($count > 0) {

                    // we  have data in database

                    while ($rows = mysqli_fetch_assoc($res)) {
                        // using while lopp to get all the data from database
                        // and while loop will execute as long as we have data in database
                        $id = $rows['id'];
                        $full_name = $rows['full_name'];
                        $username = $rows['username'];

                        // display the value in our table
            ?>
                        <tr>
                            <td><?php echo $sn++; ?></td>
                            <td><?php echo $full_name ?></td>
                            <td><?php echo $username ?></td>


                            <td>
                                 <a href="<?php echo SITEURL; ?>admin/update-password.php?id=<?php echo $id; ?>"class='btn-primary'>change password</a>
                                <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id; ?>" class="btn-secondary">update admin</a>
                                <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>" class="btn-danger">Delete Admin</a>
                            </td>
                        </tr>

            <?php
                    }
                } else {
                    // we do not have data in database
                }
            }

            ?>


        </table>

    </div>
</div>
<!--main content section Ends -->
<?php include('partials/footer.php'); ?>