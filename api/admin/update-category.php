<?php include('menu.php')?>

    <div class="main-content">
        <div class="wrapper">
            <h1 class="headerClass">Update Category</h1>
            <br><br>

            <?php   
                //Check whether the id id set or not
                if(isset($_GET['id']))
                {
                    //Get the id and all other details
                    //echo "Getting the Data";
                    $id = $_GET['id'];

                    //Create SQL query to get all other data
                    $sql = "SELECT * FROM tbl_category WHERE id=$id";

                    //Execute the query
                    $res = mysqli_query($conn, $sql);

                    //count the row to check whether the id id valid or not
                    $count = mysqli_num_rows($res);

                    if($count==1)
                    {
                        //get all the data
                        $row = mysqli_fetch_assoc($res);
                        $title = $row['title'];
                        $current_image = $row['image_name'];
                        $featured = $row['featured'];
                        $active = $row['active'];
                    }
                    else
                    {
                        //redirect to manage category with session message
                        $_SESSION['no-category-found'] = "<div class='error'>Category Not Found</div>";
                        header('location:'.SITEURL.'admin/manage-category.php');
                    }
                }
                else
                {
                    //Redirect to manage category
                    header('location:'.SITEURL.'admin/manage-category.php');
                }
            
            
            
            ?>

           <form action="" class="form form-container" method="POST" enctype="multipart/form-data">

           <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" class="select"name="title" value="<?php echo $title;?>">
                    </td>
                </tr>

                <tr>
                    <td>Current Image: </td>
                    <td>
                        <?php
                            if($current_image != "")
                            {
                                //display the image
                                ?>
                                <img src="<?php echo SITEURL; ?>images/pic/<?php echo $current_image; ?>" width="150px" >
                                <?php 
                            }
                            else
                            {
                                echo "<div class='error'>Image Not Added</div>";
                            }
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>New Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input <?php if($featured=="Yes"){echo "Checked";}?> type="radio" name="featured" value="Yes"> Yes
                        <input <?php if($featured=="No"){echo "Checked";}?> type="radio" name="featured" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <input <?php if($active=="Yes"){echo "Checked";}?> type="radio" name="active" value="Yes"> Yes
                        <input <?php if($active=="No"){echo "Checked";}?> type="radio" name="active" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td>
                        <input type="hiddden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input id="update-food-button"  type="submit" name="submit" value="update-category" class="btn-secondary">
                    </td>
                </tr>
            </table>
           </form>

           <?php

                if(isset($_POST['submit']))
                {
                    //echo "Clicked";
                    //Get all the values from our form
                    $id = $_POST['id'];
                    $title = $_POST['title'];
                    $current_image = $_POST['current_image'];
                    $featured = $_POST['featured'];
                    $active = $_POST['active'];

                    //check whether the image is selected or not
                    if(isset($_FILES['image']['name']))
                    {
                        //get the image details
                        $image_name = $_FILES['image']['name'];

                        //check whether the image is available or not
                        if($image_name != "")
                        {
                            //Image available
                            //Upload the new image

                             //Auto rename our image
                    //Get the exension of our image (jpg, png, gif, etc)
                    $ext = end(explode('.', $image_name));

                    //Rename the Image
                    $image_name = "Food_category_".rand(000, 999).'.'.$ext;
                    

                    $source_path = $_FILES['image']['tmp_name'];

                    $destination_path = "../images/pic/".$image_name;

                    //Upload the image
                    $upload = move_uploaded_file($source_path, $destination_path);

                    if($upload==false)
                    {
                        $_SESSION['upload'] = "<div class='error>Failed to Upload Image</div>";
                        header('location:'.SITEURL.'admin/manage-category.php');
                        die();
                    }

                            //Remove the current image
                            if($current_image!="")
                            {
                                $remove_path = "../images/pic".$current_image;

                                $remove = unlink($remove_path);
                                if($remove==false)
                                {
                                    $_SESSION['failed-remove'] = "<div class='error'>Failed to Remove Current Image</div>";
                                    header('location:'.SITEURL.'admin/manage-category.php');
                                    die();
                                }
                            }
                           


                        }
                        else
                        {
                            $image_name = $current_image;
                        }
                    }
                    else
                    {
                        $image_name = $current_image;
                    }

                    //Update the database
                    $sql2 = "UPDATE tbl_category SET
                        title = '$title',
                        image_name = '$image_name',
                        featured = '$featured',
                        active = '$active'
                        WHERE id=$id
                        ";

                    //Execute the query
                    $res2 = mysqli_query($conn, $sql2); 

                    //check whether execute or not
                    if($res2==true)
                    {
                        //category update
                        $_SESSION['update'] = "<div class='success'>Category Updated Successfully</div>";
                        header('location:'.SITEURL.'admin/manage-category.php');
                    }
                    else
                    {
                        //Failed to update category
                        $_SESSION['update'] = "<div class='error'>Failed to Update Category</div>";
                        header('location:'.SITEURL.'admin/manage-category.php');
                    }
                }
           
           
           ?>
        </div>
    </div>



<?php include('footer.php')?>