
<?php include "includes/db.php" ?>


<!-- ======= Header ======= -->
<?php include "includes/login_header.php" ?>

<?php

$login_array = array();


if(isset($_POST['login']) AND $_SERVER['REQUEST_METHOD']== "POST" ){

    if(preg_match('/^.{3,255}$/i',$_POST['username'])){
    $username =  mysqli_real_escape_string($connection,$_POST['username']);
  }else{
    $login_array['username_error'] = "Please enter a valid username ";
  }

  if(preg_match('/^.{6,100}$/i',$_POST['password'])){
    $password_lg =  mysqli_real_escape_string($connection, md5($_POST['password']));
  }else{
    $login_array['password_error'] = "You entered a wrong password ";
  }

   

    if(empty($login_array)){
      $query = "SELECT * FROM users WHERE user_name = '{$username}'  AND user_password = '{$password_lg}' AND active = '1'" ;

      $select_user_query = mysqli_query($connection, $query);
 
      if(!$select_user_query){
       die("QUERY FAILED" . mysqli_error($connection));
      }
 
      if(mysqli_num_rows($select_user_query) == 1){

       $row = mysqli_fetch_assoc($select_user_query);
       
       $value = md5(uniqid(rand(), true));

       $query_confirmation = "SELECT cookies_session FROM users WHERE user_name = '{$username}' AND active = '1' ";
        $query_confirm_sessions = mysqli_query ($connection, $query_confirmation );

        if(!$query_confirm_sessions){
          die("QUERY FAILED" . mysqli_error($connection));
         }
      $cookie_value_if_empty = mysqli_fetch_array($query_confirm_sessions);
      
    
    if (empty($cookie_value_if_empty[0])){

    mysqli_query($connection,"UPDATE users SET cookies_session = '{$value}' WHERE user_name= '{$username}' AND active = '1'") or die(db_conn_error);		

    setcookie("remember_me", $value, time() + 432000);	//session time out is 5 days
    
    }else if(!empty($cookie_value_if_empty[0])){
    
    setcookie("remember_me", $cookie_value_if_empty[0], time() + 432000);	
    }
    
       
      $_SESSION['user_id'] = $row['user_id'];
      $_SESSION['user_name'] = $row['user_name'];
      $_SESSION['user_role'] = $row['user_role'];
       
      header("Location: ./admin"); 
      exit;
      }else{ 
       $login_array['password_mismatch']= "Username and password do not match";}


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
                    <h5 class="card-title text-center pb-0 fs-4">Login to Your Account</h5>
                    <p class="text-center small">Enter your username & password to login</p>
                  </div>

                  <form class="row g-3 " method="POST" action="">
                  <?php if(array_key_exists('password_mismatch', $login_array)){echo '<div class="alert alert-danger">'.$login_array['password_mismatch'].'</div>';}?>

                  <div class="col-12">
                      <label for="yourUsername" class="form-label">Enter Username</label>
              
                        <input type="text" name="username" class="form-control" id="yourUsername" value="<?php echo isset($username)?$username:""?>" required>
                        <?php if(array_key_exists('username_error', $login_array)){echo '<p class="text-danger">'.$login_array['username_error'].'</p>';}?>
                      
                    </div>

                    <div class="col-12">
                      <label for="yourPassword" class="form-label">Enter Password</label>
                      <input type="password" name="password" class="form-control" id="yourPassword" required>
                      <?php if(array_key_exists('password_error', $login_array)){echo '<p class="text-danger">'.$login_array['password_error'].'</p>';}?>
                    </div>

                    <div class="col-12">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" value="true" id="rememberMe">
                        <label class="form-check-label" for="rememberMe">Remember me</label>
                      </div>
                    </div>
                    <div class="col-12">
                      <input class="btn btn-primary w-100" name="login" type="submit"></input>
                    </div>
                    <div class="col-12">

                    
                      <p class="small mb-0">Don't have account? <a href="./register">Create an account</a></p>
                    </div>
                    <div class="col-12">
                      <p class="small mb-0"><a href="./forgotPassword.php?forgot=<?php echo uniqid(true) ;?>">Forgot password ?</a></p>
                    </div>
                  </form>

                </div>
              </div>

              <div class="credits">
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
                Designed by <a href="https://bootstrapmade.com/">Rasheed</a>
              </div>

            </div>
          </div>
        </div>

      </section>

    </div>
  </main><!-- End #main -->

<!-- ======= Footer ======= -->

  <?php include "includes/login_footer.php" ?>
