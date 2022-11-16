<?php include('partials-frontend/menu-users.php'); ?>

<?php  
  //check whether id is passed or not
  if(isset($_GET['category_id'])){
    //category id is set and get the id
    $category_id = $_GET['category_id'];
    //Get catgeory title based on category id
    $sql = "SELECT title FROM table_category WHERE id=$category_id";
    $res = mysqli_query($conn, $sql);
    $count = mysqli_fetch_assoc($res);

    $category_title = $count['title'];

  }
  else{
    //if category not passed 
    //redirect
    header('location:'.SITEURL);
  }
?>
  <!-- food section -->
  <section class="food-search text-center">
    <div class="container">

   
        <h2>Foods on Your Search <a href="#" class="text-white">"<?php echo $category_title; ?>"</a></h2>

    </div> 
  </section>

  <section class="food_section layout_padding">
    <div class="container">
      <div class="heading_container heading_center">
        <h2>
          Food Menu
        </h2>


      </div>
      
      <ul class="filters_menu">
        <li class="active" data-filter="*">All</li>
        <li data-filter=".burger">Burger</li>
        <li data-filter=".pizza">Pizza</li>
        <li data-filter=".pasta">Pasta</li>
        <li data-filter=".fries">Fries</li>
      </ul>

      <div class="filters-content">
        <div class="row grid">
          <?php 
            //Create SQL Query to Get foods based on selected category
            $sql2 = "SELECT * FROM table_food WHERE category_id=$category_id";
            $res2 = mysqli_query($conn, $sql2);

            //counting of rows
            $count2 = mysqli_num_rows($res2);

            //check whether food is available or not
            if($count2>0){
              //food is available
              while($rows = mysqli_fetch_assoc($res2)){
                $id = $rows['id'];
                $title = $rows['title'];
                $price = $rows['price'];
                $description = $rows['description'];
                $image_name = $rows['image_name'];

                ?>

                  <div class="col-sm-6 col-lg-4 all pizza">
                    <div class="box">
                      <div>
                        <div class="img-box">
                            <?php 
                              if($image_name==''){
                                //image not available
                                echo "<div class='error'>Image not Available. </div>";


                              }
                              else{
                                //image available
                                ?>
                                  <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="">
                                <?php
                              }
                            ?>
                        </div>
                        <div class="detail-box">
                          <h5>
                            <?php echo $title; ?>
                          </h5>
                          <p>
                          <?php echo $description; ?>
                          </p>
                          <div class="options">
                            <h6>
                            # <?php echo $price; ?>
                            </h6>
                            <a href="<?php echo SITEURL;  ?>order.php?food_id=<?php echo $id; ?>" style="backbround:#ffbe33; border-radius:45px; width:120px;"> Order Now 
                              <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 456.029 456.029" style="enable-background:new 0 0 456.029 456.029;" xml:space="preserve">
                              </svg>
                            </a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                <?php
              }
            }
            else{
              //food not available
              echo "<div class='error'>Food not Available. </div>";
            }
          
          ?>
          
        </div>
      </div>
      <div class="btn-box">
        <a href="">
          View More
        </a>
      </div>
    </div>
  </section>

  <!-- end food section -->

<?php include('partials-frontend/footer.php'); ?>
 