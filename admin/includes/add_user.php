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

     

          if(preg_match('/^.{3,100}$/i', trim($_POST['user_firstname']))){	
          $user_firstname_data = escape($_POST['user_firstname']);
          } else {
          $errors['user_firstname'] = "This field can't be empty .";
          } 
     

          if(preg_match('/^.{3,100}$/i', trim($_POST['user_lastname']))){	
          $user_lastname_data = escape($_POST['user_lastname']);
          } else {
          $errors['user_lastname'] = "This field can't be empty .";
          } 
     

          if(preg_match('/^.{3,50}$/i', trim($_POST['user_name']))){	
          $user_name_data = escape($_POST['user_name']);
          } else {
          $errors['user_name'] = "This field can't be empty .";
          } 
     
          
          if(preg_match('/^.{6,100}$/i', trim($_POST['user_password']))){	
            $user_password_data = escape(md5($_POST['user_password']));
            } else {
            $errors['user_password'] = "Please enter a password that is 6 characters and above";
            } 
       

        if(filter_var($_POST['user_email'],FILTER_VALIDATE_EMAIL)){	
          $user_email_data = escape($_POST['user_email']);
          } else {
          $errors['user_email'] = "Please enter a valid email address";
          } 



          if(preg_match('/^.{3,255}$/i', trim($_POST['user_about']))) {	
              $user_about_data = escape($_POST['user_about']);
          } else {
            $errors['user_about'] = "This field can't be empty .";
          } 

              $user_image_data = $_FILES['image']['name'];
              $user_image_temp = $_FILES['image']['tmp_name'];


     
            $user_role = $_POST['user_role'];


              $post_date_data = date('d-m-y');

          

          move_uploaded_file($user_image_temp, "../images/$user_image_data");


          if(empty($errors)){ 
          $query = "INSERT INTO users(user_name,user_firstname,user_lastname,user_password,user_email,user_image,user_role,user_about) VALUES('{$user_name_data}','{$user_firstname_data}','{$user_lastname_data}','{$user_password_data}','{$user_email_data}','{$user_image_data}','{$user_role}','{$user_about_data}')";

          $insert_user_query = mysqli_query($connection, $query);

          confirmationQuery($insert_user_query);

          }


 }
               ?>

              <!-- Function to insert new categories END -->
              <h5 class="card-title">Add User</h5>
              <!-- Notification -->
                <?php if(isset($insert_user_query)){echo "<p class='text-left text-success progress-bar-animated'> User created succesfully</p> " ;} ?>
                <!-- Vertical Form -->

              <form action="" method="POST"  class="row g-3" enctype="multipart/form-data">
              <div class="col-12">
                <label for="inputNanme4" class="form-label">Firstname</label>
                <input type="text" class="form-control" name="user_firstname" >
                <?php if(array_key_exists('user_firstname', $errors)){echo '<p class="text-danger text-left">'.$errors['user_firstname'].'</p>';} ?>
              </div>

              <div class="col-12">
                <label for="inputNanme4" class="form-label">Lastname</label>
                <input type="text" class="form-control" name="user_lastname" >
                <?php if(array_key_exists('user_lastname', $errors)){echo '<p class="text-danger text-left">'.$errors['user_lastname'].'</p>';} ?>
              </div>
   


              <div class="col-12">
                <label for="inputNanme4" class="form-label">Username</label>
                <input type="text" class="form-control" name="user_name" >
                <?php if(array_key_exists('user_name', $errors)){echo '<p class="text-danger text-left">'.$errors['user_name'].'</p>';} ?>
              </div>
   
              
              <div class="col-12">
                <label for="inputNanme4" class="form-label">Email</label>
                <input type="email" class="form-control" name="user_email" >
                <?php if(array_key_exists('user_email', $errors)){echo '<p class="text-danger text-left">'.$errors['user_email'].'</p>';} ?>
              </div>


                            
              <div class="col-12">
                <label for="inputNanme4" class="form-label">User password </label>
                <input type="password" class="form-control" name="user_password" >
                <?php if(array_key_exists('user_password', $errors)){echo '<p class="text-danger text-left">'.$errors['user_password'].'</p>';} ?>
              </div>


              <div class="col-12">
                <label for="inputNanme4" class="form-label">About</label>
                <textarea name="user_about" class="form-control" cols="5" rows="5"  ></textarea>
                <?php if(array_key_exists('user_about', $errors)){echo '<p class="text-danger text-left">'.$errors['user_about'].'</p>';} ?>
              </div>


              <div class="col-12">
                <label for="inputPassword4" class="form-label">User role</label>
                
                <select name="user_role" id="" class="form-control">
                   <option value="Select option">Select option</option>
                    <option value="admin">Admin</option>
                    <option value="subscriber">Subscriber</option>
                    
                </select>

              </div> 



              <div class="col-12">
                <label for="inputPassword4" class="form-label">User Image</label>
                <input type="file" class="form-control" name="image" >

              </div> 
            
        
              <div class="text-left">
                <button type="submit" name="submit" class="btn btn-primary">PUBLISH USER</button>
              </div>
              </form><!-- Vertical Form -->
        
            
            </div>
          </div>


            </div>
        
        </div>
    </section>

</main>
