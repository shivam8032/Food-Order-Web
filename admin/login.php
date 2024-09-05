<?php include('../config/constants.php'); ?>
<html>
    <head>
        <title>
            Login - Food order system
        </title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>
    <body>
        <div class="login">
            <h1 class="text-center">Login</h1>
            <br><br>

            <?php 
                if(isset($_SESSION['login']))
                {
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }
                if(isset($_SESSION['no-login-message']))
                {
                    echo $_SESSION['no-login-message'];
                    unset($_SESSION['no-login-message']);
                }
            ?>
            <br><br>
            <!-- login form starts here  -->
            <form action=""method="POST" class="text-center">
            username: <br>
            <input type="text"name="username"placeholder="Enter username"><br><br>
            password: <br>
            <input type="password"name="password"placeholder="Enter password"><br><br>
            <input type="submit"name="submit" value="Login"class="btn-primary">
            <br><br>
            </form>
             <!-- login form ends here  -->

            <p class="text-center">created By -<a href="www.vijaythapa.com">shivam choudhary</a></p>
        </div>
    </body>
</html>
<?php
    // check wheather the submit button is clicked or not 
    if (isset($_POST['submit']))
    {
        // process for login 
        // 1. get the data from login form 
        $username=$_POST['username'];
        $password=md5($_POST['password']);

        // 2.sql to check wheather the user with username and password exists or not  
        $sql="SELECT * FROM tbl_admin WHERE username='$username'AND password='$password'";
        // execte the query
        $res= mysqli_query($conn,$sql);
        // 4. count rows to check wheather the user exists or not 
        $count=mysqli_num_rows($res);
        if($count==1)
        {
            // user available 
            $_SESSION['login']="<div class='success'>Login successful.</div>";
            $_SESSION['user']=$username;// to check the user is logged in or not and logout will unset it


            // redirect to home page/dasboard 
            header('location:'.SITEURL.'admin/');
            
        }
        else
        {
            // user not  available and login fail 
            // user available 
            $_SESSION['login']="<div class='error text-center'>username or password did not match.</div>";
            // redirect to home page/dasboard 
            header('location:'.SITEURL.'admin/login.php');

        }

    }
?>