<?php 
ob_start();
include('partials/menu.php');
?>


<div class="main-content">
    <div class="wrapper pl-5">
        <h1>Update Category</h1>

        <br><br>

        <?php
        

            //Check whether the id is set or not
            if(isset($_GET['id'])){
                //Get the id and other details
                $id = $_GET['id'];

                //CReate sql query to get all other details
                $sql = "SELECT * FROM table_category WHERE id=$id";

                //Execute the query
                $res = mysqli_query($conn, $sql);

                //Count the rows to check whether the id is valid or not
                $count = mysqli_num_rows($res);
                
                if($count==1){
                    //get all the data
                    $row = mysqli_fetch_assoc($res);
                    $title = $row['title'];
                    $current_image = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];
                }
                else{
                    //Redirect to manage with session message
                    $_SESSION['no-category-found'] = "<div class='error'>Category not found.</div>";
                    //Redirect to Manage Admin page
                    header('location:'.SITEURL.'admin/manage-category.php');
                }
            }
            else{
                //redirect to manage Category
                header('location:'.SITEURL.'admin/manage-category.php');
            }
        
        ?>

       <form action="" method="POST" enctype="multipart/form-data">
       <table class="tbl-30">
            <tr>
                <td>Title: </td>
                <td>
                    <input type="text" name="title" value="<?php echo $title; ?>" >
                </td>
            </tr>

            <tr>
                <td> Current Image: </td>
                <td>
                    <!-- <input type="file" name="image"> -->
                    <?php 
                        if($current_image != ""){
                            //Display the image
                            ?>
                                <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image; ?>" width="150px" alt="">
                            <?php
                        }
                        else{
                            // Display message
                            echo "<div class='error'>Image not added.</div>";
                        }
                     ?>
                </td>
            </tr>

            <tr>
                <td> New Image: </td>
                <td>
                    <input type="file" name="image">
                </td>
            </tr>

            <tr>
                <td>Featured: </td>
                <td>
                    <input <?php if($featured=="Yes"){echo "checked";} ?> type="radio" name="featured" value="Yes"> YES

                    <input <?php if($featured=="No"){echo "checked";} ?> type="radio" name="featured" value="No"> NO
                </td>
            </tr>

            <tr>
                <td>Active: </td>
                <td>
                    <input <?php if($active=="Yes"){echo "checked";} ?> type="radio" name="active" value="Yes"> YES

                    <input <?php if($active=="No"){echo "checked";} ?> type="radio" name="active" value="No"> NO
                </td>
            </tr>

            <tr>
                <td colspan="2" >
                    <!-- Button to update Admin -->
                    <input type="hidden" name="current_image" value ="<?php echo $current_image; ?>">
                    <input type="hidden" name="id" value ="<?php echo $id; ?>">
                    <input type="submit" name="submit" value="Update Category" class="btn-secondary">
                </td>
                    
            </tr>
        </table>
       </form>

        <?php

            if(isset($_POST['submit'])){
                //1. Get all the values from our FORM

                $title = mysqli_real_escape_string($conn, $_POST['title']);
                $id = $_POST['id'];
                $current_image = mysqli_real_escape_string($conn, $_POST['current_image']);
                $featured = $_POST['featured'];
                $active = $_POST['active'];


                //2. Updating the new image if selected
                //check whether image is selected or not
                if(isset($_FILES['image']['name'])){
                    //get the image details
                    $image_name = $_FILES['image']['name'];

                    // check whetherthe image is available or not
                    if($image_name != ""){
                        //Image is available

                        //A. Upload the new image
                        //Auto rename our image
                        //Get the extension of our image(jpg, png, git, etc) e.g "food.jpg"
                        $ext = end(explode('.', $image_name));

                        //Rename the image
                        $image_name = "Food_Category_".rand(000,999).'.'.$ext;  // e.g. Food_Category_834.jpg
                        $source_path = $_FILES['image']['tmp_name'];

                        $destination_path = "../images/category/".$image_name;

                        //Upload the image
                        $upload = move_uploaded_file($source_path, $destination_path);

                        //check whether the iamge is uploaded or not
                        //And if the image is not uploaded the we will stop the process and redirect with error message
                        if($upload==false){
                            //SET message
                            $_SESSION['upload'] = "<div class='error'> Failed to upload image.</div>";
                            //redirect to add category page

                            header('location:'.SITEURL.'admin/manage-category.php');
                            //Stop the process
                            die();
                        }

                        //B. Remove the current image if available
                        if($cureent_image != ""){
                            $remove_path = "../images/category/".$current_image;

                            $remove = unlink($remove_path);
    
                            //check whether the image is remove or not
                            // if ailed to remove then display message and stop the process
                            if($remove==false){
                                //Failed to remove image
                                $_SESSION['failed to remove'] = "<div class='error'> Failed to remove current image.</div>";
                                header('location:'.SITEURL.'admin/manage-category.php');
                                die(); //stop the process
    
                            } 

                        }
                       

                    }
                    else{
                        $image_name = $current_image;

                    }
                }
                else{
                    $image_name = $current_image;
                }

                //3. Update the database
                $sql2 = "UPDATE table_category SET
                    title = '$title',
                    image_name = '$image_name',
                    featured = '$featured',
                    active = '$active'
                    WHERE id=$id
                ";
                //Execute the query
                $res2 = mysqli_query($conn, $sql2);


                //4. redirect the manage category with message
                //Check whether query executed or not
                if($res2==true){
                    //Category updated
                    $_SESSION['updated'] = "<div class='success'>Category updated successfully.</div>";
                    //Redirect to Manage Admin page
                    header('location:'.SITEURL.'admin/manage-category.php');
                }
                else{
                    //failed to execute
                    $_SESSION['updated'] = "<div class='error'>Failed to update category.</div>";
                    //Redirect to Manage Admin page
                    header('location:'.SITEURL.'admin/manage-category.php');
                }
                
            }
        ?>



        
    </div>

</div>


<?php include('partials/footer.php') ?>
