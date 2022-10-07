<?php 

include "includes/admin_header.php";

?>

  <!-- ======= Header ======= -->
  <?php include "includes/admin_navigation.php"; ?>
  <!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <?php include "includes/admin_sidebar.php"; ?>

  <!-- End Sidebar-->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-8">
          <div class="row">

            <!-- Sales Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card sales-card">


                <div class="card-body">
                  <h5 class="card-title">Posts <span>| Today</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-cart"></i>
                    </div>
                    <div class="ps-3">
                      <?php 
                       $posts_count =  recordCount('posts');
                      ?>
                      <h6><?php  echo $posts_count ?></h6>
                      <span class="text-success small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">increase</span>

                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Sales Card -->

            <!-- Revenue Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card revenue-card">

  
                <div class="card-body">
                  <h5 class="card-title">Comments <span>| This Month</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-currency-dollar"></i>
                    </div>
                    <div class="ps-3">
                    <?php 
                       $comments_count = recordCount('comments');
                      ?>
                      <h6><?php  echo $comments_count  ?></h6>
                      <span class="text-success small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">increase</span>

                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Revenue Card -->

            <!-- Categories Card -->
            <div class="col-xxl-4 col-xl-12">

              <div class="card info-card customers-card">

      
                <div class="card-body">
                  <h5 class="card-title">Categories <span>| This Year</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-people"></i>
                    </div>
                    <div class="ps-3">
                    <?php 
                     $categories_count = recordCount('categories');
                    ?>
                      
                      <h6><?php  echo $categories_count ?></h6>
                      <span class="text-success small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">increase</span>

                    </div>
                  </div>

                </div>
              </div>

            </div><!--End Categories Card -->

 


            <!--Users Card -->
            <div class="col-xxl-4 col-xl-12">

                  <div class="card info-card customers-card">

                    <div class="card-body">
                      <h5 class="card-title">User <span>| This Year</span></h5>

                      <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                          <i class="bi bi-people"></i>
                        </div>
                        <div class="ps-3">
                        <?php 
                        $users_count = recordCount('users');
                        ?>
                          <h6><?php  echo $users_count ?></h6>
                          <span class="text-success small pt-1 fw-bold"><?php ceil( $users_count * 5/100 ) ?>%</span> <span class="text-muted small pt-2 ps-1">increase</span>

                        </div>
                      </div>

                    </div>
                  </div>

              </div>  <!--End Users Card -->



            <!--Post viewed Card -->
            <div class="col-xxl-4 col-xl-12">

                  <div class="card info-card customers-card">

                    <div class="card-body">
                      <h5 class="card-title">Post viewed <span>| This Year</span></h5>

                      <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                          <i class="bi bi-people"></i>
                        </div>
                        <div class="ps-3">
                        <?php 

                        $query_view = "SELECT * FROM posts WHERE post_views_count >= 1 ";
                        $select_postView_row_query = mysqli_query($connection, $query_view);

                        $postView_counts = mysqli_num_rows($select_postView_row_query);
                        confirmationQuery($postView_counts);

                        ?>
                          
                          <h6><?php  echo $postView_counts ?></h6>
                          <span class="text-success small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">increase</span>

                        </div>
                      </div>

                    </div>
                  </div>

              </div>  <!--End Post viewed Card -->
            <?php 
            
        

  
            $draft_posts_count = checkStatus('posts', 'post_status', 'draft');

           
            $published_posts_count = checkStatus('posts', 'post_status', 'published');
            ?>
            <!-- Reports -->
            <div class="col-12">
              <div class="card">

                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Filter</h6>
                    </li>

                    <li><a class="dropdown-item" href="#">Today</a></li>
                    <li><a class="dropdown-item" href="#">This Month</a></li>
                    <li><a class="dropdown-item" href="#">This Year</a></li>
                  </ul>
                </div>

                <div class="card-body">
                  <h5 class="card-title">CMS Analysis <span>/Today</span></h5>

                  <!-- Line Chart -->
                  <div id="reportsChart" style="width: 800px; height: 600px;"></div>
                  <!-- <div id="reportsChart"></div> -->

                  <!-- End Line Chart -->

                </div>

              </div>
            </div><!-- End Reports -->


          </div>
        </div><!-- End Left side columns -->

        <!-- Right side columns -->
        <div class="col-lg-4">

          <!-- News & Updates Traffic -->
          <div class="card">
            <div class="filter">
              <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
              <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                <li class="dropdown-header text-start">
                  <h6>Filter</h6>
                </li>

                <li><a class="dropdown-item" href="#">Today</a></li>
                <li><a class="dropdown-item" href="#">This Month</a></li>
                <li><a class="dropdown-item" href="#">This Year</a></li>
              </ul>
            </div>

            <div class="card-body pb-0">
            <h5 class="card-title">News &amp; Updates <span>| Today</span></h5>

              <?php
                             
                $query = "SELECT * FROM posts ORDER BY post_id DESC LIMIT 3, 5";

                $select_posts_query = mysqli_query($connection, $query);
        
                confirmationQuery($select_posts_query);

                while ($row = mysqli_fetch_assoc($select_posts_query)) {
                  $post_id = $row['post_id'];
                  $post_title = $row['post_title'];
                  $post_content = substr($row['post_content'],0,80);
                  $post_image  = $row['post_image'];
              ?>

              <div class="news">

                <div class="post-item clearfix">
                  <img src="../images/<?php echo $post_image ?>" alt="">
                  <h4><a href="../post.php?p_id=<?php echo $post_id ?>"><?php echo $post_title ?></a></h4>
                  <p><?php echo $post_content ?></p>
                </div>


              </div><!-- End sidebar recent posts-->
              <?php
                }
        ?>
            </div>
          </div><!-- End News & Updates -->

        </div><!-- End Right side columns -->

      </div>
    </section>

  </main><!-- End #main -->

 <?php include "includes/admin_footer.php" ?>