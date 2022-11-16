<?php include('partials-frontend/menu-users.php'); ?>

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
        
          //create sql query to display categories from database
          $sql = "SELECT * FROM table_category WHERE active='Yes'";

          // execute the query
          $res = mysqli_query($conn, $sql);

          // counting of rows to check whether the category is available or not
          $count = mysqli_num_rows($res);

          //Check whether categories available or not
          if($count>0){
            //Categories available
            while($row=mysqli_fetch_assoc($res))
            {
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
  
                          if($image_name==""){
                            //Image not available
                            echo "<div class='error'>Image not found.</div>";
  
                          }
                          else{
                            //Image available
                            ?>
                              <div class='img-box'>
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
            echo "<div class='error'>Category not found.</div>";
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

  