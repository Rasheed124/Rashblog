<?php 

  

if(isset($_POST['checkBoxArray'])){

    $checkBoxArray = $_POST['checkBoxArray'];

    foreach($checkBoxArray as $userValueId){

    $bulk_options = $_POST['bulk_options'];

    switch($bulk_options){
     
        case 'change_to_admin' :

            $query = "UPDATE users SET user_role = 'admin' WHERE user_id = {$userValueId} ";
        
            $update_admin_query = mysqli_query($connection, $query);
        
            confirmationQuery($update_admin_query);
        break;

        case 'change_to_sub' :

            $query = "UPDATE users SET user_role = 'subscriber' WHERE user_id = {$userValueId} ";
        
            $update_sub_query = mysqli_query($connection, $query);
        
            confirmationQuery($update_sub_query);
        break;

        case 'delete' :
            $query = "DELETE FROM users WHERE user_id = {$userValueId} ";
            $update_delete_query = mysqli_query($connection, $query);
            confirmationQuery($update_delete_query);
            break;

        case 'clone' :
            $query = "SELECT * FROM users WHERE user_id = {$userValueId} ";
            $select_clone_query  = mysqli_query($connection, $query);
            confirmationQuery($select_clone_query);
            while($row= mysqli_fetch_assoc($select_clone_query)){

                $user_name = $row['user_name'];
                $user_firstname = $row['user_firstname'];
                $user_lastname = $row['user_lastname'];
                $user_image = $row['user_image'];
                $user_email = $row['user_email'];
                $user_role = $row['user_role'];
        
        
             }

            $query = "INSERT INTO users(user_name, user_firstname, user_lastname, user_image, user_email, user_role, )  VALUES({$user_name},'{$user_firstname}','{$user_lastname}','{$user_image}','{$user_email}','{$user_role}') ";

            $create_clone_query = mysqli_query($connection, $query);
        
            confirmationQuery($create_clone_query);
            
           
            
            break;

        default;


    }


    }


}

?>








<main id="main" class="main">
    <section class="section">
        <div class="row">
            <!-- view category -->
            <div class="col-lg-12">
            <?php include("includes/delete_modal.php") ?>

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Categories</h5>
                        <!-- Table with hoverable rows -->
                        <form action="" method="post">
                        <table class="table table-sm table-hover table-bordered ">

                        <div class="col-lg-12 d-flex">
                            <div id="bulkOptionContainer" class="col-lg-6">

                                <select class="form-control" name="bulk_options" id="">
                                    <option value="">Select options</option>
                                    <option value="change_to_sub">Subscriber</option>
                                    <option value="change_to_admin">Admin</option>
                                    <option value="delete">Delete</option>
                                    <option value="clone">Clone</option>
                          
                                </select>
                        </div>
                            <div  class="col-lg-6 ">
                                <input type="submit" class="btn btn-success" name="submit" value="Apply">
                                <a  href="users.php?source=add_user" class="btn btn-primary">Add New</a>
                            </div>
                       </div>
                  
                            <thead>
                                <tr>
                                    <th><input id="selectAllBoxes" type="checkbox"></th>
                                    <th scope="col">ID</th>
                                    <th scope="col">Username</th>
                                    <th scope="col">Firstname</th>
                                    <th scope="col">Lastname</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Admin</th>
                                    <th scope="col">Subscriber</th>
                                    <!-- <th scope="col">Date</th> -->

                                </tr>
                            </thead>
                            <tbody>
                                  <?php 
                                  
                                  
                $query = "SELECT * FROM users ORDER BY user_id DESC";

                $select_all_users = mysqli_query($connection, $query);

                confirmationQuery($select_all_users);

                while ($row = mysqli_fetch_assoc($select_all_users)) {
                    $user_id = $row['user_id'];
                    $user_name = $row['user_name'];
                    $user_firstname = $row['user_firstname'];
                    $user_lastname = $row['user_lastname'];
                    $user_image = $row['user_image'];
                    $user_email = $row['user_email'];
                    $user_role = $row['user_role'];
             
                    
                               echo "<tr>";
                                ?>

                             <th><input class="checkBoxes" type="checkbox" name="checkBoxArray[]" value="<?php echo $user_id ?>" ></th>
                             <?php 
                                echo " <th scope='row'>$user_id</th>";
                                echo "<td>$user_name</td>";
                                echo "<td> $user_firstname</td>";
                                echo "<td> $user_lastname</td>";

                                echo "<td> <img width='100' height='100'  src='../images/$user_image' alt=''></td> ";
                                echo "<td> $user_email</td>";
                                echo "<td> $user_role</td>";
                         
                                echo "<td><a href='users.php?change_to_admin={$user_id}' >Admin</a></td>";
                                echo "<td><a href='users.php?change_to_sub={$user_id}' >Subscriber</a></td>";
                                echo "<td><a href='users.php?source=edit_user&edit_user_id={$user_id}' >Edit</a></td>";
                                echo "<td><a href='javascript:void(0)' rel='$user_id' class='user_link'>Delete</a></td>";

                                // echo "<td><a  onClick=\"javascript:return confirm('Are you sure to delete this user '); \" href='users.php?delete={$user_id}' >Delete</a></td>";
                      
                
                                echo "</tr>";
                    
                    }
                                                    
                              ?>
                            </tbody>

                        </table>
                        <!-- End Table with hoverable rows -->

                        </form>
                    </div>
                </div>


            </div>

        </div>
    </section>

</main>

<?php 




if (isset($_GET['change_to_admin'])) {
    $change_to_admin_id = $_GET['change_to_admin'];


    $query = "UPDATE users SET user_role = 'admin' WHERE user_id = {$change_to_admin_id} ";

    $change_to_admin_query = mysqli_query($connection, $query);
    header("Location:users.php");

    confirmationQuery($change_to_admin_query);
}

if (isset($_GET['change_to_sub'])) {
    $change_to_sub_id = $_GET['change_to_sub'];


    $query = "UPDATE users SET user_role = 'subscriber' WHERE user_id = {$change_to_sub_id} ";

    $change_to_sub_query = mysqli_query($connection, $query);
    header("Location:users.php");

    confirmationQuery($change_to_sub_query);
}

if (isset($_GET['delete'])) {
    $the_user_id = $_GET['delete'];


    $query = "DELETE FROM users WHERE user_id = {$the_user_id} ";

    $delete_query = mysqli_query($connection, $query);
    header("Location:users.php");

    confirmationQuery($delete_query);
}




?>