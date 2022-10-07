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

     case "edit_comment.php":
       include "includes/edit_comment.php";
     break;
 
     default:
        include "view_all_comments.php";
     break;

 }



?>




  <?php include "includes/admin_footer.php" ?>