<?php 

if(isset($_POST['checkBoxArray'])){

    // $checkBoxArray = $_POST['checkBoxArray'];

    // foreach($checkBoxArray as $postValueId){

    // $bulk_options = $_POST['bulk_options'];

    // switch($bulk_options){
    //     case 'published' :
    //         $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = '{$postValueId}' ";
    //         $update_publish_query = mysqli_query($connection, $query);
    //         confirmationQuery($update_publish_query);
    //         break;

    //     case 'draft' :
    //         $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = '{$postValueId}' ";
    //         $update_draft_query = mysqli_query($connection, $query);
    //         confirmationQuery($update_draft_query);
    //         break;

    //     case 'delete' :
    //         $query = "DELETE FROM posts WHERE post_id = {$postValueId} ";
    //         $update_delete_query = mysqli_query($connection, $query);
    //         confirmationQuery($update_delete_query);
    //         break;

    //     case 'clone' :
    //         $query = "SELECT * FROM posts WHERE post_id = {$postValueId} ";
    //         $select_clone_query  = mysqli_query($connection, $query);
    //         confirmationQuery($select_clone_query);
    //         while($row= mysqli_fetch_assoc($select_clone_query)){

    //             $post_title = $row['post_title'];
    //             $post_category_id = $row['post_category_id'];
    //             $post_status = $row['post_status'];
    //             $post_tags = $row['post_tag'];
    //             $post_date = $row['post_date'];
    //             $post_content = $row['post_content'];
    //             $post_author_user = $row['post_author_user'];
    //             $post_image = $row['post_image'];        
    //             $post_author_image = $row['post_author_image'];        
    //             // $post_views_count = $row['post_content'];
    //             // $post_comments_count = $row['post_content'];
        
        
    //          }

    //         $query = "INSERT INTO posts(post_category_id, post_title, post_author_user, post_content, post_image, post_date, post_author_image, post_tag,  post_status)  VALUES({$post_category_id},'{$post_title}','{$post_author_user}','{$post_content}','{$post_image}',now(),'{$post_author_image}','{$post_tags}','{$post_status}') ";

    //         $create_clone_query = mysqli_query($connection, $query);
        
    //         confirmationQuery($create_clone_query);
            
           
            
    //         break;

    //         case 'reset' :
    //                 $zero_count = 0;
    //                 $query = "UPDATE posts SET post_views_count = {$zero_count}  WHERE post_id = {$postValueId}";
           
    //                 $reset_post_query = mysqli_query($connection, $query);
           
    //                 confirmationQuery($reset_post_query);
        
    //              break;



  
    //     default;


    // }


    // }


}

?>








<main id="main" class="main">
    <section class="section">
        <div class="row">
            <!-- view category -->
            <div class="col-lg-12">
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
                                    <th scope="col">Comment Auhtor</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Content</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">In response to</th>
                                    <!-- <th scope="col">Comment</th> -->
                                    <!-- <th scope="col">Views</th> -->

                                </tr>
                            </thead>
                            <tbody>
                                  <?php 
                                  
                                  
                $query = "SELECT * FROM comments ORDER BY comment_id DESC";

                $select_comments_query = mysqli_query($connection, $query);
        
                confirmationQuery($select_comments_query);
        
                        while ($row = mysqli_fetch_assoc($select_comments_query)) {
                            $comment_id = $row['comment_id'];
                            $comment_post_id = $row['comment_post_id'];
                            $comment_author = $row['comment_author'];
                            $comment_email = $row['comment_email'];
                            $comment_content = $row['comment_content'];
                            $comment_status = $row['comment_status'];
                            // $comment_comments_count = $row['comment_comments_count']; 
                            // $comment_views_count = $row['comment_views_count']; 
                            $comment_date = $row['comment_date'];
        
                    
                               echo "<tr>";
                                ?>

                             <th><input class="checkBoxes" type="checkbox" name="checkBoxArray[]" value="<?php echo $comment_id ?>" ></th>
                             <?php 
                                echo " <th scope='row'>$comment_id</th>";
                                echo "<td>$comment_author</td> ";
                                echo "<td>$comment_email </td> ";
                                echo "<td>$comment_content</td> ";
                                echo "<td>$comment_status </td> ";
                                echo "<td>$comment_date </td> ";
                                echo "<td><a href='../post.php?p_id=$comment_post_id'>View Response</a></td>";

                                echo "<td><a class='text-danger' href='comments.php?delete={$comment_id}'>Delete</a></td>";
                                echo "<td><a href='comments.php?publish=$comment_id'>publish</a></td>";
                                echo "<td><a href='comments.php?draft=$comment_id'>Draft</a></td>";
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

        $query = "UPDATE posts SET post_status = 'Draft' WHERE post_id = ". mysqli_real_escape_string($connection, $post_draft_id ) ." ";

        $the_draft_post_query = mysqli_query($connection, $query);
        header("Location:posts.php");

        confirmationQuery($the_draft_post_query);

}

if(isset($_GET['publish'])){
    $post_publish_id = $_GET['publish'];

        $query = "UPDATE posts SET post_status = 'Published' WHERE post_id = ". mysqli_real_escape_string($connection, $post_publish_id ) ." ";

        $the_publish_post_query = mysqli_query($connection, $query);
        header("Location:posts.php");

        confirmationQuery($the_publish_post_query);

}
?>