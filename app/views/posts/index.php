<?php require APP_ROUTE . '/views/inc/head.php'; ?>
<?php require APP_ROUTE . '/views/inc/navbar.php'; ?>

<!-- Section Profile and Post -->
<section>
    <div class="container">
        <div class="row mt-2 position-sticky">
            <div class="col-4">
                <div class="card" style="width: 18rem;">
                    <div class="card-header">
                        <h3 class="text-center">Profile</h3>

                            <img src="https://media.discordapp.net/attachments/926825487815278622/926825664613609483/12640_2.png" class="d-block rounded-circle mx-auto" alt="profile picture" width="100" height="100">
                        
                            <div class="card-body text-center">
                                <h6 class="card-title">
                                    <?php echo $data['userData']->pseudo ?>
                                </h6>

                                <p class="card-text text-muted" style="font-size : 0.8rem;">
                                    <?php echo $data['userData']->status ?>
                                </p>
                            </div>
                            

                                <!-- If status is null then we add a form to change the status -->
                            <?php if($data['userData']->status== null) : ?>
                                <form method="post">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="status" maxlength="30" name="status" placeholder="Set a custom status">
                                    </div>

                                    <div class="text-center">
                                        <button type="submit" name="submit-status" class="btn btn-sm btn-primary my-1 mb-0">Submit</button>
                                    </div>
                                </form>

                                <div class="text-center my-5 mb-0">
                                    <a href="<?php echo URL_ROOT;?>/users/logout" class="btn btn-danger">Logout</a>
                                </div>

                                <?php else :?>
                                    
                                <div class="text-center my-2 mb-2">
                                    <a href="<?php echo URL_ROOT;?>/users/logout" class="btn btn-sm btn-danger">Logout</a>
                                </div>
                        <?php endif;?>
                    </div>
                </div>
            </div>

            <div class="col-8">
                <div class="card w-50">
                    <div class="card-header">
                        <h3 class="text-center">Create a post</h3>
                    </div>
                    <div class="card-body">
                        <form action="<?php echo URL_ROOT;?>/posts/index" method="post">
                            <div class="form-group mb-3">
                                <textarea class="form-control <?php echo (!empty($data['content_err'])) ? 'is-invalid' : '';?>" name="content" rows="3" placeholder="What's on your mind?" maxlength="255" value=<?php echo $data['content']?>></textarea>
                                <span class="invalid-feedback"><?php echo $data['content_err'];?></span>
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
                <?php foreach($data['posts'] as $post) : ?>
                    <div class="col-12">
                        <div class="card d-flex justify-content-center w-50 mx-auto" style="border : none">
                            <div class="card-body bg-white">
                                <div class="card mb-0">
                                    <div class="card-body d-flex align-items-start">
                                        <div class="d-flex">
                                            <div>
                                                <img src="https://media.discordapp.net/attachments/926825487815278622/926825664613609483/12640_2.png" class="d-block rounded-circle" alt="profile picture" width="60" height="60">
                                            </div>

                                            <div class="d-flex flex-column">
                                                <p class="card-title mx-2 mb-0" style="font-weight: 500; font-size : 1.1rem;"><?=$post->author?></p>
                                                <p class="card-text mx-2 text-muted mb-0" style="font-size: 0.7rem;"><?=$post->status?></p>

                                                <p class="card-text mx-2 text-muted mb-0">
                                                    <?= $post->created_at?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                

                                    <div class="card-body">
                                        <p class="card-text fs-6"><?=$post->content?></p>
                                    </div>

                                    <!-- Check if the data['likes'] is not empty -->
                                    <?php if(empty($data['likes'])) : ?>
                                        <div class="card-footer">
                                            <div class="d-flex justify-content-between align-items-center">
                                            <form action='<?php echo URL_ROOT . '/posts/index?post_id=' . $post->id ;?>' method="post">
                                                <button name="submit-like" type="submit" class="btn btn-sm btn-outline-secondary">Like</button>
                                                <?php if($_SESSION['user_role'] == "admin") :?>
                                                    <button name="submit-delete" type="submit" class="btn btn-sm btn-danger">Delete</button>
                                                <?php endif;?>
                                            </form>

                                            <small class="text-muted"><?=$post->likes?> likes</small>
                                        </div>
                                    <?php else :?>
                                        <div class="card-footer">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <form action='<?php echo URL_ROOT . '/posts/index?post_id=' . $post->id ;?>' method="post">
                                                    <?php foreach($data['likes'] as $postLiked => $liked) : ?>
                                                        <?php foreach($liked as $likedPost) : ?>
                                                            <?php if($likedPost->post_id == $post->id && $likedPost->user_id == $_SESSION['user_id']) : ?>
                                                                <?php 
                                                                    $data['posts'][$post->id]['isAlreadyiked'] = true;
                                                                ?>
                                                            <?php endif;?>
                                                        <?php endforeach;?>
                                                    <?php endforeach;?>
                                                    
                                                    <button <?php echo (isset($data['posts'][$post->id]['isAlreadyiked'])) ? 'disabled' : '';?>  name="submit-like" type="submit" class="btn btn-sm btn-outline-secondary">Like</button>
                                                    
                                                    <?php if($_SESSION['user_role'] == "admin") :?>
                                                        <button name="submit-delete" type="submit" class="btn btn-sm btn-danger">Delete</button>
                                                    <?php endif;?>
                                                </form>
                                                
                                                <small class="text-muted"><?=$post->likes?> likes</small>
                                            </div>
                                        </div>
                                    <?php endif;?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach;?>
            </div>
        </div>
</section>





<?php require APP_ROUTE . '/views/inc/footer.php'; ?>


