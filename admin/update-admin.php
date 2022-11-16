<?php include('partials/menu.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>
    </div>
    <br><br>

    <?php
        ob_start();
        //1. Get the ID of selected admin
        $id = $_GET['id'];

        //2. Create SQL query to get the dtails
        $sql = "SELECT * FROM table_admin WHERE id =$id";

        //Execute the Query
        $res = mysqli_query($conn, $sql);

        //check whether then query is executed or not
        if($res == true){
            //check whether the data is available or not
            $count = mysqli_num_rows($res);
            // echo $count;
            //check whether we have admin data or not
            if($count==true){
                //Get the dtails
                $row = mysqli_fetch_assoc($res);

                $full_name = $row['full_name'];
                $username = $row['username'];
                // $password = $row['password'];
            }
            else{
                //Redirect to manage admin page
                header('location:'.SITEURL.'admin/manage-admin.php');
            }
        }
    ?>
    <form action=""  method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full name:</td>
                    <td>
                        <input type="text" name="full_name" value="<?php echo $full_name; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Username:</td>
                    <td>
                        <input type="text" name="username" value="<?php echo $username; ?>">
                    </td>
                </tr>

                <!-- <tr>
                    <td>Password:</td>
                    <td>
                        <input type="password" name="password"  value="">
                    </td>
                </tr> -->

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                    </td>

                </tr>
            </table>

        </form>
</div>

<?php
    //check whether the submit button is clicked or not
    if(isset($_POST['submit'])){
        // echo "button clicked";
        //Get all the values from form to update
        $id =$_POST['id'];
        $full_name =mysqli_real_escape_string($conn, $_POST['full_name']);
        $username = mysqli_real_escape_string($conn, $_POST['username']);

        //Craete SQl query tom update Admin
        $sql = "UPDATE table_admin SET
        full_name = '$full_name',
        username = '$username'
        WHERE id ='$id'
        ";

        //Execute the query
        $res = mysqli_query($conn, $sql);

        //check whether the query executed successfully or not
        if($res==true){
            //Query Executed and Admin updated
           
        }
        else{
            //Failed to update admin
            $_SESSION['update'] = "<div class='error'>Failed to delete admin.</div>";
            //Redirect to Manage Admin page
            header('location:'.SITEURL.'admin/manage-admin.php');
            ob_end_flush();
        }

    }
?>


<?php include('partials/footer.php');?>
