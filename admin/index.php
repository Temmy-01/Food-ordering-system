<?php include('partials/menu.php') ?>

  <!-- Main conetnt section starts -->
  <div class="main-content">
    <h3>DASHBOARD</h3>
      <h6>
        <?php
          if(isset($_SESSION['login'])){
            $message =$_SESSION['login'];
            echo "<div class=''>
              <strong> $message</strong> 
            </div>";
            // echo $_SESSION['user-not-found']; //displayimg session message
            unset($_SESSION['login']);  //removing session message
          }
        ?>
      </h6>
    <div class="wrapper" style="margin-left:100px">
      
      <br><br>
      
      <div class="col-4 text-center">
          <?php 
            //SQl Query
            $sql = "SELECT * FROM table_category";
            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);

          
          ?>

        <h1><?php echo $count; ?></h1> <br>
        Categories
      </div>
      <div class="col-4 text-center">
        <?php 
          //SQl Query
          $sql2 = "SELECT * FROM table_food";
          $res2 = mysqli_query($conn, $sql2);
          $count2 = mysqli_num_rows($res2);

            
        ?>
        <h1><?php echo $count2; ?></h1> <br>
        Foods
      </div>
      <div class="col-4 text-center">
        <?php 
          //SQl Query
          $sql3 = "SELECT * FROM table_order";
          $res3 = mysqli_query($conn, $sql3);
          $count3 = mysqli_num_rows($res3);             
          ?>
        <h1><?php echo $count3; ?></h1> <br>
        Total Orders
      </div>
      <div class="col-4 text-center">
        <?php
          //Create sql query to get total revenue generated
          //Aggregate to get all 
          $sql4 = "SELECT SUM(total) AS Total FROM table_order WHERE status ='Delivered'";
          $res4 = mysqli_query($conn, $sql4);
          
          //Get the Value
          $row4 = mysqli_fetch_assoc($res4);

          //Get the Total Revenue
          $total_revenue = $row4['Total'];
        
        ?>
        <h1><?php echo $total_revenue; ?></h1> <br>
        Revenue Generated
      </div>
      <div class="clearfix"></div>
    </div>
  </div>

<?php include('partials/footer.php') ?>


  