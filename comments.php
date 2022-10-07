



             <?php $errors = array(); 
                
             if ($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['submit'])){
                $the_post_id = $_GET['p_id'];
               if (preg_match('/^.{3,20}$/i', trim($_POST['comment_name']))) {	
               $comment_name = escape($_POST['comment_name']);
             } else {
               $errors['comment_name'] = 'Please enter a valid name.';
             } 

               if (filter_var($_POST['comment_email'],FILTER_VALIDATE_EMAIL)) {	
                $comment_email = escape($_POST['comment_email']);
             } else {
               $errors['comment_email'] = 'Please enter valid email.';
             } 
             
               if (preg_match ('/^.{3,200}$/i', trim($_POST['comment_message']))) {	
                $comment_content = escape($_POST['comment_message']);
             } else {
               $errors['comment_message'] = 'Please enter a valid message.';
             } 
             
           

             if(empty($errors)){
                $query = "INSERT INTO comments(comment_post_id, comment_author, comment_email,comment_content, comment_status, comment_date)  VALUES ($the_post_id, '{$comment_name}', '{$comment_email}', '{$comment_content}','approved',now()) ";

               
                 $insert_comments_query = mysqli_query($connection, $query);

                 confirmationQuery($insert_comments_query);
                 
               }


           }
            
            
            ?>


            
<?php

          $query = "SELECT * FROM comments WHERE comment_post_id = {$the_post_id}";
          // $query = "SELECT * FROM comments ";

          $comment_insert_query = mysqli_query($connection, $query);

          confirmationQuery($comment_insert_query);

          $comments_num_row = mysqli_num_rows($comment_insert_query);

          ?>


         <h5 class="comment-title py-4"><?php echo $comments_num_row ?> Comments</h5>

          <?php
          while($row = mysqli_fetch_assoc($comment_insert_query)){

            $comment_author_insert = $row['comment_author'];
            $comment_content_insert = $row['comment_content'];
            $comment_date_insert = $row['comment_date'];


?>
             
              <div class="comments mb-3">
      
                  <div class="comment d-flex">
                    <div class="flex-shrink-0">
                      <div class="avatar avatar-sm rounded-circle">
                        <!-- <img class="avatar-img" src="assets/img/person-2.jpg" alt="" class="img-fluid"> -->
                      </div>
                    </div>
                    <div class="flex-shrink-1 ms-2 ms-sm-3">
                      <div class="comment-meta d-flex">
                        <h6 class="me-2"><?php echo $comment_content_insert ?></h6>
                        <span class="text-muted"><?php echo $comment_date_insert ?></span>
                      </div>
                      <div class="comment-body">
                      <?php echo $comment_author_insert?>
                      </div>
                    </div>
                </div>



              </div><!-- End Comments -->
              <?php
            }

?>



            <!-- ======= Comments Form ======= -->
            <form action="" method="POST">
                <div class="row justify-content-center mt-5">

                  <div class="col-lg-12">
                    <h5 class="comment-title">Leave a Comment</h5>
                     <!-- Notification -->
                <?php if(isset($insert_comments_query )){echo "<p class='text-left text-success progress-bar-animated'> Comment created succesfully</p> " ;} ?>
                    <div class="row">
                      <div class="col-lg-6 mb-3">
                        <label for="comment-name">Name</label>
                        <input type="text" class="form-control" name="comment_name" placeholder="Enter your name" value="">
                <?php if(array_key_exists('comment_name', $errors)){echo '<p class="text-danger text-left">'.$errors['comment_name'].'</p>';} ?>

                      </div>
                      <div class="col-lg-6 mb-3">
                        <label for="comment-email">Email</label>
                        <input type="text" class="form-control" name="comment_email" placeholder="Enter your email" value="">
                        <?php if(array_key_exists('comment_email', $errors)){echo '<p class="text-danger text-left">'.$errors['comment_email'].'</p>';} ?>

                      </div>
                      <div class="col-12 mb-3">
                        <label for="comment-message">Message</label>

                        <textarea class="form-control" name="comment_message" placeholder="Enter your message" cols="30" rows="10"></textarea>
                        <?php if(array_key_exists('comment_message', $errors)){echo '<p class="text-danger text-left">'.$errors['comment_message'].'</p>';} ?>
                      </div>
                      <div class="col-12">
                        <input type="submit" name="submit" class="btn btn-primary" value="Post comment">
                      </div>
                    </div>
                  </div>
                </div><!-- End Comments Form -->

            </form>