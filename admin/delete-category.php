<?php 
    include('../config/constants.php');

    //Check whether the id and the image_name value is set or not
    if(isset($_GET['id']) AND isset($_GET['image_name'])){

        //Get the value and Delete it
        // echo "Get Value and Delete";
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        //Remove the physical image file if available
        if($image_name !=""){

            //it means image is available. So remove it.
            $path = "../images/category/".$image_name;
            //Remove the image
            $remove = unlink($path);

            //if failed to remove image then add an error message and stop the process
            if($remove ==false){
                //set the session message
                $_SESSION['remove'] = "<div class='error'>Failed to remove category image.</div>";
                //redirect to manage category page
                header('location:'.SITEURL.'admin/manage-category.php');
                //stop the session
                die();

            }


        }

        //Delete data from Database
        //sql Query to delete from database 
        $sql = "DELETE FROM table_category WHERE id=$id";

        //Execute the query
        $res = mysqli_query($conn, $sql);

        //check whether the data is deleted from database or not
        if($res==true){
            //set success message and redirect
            $_SESSION['delete'] = "<div class='success'>Category deleted successfully.</div>";
            header('location:'.SITEURL.'admin/manage-category.php');

        }
        else{
            //set fail message and redirect
            $_SESSION['delete'] = "<div class='error'>Category failed to delete.</div>";
            header('location:'.SITEURL.'admin/manage-category.php');

        }

        // Redirect to manage category page
    }
    else{
        //Redirect to mmanage category page
        header('location:'.SITEURL.'admin/manage-category.php');
    }
?>