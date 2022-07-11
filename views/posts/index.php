<!DOCTYPE html>
<html lang="en">
<?php include './views/includes/head.php'; ?>
<body>
    <?php include_once './views/includes/header.php';?>

    <!-- Section Profile and Post -->
    <section>
        <div class="container">
            <div class="row mt-2 position-sticky">
                <div class="col-4">
                    <!-- wrapper card for profile -->
                    <div class="card" style="width: 18rem;">
                        <!-- card head -->
                        <div class="card-header">
                            <h3 class="text-center">Profile</h3>

                            <?php
                                 foreach($userProfilData as $user)
                                 {
                                    $pseudo = $user['pseudo'];
                                    $email = $user['email'];
                                    $created_at = $user['created_at'];
                                    $status = $user['status'];
                                    $role = $user['role'];
                                    $_SESSION['role']=$role;

                                    echo '<img src="https://media.discordapp.net/attachments/926825487815278622/926825664613609483/12640_2.png" class="d-block rounded-circle mx-auto" alt="profile picture" width="100" height="100">';
                                    
                                    echo '
                                    <div class="card-body text-center">
                                        <h6 class="card-title">
                                            '. $pseudo .'
                                        </h6>
                                        <p class="card-text text-muted" style="font-size : 0.8rem;">
                                            '. $status .'
                                        </p>
                                    </div>
                                    ';

                                    //If status is null then we add a form to change the status
                                    if($user['status'] == null)
                                    {
                                        //We add a form to set a string sttus
                                        echo '
                                        <form method="post">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" id="status"  maxlength="30" name="status" placeholder="Set a custom status">
                                                </div>
                                                <div class="text-center">
                                                    <button type="submit" name="submit-status" class="btn btn-sm btn-primary my-1 mb-0">Submit</button>
                                                </div>
                                        </form>';

                                        //Add a button to logout
                                        echo '
                                        <div class="text-center my-5 mb-0">
                                            <a href="?page=logout" class="btn btn-danger">Logout</a>
                                        </div>
                                        ';
                                    }
                                    else
                                    {
                                        echo '
                                        <div class="text-center my-2 mb-2">
                                            <a href="?page=logout" class="btn btn-sm btn-danger">Logout</a>
                                        </div>';
                                    }
                                }
                            ?>
                        </div>
                    </div>
                </div>

                <div class="col-8">
               <!-- create post inside card with a text area-->
                <div class="card w-50">
                    <div class="card-header">
                        <h3 class="text-center">Create a post</h3>
                    </div>
                    <div class="card-body">
                        <form method="post">
                            <div class="form-group mb-3">
                                <textarea class="form-control" id="post" name="post" rows="3" placeholder="What's on your mind?" maxlength="255"></textarea>
                            </div>
                            <button name="submit-post" type="submit" class="btn btn-gray mx-3" style="float: right;">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
  
    <!-- Section Public Posts -->
    <section>
        <div class="container">
            <div class="row mt-5">

                <?php 

                    //We display all posts
                    foreach($usersPostsData as $post)
                    {
                        $content = $post['content'];
                        $author = $post['author'];
                        $status = $post['status'];
                        $created_at = $post['created_at'];
                        $like = $post['likes'];
                        $id_post = $post['id'];


                        if($_SESSION['role'] == "admin")
                        {
                            $buttonCanLike = '
                            <!-- card footer -->
                                <div class="card-footer">
                                    <div class="d-flex justify-content-between align-items-center">
                                    <form action="?id_post='.$id_post.'" method="post">
                                        <button name="submit-like" type="submit" class="btn btn-sm btn-outline-secondary">Like</button>
                                        <button name="submit-delete" type="submit" class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                    <small class="text-muted">'.$like.' likes</small>
                                </div>
                            ';
                        }
                        else
                        {
                            $buttonCanLike = '
                            <!-- card footer -->
                            <div class="card-footer">
                                <div class="d-flex justify-content-between align-items-center">
                                <form action="?id_post='.$id_post.'" method="post">
                                    <button name="submit-like" type="submit" class="btn btn-sm btn-outline-secondary">Like</button>
                                </form>
                                <small class="text-muted">'.$like.' likes</small>
                            </div>
                        ';
                        }

                        foreach($likes as $postLiked => $liked)
                        {
                            foreach($liked as $likedPost)
                            {
                                if($likedPost["post_id"] == $id_post && $likedPost["user_id"] == $_SESSION['id'])
                                {
                                    if($_SESSION['role'] == "admin")
                                    {
                                        $buttonCanLike = '
                                        <!-- card footer -->
                                            <div class="card-footer">
                                                <div class="d-flex justify-content-between align-items-center">
                                                <form action="?id_post='.$id_post.'" method="post">
                                                    <button disabled name="submit-like" type="submit" class="btn btn-sm btn-outline-secondary">Like</button>
                                                    <button name="submit-delete" type="submit" class="btn btn-sm btn-danger">Delete</button>
                                                </form>
                                                <small class="text-muted">'.$like.' likes</small>
                                            </div>
                                        ';
                                    }
                                    else
                                    {
                                        $buttonCanLike = '
                                        <!-- card footer -->
                                        <div class="card-footer">
                                            <div class="d-flex justify-content-between align-items-center">
                                            <form action="?id_post='.$id_post.'" method="post">
                                                <button disabled name="submit-like" type="submit" class="btn btn-sm btn-outline-secondary">Like</button>
                                            </form>
                                            <small class="text-muted">'.$like.' likes</small>
                                        </div>
                                    ';
                                    }
                                }
                                    
                            }
                        }

                     

                            echo '
                            <div class="col-12">
                                <div class="card d-flex justify-content-center w-50 mx-auto" style="border : none">
                                <div class="card-body bg-white">
                                    <div class="card mb-0">
                                        <div class="card-body d-flex align-items-start">
                                            <div class="d-flex">
                                                <!-- container profile left side -->
                                                <div>
                                                    <img src="https://media.discordapp.net/attachments/926825487815278622/926825664613609483/12640_2.png" class="d-block rounded-circle" alt="profile picture" width="60" height="60">
                                                </div>
        
                                                <!-- Container profile right side -->
                                                <div class="d-flex flex-column">
                                                    <p class="card-title mx-2 mb-0" style="font-weight: 500; font-size : 1.1rem;">'. $pseudo . '</p>
                                                    <p class="card-text mx-2 text-muted mb-0" style="font-size: 0.7rem;">'. $status .'</p>
        
                                                   <!-- Show current day in text -->
                                                    <p class="card-text mx-2 text-muted mb-0">
                                                       '. $created_at .'
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                       
        
                                        <div class="card-body">
                                            <p class="card-text fs-6">'.$content.'</p>
                                        </div>
        
                                       '.$buttonCanLike.'
                                       
                                    </div>
                                </div>
                            </div>
                        </div>
                                ';
                    }
                ?>
                    
            </div>
        </div>
    </section>
</body>
</html>

<!-- TODO AJOUTER LE DISABLED AVEC isPostAlreadyLiked COMME DATA TO CHECK -->

<!-- <button name="submit-comment" type="submit" class="btn btn-sm btn-outline-secondary">Comment</button> -->
<!-- <button name="submit-delete" type="submit" class="btn btn-sm btn-outline-secondary">Delete</button> -->