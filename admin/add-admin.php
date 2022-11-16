
<?php 

// var_dump($_POST);
    include('../config/constants.php');

    // process the value from form and save it in database
    // Check whether the submit button is clicked or not
    if(isset($_POST['submit'])) {

        //1.  Get data from our form
           $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
           $username = mysqli_real_escape_string($conn, $_POST['username']);
           $password = mysqli_real_escape_string($conn, md5($_POST['password']));  //Pasword encrypted with MD5 


        //2. SQL query to save the data into database
            $sql = "INSERT INTO table_admin (full_name, username, password)
                VALUES ('$full_name', '$username', '$password')";


        //  3. Executing Query and Saving data into Database  
           $res = mysqli_query($conn, $sql) or die(mysql_error()); 


        // 4. Check whether the (Query is Executed) data is inserted or not and display appropriate message
        if($res) {

        // Craete a Session Variable to Display Message
            $_SESSION['add'] = "Admin Added Successfully!";

            // Redirect Page to Manage Admin
            $route = SITEURL.'admin/manage-admin.php';
            header("Location: $route");

        } else {
            // Craete a Session Variable to Display Message
            $_SESSION['add'] = "Failed to add Admin";
            // Redirect Page to Add Admin
            $route = SITEURL.'admin/delete-admin.php';
            header("Location: $route");
        }
    
    }

        
    
?>
