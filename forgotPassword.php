<?php include "includes/db.php" ?>

<!-- codingfacultyrasheed!@#2022   116419308 -->
<!-- ======= Header ======= -->
<?php include "includes/login_header.php" ?>
<?php include "admin/includes/functions.php" ?>


<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;



//Load Composer's autoloader
require './vendor/autoload.php';
require './classes/config.php';


?>

<?php

if(!ifItIsMethod('post') && !isset($_GET['forgot'])){

  redirect('/cmspro');
}





$forgot_array = array();

if(ifItIsMethod('post')){


  if(filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
    $email = mysqli_real_escape_string($connection,$_POST['email']);
  }else{
    $forgot_array['email_error'] = "Please enter a valid email address";
  }

  $length = 50;

  $token = bin2hex(openssl_random_pseudo_bytes($length));


  if(email_exists($email)){
    
    if($stmt = mysqli_prepare($connection, "UPDATE users SET token='{$token}' WHERE user_email= ?")){

      mysqli_stmt_bind_param($stmt, "s", $email);
      mysqli_stmt_execute($stmt);
      mysqli_stmt_close($stmt);

    

          /**
           *
           * configure PHPMailer
           *
           *
           */

          //Create an instance; passing `true` enables exceptions
          $mail = new PHPMailer(true);

          try {
              //Server settings
              $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
              $mail->isSMTP();                                            //Send using SMTP
              $mail->Host       =  Config::SMTP_HOST;                     //Set the SMTP server to send through
              $mail->Username   = Config::SMTP_USER;                     //SMTP username
              $mail->Password   = Config::SMTP_PASSWORD;                                //SMTP password
              $mail->Port       = Config::SMTP_PORT;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
              $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
              $mail->SMTPAuth   = true;                                   //Enable SMTP authentication



              //Recipients
             $mail->setFrom('toluatnewlife@gmail.com', 'Rasheed');
             $mail->addAddress($email);                                //Add a recipient

              //$mail->addAddress('ellen@example.com');               //Name is optional
            // $mail->addReplyTo('info@example.com', 'Information');
            // $mail->addCC('cc@example.com');
              //$mail->addBCC('bcc@example.com');

              //Attachments
              //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

              //Content

              $mail->isHTML(true);                                  //Set email format to HTML
              $mail->Subject = 'Here is the subject';
              $mail->Body    = 'This is the HTML message body <b>in bold!</b>';

              //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';


              if($mail->send()){

              echo 'Message has been sent';

              }else{
              echo 'Message has not been sent';

              }
              



              
          } catch (Exception $e) {
              echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
          }



  }
  else{

    mysqli_stmt_error($stmt);

  }


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

                  <div class="pt-4 pb-2 text-center">
                           <h3><i class="fa fa-lock fa-4x text-primary"></i></h3>
                          <h2 class="card-title text-center pb-0 fs-4">Forgot Password?</h2>
                          <p class="text-center small">You can reset your password here.</p>
                  </div>


                  <form class="row g-3 " id="register-form" role="form" autocomplete="off"  method="post">

                  <?php //if(array_key_exists('user_exits', $forgot_array)){echo '<div class="alert alert-danger">'.$forgot_array['user_exits'].'</div>';}?>

                  <div class="col-12">
                      <label for="yourUsername" class="form-label">Enter your email address</label>
                        <input type="email" name="email" class="form-control" id="yourUsername" value="<?php //echo isset($username)?$username:""?>" required>
                        <?php //if(array_key_exists('username_error', $login_array)){echo '<p class="text-danger">'.$login_array['username_error'].'</p>';}?>
                      
                    </div>

        
                    <div class="col-12">
                      <input class="btn btn-primary w-100" name="recover-submit"  type="submit" value="Reset Password">
                    </div>

                    <input type="hidden" class="hide" name="token" id="token" value="">

                    <div class="col-12">
                      <p class="small mb-0">Don't have account? <a href="./register">Create an account</a></p>
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
