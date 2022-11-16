<?php include('partials-frontend/menu.php'); ?>
  
    <!-- slider section -->
    <section class="slider_section ">
      <div id="customCarousel1" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <div class="container ">
              <div class="row">
                <div class="col-md-7 col-lg-6 ">
                  <div class="detail-box">
                    <h1>
                      Fast Food Restaurant
                    </h1>
                    <p>
                      Doloremque, itaque aperiam facilis rerum, commodi, temporibus sapiente ad mollitia laborum quam quisquam esse error unde. Tempora ex doloremque, labore, sunt repellat dolore, iste magni quos nihil ducimus libero ipsam.
                    </p>
                    <div class="btn-box">
                      <a href="" class="btn1">
                        Order Now
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="carousel-item ">
            <div class="container ">
              <div class="row">
                <div class="col-md-7 col-lg-6 ">
                  <div class="detail-box">
                    <h1>
                      Fast Food Restaurant
                    </h1>
                    <p>
                      Doloremque, itaque aperiam facilis rerum, commodi, temporibus sapiente ad mollitia laborum quam quisquam esse error unde. Tempora ex doloremque, labore, sunt repellat dolore, iste magni quos nihil ducimus libero ipsam.
                    </p>
                    <div class="btn-box">
                      <a href="" class="btn1">
                        Order Now
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="carousel-item">
            <div class="container ">
              <div class="row">
                <div class="col-md-7 col-lg-6 ">
                  <div class="detail-box">
                    <h1>
                      Fast Food Restaurant
                    </h1>
                    <p>
                      Doloremque, itaque aperiam facilis rerum, commodi, temporibus sapiente ad mollitia laborum quam quisquam esse error unde. Tempora ex doloremque, labore, sunt repellat dolore, iste magni quos nihil ducimus libero ipsam.
                    </p>
                    <div class="btn-box">
                      <a href="" class="btn1">
                        Order Now
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="container">
          <ol class="carousel-indicators">
            <li data-target="#customCarousel1" data-slide-to="0" class="active"></li>
            <li data-target="#customCarousel1" data-slide-to="1"></li>
            <li data-target="#customCarousel1" data-slide-to="2"></li>
          </ol>
        </div>
          <style>
              .food-search2 input[type="search"]{
                width: 50%;
                padding: 1%;
                font-size: 1rem;
                border: none;
                border-radius: 5px;
            }
          </style>
        <section class="food-search2 text-center">
          <div class="" >
              
            <form action="<?php echo SITEURL; ?>foods-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

          </div>
        </section>
      </div>

    </section>
    <!-- end slider section -->
  </div>
  <?php 
    if(isset($_SESSION['order'])){
    // print_r(2);
    $message= $_SESSION['order'];
    echo "<div class='alert alert-success'>
        <strong> $message </strong>
    </div>";
    // echo $_SESSION['order']; //displayimg session message
    unset($_SESSION['order']);  //removing session message
  }

  
  ?>

  <!-- food section -->

  <section class=" categories_session food_section layout_padding-bottom">
    <div class="container">
      <div class="heading_container heading_center">
        <h2>
          Explore Foods
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

          //create sql query to display categories from database
          $sql = "SELECT * FROM table_category WHERE active='Yes' AND featured='Yes' LIMIT 3";

          // execute the query
          $res = mysqli_query($conn, $sql);

          // counting of rows to check whether the category is available or not
          $count = mysqli_num_rows($res);

          if($count>0){
            //categories available
            while($row=mysqli_fetch_assoc($res)){
              //Get the values like id, title, image_name
              $id = $row['id'];
              $title = $row['title'];
              $image_name = $row['image_name'];

              ?>
                <a href="<?php SITEURL; ?>category-foods.php?category_id=<?php echo $id; ?>">
                  <div class="col-sm-6 col-lg-4 all pizza">
                    <div class="box">
                      <div>
                        <?php 
                          
                          //Check whether image is available or not
                          if($image_name==""){
                            //Display mesage
                            echo "<div class='error'>Image not Available</div>";
                          }
                          else{
                            //Image is available
                            
                            ?>
                            
                              <div class="img-box">
                                <img src="<?php echo SITEURL;?>images/category/<?php echo $image_name; ?>" alt="">
                              </div>
                            <?php
                          }
                        
                        ?>
  
                        
                        <div class="detail-box">
                          <h5>
                            <?php echo $title; ?>
                          </h5>
                          <!-- <p>
                            Veniam debitis quaerat officiis quasi cupiditate quo, quisquam velit, magnam voluptatem repellendus sed eaque
                          </p> -->
                          <!-- <div class="options">
                            <h6>
                              $20
                            </h6>
                            <a href="">
                              <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 456.029 456.029" style="enable-background:new 0 0 456.029 456.029;" xml:space="preserve">
                              </svg>
                            </a>
                          </div> -->
                        </div>
                      </div>
                    </div>
                  </div>
               </a>

              <?php
            }
          }
          else{
            //categories not available
            echo "<div class='error'> Category not Added</div>";
          }


        ?>

          
          
        </div>
      </div>
      <div class="btn-box ">
        <a href="">
          View More
        </a>
      </div>
    </div>
  </section>

  <!-- end food section -->

  <!-- offer section -->

  <section class="offer_section layout_padding-bottom">
    <div class="offer_container">
      <div class="container ">
        <div class="heading_container heading_center">
          <h2>
            Food Menu
          </h2>
        </div>
        <div class="row">

          <?php 
          
            //Getting food from database that are active and featured
            $sql2 = "SELECT * FROM table_food WHERE active='Yes' AND featured='Yes' LIMIT 6";

            //Execute the query
            $res2 = mysqli_query($conn, $sql2);

            //Coun rows
            $count2 = mysqli_num_rows($res2);

            //Check whether food available or not
            if($count2>0){
              //Food available
              while($row=mysqli_fetch_assoc($res2)){
                //get all the values
                $id = $row['id'];
                $title = $row['title'];
                $price = $row['price'];
                $description = $row['description'];
                $image_name = $row['image_name'];

                ?>

                  <div class="col-md-6  ">
                    <div class="box ">
                      <div class="img-box">
                        <?php  

                          //Check whether image available or not
                          if($image_name==''){
                            //Image not Available
                            echo "<div class='error'>Image not available.</div>";

                          }
                          else{
                            //Image available
                            ?>
                              
                              <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" width="100px" alt="">

                            <?php
                          }
                        
                        
                        ?>
                      </div>
                      <div class="detail-box">
                        <h5>
                          <?php echo $title; ?>
                        </h5>
                        <h6>
                          <span> #<?php echo $price; ?></span>
                        </h6>
                        <p>
                          <?php echo $description; ?>
                        </p>
                        <a href="<?php echo SITEURL;  ?>order.php?food_id=<?php echo $id; ?>">
                          Order Now 
                          <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 456.029 456.029" style="enable-background:new 0 0 456.029 456.029;" xml:space="preserve">
                          </svg>
                        </a>
                      </div>
                    </div>
                  </div>

                <?php
              }
            }
            else{
              //Food not available
              echo "<div class='error'>Food not available.</div>";
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

  <!-- end offer section -->

  <!-- about section -->

  <section class="about_section layout_padding">
    <div class="container  ">

      <div class="row">
        <div class="col-md-6 ">
          <div class="img-box">
            <img src="images/about-img.png" alt="">
          </div>
        </div>
        <div class="col-md-6">
          <div class="detail-box">
            <div class="heading_container">
              <h2>
                We Are Feane
              </h2>
            </div>
            <p>
              There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration
              in some form, by injected humour, or randomised words which don't look even slightly believable. If you
              are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in
              the middle of text. All
            </p>
            <a href="">
              Read More
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- end about section -->

  <!-- book section -->
  <section class="book_section layout_padding">
    <div class="container">
      <div class="heading_container">
        <h2>
          Book A Table
        </h2>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="form_container">
            <form action="">
              <div>
                <input type="text" class="form-control" placeholder="Your Name" />
              </div>
              <div>
                <input type="text" class="form-control" placeholder="Phone Number" />
              </div>
              <div>
                <input type="email" class="form-control" placeholder="Your Email" />
              </div>
              <div>
                <select class="form-control nice-select wide">
                  <option value="" disabled selected>
                    How many persons?
                  </option>
                  <option value="">
                    2
                  </option>
                  <option value="">
                    3
                  </option>
                  <option value="">
                    4
                  </option>
                  <option value="">
                    5
                  </option>
                </select>
              </div>
              <div>
                <input type="date" class="form-control">
              </div>
              <div class="btn_box">
                <button>
                  Book Now
                </button>
              </div>
            </form>
          </div>
        </div>
        <div class="col-md-6">
          <div class="map_container ">
            <div id="googleMap"></div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- end book section -->

  <!-- client section -->

  <!-- <section class="client_section layout_padding-bottom">
    <div class="container">
      <div class="heading_container heading_center psudo_white_primary mb_45">
        <h2>
          What Says Our Customers
        </h2>
      </div>
      <div class="carousel-wrap row ">
        <div class="owl-carousel client_owl-carousel">
          <div class="item">
            <div class="box">
              <div class="detail-box">
                <p>
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam
                </p>
                <h6>
                  Moana Michell
                </h6>
                <p>
                  magna aliqua
                </p>
              </div>
              <div class="img-box">
                <img src="images/client1.jpg" alt="" class="box-img">
              </div>
            </div>
          </div>
          <div class="item">
            <div class="box">
              <div class="detail-box">
                <p>
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam
                </p>
                <h6>
                  Mike Hamell
                </h6>
                <p>
                  magna aliqua
                </p>
              </div>
              <div class="img-box">
                <img src="images/client2.jpg" alt="" class="box-img">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section> -->

  <!-- end client section -->

<?php include('partials-frontend/footer.php'); ?>