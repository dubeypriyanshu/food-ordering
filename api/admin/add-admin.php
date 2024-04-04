<?php include('menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>

        <br><br>

        <?php
        if(isset($_SESSION['add']))  //checking whether session is set or not
        {
            echo $_SESSION['add'];  //Display the session message is set
            unset($_SESSION['add']);  //Remove session message
        } 
        ?>

        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>Full Name: </td>
                    <td>
                        <input type="text" name="full_name" placeholder="Enter Your Name">
                    </td>
                </tr>

                <tr>
                    <td>Username: </td>
                    <td>
                        <input type="text" name="username" placeholder="Your Username">
                    </td>
                </tr>

                <tr>
                    <td>Password: </td>
                    <td>
                        <input type="password" name="password" placeholder="Your Password">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-primary">
                    </td>
                </tr>
            </table>

        </form>
    </div>
</div>


<?php include('footer.php'); ?>

<?php
// process the value from form and save it in database

// check whether the submit button is clicked or not 

if(isset($_POST['submit']))
{
    // Button Clicked
    // echo "Button Clicked";
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $password = $_POST['password'];  //when we use MD5 password Encryption

    // SQL query to save the data into database 
    $sql = "INSERT INTO tbl_admin SET
        full_name='$full_name',
        username='$username',
        password='$password'
    ";


    //Executing Query and saving data into database 
    $res = mysqli_query($conn, $sql) or die(mysqli_error()); 


    //Check whether the (Query is Executing) data is inserted or not and display appropriate message
    if($res==TRUE)
    {
        //Data Inserted
        //echo "Data Inserted";
        //Create a session variable to Display Message
        $_SESSION['add'] = "Adin Added Successfully";
        //Redirect Page to manage admin
        header("location:".SITEURL.'admin/manage-admin.php');
    }
    else
    {
        //Failed to Insert Data
        //echo "Fail to Insert Data";
         //Create a session variable to Display Message
         $_SESSION['add'] = "Failed to Add Admin";
         //Redirect Page to Add admin
         header("location:".SITEURL.'admin/add-admin.php');
    }

}

?>