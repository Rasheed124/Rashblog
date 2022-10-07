<?php





// function usersonline(){


//     if(isset($_GET['onlineusers'])){
//         global $connection;

//         if(!$connection){

//         session_start();
//         include "../includes/db.php" ;


//         $session = session_id();
//         $time = time();
//         $time_out_in_seconds = 05;
//         $time_out = $time - $time_out_in_seconds;
    
//         $query = "SELECT * FROM users_online WHERE session = '$session' ";
//         $users_query = mysqli_query($connection, $query);
    
//         $count = mysqli_num_rows($users_query);
    
        
//            // This check if a new users just login
//            if($count == NULL){
//              // then insert a new session and time
//              mysqli_query($connection, "INSERT INTO users_online(session, time) VALUES('$session', '$time')");
//          }else{
    
//              // If same users
//                      // update the time //
//              mysqli_query($connection, "UPDATE users_online SET time = '$time' WHERE session = '$session' ");
//          }
//          $users_online_query = mysqli_query($connection, "SELECT * FROM users_online WHERE time > '$time_out' ");

//         $count_usersOnline = mysqli_num_rows($users_online_query);
    
//        }

//         }


       
// }

// usersonline();

// **************  TO REDIRECT   ********//
function redirect($location){

    header("Location:" . $location);
    exit;
}


// ************** TO CHECK GLOBAL SERVER REQUEST[POST, GET]  ********//
function ifItIsMethod($method=null){

    if($_SERVER['REQUEST_METHOD']  == strtoupper($method) ){
        return true;

    }
    return false;

}

// ************** TO CHECK USER ROLE  ********//
function isLoggedIn($user=null){

    if(isset($_SESSION[$user]) ){
        return true;
    }
    else{
        return false;

    }

}

// ************** TO CHECK IF USER IS LOGGED THEN REDIRRECT ********//
function checkIfUserIsLoggedInAndRedirect($redirectlocation){

    if(isLoggedIn('user_role')){
        redirect($redirectlocation);
    }
    return false;

}


// ************** PROTECTION FROM MYSQLI INJECTION********//
function escape($string){

    global $connection;
   return mysqli_real_escape_string($connection, trim($string));


}


// ************** MYSQLI DIE ERROR QUERY ********//
function confirmationQuery($confirm){

     global $connection;

    if(!isset($confirm)){
        die("QUERY FAILED" . mysqli_error($connection));
    }
}





// ************** To check if the user is an admin 
 //***  Used in the home, category , post **********************//
function is_admin($username=''){

    global $connection;

        if(isset($_SESSION[$username])){

        $query = "SELECT user_role FROM users WHERE user_name = '$username'";
    
        $result = mysqli_query($connection, $query);
    
        $row = mysqli_fetch_assoc($result);

    
        if($row['user_role'] == 'admin' ) {
    
            return true;
        }else{
    
            return false;
        }

    }

}





// ************** IF USERNAME EXISTS ************//

function usernname_exists($username){


    global $connection;

    $query = "SELECT user_name FROM users WHERE user_name = '$username'";

    $result = mysqli_query($connection, $query);

    $row = mysqli_fetch_array($result);

    if(mysqli_num_rows($result) > 0){

        return true;
    }else{

        return false;
    }
}

// ************** IF EMAIL EXISTS ************//

function email_exists($email){


    global $connection;

    $query_email = "SELECT user_email FROM users WHERE user_email = '$email'";

    $result_email = mysqli_query($connection, $query_email);

    if(mysqli_num_rows($result_email) > 0){

        return true;

    }else{
        return false;

    }
}




// ************** Query for Counting table row in the admin page **********************//
function recordCount($table){

    global $connection;

    $query = "SELECT * FROM " . $table;
    $select_posts_row_query = mysqli_query($connection, $query);
     $result = mysqli_num_rows($select_posts_row_query);
     confirmationQuery($result);
     return $result;
}



// ************** Graph Chart **********************//
// ************** Query for Counting table,column,status row in the admin page **********************//
function checkStatus($table, $column, $status){

    global $connection;

    $query = "SELECT * FROM $table WHERE $column = '$status' ";
    $checked_selected_table = mysqli_query($connection, $query);
    $status_result = mysqli_num_rows($checked_selected_table);
    confirmationQuery($status_result);

    return $status_result;
    
}



// ************** TO LOOP CATEGORIES FROM THE DATABASE ********//

function finding_categories(){


  global $connection;


  $query = "SELECT * FROM categories";

  $select_categories_query = mysqli_query($connection, $query);

  confirmationQuery($select_categories_query);

  ?>
          <?php
          while ($row = mysqli_fetch_assoc($select_categories_query)) {
              $category_id = $row['category_id'];
              $category_title = $row['category_title'];
              $category_description = $row['category_description'];
              $category_slug = $row['category_slug'];
              $category_count = $row['category_count'];

          ?>
              <tr>
                  <th scope="row"><?php echo $category_id ?></th>
                  <td><?php echo $category_title ?></td>
                  <td><?php echo $category_description ?></td>
                  <td><?php echo $category_slug ?></td>
                  <td><?php echo $category_count ?></td>
                  <td><a class="text-danger" href="categories.php?delete=<?php echo $category_id ;?>">Delete</a></td>
                  <td><a class="text-secondary" href="update_categories.php?&edit=<?php echo $category_id ;?>">Edit</a></td>
              </tr>
          <?php
          }
              
}





?>




