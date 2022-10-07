<main id="main" class="main">
    <section class="section">
        <div class="row">
            <!-- Add category  -->
          <div class="col-lg-12">

            <div class="card">
            <div class="card-body">
            


            <?php
  if(isset($_GET['edit_post_id'])){

      $edit_post_id = $_GET['edit_post_id'];
  }


     $query = "SELECT * FROM posts WHERE post_id = $edit_post_id ";
     $select_all_posts = mysqli_query($connection, $query);

     confirmationQuery($select_all_posts);

     while($row= mysqli_fetch_assoc($select_all_posts)){

        $post_id = $row['post_id'];
        $post_category= $row['post_category_id'];
        $post_title = $row['post_title'];
        $post_author_user = $row['post_author_user'];
        $post_content = $row['post_content'];
        $post_image = $row['post_image'];
        $post_date = $row['post_date'];
        $post_author_image = $row['post_author_image'];
        $post_tag = $row['post_tag'];
        $post_status = $row['post_status'];
        // $post_comment_count = 2;
        // $post_view_count = 3;
     }



     if(isset($_POST['update_post'])){

     
        $post_category_id = $_POST['post_category'];

        $post_title = escape($_POST['post_title']);
    
        $post_author_user = $_POST['post_author_user'];

         $post_content = escape($_POST['post_content']);
    

         $post_image = $_FILES['image']['name'];
         $post_image_temp = $_FILES['image']['tmp_name'];


         $post_tag = escape($_POST['post_tags']);
  

        $post_author_image = $_FILES['image_author']['name'];
        $post_image_author_temp = $_FILES['image_author']['tmp_name'];

        $post_status = $_POST['post_status'];


        $post_date = date('d-m-y');

                
            //   $post_comments_count = 3;
            //   $post_views_count  = 4;

        move_uploaded_file($post_image_temp, "../images/$post_image");

        move_uploaded_file($post_image_author_temp, "../images/$post_author_image");

        if(empty($post_image) && empty($post_author_image)){
            $select_post_image = "SELECT * FROM posts WHERE post_id =  $edit_post_id ";

            $select_post_image_query = mysqli_query($connection, $select_post_image);
    
            while($row = mysqli_fetch_assoc($select_post_image_query)){
                $post_image = $row['post_image'];
                $post_author_image = $row['post_author_image'];
            }
        }

        $query =  "UPDATE posts SET post_title='{$post_title}', post_author_user='{$post_author_user}', post_date= now(), post_category_id = '{$post_category_id}',  post_image='{$post_image}',  post_author_image='{$post_author_image}', post_content='{$post_content}',post_tag='{$post_tag}', post_status ='{$post_status}'  WHERE post_id =  {$edit_post_id } ";
        
        $update_posts_query = mysqli_query($connection, $query);
        
        confirmationQuery($update_posts_query);

 
     }


 ?>
              <!-- Function to insert new categories END -->
              <h5 class="card-title">Add Post</h5>
              <!-- Notification -->
                <?php if(isset($update_posts_query)){echo "<p class='text-left text-success'> Post updated <a href='../post.php?p_id={$edit_post_id}'> View post </a> or <a href='posts.php'> Edit more posts </a>succesfully</p> " ;} ?>
                <!-- Vertical Form -->

              <form action="" method="POST"  class="row g-3" enctype="multipart/form-data">
              <div class="col-12">
                <label for="inputNanme4" class="form-label">Post Title</label>
                <input type="text" class="form-control" name="post_title" value="<?php if(isset($post_title)){echo $post_title;} ?>">
              </div>
   
              <div class="col-12">
                <label for="inputPassword4" class="form-label">Post Category</label>
                
              <select name="post_category"  class='form-control'>

                  <?php  
                        $query = "SELECT * FROM categories ";

                        $select_post_categories = mysqli_query($connection, $query);

                      confirmationQuery($select_post_categories);

                      while ($row = mysqli_fetch_assoc($select_post_categories)) {
                          $category_id = $row['category_id'];
                          $category_title = $row['category_title'];
                          
                          if($category_id == $post_category_id){
                            echo "<option selected  value='{$category_id}'>{$category_title}</option>";

                          }else{
                            echo "<option value='{$category_id}'>{$category_title}</option>";
                          }

                      
                      }?>

              </select>

              </div> 

                <div class="col-12">
                  <label for="post-status" class="form-label">Post Status</label>
                  <select name="post_status" id="" class='form-control'>
                  <option value="<?php  echo $post_status ; ?>"><?php  echo $post_status ; ?></option>

                  <?php 

                        if($post_status == 'draft'){
                            echo  "<option value='published'>Publish</option>";
                        }else{
                            echo  "<option value='draft'>Draft</option>";
                        }

                        ?>
                

                  </select>
              </div> 

              <div class="col-12">
                <label for="inputPassword4" class="form-label">Post User</label>
                
              <select name="post_author_user" id="" class='form-control'>
              <?php echo "<option value='{$post_author_user}'>{$post_author_user}</option>"; ?>
                
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
                <img width="100" src="../images/<?php if(isset($post_image)){echo $post_image;} ?>" alt="">
                <input type="file" class="form-control" name="image" >

              </div> 
              <div class="col-12">
                <label for="inputPassword4" class="form-label">Post Tags</label>
                <input type="text" class="form-control" name="post_tags"  value="<?php if(isset($post_tag)){echo $post_tag;} ?>">

              </div> 

              <div class="col-12">
                <label for="inputPassword4" class="form-label">Post Author Image</label>
                <img width="100" src="../images/<?php if(isset($post_author_image)){echo $post_author_image;} ?>" alt="">
                <input type="file" class="form-control" name="image_author" >

              </div> 

            <div class="col-12">
                <label for="inputEmail4" class="form-label">Post Content</label>
                <textarea name="post_content" class="form-control" cols="20" rows="10"  ><?php if(isset($post_content)){echo $post_content;} ?></textarea>

              </div>

        
              <div class="text-left">
                <button type="submit" name="update_post" class="btn btn-primary">UPDATE POST</button>
              </div>
              </form><!-- Vertical Form -->
        
            
            </div>
          </div>


            </div>
        
        </div>
    </section>

</main>
