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
         <?php
                   if(isset($_GET['edit'])){
                    
                    $the_edit_category_id = $_GET['edit'];
                  
                    $query = "SELECT * FROM categories WHERE category_id = $the_edit_category_id";
                    $select_category_query = mysqli_query($connection, $query);
 
                while($row = mysqli_fetch_assoc($select_category_query)){
                    $edit_category_title = $row['category_title'];
                    $edit_category_description = $row['category_description'];
                    $edit_category_slug = $row['category_slug'];
                    $edit_category_count = $row['category_count'];
                }
 
                ?>   
                 <h5 class="card-title">Edit Category</h5>
                 <!-- Notification -->
                 <?php if(isset($update_category_query)){echo "<p class='text-left text-success progress-bar-animated'> Category updated succesfully</p> " ;} ?>
                 <!-- Vertical Form -->
             
               <form action="" method="POST"  class="row g-3" >
               <div class="col-12">
                 <label for="inputNanme4" class="form-label">Name</label>
                 <input type="text" class="form-control" name="cat_title" value="<?php if(isset($edit_category_title)){ echo $edit_category_title;} ?>">
                 <?php // if(array_key_exists('cat_title', $errors)){echo '<p class="text-danger text-left">'.$errors['cat_title'].'</p>';} ?>
               </div>
               <div class="col-12">
                 <label for="inputEmail4" class="form-label">Description</label>
                 <textarea name="cat_desc" class="form-control" cols="20" rows="10"><?php if(isset($edit_category_description)){ echo $edit_category_description ;} ?></textarea>
                 <?php // if(array_key_exists('cat_desc', $errors)){echo '<p class="text-danger text-left">'.$errors['cat_desc'].'</p>';} ?>
             
               </div>
               <div class="col-12">
                 <label for="inputPassword4" class="form-label">Slug</label>
                 <input type="text" class="form-control" name="cat_slug" value="<?php if(isset($edit_category_slug)){ echo $edit_category_slug ;} ?>" >
                 <?php //if(array_key_exists('cat_slug', $errors)){echo '<p class="text-danger text-left">'.$errors['cat_slug'].'</p>';} ?>
             
               </div> 
             
               <div class="text-left">
                 <button type="submit" name="update_category" class="btn btn-primary">UPDATE CATEGORY</button>
               </div>
             </form><!-- Vertical Form -->
             <?php
                 
                 if(isset($_POST['update_category'])){

                     $the_category_title = $_POST['cat_title'];
                     $the_category_description = $_POST['cat_desc'];
                     $the_category_slug = $_POST['cat_slug'];


                     
                     $query = "UPDATE categories SET category_title = '{$the_category_title}', category_description = '{$the_category_description}', category_slug = '{$the_category_slug}'   WHERE category_id = $the_edit_category_id ";

                     $update_category_query = mysqli_query($connection, $query);

                    confirmationQuery($update_category_query);
                 }
                 
                 ?>
             <?php
               }
               ?>
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