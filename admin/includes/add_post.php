<main id="main" class="main">
    <section class="section">
        <div class="row">
            <!-- Add category  -->
          <div class="col-lg-12">

            <div class="card">
            <div class="card-body">
         
              <!-- Function to insert new categories START -->
              <?php
             $errors = array(); 
             
                if ($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['submit'])){

     
          $post_category_id = $_POST['post_category'];

          if(preg_match('/^.{3,1000}$/i', trim($_POST['post_title']))){	
          $post_title_data = escape($_POST['post_title']);
          } else {
          $errors['post_title'] = "This field can't be empty .";
          } 


            $post_author_user = $_POST['post_author_user'];

          if(preg_match('/^.{3,1000}$/i', trim($_POST['post_content']))) {	
              $post_content_data = escape($_POST['post_content']);
          } else {
            $errors['post_content'] = "This field can't be empty .";
          } 

              $post_image = $_FILES['image']['name'];
              $post_image_temp = $_FILES['image']['tmp_name'];


            if(preg_match('/^.{3,1000}$/i', trim($_POST['post_tags']))){	
                $post_tag_data = escape($_POST['post_tags']);
            } else {
              $errors['post_tags'] = "This field can't be empty .";
            } 


              $post_author_image = $_FILES['image_author']['name'];
              $post_image_author_temp = $_FILES['image_author']['tmp_name'];

              $post_status_data = $_POST['post_status'];


              $post_date_data = date('d-m-y');

                  
                $post_comments_count = 3;
                $post_views_count  = 4;

          move_uploaded_file($post_image_temp, "../images/$post_image");

          move_uploaded_file($post_image_author_temp, "../images/$post_author_image");

          if(empty($errors)){ 
          $query = "INSERT INTO posts(post_category_id,post_title,post_author_user,post_content,post_image,post_date,post_author_image,post_tag,post_status,post_comments_count,post_views_count ) VALUES('{$post_category_id}','{$post_title_data}','{$post_author_user}','{$post_content_data}','{$post_image}',now(),'{$post_author_image}','{$post_tag_data}','{$post_status_data}','{$post_comments_count}','{$post_views_count}')";

          $insert_post_query = mysqli_query($connection, $query);

          confirmationQuery($insert_post_query);

          }


          }
               ?>

              <!-- Function to insert new categories END -->
              <h5 class="card-title">Add Post</h5>
              <!-- Notification -->
                <?php if(isset($insert_post_query)){echo "<p class='text-left text-success progress-bar-animated'> Post created succesfully</p> " ;} ?>
                <!-- Vertical Form -->

              <form action="" method="POST"  class="row g-3" enctype="multipart/form-data">
              <div class="col-12">
                <label for="inputNanme4" class="form-label">Post Title</label>
                <input type="text" class="form-control" name="post_title" >
                <?php if(array_key_exists('post_title', $errors)){echo '<p class="text-danger text-left">'.$errors['post_title'].'</p>';} ?>
              </div>
   
              <div class="col-12">
                <label for="inputPassword4" class="form-label">Post Category</label>
                
              <select name="post_category" id="post_category_id" class='form-control'>
                  <option value="Select option">Select option</option>

                  <?php  
                        $query = "SELECT * FROM categories ";

                        $select_post_categories = mysqli_query($connection, $query);

                      confirmationQuery($select_post_categories);

                      while ($row = mysqli_fetch_assoc($select_post_categories)) {
                          $category_id = $row['category_id'];
                          $category_title = $row['category_title'];

                          echo "<option value='{$category_id}'>{$category_title}</option>";
                      }?>

              </select>

              </div> 


                <div class="col-12">
                  <label for="post-status" class="form-label">Post Status</label>
                  <select name="post_status" id="" class='form-control'>
                      <option value="draft">Select option</option>
                      <option value="published">Published</option>
                      <option value="draft">Draft</option>

                  </select>
              </div> 

              <div class="col-12">
                <label for="inputPassword4" class="form-label">Post User</label>
                
              <select name="post_author_user" id="" class='form-control'>
                      <option value="Select option">Select option</option>
                  <?php  
                        $query = "SELECT * FROM users ";

                        $select_users = mysqli_query($connection, $query);

                      confirmationQuery($select_users);

                      while ($row = mysqli_fetch_assoc($select_users)) {
                          $user_id = $row['user_id'];
                          $user_name = $row['user_name'];

                          echo "<option value='{$user_name}'>{$user_name}</option>";
                      }?>

              </select>

              </div> 



              <div class="col-12">
                <label for="inputPassword4" class="form-label">Post Image</label>
                <input type="file" class="form-control" name="image" >

              </div> 
              <div class="col-12">
                <label for="inputPassword4" class="form-label">Post Tags</label>
                <input type="text" class="form-control" name="post_tags" >
                <?php if(array_key_exists('post_tags', $errors)){echo '<p class="text-danger text-left">'.$errors['post_tags'].'</p>';} ?>

              </div> 

              <div class="col-12">
                <label for="inputPassword4" class="form-label">Post Author Image</label>
                <input type="file" class="form-control" name="image_author" >

              </div> 

            <div class="col-12">
                <label for="inputEmail4" class="form-label">Post Content</label>
                <textarea name="post_content" class="form-control" cols="20" rows="10"  ></textarea>
                <?php if(array_key_exists('post_content', $errors)){echo '<p class="text-danger text-left">'.$errors['post_content'].'</p>';} ?>

              </div>

        
              <div class="text-left">
                <button type="submit" name="submit" class="btn btn-primary">PUBLISH POST</button>
              </div>
              </form><!-- Vertical Form -->
        
            
            </div>
          </div>


            </div>
        
        </div>
    </section>

</main>
