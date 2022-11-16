<style>
  <?php include "css/admin.css" ?>
</style>


<?php include('partials/menu.php') ?>

<div class="main-content">
    <div class="wrapper pl-5">
        <h1>Manage Order</h1>

        
        <br/><br/><br/>

        <?php 
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
        <br><br>

        <table class="tbl-full">
            <tr>
                <th>SN.</th>
                <th>Food</th>
                <th>Price</th>
                <th>Qty</th>
                <th>Total</th>
                <th>Order Date</th>
                <th>Status</th>
                <th>Customer Name</th>
                <th>Contact</th>
                <th>Email</th>
                <th>Address</th>
                <th>Actions</th>
            </tr>

            <?php 
                //Get all the orders from database
                $sql = "SELECT * FROM table_order ORDER BY id DESC";
                $res = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($res);

                $sn =1;

                if($count>0){
                    //Order avilable
                    while($row=mysqli_fetch_assoc($res)){
                        //Get all the order details
                        $id = $row['id'];
                        $food = $row['food'];
                        $price = $row['price'];
                        $qty = $row['qty'];
                        $total = $row['total'];
                        $order_date = $row['order_date'];
                        $status = $row['status'];
                        $customer_name = $row['customer_name'];
                        $customer_contact = $row['customer_contact'];
                        $customer_email = $row['customer_email'];
                        $customer_address = $row['customer_address'];

                        ?>

                            <tr>
                                <td><?php echo $sn++; ?></td>
                                <td><?php echo $food; ?></td>
                                <td><?php echo $price; ?></td>
                                <td><?php echo $qty; ?></td>
                                <td><?php echo $total; ?></td>
                                <td><?php echo $order_date; ?></td>

                                <td>
                                    
                                    <?php 
                                        // Odered, On delivery, Delivered, Cancelled
                                        if($status=="Ordered") {
                                            echo "<label><b>$status</b></label>";
                                        }
                                        else if($status=="On Delivery"){
                                            echo "<label style='color:orange;'><b>$status</b></label>";

                                        }
                                        else if($status=="Delivered"){
                                            echo "<label style='color:green;'><b>$status</b></label>";
                                        }
                                        else if($status=="Cancelled"){
                                            echo "<label style='color:red;'><b>$status</b></label>";
                                        }
                                    ?>
                                </td>

                                <td><?php echo $customer_name; ?></td>
                                <td><?php echo $customer_contact; ?></td>
                                <td><?php echo $customer_email; ?></td>
                                <td><?php echo $customer_address; ?></td>
                                <td>
                                    <a href="<?php echo SITEURL; ?>admin/update-order.php?id=<?php echo $id; ?>" class="update"><i class="fa-solid fa-pen-to-square"></i></a>
                                    
                                </td>
                            </tr>
                        <?php
                    }
                }
                else{
                    //orders not available
                    echo "<tr><td colsspan='12' class='error'>Orders not Available</tr></td>";
                }
                
            ?>

            
        </table>
    </div>

</div>

<?php include('partials/footer.php') ?>

