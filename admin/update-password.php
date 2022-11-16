<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1>
    </div>
    <br><br>

    <?php
    ob_start();
    //get
    
    if(isset($_GET['$id'])){
        $id = $_GET['id'];
    }
        
    ?>
    <form action=""  method="POST">
            <table class="tbl-30">
                

                <tr>
                    <td>Current Password:</td>
                    <td>
                        <input type="password" name="current_password" placeholder="Current Password"  value="">
                    </td>
                </tr>
                <tr>
                    <td>New Password:</td>
                    <td>
                        <input type="password" name="new_password" placeholder="New Password"  value="">
                    </td>
                </tr>
                <tr>
                    <td>Confirm Password:</td>
                    <td>
                        <input type="password" name="confirm_password" placeholder="Confirm Password"  value="">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Change Password" class="btn-secondary">
                    </td>

                </tr>
            </table>

        </form>
</div>

<?php
    //check whether submit button is clicked or not
    if(isset($_POST['submit'])){
        //1. get data from frorm
        $id = $_GET['id'];
        $current_password = md5($_POST['current_password']);
        $new_password = md5($_POST['new_password']);
        $confirm_password = md5($_POST['confirm_password']);
        // echo $id;die;
        //2. check whether the user with current id and password exist or not
        $sql = "SELECT * FROM table_admin WHERE id = $id AND password = '$current_password'";

        //3.check whether the New Password and Confirm Password Match or not
        $res = mysqli_query($conn, $sql);

    if($res==true)
        //check whether data is available or not
        $count = mysqli_num_rows($res);
        if($count ==true){
            //user exist and password can be changed

            //Check whether the new password and confirm match or not
            if($new_password==$confirm_password){
                //Update the password
                $sql2 = "UPDATE table_admin SET 
                    password='$new_password'
                    WHERE id=$id
                ";

                //Execute the query
                $res2 = mysqli_query($conn, $sql2);

                //Check whether the query executed or not
                if($res2 ==true){
                    //Display success message
                    //redirect to Manage Admin Page with error Message
                    $_SESSION['change-password'] = "<div class='success'> Password changed successfully. <div/>";
                    header('location:'.SITEURL.'admin/manage-admin.php');

                }
                else{
                    //Display error message
                    //redirect to Manage Admin Page with error Message
                    $_SESSION['change-password'] = "<div class='error'> Failed to change Password.<div/>";
                    header('location:'.SITEURL.'admin/manage-admin.php');
                }
            }
            else{
                //redirect to Manage Admin Page with error Message
                $_SESSION['password-not-match'] = "<div class='error'> Password Not Match. <div/>";
                header('location:'.SITEURL.'admin/manage-admin.php');
            }


            // $_SESSION['user-found'] = "<div class='success'> User Found. <div/>";
            // header('location:'.SITEURL.'admin/manage-admin.php');

            
        }
        else{
            //user does not exist set manager and redirect
            $_SESSION['user-not-found'] = "<div class='error'> User Not Found. <div/>";
            header('location:'.SITEURL.'admin/manage-admin.php');
            ob_end_flush();

        }


        //4. Chnage Password if all above is true

    }
?>



<?php include('partials/footer.php'); ?>
