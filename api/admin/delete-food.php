<?php 
    include('constants.php');

    if(isset($_GET['id']) AND isset($_GET['image_name']))
    {
        //Process to Delete
        //Get id and image
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        //Remove the image if available
        if($image_name != "")
        {
            //Fet the image path
            $path = "../images/photo/".$image_name;

            //Remove image file from folder
            $remove = unlink($path);

            //check whether the image is removed or not
            if($remove==false)
            {
                //Failed to remove image
                $_SESSION['upload'] = "<div class='error'>Failed to Remove Image File</div>";

                //Redirect to manage food
                header('location:'.SITEURL.'admin/manage-food.php');
                die();
            }

        }

        //Delete food from database
        $sql = "DELETE FROM tbl_food WHERE id=$id";

        $res = mysqli_query($conn, $sql);

        //Redirect to manage food with session image
        if($res==true)
        {
            $_SESSION['delete'] = "<div class='success'>Food Deleted Successfully</div>";
            header('location:'.SITEURL.'admin/manage-food.php');
        }
        else
        {
            $_SESSION['delete'] = "<div class='error'>Failed to Delete Food</div>";
            hrader('location:'.SITEURL.'admin/manage-food.php');
        }

        
    }
    else
    {
        //Redirect to manage food page
        $_SESSION['unauthorize'] = "<div class='error'>Unauthorized Process</div>";
        header('location:'.SITEURL.'admin/manage-food.php');
    }

?>