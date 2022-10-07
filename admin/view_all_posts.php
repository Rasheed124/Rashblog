<?php 


if(isset($_POST['checkBoxArray'])){

    $checkBoxArray = $_POST['checkBoxArray'];

    foreach($checkBoxArray as $postValueId){

    $bulk_options = $_POST['bulk_options'];

    switch($bulk_options){
        case 'published' :
            $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = '{$postValueId}' ";
            $update_publish_query = mysqli_query($connection, $query);
            confirmationQuery($update_publish_query);
            break;

        case 'draft' :
            $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = '{$postValueId}' ";
            $update_draft_query = mysqli_query($connection, $query);
            confirmationQuery($update_draft_query);
            break;

        case 'delete' :
            $query = "DELETE FROM posts WHERE post_id = {$postValueId} ";
            $update_delete_query = mysqli_query($connection, $query);
            confirmationQuery($update_delete_query);
            break;

        case 'clone' :
            $query = "SELECT * FROM posts WHERE post_id = {$postValueId} ";
            $select_clone_query  = mysqli_query($connection, $query);
            confirmationQuery($select_clone_query);
            while($row= mysqli_fetch_assoc($select_clone_query)){

                $post_title = $row['post_title'];
                $post_category_id = $row['post_category_id'];
                $post_status = $row['post_status'];
                $post_tags = $row['post_tag'];
                $post_date = $row['post_date'];
                $post_content = $row['post_content'];
                $post_author_user = $row['post_author_user'];
                $post_image = $row['post_image'];        
                $post_author_image = $row['post_author_image'];        
                // $post_views_count = $row['post_content'];
                // $post_comments_count = $row['post_content'];
        
        
             }

            $query = "INSERT INTO posts(post_category_id, post_title, post_author_user, post_content, post_image, post_date, post_author_image, post_tag,  post_status)  VALUES({$post_category_id},'{$post_title}','{$post_author_user}','{$post_content}','{$post_image}',now(),'{$post_author_image}','{$post_tags}','{$post_status}') ";

            $create_clone_query = mysqli_query($connection, $query);
        
            confirmationQuery($create_clone_query);
            
           
            
            break;

            case 'reset' :
                    // $zero_count = 0;
                    // $query = "UPDATE posts SET post_views_count = {$zero_count}  WHERE post_id = {$postValueId}";
           
                    // $reset_post_query = mysqli_query($connection, $query);
           
                    // confirmationQuery($reset_post_query);
        
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

  

                        <form action=""  method="post">
                        <table class="table  table-hover table-bordered w-auto table-responsive-lg table-responsive-sm table-responsive-xs">

                        <div class="col-lg-12 d-flex">

                            <div id="bulkOptionContainer" class="col-lg-6">

                                <select class="form-control" name="bulk_options" id="">
                                    <option value="">Select options</option>
                                    <option value="published">Publish</option>
                                    <option value="draft">Draft</option>
                                    <option value="delete">Delete</option>
                                    <option value="clone">Clone</option>
                                    <option value="reset">Reset</option>
                                </select>
                        </div>
                            <div  class="col-lg-6 ">
                                <input type="submit" class="btn btn-success" name="submit" value="Apply">
                                <a  href="posts.php?source=add_post" class="btn btn-primary">Add New</a>
                            </div>
                       </div>
                  
                            <thead>
                                <tr>
                                    <th><input id="selectAllBoxes" type="checkbox"></th>
                                    <th scope="col">ID</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">Author(user)</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Content</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Image</th>
                                    <!-- <th scope="col">Tags</th> -->
                                    <!-- <th scope="col">Comment</th> -->
                                    <!-- <th scope="col">Views</th>
                                    <th scope="col">Author Image</th>
                                    <th scope="col">Date</th> -->

                                </tr>
                            </thead>
                            <tbody>
                                  <?php 
                                  
                $query = "SELECT posts.post_id, posts.post_category_id, posts.post_title, posts.post_author_user ,posts.post_content, posts.post_content, posts.post_image, posts.post_date, posts.post_author_image, posts.post_tag, posts.post_status, posts.post_comments_count, posts.post_views_count, categories.category_id, categories.category_title FROM posts LEFT JOIN categories ON posts.post_category_id = category_id ORDER BY post_id DESC";

                $select_posts_query = mysqli_query($connection, $query);
        
                confirmationQuery($select_posts_query);
        
                        while ($row = mysqli_fetch_assoc($select_posts_query)) {
                            $post_id = $row['post_id'];
                            $post_category_id = $row['post_category_id'];
                            $post_title = $row['post_title'];
                            $post_author_user = $row['post_author_user'];
                            $post_content = $row['post_content'];
                            $post_status = $row['post_status'];
                            $post_image  = $row['post_image'];
                            $post_tag = $row['post_tag'];
                            // $post_comments_count = $row['post_comments_count']; 
                            $post_views_count = $row['post_views_count']; 
                            $post_author_image  = $row['post_author_image'];
                            $post_date = $row['post_date'];
                            $category_id = $row['category_id'];
                            $category_title = $row['category_title'];
        
                    
                               echo "<tr>";
                                ?>

                             <th><input class="checkBoxes" type="checkbox" name="checkBoxArray[]" value="<?php echo $post_id ?>" ></th>
                             <?php 
                                echo " <th scope='row'>$post_id</th>";

                                echo "<td class='td-sm text-nowrap'>{$category_title}
                                <div class='d-flex justify-content-between'>
                                <p class='text-left m-2'><a href='../post.php?p_id=$post_id'>View post</a></p>
                                <p class='text-left m-2'><a href='javascript:void(0)' rel='$post_id' class='delete_link text-danger '>Delete</a></p>
                                </div>
                                </td>";
                                echo "<td>$post_author_user</td> ";
                                echo "<td>$post_title </td> ";
                                echo "<td>$post_content</td> ";
                                echo "<td>$post_status </td> ";
                                echo "<td> <img width='100' height='100'  src='../images/$post_image' alt=''></td> ";
                             //   echo "<td> $post_tag </td> ";
                                // echo "<td>$post_comments_count </td> ";
                             //   echo "<td>$post_views_count</td> ";
                               // echo "<td> <img width='100' height='100' src='../images/$post_author_image' alt=''></td> ";
                                //echo "<td>$post_date </td> ";
                              //  echo "<td><a href='javascript:void(0)' rel='$post_id' class='delete_link'>Delete</a></td>";
                                echo "<td><a class='text-secondary' href='posts.php?source=edit_post&edit_post_id={$post_id}'>Edit</a></td>";
                               // echo "<td><a href='../post.php?p_id=$post_id'>View post</a></td>";
                                echo "<td><a href='posts.php?publish=$post_id'>publish</a></td>";
                                echo "<td><a href='posts.php?draft=$post_id'>Draft</a></td>";
                                echo " </tr>" ;
                    
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



if(isset($_GET['delete'])){
     $post_delete_id =  $_GET['delete'];

    $query = "DELETE FROM posts WHERE post_id = {$post_delete_id}";
    $post_delete_query = mysqli_query($connection, $query);
    header("Location:posts.php");

    confirmationQuery($post_delete_query);
}


if(isset($_GET['draft'])){
    $post_draft_id = $_GET['draft'];

        $query = "UPDATE posts SET post_status = 'draft' WHERE post_id = ". mysqli_real_escape_string($connection, $post_draft_id ) ." ";

        $the_draft_post_query = mysqli_query($connection, $query);
        header("Location:posts.php");

        confirmationQuery($the_draft_post_query);

}

if(isset($_GET['publish'])){
    $post_publish_id = $_GET['publish'];

        $query = "UPDATE posts SET post_status = 'published' WHERE post_id = ". mysqli_real_escape_string($connection, $post_publish_id ) ." ";

        $the_publish_post_query = mysqli_query($connection, $query);
        header("Location:posts.php");

        confirmationQuery($the_publish_post_query);

}
?>

