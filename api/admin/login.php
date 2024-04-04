<?php include('constants.php')?>


<html>
    <head>
        <title>Login Food order system</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>

    <body>
        

    <div class="login">
        <h1>Login</h1>
        

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

        <form action="" method="POST" class="text-center">
            <div class="login_form">
                <label for="username">Username</label>
                <input type="text" name="username" placeholder="Enter Username">
                
            </div>


            <div class="login_form">
                <label for="username">Password</label>
                <input type="password" name="password" placeholder="Enter Password">                
            </div>


            <input type="submit" name="submit" value="Login" class="btn-primary">
        </form>
    </div>
    </body>
</html>

<?php

    //Check whether the submit button is clicked or not
    if(isset($_POST['submit']))
    {
        //Process for Login
        //Get the data from login form
        $username = $_POST['username'];
        $password = $_POST['password'];

        //SQL to check whether the user with username and password exists or not
        $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";

        //Execute the query
        $res = mysqli_query($conn, $sql);

        //Count rows to check wherther the user exists or not
        $count = mysqli_num_rows($res);

        if($count==1)
        {
            //User Available and Login success
            $_SESSION['login'] = "<div class='success'>Login Successful</div>";
            $_SESSION['user'] = $username;

            //Redirect to home page
            header('location: '.SITEURL.'admin/');
        }
        else
        {
            //user not available and login fail
            $_SESSION['login'] = "<div class='error'>Username or Password did not match</div>";

            //Redirect to home page
            header('location: '.SITEURL.'admin/login.php');
        }
    }


?>