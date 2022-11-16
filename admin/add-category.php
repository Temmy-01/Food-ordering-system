
<?php include('partials/menu.php');

ob_start();
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>

        <br><br>

        <!-- Add catgory form starts -->
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Category Title">
                    </td>
                </tr>

                <tr>
                    <td> Select Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes"> YES
                        <input type="radio" name="featured" value="No"> NO
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes"> YES
                        <input type="radio" name="active" value="No"> NO
                    </td>
                </tr>

                <tr>
                    <td colspan="2" >
                        <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                    </td>
                        
                </tr>
            </table>
        </form>
        <!-- Add catgory form ends -->

        <?php
            // ob_start();

            //Check whether the submit button is clicked or not
            if(isset($_POST['submit'])){

                //get the value from category form
                $title = mysqli_real_escape_string($conn, $_POST['title']); 

                //For radio input, we need to check whether the button is selected or not
                if(isset($_POST['featured'])) {
                    //Get the value from form
                    $featured = mysqli_real_escape_string($conn, $_POST['featured']);
                }
                else {
                    //Set the default value
                    $featured = "No";
                }
                if(isset($_POST['active'])){
                    $active = mysqli_real_escape_string($conn, $_POST['active']);
                }
                else {
                    //Set the default value
                    $active = "No";
                }

                //Check whether the image is selected or not and set the value for image
                // print_r($_FILES['image']); die();

                if(isset($_FILES['image']['name'])) {
                    //Upload the image
                    //To upload the image we need image name, source path and destination path
                    $image_name = $_FILES['image']['name'];

                    //Upload image only if image is selected
                    if($image_name !=""){

                   

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

                            header('location:'.SITEURL.'admin/add-category.php');
                            //Stop the process
                            die();


                        }
                    }

                }
                else{
                    //Don't upload the image and set the image_name as blank
                    $image_name="";
                }



                //2. Create SQL Query to insert Category into Database
                $sql = "INSERT INTO table_category SET
                    title =  '$title',
                    image_name =  '$image_name',
                    featured =  '$featured',
                    active =  '$active'
                    
                ";
                //3.  Execute the query and save in database
                $res = mysqli_query($conn, $sql);

                //4. Check whether the query executed or not and data added or not
                if($res==true){
                    //Query Executed and Category Added
                    $_SESSION['add'] = "<div class='success'> Category added successfully.</div>";
                    //Redirect to Manage Admin page
                    header('location:'.SITEURL.'admin/manage-category.php');
                }
                else{
                    //Failed to add category
                    $_SESSION['add'] = "<div class='error'> Failed to add Category.</div>";
                    //Redirect to Manage Admin page
                    header('location:'.SITEURL.'admin/add-category.php');

                    ob_end_flush();
                }
            }

        ?>

    </div>
</div>


<?php include('partials/footer.php') ?>
