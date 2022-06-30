<html lang="en">
    
<style>
<?php include 'CSS/main.css'; ?>
</style>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <title>Blog</title>
</head>
<body>
    <header class="background-header text-white d-flex justify-content-between align-items-center px-5">
        <a href="?page=home"><h1>Blog</h1></a>

        <?php if(!empty($_COOKIE['user']))
            echo '<a class="nav-link"  aria-disabled="false" href="?action=checkIsLogged">Post Blog</a>';
        else echo '<a class="nav-link"  aria-disabled="false" href="?page=login">Log in</a>';?>
    </header>
    
    <main>
        <section class="container">
            <ul class="row">
                <h2 class="p-2">Posts</h2>
                <?php 
                    foreach ($posts as $post) {
                        $title = $post['title'];
                        $content = $post['content'];
                        $date = $post['date'];
                        $image = "assets/".$post['image'];
                        $author = $post['author'];
                        $id = $post['id'];

                        echo '
                        <li class="col-12">';
                            echo "
                            <div class='card mx-auto my-5' style='width: 35rem; height: 35rem'>
                                <img src='{$image}' class='card-img-top' alt='Image here of post'>
                                <div class='card-body' style='max-width: 25rem; overflow: hidden;'>
                                    <h5 class='card-title text-primary'>{$title}</h5>
                                    <p class='card-text text-dark' style='display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;'>{$content}</p>
                                </div>

                                <div class='card-footer'>
                                    <div class='d-flex gap-5 mb-3 justify-content-center'>
                                        <small class='text-muted mx-auto'>Publish the : {$date}</small>
                                        <small class='text-muted mx-auto'>Author : {$author}</small>
                                    </div>

                                    <div class='d-flex flex-row'>
                                        <a href='?page=post&id={$id}' class='btn btn-primary w-50 mx-3'>Read more.</a>
                                        <a href='?action=delete&id={$id}' class='btn btn-danger w-50'>Delete.</a>
                                    </div>
                                </div>
                            </div>";
                        echo '</li>';
                    }
                ?>
            </ul>
        </section>
    </main>
</body>
</html>