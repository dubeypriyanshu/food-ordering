<?php include('menu.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1>
        <br><br>

        <?php 
            if(isset($_GET['id']))
            {
                $id=$_GET['id'];
            }
        ?>

        <form action="" method="POST">

        <table class="tbl-30">
            <tr>
                <td>Current Password: </td>
                <td>
                    <input type="password" name="current_password" placeholder="Current Password">
                </td>
            </tr>

            <tr>
                <td>New Password: </td>
                <td>
                    <input type="password" name="new_password" placeholder="New Password">
                </td>
            </tr>

            <tr>
                <td>Confirm Password: </td>
                <td>
                    <input type="password" name="confirm_password" placeholder="Confirm Password">
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

            //Check whether submit button is clicked or not
            if(isset($_POST['submit']))
            {
                    //echo "Clicked"


                    //Get the data from form
                    $id=$_POST['id'];
                    $current_password = $_POST['current_password'];
                    $new_password = $_POST['new_password'];
                    $confirm_password = $_POST['confirm_password'];


                    //Check whether the user with current ID and password exists or not
                    $sql = "SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";

                    //Execute the query
                    $res = mysqli_query($conn, $sql);

                    if($res==true)
                    {
                        //Checked whether data is available or not
                        $count=mysqli_num_rows($res);

                        if($count==1)
                        {
                            //user exists the password can be change
                            //echo "User Found";

                            //Check whether new and confirm password match or not
                            if($new_password==$confirm_password)
                            {
                                //Update the password
                                // echo "Password match";
                                $sql2 = "UPDATE tbl_admin SET
                                    password='$new_password'
                                    WHERE id=$id
                                    ";

                                    //Execute the query
                                    $res2 = mysqli_query($conn, $sql2);

                                    //Check whether rhe query executed or not
                                    if($res2==true)
                                    {
                                        //Display success message
                                        $_SESSION['change-pwd'] = "<div class='success'>Password change successfully </div>";

                                        //Redirect the user
                                        header('location: '.SITEURL.'admin/manage-admin.php');
                                    }
                                    else
                                    {
                                        //Display error message
                                        $_SESSION['change-pwd'] = "<div class='error'>Failed to change password </div>";

                                        //Redirect the user
                                        header('location: '.SITEURL.'admin/manage-admin.php');
                                    }
                            }
                            else
                            {
                                // Redirect to manage admin page with error message 
                                $_SESSION['pwd-not-match'] = "<div class='error'>Password did not match </div>";

                                //Redirect the user
                                header('location: '.SITEURL.'admin/manage-admin.php');

                            }
                        }
                        else
                        {
                            //user does not exist set message and redirect
                            $_SESSION['user-not-found'] = "<div class='error'>User not found </div>";

                            //Redirect the user
                            header('location: '.SITEURL.'admin/manage-admin.php');
                        }
                    }
            }

?>

<?php include('footer.php');?>