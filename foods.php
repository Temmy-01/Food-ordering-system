<?php include('partials-frontend/menu-users.php'); ?>



   <!-- fOOD sEARCH Section Starts Here -->
  <section class="food-search text-center">
    <div class="container">
        
        <form action="<?php SITEURL; ?>foods-search.php" method="POST">
            <input type="search" name="search" placeholder="Search for Food.." required>
            <input type="submit" name="submit" value="Search" class="btn btn-primary">
        </form>

    </div>
  </section>
<!-- fOOD sEARCH Section Ends Here -->

  <!-- food section -->

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
          
            //Display food that are active
            $sql = "SELECT * FROM table_food WHERE active='Yes'";

            //execute the query
            $res = mysqli_query($conn, $sql);

            //Count Rows
            $count = mysqli_num_rows($res);

            //Check whether the foods are available or not
            if($count>0){
              //Foods Available
              while($row=mysqli_fetch_assoc($res)){
                //Get the Values
                $id = $row['id'];
                $title = $row['title'];
                $description = $row['description'];
                $price = $row['price'];
                $image_name = $row['image_name'];

                if($title=='Pizza'){
                  ?>

                    <div class="col-sm-6 col-lg-4 all pizza">
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
                                # <?php echo $price; ?>
                              </h6>
                              <a href="<?php echo SITEURL;  ?>order.php?food_id=<?php echo $id; ?>" style="backbround:#ffbe33; border-radius:45px; width:120px;"> 
                                Order Now 
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
                                # <?php echo $price; ?>
                              </h6>
                              <a href="<?php echo SITEURL;  ?>order.php?food_id=<?php echo $id; ?> " style="backbround:#ffbe33; border-radius:45px; width:120px;">Order Now 
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
                

                if($title=='French Fries'){
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
                                # <?php echo $price; ?>
                              </h6>
                              <a href="<?php echo SITEURL;  ?>order.php?food_id=<?php echo $id; ?>" style="backbround:#ffbe33; border-radius:45px; width:120px;">Order Now 
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
                                #<?php echo $price; ?>
                              </h6>
                              <a href="<?php echo SITEURL;  ?>order.php?food_id=<?php echo $id; ?>" style="backbround:#ffbe33; border-radius:45px; width:120px;"> 
                                Order Now 
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
              //food not available
              echo "<div class='error'>Food not Found.</div>";
            }
          
          
          ?>

          



          <!-- <div class="col-sm-6 col-lg-4 all burger">
            <div class="box">
              <div>
                <div class="img-box">
                  <img src="images/f2.png" alt="">
                </div>
                <div class="detail-box">
                  <h5>
                    Delicious Burger
                  </h5>
                  <p>
                    Veniam debitis quaerat officiis quasi cupiditate quo, quisquam velit, magnam voluptatem repellendus sed eaque
                  </p>
                  <div class="options">
                    <h6>
                      $15
                    </h6>
                    <a href="">
                      <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 456.029 456.029" style="enable-background:new 0 0 456.029 456.029;" xml:space="preserve">
                      </svg>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div> -->
          
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
