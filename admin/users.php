<?php 

include "includes/admin_header.php";



if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin'){
  
  header("Location: ./");
}
?>

  
  <!-- ======= Header ======= -->
  <?php include "includes/admin_navigation.php"; ?>
  <!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <?php include "includes/admin_sidebar.php"; ?>



<?php

if(isset($_GET['source'])){
    $source = $_GET['source'];
}else{
    $source = "";
 }

 
 switch($source){
     case "add_user":
       include "includes/add_user.php";
     break;
     case "edit_user":
       include "includes/edit_user.php";
     break;
 
     default:
        include "view_all_users.php";
     break;

 }



?>




  <?php include "includes/admin_footer.php" ?>