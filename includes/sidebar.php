
      <!-- ======= Sidebar ======= -->
      <div class="aside-block">

        <ul class="nav nav-pills custom-tab-nav mb-4" id="pills-tab" role="tablist">
          <li class="nav-item" role="presentation">
            <button class="nav-link active" id="pills-popular-tab" data-bs-toggle="pill" data-bs-target="#pills-popular" type="button" role="tab" aria-controls="pills-popular" aria-selected="true">Popular</button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link" id="pills-trending-tab" data-bs-toggle="pill" data-bs-target="#pills-trending" type="button" role="tab" aria-controls="pills-trending" aria-selected="false">Trending</button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link" id="pills-latest-tab" data-bs-toggle="pill" data-bs-target="#pills-latest" type="button" role="tab" aria-controls="pills-latest" aria-selected="false">Latest</button>
          </li>
        </ul>

        <div class="tab-content" id="pills-tabContent">

          <!-- Popular -->
          <div class="tab-pane fade show active" id="pills-popular" role="tabpanel" aria-labelledby="pills-popular-tab">
            <?php




         $query_2 =  "SELECT * FROM posts ORDER BY post_id DESC LIMIT 2";   

          //  $select_all_query = mysqli_query($connection, $query);
          $select_all_post2_query =  mysqli_query($connection, $query_2);

            // while (mysqli_fetch_assoc($select_all_query)){
           while($row = mysqli_fetch_assoc($select_all_post2_query)){


              $post_id = $row['post_id'];
              $post_category_id = $row['post_category_id'];
              $post_title = $row['post_title'];
              $post_author_user= $row['post_author_user'];
              $post_date = $row['post_date'];
              $post_content = substr($row['post_content'], 0, 1000);
              $post_status  = $row['post_status'];

            ?>
              <div class="post-entry-1 border-bottom">
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
                <h2 class="mb-2"><a href="/cmspro/post/<?php echo $post_id ?>"><?php echo $post_title ?></a></h2>
                <span class="author mb-3 d-block"><?php echo $post_author_user ?></span>
              </div>
            <?php
            }
            ?>

          </div> <!-- End Popular -->



        </div>
      </div>

      <div class="aside-block">
        <h3 class="aside-title">Video</h3>
        <div class="video-post">
          <a href="https://www.youtube.com/watch?v=AiFfDjmd0jU" class="glightbox link-video">
            <span class="bi-play-fill"></span>
            <img src="assets/img/post-landscape-5.jpg" alt="" class="img-fluid">
          </a>
        </div>
      </div><!-- End Video -->

      <div class="aside-block">
        <h3 class="aside-title">Categories</h3>

        <ul class="aside-links list-unstyled">

          <?php
          $select_cats_query = mysqli_query($connection, "SELECT * FROM categories");
          confirmationQuery($select_cats_query);
          while ($row = mysqli_fetch_assoc($select_cats_query)) {
            $cat_id = $row['category_id'];
            $cat_title = $row['category_title'];
            echo "<li><a href='/cmspro/category/{$cat_id}'><i class='bi bi-chevron-right'></i>$cat_title </a></li> ";
          }
          ?>


      </div><!-- End Categories -->

      <div class="aside-block">
        <h3 class="aside-title">Tags</h3>
        <ul class="aside-tags list-unstyled">
          <?php
           $select_post_tags_query = mysqli_query($connection, "SELECT * FROM posts");
           confirmationQuery($select_post_tags_query);
           while($row = mysqli_fetch_array($select_post_category_query)){
           echo "<li><a href='#'><i class='bi bi-chevron-right'></i>{$row['post_tag']} </a></li> ";
          echo "<li><a href='#'>$post_tags </a></li>";
           }
          ?>
        </ul>
      </div><!-- End Tags -->