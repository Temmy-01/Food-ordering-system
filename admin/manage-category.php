<style>
  <?php include "css/admin.css" ?>
</style>


<?php include('partials/menu.php') ?>

<div class="main-content">
    <div class="wrapper pl-5">
        <h1>Manage Category</h1>

        <br><br>
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

            if(isset($_SESSION['upload'])){
                // print_r(2);
                $message= $_SESSION['upload'];
                echo "<div class='alert alert-success'>
                    <strong> $message </strong>
                </div>";    
                // echo $_SESSION['upload']; //displayimg session message
                unset($_SESSION['upload']);  //removing session message
            }
            if(isset($_SESSION['remove'])){
                // print_r(2);
                $message= $_SESSION['remove'];
                echo "<div class='alert alert-success'>
                    <strong> $message </strong>
                </div>";    
                // echo $_SESSION['remove']; //displayimg session message
                unset($_SESSION['remove']);  //removing session message
            }
            if(isset($_SESSION['delete'])){
                // print_r(2);
                $message= $_SESSION['delete'];
                echo "<div class='alert alert-success'>
                    <strong> $message </strong>
                </div>";    
                // echo $_SESSION['delete']; //displayimg session message
                unset($_SESSION['delete']);  //removing session message
            }
            if(isset($_SESSION['no-category-found'])){
                // print_r(2);
                $message= $_SESSION['no-category-found'];
                echo "<div class='alert alert-error'>
                    <strong> $message </strong>
                </div>";    
                // echo $_SESSION['no-category-found']; //displayimg session message
                unset($_SESSION['no-category-found']);  //removing session message
            }
            if(isset($_SESSION['updated'])){
                // print_r(2);
                $message= $_SESSION['updated'];
                echo "<div class='alert alert-success'>
                    <strong> $message </strong>
                </div>";    
                // echo $_SESSION['updated']; //displayimg session message
                unset($_SESSION['updated']);  //removing session message
            }
            if(isset($_SESSION['upload'])){
                // print_r(2);
                $message= $_SESSION['upload'];
                echo "<div class='alert alert-success'>
                    <strong> $message </strong>
                </div>";    
                // echo $_SESSION['upload']; //displayimg session message
                unset($_SESSION['upload']);  //removing session message
            }
            if(isset($_SESSION['failed to remove'])){
                // print_r(2);
                $message= $_SESSION['failed to remove'];
                echo "<div class='alert alert-error'>
                    <strong> $message </strong>
                </div>";    
                // echo $_SESSION['failed to remove']; //displayimg session message
                unset($_SESSION['failed to remove']);  //removing session message
            }

        ?>

        <!-- Button to Add Admin -->
        <a href="<?php echo SITEURL; ?>admin/add-category.php" class="btn-primary">Add Category</a>
        
        <br/><br/><br/>

        <table class="tbl-full">
            <tr>
                <th>SN.</th>
                <th>Title</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>

            <?php
                //Query to Get Category from Database
                $sql = "SELECT * FROM table_category";

                //Execute Query
                $res = mysqli_query($conn, $sql);

                //Count Rows
                $count = mysqli_num_rows($res);
                $sn = 1;

                //Check  whether we have data in database or not
                if($count>0){
                    //we have data in database
                    //get the data and display
                    while($row=mysqli_fetch_assoc($res)){
                        $id = $row['id'];
                        $title = $row['title'];
                        $image_name = $row['image_name'];
                        $featured = $row['featured'];
                        $active = $row['active'];


                        ?>

                            <tr>
                                <td><?php echo $sn++; ?></td>
                                <td><?php echo $title; ?></td>
                                <td>
                                    <?php 
                                        //check whether image name is available or not
                                        if($image_name !=""){
                                            //Diplay the image
                                            ?>
                                                <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" width="100px">
                                            <?php

                                        }
                                        else{
                                            //Diplay the message
                                            echo "<div class='error'>Image not Added.</div>";
                                        }
                                    ?>
                                </td>
                                <td><?php echo $featured; ?></td>
                                <td><?php echo $active; ?></td>
                                <td>
                                    <a href="<?php echo SITEURL; ?>admin/update-category.php ?id=<?php echo $id; ?>" class="update"><i class="fa-solid fa-pen-to-square"></i></a>
                                    <a href="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="delete"><i class="fa-solid fa-trash"></i></a>
                                    
                                </td>
                            </tr>

                        <?php
                    }
                }
                else{
                    // not have data
                    // We will display the message inside table
                    ?>

                    <tr>
                        <td colspan="6"><div class="error">No Category Added.</div></td>
                    </tr>
                    <?php
                }
                
            
            ?>

        </table>
    </div>

</div>

<?php include('partials/footer.php') ?>

