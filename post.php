
 <?php include "./includes/header.php" ?>


 
<!-- ======= Header ======= -->
<?php include "./includes/navigation.php" ?>

<!-- End Header -->

  <main id="main">

    <section class="single-post-content">
      <div class="container">
        <div class="row">
      <?php       
        if (isset($_GET['p_id'])) {
                $the_post_id = $_GET['p_id'];

                if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin'){
                      
                  // if(is_admin(isset($_SESSION['user_name']))){


                   $query_post  = "SELECT * FROM posts WHERE post_id = {$the_post_id} ";


                }else{


                  $query_post  = "SELECT * FROM posts WHERE post_id = {$the_post_id} AND post_status = 'published'";


                  // ============= Update post views if 
                  $query  = "UPDATE posts SET post_views_count = post_views_count + 1 WHERE post_id = $the_post_id ";
                  $post_views_count_query  = mysqli_query($connection, $query);
                   
                  confirmationQuery($post_views_count_query);
                  


                }

            $select_all_posts = mysqli_query($connection, $query_post);

            if(mysqli_num_rows($select_all_posts) < 1){

              echo "<div class='col-md-9' data-aos='fade-up'>
                         <h3 class='text-center'>No post available</h3>
                   </div>";
          }else{

            
?>
          <div class="col-md-9 post-content" data-aos="fade-up">
              <?php  
              
            while ($row = mysqli_fetch_assoc($select_all_posts)) {

                $post_id = $row['post_id'];
                $post_category_id = $row['post_category_id'];
                $post_title = $row['post_title'];
                $post_image = $row['post_image'];
                $post_date = $row['post_date'];
                // $post_content = substr($row['post_content'], 0, 100);
                $post_content = $row['post_content'];
              
              ?>
            <!-- ======= Single Post Content ======= -->
            <div class="single-post">
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

              </span> <span class="mx-1">&bullet;</span> <span><?php echo $post_date ?></span></div>
              <h1 class="mb-5"><?php echo $post_title ?></h1>
              <p></p>

              <!-- <p><span class="firstcharacter">L</span>orem ipsum dolor sit, amet consectetur adipisicing elit.suscipit distinctio, numquam omnis </p> -->
          
              <figure class="my-4" >
                <img width="500" src="/cmspro/images/<?php echo $post_image ?>" alt="" class="img-fluid">
              </figure>
              <p><?php echo $post_content ?></p>
        
            </div><!-- End Single Post Content -->
            <?php
            }
            ?>
            <!-- ======= Comments ======= -->

            <div>
            <?php include "comments.php" ?>

            </div>
           
  
           <!-- ======= Comments ======= -->


          </div>

          <?php
     }

              }else{

          header("Location:index.php");
        }
              ?>
          <div class="col-md-3">
           
              <?php include "./includes/sidebar.php" ?>

          </div>
        </div>
      </div>
    </section>
  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <?php include "./includes/footer.php" ?>
