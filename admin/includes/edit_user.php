<main id="main" class="main">
    <section class="section">
        <div class="row">
            <!-- Add category  -->
          <div class="col-lg-12">

            <div class="card">
            <div class="card-body">
            


            <?php
  if(isset($_GET['edit_user_id'])){

      $edit_user_id = $_GET['edit_user_id'];
  }


     $query = "SELECT * FROM users WHERE user_id = $edit_user_id ";
     $select_all_users = mysqli_query($connection, $query);

     confirmationQuery($select_all_users);

     while($row= mysqli_fetch_assoc($select_all_users)){

        $user_id = $row['user_id'];
        $username = $row['user_name'];
        $user_password = $row['user_password'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_image = $row['user_image'];
        $user_email = $row['user_email'];
        $user_role = $row['user_role'];
        // $user_comment_count = 2;
        // $user_view_count = 3;
     }



     if(isset($_POST['update_user'])){

    

        $user_name = escape($_POST['user_name']);

        $user_firstname = escape($_POST['user_firstname']);

        $user_lastname = escape($_POST['user_lastname']);
    

        $user_email = escape($_POST['user_email']);

        $user_password = escape($_POST['user_password']);

    
         $user_image = $_FILES['image']['name'];
         $user_image_temp = $_FILES['image']['tmp_name'];


        move_uploaded_file($user_image, "../images/$user_image");


        if(empty($user_image)){
            $select_user_image = "SELECT * FROM users WHERE user_id =  $edit_user_id ";

            $select_user_image_query = mysqli_query($connection, $select_user_image);
    
            while($row = mysqli_fetch_assoc($select_user_image_query)){
                $user_image = $row['user_image'];
            }
        }

        if(!empty($user_password)){

            $query_password = "SELECT user_password FROM users WHERE user_id = '$user_id' ";

            $get_user_query = mysqli_query($connection, $query_password);

            $row = mysqli_fetch_array($get_user_query);

            $db_user_password = $row['user_password'];

            if($db_user_password != $user_password){
                $hashed_password = escape(md5($user_password)) ;
    
            }

            $query =  "UPDATE users SET user_name='{$username}', user_firstname='{$user_firstname}', user_lastname='{$user_lastname}', user_password='{$hashed_password}', user_email='{$user_email}', user_image='{$user_image}', user_role ='{$user_role}'  WHERE user_id =  {$edit_user_id}  ";
        
            $update_users = mysqli_query($connection, $query);
            
            confirmationQuery($update_users);
        }else{
            $msg = "<p class='text-left text-danger'> update your password or rewrite your formal password";
        }

 
     }


 ?>
              <!-- Function to insert new categories END -->
              <h5 class="card-title">Add user</h5>
              <!-- Notification -->
                <?php if(isset($update_users)){echo "<p class='text-left text-success'> User updated successfully <a href='./profile.php'> View user </a> or <a href='users.php'> Edit more users </a>succesfully</p> " ;} ?>
                <!-- Vertical Form -->

              <form action="" method="post"  class="row g-3" enctype="multipart/form-data">
              <div class="col-12">
                <label for="inputNanme4" class="form-label">User name</label>
                <input type="text" class="form-control" name="user_name" value="<?php if(isset($username)){echo $username;} ?>">
              </div>

              <div class="col-12">
                <label for="inputNanme4" class="form-label">First name</label>
                <input type="text" class="form-control" name="user_firstname" value="<?php if(isset($user_firstname)){echo $user_firstname;} ?>">
              </div>

              <div class="col-12">
                <label for="inputNanme4" class="form-label">Last name</label>
                <input type="text" class="form-control" name="user_lastname" value="<?php if(isset($user_lastname)){echo $user_lastname;} ?>">
              </div>
   

              <div class="col-12">
                <label for="inputNanme4" class="form-label">Email</label>
                <input type="text" class="form-control" name="user_email" value="<?php if(isset($user_email)){echo $user_email;} ?>">
              </div>

                

              <div class="col-12">
                <label for="inputNanme4" class="form-label">User password</label>
                <input type="password" class="form-control"  name="user_password"  >
                 <?php if(isset($msg)){echo $msg; }  ?>

              </div>

                <div class="col-12">
                  <label for="user-status" class="form-label">User role</label>
                  <select name="user_role" id="" class="form-control">
                    <option value="<?php echo $user_role; ?>"><?php echo $user_role; ?></option>
                    <?php 
                    if($user_role == "admin"){

                    echo "<option value='subscriber'>Subscriber</option>";
                    }else{
                        echo "<option value='admin'>Admin</option>";
                    }
                    
                    
                    ?>
                </select>
              </div> 

    

              <div class="col-12">
                <label for="inputPassword4" class="form-label">User Image</label>
                <img width="100"  src="../images/<?php if(isset($user_image)){echo $user_image;} ?>" alt="">
                <input type="file" class="form-control" name="image" >

              </div> 


        
              <div class="text-left">
                <input type="submit" name="update_user" value="UPDATE USER" class="btn btn-primary">
              </div>
              </form><!-- Vertical Form -->
        
            
            </div>
          </div>


            </div>
        
        </div>
    </section>

</main>
