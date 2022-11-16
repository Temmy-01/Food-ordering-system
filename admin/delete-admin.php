<?php
    //Include constants.php file here
    include('../config/constants.php');

    //1. get the id of admin to be deleted
    $id = $_GET['id'];

    //2. Crate SQL query to delete admin
    $sql = "DELETE FROM table_admin WHERE id=$id";

    //Execute the query
    $res = mysqli_query($conn, $sql);

    //check whether the query executed successfully or not

    if($res ==true){
        // echo SITEURL.'admin/manage-admin.php';
        //Query executed successfully and admin deleted
        // echo "Admin deleted";
        //Create session variable to display message
        $_SESSION['delete'] = "<div class='success'>Admin deleted successfully!</div>";
        //Redirect to manage admin page
        $route = SITEURL.'admin/manage-admin.php';
        header("Location: $route");
        // header("Location: http://localhost/feane/admin/manage-admin.php'");

    }
    else {
        echo 2;
        //Failed to delete Admin
        // echo "Failed to Delete Admin";
        $_SESSION['delete'] = "<div class='error'>Admin failed to delete. try again later. </div>";
        $route = SITEURL.'admin/add-admin.php';
        header("Location: $route");
        // header('location:'.SITEURL.'admin/manage-admin.php');
        // header("Location: http://localhost/feane/admin/add-admin.php'");





    }

    //3. Redirect to manage admin page with message (success/error)


?>