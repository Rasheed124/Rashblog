

<?php include "./includes/header.php"; ?>
<!-- ======= Header ======= -->
<?php include "./includes/navigation.php"; ?>

<!-- End Header -->

  <main id="main">
    <section>
      <div class="container">
        <div class="row">

        <div class="col-md-9" data-aos="fade-up">

        <?php

if(isset($_GET['category'])){
     $the_category_id = $_GET['category'];
     

     if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin'){

      //  if(is_admin(isset($_SESSION['user_name']))){
                    
          $query = "SELECT * FROM posts WHERE  post_category_id = $the_category_id ORDER BY post_id DESC  ";

        }else{

          $query  =  "SELECT * FROM posts  WHERE  post_category_id = $the_category_id AND  post_status = 'published' ORDER BY post_id DESC ";

        }




  
     $select_all_posts_category = mysqli_query($connection, $query);

     if(mysqli_num_rows($select_all_posts_category) < 1){

         echo "
                    <h1 class='text-center'>No post available</h1>
              ";
     }else{
?>


<?php
              while($row = mysqli_fetch_assoc($select_all_posts_category)){

                  $post_id = $row['post_id'];
                  $post_category_id = $row['post_category_id'];
                  $post_title = $row['post_title'];
                  $post_image = $row['post_image'];
                  $post_author_image = $row['post_author_image'];
                  $post_author_user= $row['post_author_user'];
                  $post_date = $row['post_date'];
                  $post_content = substr($row['post_content'], 0, 1000);
                  $post_status  = $row['post_status'];


            ?>
              <div class="d-md-flex post-entry-2 half">
                <a href="/cmspro/post/<?php echo $post_id ?>" class="me-4 thumbnail">
                  <img src="/cmspro/images/<?php echo $post_image ?>" alt="" class="img-fluid">
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
                  </span> <span class="mx-1">&bullet;</span> <span><?php echo $post_date ?></span></div>
                  <h3><a href="/cmspro/post/<?php echo $post_id ?>"><?php echo $post_title ?></a></h3>
                  <p><?php echo $post_content ?></p>
                  <div class="d-flex align-items-center author">
                    <div class="photo"><img src="/cmspro/images/<?php echo $post_author_image ?>" alt="" class="img-fluid"></div>
                    <div class="name">
                      <h3 class="m-0 p-0"><?php echo $post_author_user ?></h3>
                    </div>
                  </div>
                </div>
              </div>
            <?php

            }
            ?>
        <?php
              }

          }else{
             header("Location: index.php");
          }?>
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
