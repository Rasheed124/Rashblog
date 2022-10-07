
<header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

      <a href="/cmspro" class="logo d-flex align-items-center">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/img/logo.png" alt=""> -->
        <h1>RashBlog</h1>
      </a>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a href="/cmspro">Blog</a></li>
          <li class="dropdown"><a href="#"><span>Categories</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
            <ul>
              <?php
              
              $query = "SELECT * FROM categories";
              $select_categories_query = mysqli_query($connection, $query);

              confirmationQuery($select_categories_query);

              while($row =  mysqli_fetch_assoc($select_categories_query)){
                $category_id = $row['category_id'];
                $category_title = $row['category_title'];



              // $category_class = '';
              // $registration_class = '';
              
              // $pageName = basename($_SERVER['PHP_SELF']);

              // $registration = 'register.php';

              // if(isset($_GET['category']) && $_GET['category'] == $category_id){
              //   $category_class = 'active';
              // }elseif($pageName == $registration){

              //   $registration_class = 'active';
              // }

              echo "<li><a href='category.php?category=$category_id'>$category_title</a></li>";


              }
              
              
              ?>
          
            </ul>
          </li>
           
  
          <li><a class="nav-link" href="

              <?php 
              if(isLoggedIn('user_role')){
                echo "./admin/";   

              }else{
                echo "/cmspro";  

              }
          ?>
          ">Admin</a></li>
          <li><a class="" href="./register">Register</a></li>

          <?php if(isLoggedIn('user_role')): ?>
            <li><a class="" href="./includes/logout.php">Logout</a></li>

          <?php else: ?>
          <li><a class="" href="./login">Login</a></li>


          <?php endif; ?>
        
          <!-- <li><a href="#">Contact</a></li> -->
        </ul>
      </nav><!-- .navbar -->

      <div class="position-relative">
   

        <a href="#" class="mx-2 js-search-open"><span class="bi-search"></span></a>
        <i class="bi bi-list mobile-nav-toggle"></i>

        <!-- ======= Search Form ======= -->
        <div class="search-form-wrap js-search-form-wrap">
          <form action="search-result.html" class="search-form">
            <span class="icon bi-search"></span>
            <input type="text" placeholder="Search" class="form-control">
            <button class="btn js-search-close"><span class="bi-x"></span></button>
          </form>
        </div><!-- End Search Form -->

      </div>

    </div>

  </header>