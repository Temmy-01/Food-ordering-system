<?php
    //include constants page
    include('../config/constants.php');
    
    if(isset($_GET['id']) AND isset($_GET['image_name'])){
        //process to delete
        
        //1. get ID and Image name
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];
        // print_r($id); die;

        //2. Remove the image if avaialble
        //check whether the image is available or not and delete only if available
        if($image_name != ""){
            //it has image and need to remove from folder
            //get the image path
            $path ="../images/food/".$image_name;

            //remove Image file from folder
            $remove = unlink($path);

            //Check whether image is successfully removed or not
            if($remove==false){
                //failed to remove image
                $_SESSION['upload'] = "<div class='error'>Failed to remove image file.</div>";
                header('location:'.SITEURL.'admin/manage-food.php');

                //stop the process of deleting food
                die();

            }
        }

        //3. Delete food from database
        $sql = "DELETE FROM table_food WHERE id=$id";

        //execute query
        $res = mysqli_query($conn, $sql);

        //Check whether the query executed or not and set the session message respectively
        //4. Redirect to manage food with session message
        if($res==true){
            // food deleted
            $_SESSION['delete'] = "<div class='success'>Food deleted successfully. </div>";
            header('location:'.SITEURL.'admin/manage-food.php');
        }
        else{
            $_SESSION['delete'] = "<div class='success'>Failed to delete food </div>";
            header('location:'.SITEURL.'admin/manage-food.php');
        }

        



    }
    else{
        // Redirect to manage-food
        $_SESSION['Unauthorize'] = "<div class='error'>Unauthorized access.</div>";
        header('location:'.SITEURL.'admin/manage-food.php');
    }

?>