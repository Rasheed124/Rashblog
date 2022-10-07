
<footer id="footer" class="footer">

<div class="footer-content">
  <div class="container">

    <div class="row g-5">
      <div class="col-lg-4">
        <h3 class="footer-heading">About RashBlog</h3>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Magnam ab, perspiciatis beatae autem deleniti voluptate nulla a dolores, exercitationem eveniet libero laudantium recusandae officiis qui aliquid blanditiis omnis quae. Explicabo?</p>
        <p><a href="about.html" class="footer-link-more">Learn More</a></p>
      </div>
      <div class="col-6 col-lg-2">
        <h3 class="footer-heading">Navigation</h3>
        <ul class="footer-links list-unstyled">
          <li><a href="index.html"><i class="bi bi-chevron-right"></i> Home</a></li>
          <li><a href="index.php" class="bi bi-chevron-right" >Blog</a></li>

  
          <li><a class="bi bi-chevron-right" href="

              <?php 
              if(!isset($_SESSION['user_id'] )){
                  echo "./index.php";   
              }else{
                echo "./admin/index.php";   
              }
          ?>
          ">Admin</a></li>
          <li><a href="./register.php" class="bi bi-chevron-right">Register</a></li>
          <!-- <li><a href="#">Contact</a></li> -->
        </ul>
      </div>
      <div class="col-6 col-lg-2">
        <h3 class="footer-heading">Categories</h3>
        <ul class="footer-links list-unstyled">
        
          <?php 
            $select_cats_query = mysqli_query($connection, "SELECT * FROM categories");
            confirmationQuery($select_cats_query);
            while($row = mysqli_fetch_assoc($select_cats_query)){
              $cat_id = $row['category_id'];
              $cat_title = $row['category_title'];
              echo "<li><a href='category.php?category={$cat_id}'><i class='bi bi-chevron-right'></i>$cat_title </a></li> ";
            }
          ?>

        </ul>
      </div>

      <div class="col-lg-4">
        <h3 class="footer-heading">Recent Posts</h3>

        <ul class="footer-links footer-blog-entry list-unstyled">
          <?php
                          $query  = "SELECT * FROM posts WHERE  post_status = 'published' ORDER BY post_id DESC LIMIT 3";
          
          // $query  = "SELECT * FROM posts ORDER BY post_id DESC LIMIT 3";

          $select_all_posts = mysqli_query($connection, $query);
       while($row = mysqli_fetch_assoc($select_all_posts)){

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
          <li>
            <a href="post.php?p_id=<?php echo $post_id ?>" class="d-flex align-items-center">
              <img src="images/<?php echo $post_image ?>" alt="" class="img-fluid me-3">
              <div>
                <div class="post-meta d-block"><span class="date">
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
                <span><?php echo $post_title ?></span>
              </div>
            </a>
          </li>
    <?php
      }
          ?>

        </ul>

      </div>
    </div>
  </div>
</div>

<div class="footer-legal">
  <div class="container">

    <div class="row justify-content-between">
      <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
        <div class="copyright">
          © Copyright <strong><span>RashBlog</span></strong>. All Rights Reserved
        </div>

        <div class="credits">
          <!-- All the links in the footer should remain intact. -->
          <!-- You can delete the links only if you purchased the pro version. -->
          <!-- Licensing information: https://bootstrapmade.com/license/ -->
          <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/herobiz-bootstrap-business-template/ -->
          Designed by <a href="">RasheedDev</a>
        </div>

      </div>

      <div class="col-md-6">
        <div class="social-links mb-3 mb-lg-0 text-center text-md-end">
          <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
          <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
          <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
          <a href="#" class="google-plus"><i class="bi bi-skype"></i></a>
          <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
        </div>

      </div>

    </div>

  </div>
</div>

</footer>

<a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="/cmspro/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="/cmspro/assets/vendor/swiper/swiper-bundle.min.js"></script>
<script src="/cmspro/assets/vendor/glightbox/js/glightbox.min.js"></script>
<script src="/cmspro/assets/vendor/aos/aos.js"></script>
<script src="/cmspro/assets/vendor/php-email-form/validate.js"></script>

<!-- Template Main JS File -->
<script src="/cmspro/assets/js/main.js"></script>

</body>

</html>