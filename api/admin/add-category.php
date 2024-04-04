<?php include('menu.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>

        <br><br>

        <?php

            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }

            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        ?>

        <!-- Add category form  -->
        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Category Title">
                    </td>
                </tr>


                <tr>
                    <td>Select Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes"> Yes
                        <input type="radio" name="featured" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes"> Yes
                        <input type="radio" name="active" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                    </td>
                </tr>
                </table>
        </form>



        <?php

            //Check whether the submit button is clicked or not
            if(isset($_POST['submit']))
            {
                //echo "Ckecked";

                $title = $_POST['title'];

                if(isset($_POST['featured']))
                {
                    $featured = $_POST['featured'];
                }
                else
                {
                    $featured = "No";
                }

                if(isset($_POST['active']))
                {
                    $active = $_POST['active'];
                }
                else
                {
                    $active = "No";
                }

                //check whether the image is selected or not
                //print_r($_FILES['image']);

                //die();
                if(isset($_FILES['image']['name']))
                {
                    //upload the image
                    $image_name = $_FILES['image']['name'];

                    if($image_name !="")
                    {

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
                        header('location:'.SITEURL.'admin/add-category.php');
                        die();
                    }
                
                    }
                }
                else
                {
                    //Dont uploade the image and set the image name value as blank
                    $image_name="";
                }

                //Creste SQL query to insert category into database
                $sql = "INSERT INTO tbl_category SET
                    title='$title',
                    image_name='$image_name',
                    featured='$featured',
                    active='$active'
                    ";

                    $res = mysqli_query($conn, $sql);

                    if($res==true)
                    {
                        $_SESSION['add'] = "<div class='success'>Categgory added successfully</div>";
                        header('location:'.SITEURL.'admin/manage-category.php');
                    }
                    else
                    {
                        $_SESSION['add'] = "<div class='error'>Failed to add categgory</div>";
                        header('location:'.SITEURL.'admin/add-category.php');
                    }
            }
               
        ?>
    </div>
</div>



<?php include('footer.php');?>