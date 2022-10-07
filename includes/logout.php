<?php  ob_start(); ?>

<?php include "db.php" ?>
<?php session_start(); ?>
<?php
if(!isset($_SESSION['user_id'])){ 
	header("Location: .../");
	exit();
}
?>
<?php

         mysqli_query($connection,"UPDATE users SET cookies_session = '' WHERE user_id = '".$_SESSION['user_id']."' AND active = '1'") or die(db_conn_error);	
         session_destroy();
         setcookie("remember_me", "", time() - 31104000);		//I think i made the cookie session time to be a month
                
      
        header("Location: /cmspro");
         exit();


         ?>