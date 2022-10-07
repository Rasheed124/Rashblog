






















 
 <?php include "./includes/header.php" ?>


 
<!-- ======= Header ======= -->
<?php include "./includes/navigation.php" ?>

<!-- End Header -->

<main id="main">


          <!-- ======= Hero Slider Section ======= -->
    <section id="hero-slider" class="hero-slider">
      <div class="container-md" data-aos="fade-in">


    <?php  
      //  Post Per PAge
            $per_page = 3;
                        
            if(isset($_GET['page'])){
                                
              $page = $_GET['page'];
              }else{

              $page = "";
              }

              if($page == "" || $page == 1){
                $page_1 = 0;

                }else{
                // this determines the number of post per page
                $page_1 = ($page * $per_page) - $per_page;
                }

          

                if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin'){

        //  if(is_admin($_SESSION['user_name'])){
                    
              // $query_1 = "SELECT * FROM posts ORDER BY post_id DESC  LIMIT $page_1, $per_page ";

              $stmt1 = mysqli_prepare($connection, "SELECT post_id, post_category_id, post_title ,post_author_user, post_content, post_image,	post_date, post_author_image, post_tag, post_status, post_comments_count, post_views_count FROM posts ORDER BY post_id DESC  LIMIT ?, ?");

              $checkpage = $page_1;
              $checkperPage = $per_page;


            }else{

              // $query_1  =  "SELECT * FROM posts  WHERE post_status = 'published' ORDER BY post_id DESC  LIMIT $page_1, $per_page ";


    
              $stmt2 = mysqli_prepare($connection, "SELECT post_id, post_category_id, post_title ,post_author_user, post_content, post_image,	post_date, post_author_image, post_tag, post_status, post_comments_count, post_views_count FROM posts  WHERE post_status = ? ORDER BY post_id DESC  LIMIT ?, ?");

              $published = 'published';
              
              $checkpage = $page_1;
              $checkperPage = $per_page;

            }


            if(isset($stmt1)){

              $stmt = $stmt1;
              

              mysqli_stmt_bind_param($stmt1, "ii" , $checkpage , $checkperPage);

              mysqli_stmt_execute($stmt1);

              mysqli_stmt_bind_result($stmt1, $post_id, $post_category_id, 	$post_title ,$post_author_user, $post_content, $post_image,	$post_date, $post_author_image, $post_tag, $post_status, $post_comments_count, $post_views_count);



            }else{

              $stmt = $stmt2;
              
              mysqli_stmt_bind_param($stmt2, "sii" , $published, $checkpage , $checkperPage);

              mysqli_stmt_execute($stmt2);

              mysqli_stmt_bind_result($stmt2, $post_id, $post_category_id, 	$post_title ,$post_author_user, $post_content, $post_image,	$post_date, $post_author_image, $post_tag, $post_status, $post_comments_count, $post_views_count);



            }





                  
            
                // $select_all_post1_query =  mysqli_query($connection, $query_1);

                // confirmationQuery($select_all_post1_query);

                    

            ?>
        <div class="row">
          <div class="col-12">
            <div class="swiper sliderFeaturedPosts">

              <div class="swiper-wrapper">

              <?php 



              //  while(mysqli_stmt_fetch($stmt)):
               while(mysqli_stmt_fetch($stmt)){

                // $post_id = $row['post_id'];
                // $post_title = $row['post_title'];
                // $post_image = $row['post_image'];
                // $post_date = $row['post_date'];
                // $post_content = substr($row['post_content'], 0, 1000);
                // $post_status  = $row['post_status'];
  
                ?>
                <div class="swiper-slide">
                <a href="post.php?p_id=<?php echo $post_id?>" class="img-bg d-flex align-items-end" style="background-image: url('./images/<?php echo $post_image?>');">
                  <div class="img-bg-inner">
                    <h2><?php echo $post_title?></h2>
                    <p><?php echo $post_content?></p>
                  </div>
                </a>
              </div>

            <?php  
            }
            // endwhile;
              
              
              ?>
              
              </div>
              <div class="custom-swiper-button-next">
                <span class="bi-chevron-right"></span>
              </div>
              <div class="custom-swiper-button-prev">
                <span class="bi-chevron-left"></span>
              </div>

              <div class="swiper-pagination"></div>
            </div>
          </div>
        </div>
      </div>
    <!-- </section> -->
    <!-- End Hero Slider Section -->



    <!-- ========================= Category Section -->
    <!-- <section> -->
      <div class="container mt-5">
        <div class="row">

          
          <div class="col-md-9" data-aos="fade-up">



            <?php


              if(mysqli_stmt_num_rows($stmt) < 1) {

               echo "<h1 class='text-center '> No Post available</h1> ";


              }else{

                $post_query_count = "SELECT * FROM posts ";

                $find_count = mysqli_query($connection,  $post_query_count);
      
                  $count = mysqli_num_rows($find_count);
    
                $count = ceil($count / $per_page);


                        
                // $select_all_post2_query =  mysqli_query($connection, $query_1);

                // confirmationQuery($select_all_post2_query);

                while(mysqli_stmt_fetch($stmt)):

            
            // $post_id = $row['post_id'];
            // $post_category_id = $row['post_category_id'];
            // $post_title = $row['post_title'];
            // $post_author_image = $row['post_author_image'];
            // $post_author_user = $row['post_author_user'];
            // $post_image = $row['post_image'];
            // $post_date = $row['post_date'];
            // $post_content = substr($row['post_content'], 0, 1000);
            // $post_status  = $row['post_status'];

            ?>
          <h3 class="category-title">  Category: 

            <?php

                $query = "SELECT * FROM categories WHERE category_id = {$post_category_id}";
                $select_post_category_query = mysqli_query($connection, $query);

                confirmationQuery($select_post_category_query);

                while ($row = mysqli_fetch_assoc($select_post_category_query)) {
                  $category_post_title = $row['category_title'];
                }
                    echo $category_post_title ;
                
                ?>
            </h3>
            <!-- Each Post Entry -->
            <div class="d-md-flex post-entry-2 half">
              <a href="post.php?p_id=<?php echo $post_id?>" class="me-4 thumbnail">
                <img src="./images/<?php echo $post_image?>" alt="" class="img-fluid">
              </a>
              <div>
                <div class="post-meta"><span class="date">
                <?php
                $query = "SELECT * FROM categories WHERE category_id = {$post_category_id}";
                $select_post_category_query = mysqli_query($connection, $query);

                confirmationQuery($select_post_category_query);

                while ($row = mysqli_fetch_assoc($select_post_category_query)) {
                  $category_post_title = $row['category_title'];
                }
                    echo $category_post_title ;
                
                ?>
                </span> <span class="mx-1">&bullet;</span> <span><?php echo $post_date?></span></div>
                <h3><a href="post.php?p_id=<?php echo $post_id?>"><?php echo $post_title?></a></h3>
                <p><?php echo $post_content?></p>
                <div class="d-flex align-items-center author">
                  <div class="photo"><img src="./images/<?php echo $post_author_image?>" alt="" class="img-fluid"></div>
                  <div class="name">
                    <h3 class="m-0 p-0"><?php echo $post_author_user?></h3>
                  </div>
                </div>
              </div>
            </div>

            <?php 
            endwhile; 
              
              
            ?>
            <!-- Pagination -->
            <div class="text-start py-4">
              <div class="custom-pagination">

              <?php
              
              if($page == 1 || $page > 1 ) {
               echo "<a href='index.php?page=".($page+1)."' class='prev'>NEXT</a>";   
             } 
              for($i = 1; $i <= $count ; $i++){

                if($i == $page){
                  echo "<a href='index.php?page={$i}' class='active'>{$i}</a>";
                }else{
                  echo "<a href='index.php?page={$i}'>{$i}</a>";
                }
                
              }
              if($page >= 2){
                echo "<a href='index.php?page=".($page-1)."' class='next'>Previous</a>";
              }
              


               ?>

              
              </div>
            </div>

   <?php

          }

          ?>

          </div>

          <div class="col-md-3">
            <!-- ======= Sidebar ======= -->
        
  <?php include "./includes/sidebar.php" ?>

          </div>

        </div>
      </div>
    </section>


</main><!-- End #main -->


<!-- ======= Footer ======= -->
<?php include "./includes/footer.php" ?>


