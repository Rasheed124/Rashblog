<header id="header" class="header fixed-top d-flex align-items-center">

<div class="d-flex align-items-center justify-content-between">
  <a href="../" class="logo d-flex align-items-center">
    <img src="assets/img/logo.png" alt="">
    <span class="d-none d-lg-block">RashBlog</span>
  </a>
  <i class="bi bi-list toggle-sidebar-btn"></i>
</div><!-- End Logo -->

<div class="search-bar">
  <form class="search-form d-flex align-items-center" method="POST" action="#">
    <input type="text" name="query" placeholder="Search" title="Enter search keyword">
    <button type="submit" title="Search"><i class="bi bi-search"></i></button>
  </form>
</div><!-- End Search Bar -->

<nav class="header-nav ms-auto">
  <ul class="d-flex align-items-center">

    <li class="nav-item d-block d-lg-none">
      <a class="nav-link nav-icon search-bar-toggle " href="#">
        <i class="bi bi-search"></i>
      </a>
    </li>
    <!-- End Search Icon-->

<?php
        $session = session_id();
        $time = time();
        $time_out_in_seconds = 60;
        $time_out = $time - $time_out_in_seconds;
    
        $query = "SELECT * FROM users_online WHERE session = '$session' ";
        $users_query = mysqli_query($connection, $query);
    
        $count = mysqli_num_rows($users_query);
    
        
           // This check if a new users just login
           if($count == NULL){
             // then insert a new session and time
             mysqli_query($connection, "INSERT INTO users_online(session, time) VALUES('$session', '$time')");
         }else{
    
             // If same users
                     // update the time //
             mysqli_query($connection, "UPDATE users_online SET time = '$time' WHERE session = '$session' ");
         }
         $users_online_query = mysqli_query($connection, "SELECT * FROM users_online WHERE time > '$time_out' ");

        $count_usersOnline = mysqli_num_rows($users_online_query);
?>
    <li class="nav-item dropdown" title="Users online">

      <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
        <i class="bi bi-bell"></i>
        <span class="badge bg-primary badge-number usersOnline" > <?php echo $count_usersOnline ?></span>
      </a>
      <!-- End Notification Icon -->

      <!-- <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
        <li class="dropdown-header">
          You have 4 new notifications
          <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
        </li>
        <li>
          <hr class="dropdown-divider">
        </li>

        <li class="notification-item">
          <i class="bi bi-exclamation-circle text-warning"></i>
          <div>
            <h4>Lorem Ipsum</h4>
            <p>Quae dolorem earum veritatis oditseno</p>
            <p>30 min. ago</p>
          </div>
        </li>

        <li>
          <hr class="dropdown-divider">
        </li>

 

      </ul> -->
      <!-- End Notification Dropdown Items -->

    </li><!-- End Notification Nav -->

    <li class="nav-item dropdown">

      <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
        <i class="bi bi-chat-left-text"></i>
        <span class="badge bg-success badge-number">3</span>
      </a><!-- End Messages Icon -->

      <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow messages">
        <li class="dropdown-header">
          You have 3 new messages
          <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
        </li>
        <li>
          <hr class="dropdown-divider">
        </li>

        <li class="message-item">
          <a href="#">
            <img src="assets/img/messages-1.jpg" alt="" class="rounded-circle">
            <div>
              <h4>Maria Hudson</h4>
              <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
              <p>4 hrs. ago</p>
            </div>
          </a>
        </li>
        <li>
          <hr class="dropdown-divider">
        </li>



        <li class="dropdown-footer">
          <a href="#">Show all messages</a>
        </li>

      </ul><!-- End Messages Dropdown Items -->

    </li><!-- End Messages Nav -->

    <li class="nav-item dropdown pe-3">
       <?php 

       if(isset($_SESSION['user_id'])){

        $the_session_id = $_SESSION['user_id'];

        $query_user = "SELECT * FROM users WHERE user_id = {$the_session_id}";

        $select_user_query = mysqli_query($connection, $query_user);
        confirmationQuery($select_user_query); 

        while($row = mysqli_fetch_assoc($select_user_query) ){

          $user_name_session = $row['user_name'];
          $user_image_session = $row['user_image'];
          $user_firstname_session = $row['user_firstname'];
          $user_role_session = $row['user_role'];
   
       
       
       ?>
      <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
        <img src="../images/<?php if(isset($user_image_session)){echo$user_image_session ;}?>" alt="Profile" class="rounded-circle">
        <span class="d-none d-md-block dropdown-toggle ps-2">
        <?php if(isset($user_firstname_session)){echo$user_firstname_session ;}?>
        
        </span>
      </a><!-- End Profile Iamge Icon -->

      <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
        <li class="dropdown-header">
          <h6><?php if(isset($user_name_session)){echo$user_name_session ;}?></h6>
          <span><?php if(isset($user_role_session)){echo strtoupper($user_role_session) ;}?></span>
        </li>
        <li>
          <hr class="dropdown-divider">
        </li>
  
        <li>
          <a class="dropdown-item d-flex align-items-center" href="profile.php">
            <i class="bi bi-person"></i>
            <span>My Profile</span>
          </a>
        </li>
        <li>
          <hr class="dropdown-divider">
        </li>

        <li>
          <a class="dropdown-item d-flex align-items-center" href="profile.php">
            <i class="bi bi-gear"></i>
            <span>Account Settings</span>
          </a>
        </li>
        <li>
          <hr class="dropdown-divider">
        </li>


        <li>
          <a class="dropdown-item d-flex align-items-center" href="../includes/logout.php">
            <i class="bi bi-box-arrow-right"></i>
            <span>Sign Out</span>
          </a>
        </li>

      </ul><!-- End Profile Dropdown Items -->

   <?php }
       }
       
       
       
       ?>
    </li><!-- End Profile Nav -->

  </ul>
</nav><!-- End Icons Navigation -->

</header>