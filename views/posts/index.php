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

                                    echo '<img src="https://media-exp2.licdn.com/dms/image/D4E35AQGGNwcrOMi6CQ/profile-framedphoto-shrink_400_400/0/1655796813997?e=1657281600&v=beta&t=gEW1w-ot2kQphjNCbMTaWKHoInycAWv6fhodbsP8J5U" class="d-block rounded-circle mx-auto" alt="profile picture" width="100" height="100">';
                                    
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
                                        <div class="text-center my-2 mb-0">
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
                            <button type="submit" class="btn btn-gray mx-3" style="float: right;">Submit</button>
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
                <div class="col-12">
                    <div class="card d-flex justify-content-center w-50 mx-auto" style="border : none">
                        <div class="card-body bg-white">
                            <div class="card mb-3">
                                <div class="card-body d-flex align-items-end">
                                    <img src="https://media-exp2.licdn.com/dms/image/D4E35AQGGNwcrOMi6CQ/profile-framedphoto-shrink_400_400/0/1655796813997?e=1657281600&v=beta&t=gEW1w-ot2kQphjNCbMTaWKHoInycAWv6fhodbsP8J5U" class="d-block rounded-circle" alt="profile picture" width="60" height="60">
                                    <p class="card-title text-muted self-justify-content-end">SuperCoolNinja</p>
                                </div>

                                <div class="card-body">
                                    <p class="card-text"><?php echo "CONTENUE" ?>Lorem ipsum dolor sit amet consectetur adipisicing elit. Facilis doloribus distinctio exercitationem ut reiciendis sint possimus non accusamus, nam dolores dolorum nesciunt delectus inventore laboriosam perspiciatis recusandae? Laudantium incidunt adipisci cupiditate maxime commodi minima perferendis quae veritatis fuga esse unde veniam quod, rem nam, voluptas magni dignissimos debitis eum. Excepturi hic, quaerat consequatur voluptatibus enim odit, ipsa corporis amet similique vitae quia libero debitis ut nobis unde magnam sequi obcaecati corrupti dolorem est ab soluta nam! Officiis expedita distinctio incidunt consequatur ipsam facere facilis, sit, atque vero possimus voluptatibus quasi impedit voluptatem natus quia eius amet voluptas. Iure dicta maiores consequuntur cumque deleniti fugiat suscipit. Eveniet a qui fuga praesentium possimus doloremque porro expedita illo! Aliquam recusandae, sed officia neque minus fuga nulla mollitia aliquid ab aut. Quae deserunt ad suscipit accusamus harum quaerat dolorum ducimus, cumque ex ab, recusandae commodi! At quia eius deserunt officiis, itaque est corporis maiores magni illum obcaecati incidunt necessitatibus? Vitae temporibus blanditiis nobis autem. Consequuntur quo eligendi reiciendis pariatur magnam ipsam eius officiis. Labore aspernatur, quas illum amet culpa nobis perspiciatis soluta harum laudantium distinctio reprehenderit laborum iusto fuga? Quibusdam libero recusandae harum, delectus numquam aliquid minus eum! Tempore, hic dolore? Rerum voluptates accusantium tempore accusamus libero velit doloremque explicabo, modi non voluptatibus eveniet aperiam quis fugiat dolorum esse atque, sapiente placeat. Veritatis quo quidem saepe et voluptates ratione aut soluta, harum voluptatibus voluptas minima? Quas facere eos nihil voluptas totam? Veniam mollitia ex consequatur temporibus unde placeat, assumenda saepe odit aliquam a quisquam quibusdam repellat voluptatum totam numquam.</p>
                                </div>

                                <!-- card footer -->
                                <div class="card-footer">
                                    <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-outline-secondary">Like</button>
                                    </div>
                                    <small class="text-muted">9 likes</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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