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
    <section class="section">
        <div class="row">
            <!-- Add category  -->
          <div class="col-lg-4">

            <div class="card">
            <div class="card-body">
         
              <!-- Function to insert new categories START -->
             <?php $errors = array(); 
             
                
              if ($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['submit'])){

                if (preg_match('/^.{3,20}$/i', trim($_POST['cat_title']))) {	
                $category_title_data = escape($_POST['cat_title']);
              } else {
                $errors['cat_title'] = 'Please enter a valid name.';
              } 

                if (preg_match ('/^.{3,1000}$/i', trim($_POST['cat_desc']))) {	
                  $category_desc_data = escape($_POST['cat_desc']);
              } else {
                $errors['cat_desc'] = 'Please enter valid description.';
              } 
              
                if (preg_match ('/^.{3,200}$/i', trim($_POST['cat_slug']))) {	
                  $category_slug_data = escape($_POST['cat_slug']);
              } else {
                $errors['cat_slug'] = 'Please enter valid url.';
              } 
              
            

                if(empty($errors)){
                  $query = "INSERT INTO categories(category_title,category_description,category_slug) VALUES('{$category_title_data}','{$category_desc_data}','{$category_slug_data}')";
                
                  $insert_categories_query = mysqli_query($connection, $query);

                  confirmationQuery($insert_categories_query);
                  
                }


            }
             
             
             ?>
             
              <!-- Function to insert new categories END -->
              <h5 class="card-title">Add New Category</h5>
              <!-- Notification -->
                <?php if(isset($insert_categories_query )){echo "<p class='text-left text-success progress-bar-animated'> Category created succesfully</p> " ;} ?>
                <!-- Vertical Form -->

              <form action="" method="POST"  class="row g-3" >
              <div class="col-12">
                <label for="inputNanme4" class="form-label">Name</label>
                <input type="text" class="form-control" name="cat_title" >
                <?php if(array_key_exists('cat_title', $errors)){echo '<p class="text-danger text-left">'.$errors['cat_title'].'</p>';} ?>
              </div>
              <div class="col-12">
                <label for="inputEmail4" class="form-label">Description</label>
                <textarea name="cat_desc" class="form-control" cols="20" rows="10"  ></textarea>
                <?php if(array_key_exists('cat_desc', $errors)){echo '<p class="text-danger text-left">'.$errors['cat_desc'].'</p>';} ?>

              </div>
              <div class="col-12">
                <label for="inputPassword4" class="form-label">Slug</label>
                <input type="text" class="form-control" name="cat_slug" >
                <?php if(array_key_exists('cat_slug', $errors)){echo '<p class="text-danger text-left">'.$errors['cat_slug'].'</p>';} ?>

              </div> 

              <div class="text-left">
                <button type="submit" name="submit" class="btn btn-primary">ADD CATEGORY</button>
              </div>
              </form><!-- Vertical Form -->
          
            
            </div>
          </div>


            </div>
            <!-- view category -->
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Categories</h5>
                               <!-- Table with hoverable rows -->
                        <table class="table table-sm table-hover table-bordered ">
                            <thead >
                                <tr >
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Slug</th>
                                    <th scope="col">Count</th>
                                </tr>
                            </thead>
                            <tbody>
                        <?php finding_categories()?>
                           
                            </tbody>
                        </table>
                        <!-- End Table with hoverable rows -->

                    </div>
                </div>

        
            </div>

        </div>
    </section>

</main>


<?php
if (isset($_GET['delete'])) {
    $delete_cat_id = $_GET['delete'];

  
    $query = "DELETE FROM categories WHERE category_id = {$delete_cat_id} ";

    $delete_query = mysqli_query($connection, $query);
    header("Location:categories.php");

    confirmationQuery($delete_query);
}

?>




<?php include "includes/admin_footer.php" ?>