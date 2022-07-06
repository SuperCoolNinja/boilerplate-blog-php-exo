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
                        <form action="index.php?controller=posts&action=create" method="post">
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
                    foreach($usersPostsData as $post)
                    {
                        $content = $post['content'];
                        $author = $post['author'];
                        $status = $post['status'];
                        $created_at = $post['created_at'];
                        $like = $post['like'];
                        
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

                                <!-- card footer -->
                                <div class="card-footer">
                                    <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-outline-secondary">Like</button>
                                    </div>
                                    <small class="text-muted">'.$like.' likes</small>
                                </div>
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



<!-- 

 <section>
        <div class="container">
            <div class="row mt-5">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="text-center">Public Posts</h3>
                        </div>
                        <div class="card-body">
                        <?php foreach ($posts as $post) { ?>
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo "TITLE"; ?></h5>
                                        <p class="card-text"><?php echo "CONTENUE" ?></p>
                                        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
 -->