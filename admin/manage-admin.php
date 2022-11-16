
<?php include_once('partials/menu.php') ?>


  <!-- Main conetnt section starts -->
  <div class="main-content">
    <div class="wrapper">
      <h1>Manage Admin</h1>
      <br/>

        <?php 
            if(isset($_SESSION['add'])){
                // print_r(2);
                $message= $_SESSION['add'];
                echo "<div class='alert alert-success'>
                  <strong> $message </strong>
                </div>";
                // echo $_SESSION['add']; //displayimg session message
                unset($_SESSION['add']);  //removing session message
            }

            if(isset($_SESSION['delete'])){
                $message= $_SESSION['delete'];
                echo "<div class='alert alert-danger'>
                    <strong> $message</strong> 
                </div>";
                // echo $_SESSION['delete']; //displayimg session message
                unset($_SESSION['delete']);  //removing session message
            }

            if(isset($_SESSION['update'])){
                $message= $_SESSION['update'];
                echo "<div class='alert alert-success'>
                    <strong> $message</strong> 
                </div>";
                // echo $_SESSION['update']; //displayimg session message
                unset($_SESSION['update']);  //removing session message
            }

            if(isset($_SESSION['user-not-found'])){
                $message= $_SESSION['user-not-found'];
                echo "<div class='alert alert-danger'>
                    <strong> $message</strong> 
                </div>";
                // echo $_SESSION['user-not-found']; //displayimg session message
                unset($_SESSION['user-not-found']);  //removing session message
            }

            if(isset($_SESSION['password-not-match'])){
                $message= $_SESSION['password-not-match'];
                echo "<div class='alert alert-danger'>
                    <strong> $message</strong> 
                </div>";
                // echo $_SESSION['user-not-found']; //displayimg session message
                unset($_SESSION['password-not-match']);  //removing session message
            }
            if(isset($_SESSION['change-password'])){
                $message= $_SESSION['change-password'];
                echo "<div class='alert alert-danger'>
                    <strong> $message</strong> 
                </div>";
                // echo $_SESSION['user-not-found']; //displayimg session message
                unset($_SESSION['change-password']);  //removing session message
            }
        ?>
        <br>
      <!-- Button to Add Admin -->
        <a href="admin-form.php" class="btn-primary">Add Admin</a> 
        
        <br/><br/>

        <table class="tbl-full" style="width: 100%">
            <tr>
                <th>SN.</th>
                <th>Full Name</th>
                <th>Username</th>
                <th>Actions</th>
            </tr>

            <?php
                // Query to get alll admin 
                $sql = "SELECT * FROM table_admin";
                //execute the query
                $res = mysqli_query($conn, $sql);

                // print($res);die;
                // check whether the query is executed or not
                if($res ==TRUE) {
                    //check rows to check whether we have data in database or not
                    $counts = mysqli_num_rows($res);  //function to get all the rows in database
                    $sn = 1;

                    //check the number of rows
                    if($counts > 0){

                        //we have data in database
                        while($rows = mysqli_fetch_assoc($res)){
                            //using while loop to get all the data from database
                            //and while loop run as long as we have data in database

                            //get individual data
                            $id = $rows['id'];
                            $full_name = $rows['full_name'];
                            $username = $rows['username'];

                            //display the value in our table
                            ?>
                                 <tr>
                                    <td><?php echo $sn++; ?></td>
                                    <td><?php echo $full_name; ?></td>
                                    <td><?php echo $username; ?></td>
                                    <td>
                                        <a href="<?php echo SITEURL; ?>admin/update-password.php?id=<?php echo $id; ?>" class="btn-primary">Change Password</a>
                                        <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id; ?>" class="btn-secondary">Update Admin</a>
                                        <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>" class="delete"><i class="fa-solid fa-trash"></i></a>
                                        
                                    </td>
                                </tr>
                            <?php

                        }
                    }
                    // else{

                    // }
                }
            ?>

        </table>
    </div>
  </div>

<?php include_once('partials/footer.php'); ?>
 