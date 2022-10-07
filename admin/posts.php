<?php 

include "includes/admin_header.php";

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
     case "add_post":
       include "includes/add_post.php";
     break;
     case "edit_post":
       include "includes/edit_post.php";
     break;
 
     default:
        include "view_all_posts.php";
     break;

 }



?>




  <?php include "includes/admin_footer.php" ?>