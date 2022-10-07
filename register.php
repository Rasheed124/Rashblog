
<?php include "includes/db.php" ?>
<?php include "./admin/includes/functions.php" ?>
<?php
// if(isset($_SESSION['user_id'])){
// 	header("Location:.././");
// 	exit();
// }
?>
<!-- ======= Header ======= -->
<?php include "./includes/login_header.php" ?>


<?php


$register_array = array();
if(isset($_POST['register']) AND $_SERVER['REQUEST_METHOD']== "POST" ){

  if(preg_match('/^.{3,100}$/i',$_POST['first_name'])){
    $fname =  mysqli_real_escape_string($connection,$_POST['first_name']);
  }else{
    $register_array['first_name_error'] = "Please enter a valid name";
  }
  
  if(preg_match('/^.{3,100}$/i',$_POST['last_name'])){
    $lname =  mysqli_real_escape_string($connection,$_POST['last_name']);
  }else{
    $register_array['last_name_error'] = "Please enter a valid name";
  }
  

  if(filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
    $email = mysqli_real_escape_string($connection,$_POST['email']);
  }else{
    $register_array['email_error'] = "Please enter a valid email address";
  }

    if(preg_match('/^.{3,255}$/i',$_POST['username'])){
    $username =  mysqli_real_escape_string($connection,$_POST['username']);
  }else{
    $register_array['username_error'] = "Please enter a valid username ";
  }


  if(preg_match('/^.{6,100}$/i',$_POST['password'])){
    $password =  mysqli_real_escape_string($connection, md5($_POST['password']));
  }else{
    $register_array['password_error'] = "Please enter a password that is 6 characters and above";
  }




  if(usernname_exists($username)){

    $register_array['user_exits'] = "Ooops this user exists, try using another username";
    
  }

  if(empty($register_array)){
    $query = "INSERT INTO users(user_name, user_firstname, user_lastname, user_password, user_email, user_image, user_role) VALUES('{$username}', '{$fname}', '{$lname}', '{$password}',  '{$email}', 'default.jpg','subcriber')";

   
     $insert_users_query = mysqli_query($connection, $query);


     if(!isset($insert_users_query)){
        die("QUERY FAILED" . mysqli_error($connection) );
     }


     header("Location: ./login.php");
     
   }

}

?>
  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4">
                <a href="/cmspro" class="logo d-flex align-items-center w-auto">
                <img src="./admin/assets/img/logo.png" alt="">

                </a>
              </div><!-- End Logo -->

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Create an Account</h5>
                    <p class="text-center small">Enter your personal details to create account</p>
                    <?php if(array_key_exists('user_exits', $register_array)){echo '<p class="text-danger">'.$register_array['user_exits'].'</p>';}?>

                  </div>

                  <form class="row g-3 " method="POST" action="">

                    <div class="col-12">
                      <label for="yourName" class="form-label">First name</label>
                      <input type="text" name="first_name" class="form-control" id="yourName" autocomplete=on value="<?php echo isset($fname)?$fname:""?>" required>
                      <?php if(array_key_exists('first_name_error', $register_array)){echo '<p class="text-danger">'.$register_array['first_name_error'].'</p>';}?>
                      <!-- <div class="invalid-feedback">Please, enter your name!</div> -->
                    </div>

                    <div class="col-12">
                      <label for="yourName" class="form-label">Last name</label>
                      <input type="text" name="last_name" class="form-control" id="yourName" autocomplete=on value="<?php echo isset($lname)?$lname:""?>" required>
                      <?php if(array_key_exists('last_name_error', $register_array)){echo '<p class="text-danger">'.$register_array['last_name_error'].'</p>';}?>
                    </div>

                    <div class="col-12">
                      <label for="yourEmail" class="form-label">Email</label>
                      <input type="email" name="email" class="form-control" id="yourEmail" autocomplete=on value="<?php echo isset($email)?$email:""?>" required>
                      <?php if(array_key_exists('email_error', $register_array)){echo '<p class="text-danger">'.$register_array['email_error'].'</p>';}?>
                      
                      
                    </div>

                    <div class="col-12">
                      <label for="yourUsername" class="form-label">Username</label>
                        <input type="text" name="username" class="form-control" id="yourUsername" autocomplete=on value="<?php echo isset($username)?$username:""?>" required> 
                        <?php if(array_key_exists('username_error', $register_array)){echo '<p class="text-danger">'.$register_array['username_error'].'</p>';}
                         //if(array_key_exists('user_exits', $register_array)){echo '<p class="text-danger">'.$register_array['user_exits'].'</p>';}?>
                    </div>

                    <div class="col-12">
                      <label for="yourPassword" class="form-label">Password</label>
                      <input type="password" name="password" class="form-control" id="yourPassword" required>
                      <?php if(array_key_exists('password_error', $register_array)){echo '<p class="text-danger">'.$register_array['password_error'].'</p>';}?>
                    </div>

                    <div class="col-12">
                      <div class="form-check">
                        <input class="form-check-input" name="terms" type="checkbox" autocomplete=on value="" id="acceptTerms" required>
                        <label class="form-check-label" for="acceptTerms">I agree and accept the <a href="#">terms and conditions</a></label>
                        <div class="invalid-feedback">You must agree before submitting.</div>
                      </div>
                    </div>
                    <div class="col-12">
                      <button class="btn btn-primary w-100" name="register" type="submit">Create Account</button>
                    </div>
                    <div class="col-12">
                      <p class="small mb-0">Already have an account? <a href="./login">Log in</a></p>
                    </div>
                  </form>

                </div>
              </div>

              <!-- <div class="credits"> -->
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
                <!-- Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a> -->
              <!-- </div> -->

            </div>
          </div>
        </div>

      </section>

    </div>
  </main><!-- End #main -->

<!-- ======= Footer ======= -->

<?php include "./includes/login_footer.php" ?>