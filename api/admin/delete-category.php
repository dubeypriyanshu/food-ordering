<?php
    //include constants file
    include('constants.php');
    //echo "Delete page"
    //Check whether id and image_name value is set or not
    if(isset($_GET['id']) AND isset($_GET['image_name']))
    {
        //Get the value and delete
        //echo "Get value and delete";
        $id = $_GET['id'];
        $image_name = $_GET['images_name'];

        //Remove the physical file if available 
        if($image_name != "")
        {
            $path = "images/pic".$image_name;
            //Remove the image  
            $remove = unlink($path);   
            //if failed to remove image
            if($remove==false)
            {
                $_SESSION['remove'] = "<div class='error'>Failed to remove category image</div>";
                header('location:'.SITEURL.'admin/manage-category.php');
                die();

            }
        }
        //Delete data from database  
        //Sql query to delete data from database
        $sql = "DELETE FROM tbl_category WHERE id=$id";

        //Execute to manage category page with message
        $res = mysqli_query($conn, $sql);

        //check whether the data is deleted from databas or not
        if($res==true)
        {
            //Set seccess message and redirect
            $_SESSION['delete'] = "<div class='success'>Category Deleted Successfully</div>";
            header('location:'.SITEURL.'admin/manage-category.php');
        }
        else
        {
            //set fail message and redirect
            $_SESSION['delete'] = "<div class='error'>Failed to Deleted Successfully</div>";
            header('location:'.SITEURL.'admin/manage-category.php');

        }

    }
    else
    {
        //Redirect to manage Category page
        header('location: '.SITEURL.'admin/manage-category.php');
    }


?>