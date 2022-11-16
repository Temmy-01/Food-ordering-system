<?php include('partials-frontend/menu-users.php'); ?>



  <!-- fOOD sEARCH Section Starts Here -->
<section class="food-search text-center">
    <div class="container">

      <?php  
        //get the search keyword
        $search = mysqli_real_escape_string($conn, $_POST['search']);
      ?>
          
      <h2>Foods on Your Search <a href="#" class="text-white"><?php echo $search; ?></a></h2>

    </div> 
</section>
    <!-- fOOD sEARCH Section Ends Here -->

    <section class="food_section layout_padding">
    <div class="container">
      <div class="heading_container heading_center">
        <h2>
          Our Menu
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
            
                

            //Sql query to get food based on search keyword
            //$search = burger'; Drop databse name;
            $sql = "SELECT * FROM table_food WHERE title LIKE '%$search%' OR description LIKE '%$search%' ";

            //Execute the query
            $res = mysqli_query($conn, $sql);

            //count rows
            $count = mysqli_num_rows($res);

            //Check whether food is available or not
            if($count>0){
                //Food available
                while($row=mysqli_fetch_assoc($res)){
                    //get the details
                    $id = $row['id'];
                    $title = $row['title'];
                    $price = $row['price'];
                    $description = $row['description'];
                    $image_name = $row['image_name'];

                    if($title=='Pizza'){
                        ?>
                          <div class="col-sm-6 col-lg-4 all pizza">
                              <div class="box">
                                  <div>
                                      
                                          
                                      <?php 
                                          //check whether image name is available or not
                                          if($image_name==""){
                                              // Image not available
                                              echo "<div class='error'>Image not Available</div>";

                                          }
                                          else{
                                              
                                              //Image Available
                                              ?>
                                                  <div class="img-box"> 
                                                      <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="">
                                                  </div>
                                              <?php
                                              
                                          }
                                      
                                      ?>

                                      
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
                                          <a href="<?php echo SITEURL;  ?>order.php?food_id=<?php echo $id; ?>" style="backbround:#ffbe33; border-radius:45px; width:120px;"> Order
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

                    if($title=='Burger'){
                      ?>
    
                        <div class="col-sm-6 col-lg-4 all burger">
                          <div class="box">
                            <div>
                              <div class="img-box">
    
                              <?php 
                              
                                if($image_name==''){
                                  //Image not Available
                                  echo "<div class='error'>Food not Found.</div>";                            
                                }
                                else{
                                  //Image Available
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
                                    <?php echo $price; ?>
                                  </h6>
                                  <a href="<?php echo SITEURL;  ?>order.php?food_id=<?php echo $id; ?>" style="backbround:#ffbe33; border-radius:45px; width:120px;"> Order
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

                    if($title=='Pasta'){
                      ?>
    
                        <div class="col-sm-6 col-lg-4 all pasta">
                              <div class="box">
                              <div>
                                  <div class="img-box">
      
                                  <?php 
                                  
                                  if($image_name==''){
                                      //Image not Available
                                      echo "<div class='error'>Food not Found.</div>";                            
                                  }
                                  else{
                                      //Image Available
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
                                      <?php echo $price; ?>
                                      </h6>
                                      <a href="<?php echo SITEURL;  ?>order.php?food_id=<?php echo $id; ?>" style="backbround:#ffbe33; border-radius:45px; width:120px;"> Order
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

                    if($title=='Frech Fries'){
                      ?>
    
                        <div class="col-sm-6 col-lg-4 all fries">
                          <div class="box">
                            <div>
                              <div class="img-box">
    
                              <?php 
                              
                                if($image_name==''){
                                  //Image not Available
                                  echo "<div class='error'>Food not Found.</div>";                            
                                }
                                else{
                                  //Image Available
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
                                    <?php echo $price; ?>
                                  </h6>
                                  <a href="<?php echo SITEURL;  ?>order.php?food_id=<?php echo $id; ?>" style="backbround:#ffbe33; border-radius:45px; width:120px;"> Order
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
            }
            else{
                // Food not available
                echo "<div class='error'>Food not found</div>";
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
