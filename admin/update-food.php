<?php
    ob_start();
    include("partials/menu.php"); 
?>
<?php
    //check whether id is set or not
    if(isset($_GET['id'])){
        //Get all the details
        $id = $_GET['id'];

        //SQL query to get the selected food
        $sql2 = "SELECT * FROM table_food WHERE id=$id";
        // execeute the query
        $res2 = mysqli_query($conn, $sql2);

        //Get the value based on query executed
        $row2 = mysqli_fetch_assoc($res2);

        //Get the individual values of selected food
        $title = $row2['title'];
        $description = $row2['description'];
        $price = $row2['price'];
        $current_image = $row2['image_name'];
        $current_category = $row2['category_id'];
        $featured = $row2['featured'];
        $active = $row2['active'];
    }
    else{
        //Redirect to manage food
        header('location:'.SITEURL.'admin/mange-food.php');
    }



?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Food</h1>

        <br><br>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title; ?>">
                    </td>
                </tr>

                <tr>
                    <td> Description: </td>
                    <td>
                        <textarea name="description" cols="30" rows="5" value=""><?php echo $description; ?></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Price: </td>
                    <td>
                        <input type="number" name="price" value="<?php echo $price; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Current Image: </td>
                    <td>
                        <?php
                            if($current_image==""){
                                //Image not available
                                echo "<div class='error'>Image not available</div>";
                            }
                            else{
                                //Image available
                                ?>
                                    <img src="<?php echo SITEURL; ?>images/food/<?php echo $current_image; ?>" alt="<?php echo $title; ?>" width="100px">
                                <?php
                            }

                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Select New Image: </td>
                    <td>
                        <input type="file" name="image">
                        
                    </td>
                </tr>

                <tr>
                    <td>Category: </td>

                    <td>
                        <select name="category" id="">
                            <?php
                                //Query to get active category
                                $sql = "SELECT * FROM table_category WHERE active='Yes'";
                                // Execute query
                                $res = mysqli_query($conn, $sql);
                                //Count rows
                                $count = mysqli_num_rows($res);

                                //Check whether category available or not
                                if($count>0){
                                    //Category available
                                    while($row=mysqli_fetch_assoc($res)){
                                        $category_title = $row['title'];
                                        $category_id = $row['id'];

                                        // echo "<option value='$category_id'>$Category_title</option>";
                                        ?>
                                          <option <?php if($current_category==$category_id){echo "selected";} ?> value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>
                                        <?php    
                                        
                                    }
                                }
                                else{
                                    //Category not availble
                                    echo "<option value='0'>Category not available.</option>";
                                }

                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Featured: </td>
                    <td>
                        <input <?php if($featured=="Yes") {echo "checked";}?> type="radio" name="featured" value="Yes"> YES
                        <input <?php if($featured=="No") {echo "checked";}?> type="radio" name="featured" value="No"> NO
                    </td>
                </tr>

                <tr>
                    <td>value: </td>
                    <td>
                        <input <?php if($active=="Yes") {echo "checked";}?> type="radio" name="active" value="Yes"> YES
                        <input <?php if($active=="No") {echo "checked";}?> type="radio" name="active" value="No"> NO
                    </td>
                </tr>

                <tr>
                    <td colspan="2" >
                        <input type="hidden" name="id" value="<?php echo $id; ?>" >
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>" >

                        <input type="submit" name="submit" value="Update Food" class="btn-secondary">
                    </td>
                        
                </tr>
            </table>
        </form>

        <?php

            if(isset($_POST['submit'])){

                //1. Get all the details from the form
                $id = $_POST['id'];
                $title = mysqli_real_escape_string($conn, $_POST['title']);
                $description = mysqli_real_escape_string($conn, $_POST['description']);
                $price = mysqli_real_escape_string($conn, $_POST['price']);
                $current_image = mysqli_real_escape_string($conn, $_POST['current_image']);
                $category = mysqli_real_escape_string($conn, $_POST['category']);

                $featured = $_POST['featured'];
                $active = $_POST['active'];
                //2. upload the image if selected

                //check whether uploaded button is clicked or not
                if($_FILES['image']['name'] !=null){

                    //upload button clciked
                    $image_name = $_FILES['image']['name'];  //new Image Name
                    //check whether the file is available or not
                    if($image_name !=""){

                        //Image is avaialabe
                        //A. uploading new image

                        //rename the image
                        $ext = end(explode('.', $image_name)); //get the extension of thge image

                        $image_name = "Food-Name-".rand(0000, 9999).'.'.$ext; //this will be renamed image

                        //get the source path and destination path
                        $src_path = $_FILES['image']['tmp_name'];
                        $dest_path = "../images/food/".$image_name; //Destination path

                        // Uploadd the image
                        $upload = move_uploaded_file($src_path, $dest_path);

                        //check whether the image is uploaded or not
                        if($upload==false){
                            //failed to upload
                            $_SESSION['upoload'] = "<div class='error'>failed to upload new Image</div>";
                            header('location:'.SITEURL.'admin/manage-food.php');
                            //stop the process
                            die();
                        }

                        //3. remove the image if new image is uploaded and current image exists
                        //B. remove current image if available
                        if($current_image !=""){
                            //Current image is available
                            // remove the image
                            $remove_path = "../images/food/".$current_image;

                            $remove = unlink($remove_path);

                            //Check whether the image is removed or not
                            if($remove==false){
                                //failed to remove current image
                                $_SESSION['remove-failed'] = "<div class='error'>Failed to remove current image</div>";
                                header('location:'.SITEURL.'admin/manage-food.php');

                                //stop the process
                                die();


                            }
                        }
                    }
                    else{
                        $image_name = $current_image; //Default image when image is not selected
                    }
                }
                else{
                    $image_name = $current_image; //Default image when button is not clicked
                }

                

                //4. update the food in database
                $sql3 = "UPDATE table_food SET
                    title = '$title',
                    description = '$description',
                    price = $price,
                    image_name = '$image_name',
                    category_id = '$category',
                    featured = '$featured',
                    active = '$active'
                    WHERE id=$id
                ";

                //execute the sql query
                $res3 = mysqli_query($conn, $sql3);


                //Check whether the query is executed or not
                if($res3==true){
                    //query exceuted and food updated
                    $_SESSION['update'] = "<div class'success'>food updated successfully.</div>";
                    header('location:'.SITEURL.'admin/manage-food.php');
                    ob_end_flush();
                }
                else{
                    //failed to update food
                    $_SESSION['update'] = "<div class'error'>Failed to update food.</div>";
                    header('location:'.SITEURL.'admin/manage-food.php');
                }
            }
        
        ?>




    </div>
</div>


<?php include("partials/footer.php"); ?> 