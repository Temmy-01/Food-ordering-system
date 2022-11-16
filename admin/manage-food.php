<style>
  <?php include "css/admin.css" ?>
</style>



<?php include('partials/menu.php') ?>

<div class="main-content">
    <div class="wrapper pl-5">
        <h1>Manage Food</h1>

        <!-- Button to Add Admin -->
        <a href="<?php echo SITEURL; ?>admin/add-food.php" class="btn-primary">Add Food</a> 
        
        <br/><br/><br/>

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
                // print_r(2);
                $message= $_SESSION['delete'];
                echo "<div class='alert alert-error'>
                    <strong> $message </strong>
                </div>";    
                // echo $_SESSION['delete']; //displayimg session message
                unset($_SESSION['delete']);  //removing session message
            }
            if(isset($_SESSION['upload'])){
                // print_r(2);
                $message= $_SESSION['upload'];
                echo "<div class='alert alert-error'>
                    <strong> $message </strong>
                </div>";    
                // echo $_SESSION['upload']; //displayimg session message
                unset($_SESSION['upload']);  //removing session message
            }
            if(isset($_SESSION['unauthorize'])){
                // print_r(2);
                $message= $_SESSION['unauthorize'];
                echo "<div class='alert alert-error'>
                    <strong> $message </strong>
                </div>";    
                // echo $_SESSION['unauthorize']; //displayimg session message
                unset($_SESSION['unauthorize']);  //removing session message
            }
            if(isset($_SESSION['update'])){
                // print_r(2);
                $message= $_SESSION['update'];
                echo "<div class='alert alert-success'>
                    <strong> $message </strong>
                </div>";    
                // echo $_SESSION['update']; //displayimg session message
                unset($_SESSION['update']);  //removing session message
            }
        ?>

        <table class="tbl-full">
            <tr>
                <th>SN.</th>
                <th>Title</th>
                <th>Price</th>
                <th>Image</th>
                <th>Feature</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>

            <?php
                //Create a sql query to get all food
                $sql = "SELECT * FROM table_food";

                //Execute query
                $res = mysqli_query($conn, $sql);

                //count rows to check whether we have food or not
                $count =  mysqli_num_rows($res);

                //create serial number variable
                $sn = 1;
                if($count>0){
                    //we have food in databse
                    //get the foods from databse and display
                    while($row=mysqli_fetch_assoc($res)){
                        //get the value from individual columns
                        $id = $row['id'];
                        $title = $row['title'];
                        $price = $row['price'];
                        $image_name = $row['image_name'];
                        $featured = $row['featured'];
                        $active = $row['active'];

                        ?>

                            <tr>
                                <td><?php echo $sn++; ?></td>
                                <td><?php echo $title; ?></td>
                                <td><?php echo $price; ?></td>
                                <td>
                                    <?php 
                                        //Check whether we have image or not
                                        if($image_name==""){
                                            //We do not have image, Display error message
                                            echo "<div class='error'>Image not Added.</div>";
                                        }
                                        else{
                                            ?>
                                                <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" width="100px">
                                            <?php
                                        }
                                    
                                    ?>
                                </td>
                                <td><?php echo $featured; ?></td>
                                <td><?php echo $active; ?></td>
                                <td>
                                    <a href="<?php echo SITEURL; ?>admin/update-food.php?id=<?php echo $id; ?>" class="update"><i class="fa-solid fa-pen-to-square"></i></a>
                                    <a href="<?php echo SITEURL; ?>admin/delete-food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name;?>" class="delete"><i class="fa-solid fa-trash"></i></a>
                                       
                                </td>
                            </tr>


                        <?php
                    }
                }
                else{
                    //.food not added in database
                    
                    echo "<tr><td  colspan='7' class='error'>food not added yet</td></tr>";
                }
            ?>

        </table>
    </div>

</div>

<?php include('partials/footer.php') ?>

