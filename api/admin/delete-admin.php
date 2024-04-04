<?php

    //Include constants.php file here
    include('constants.php');

    //Get the id of admin to be deleted
    $id = $_GET['id'];


    //Create SQL query to delete admin
    $sql = "DELETE FROM tbl_admin WHERE id=$id";

    //Execute the query
    $res = mysqli_query($conn, $sql);


    //Check whether the query executed successfully or not 
    if($res==true)
    {
        //Query executed Successfully and Anmin Deleted
        //echo "Admin Deleted";

        //Create session variable to display message
        $_SESSION['delete'] = "<div class='success'>Admin Deleted Successfully</div>";

        //Redirect to manage admin page
        header('location:'.SITEURL.'admin/manage-admin.php');
    }
    else
    {
        //Failed to Deleted Admin
        //echo "Failed to Delete Admin";
        $_SESSION['delete'] = "<div class='error'>Failed to delete admin. Try again later</div>";
        header('location:'.SITEURL.'admin/manage-admin.php');
    }

    //Redierect to manage admin page with message (Success/error)

?>