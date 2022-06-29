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
        <a class="nav-link"  aria-disabled="false" href="?page=postform">Post Blog</a>
    </header>
    
    <main>
        <section class="container">
        <?php 
            foreach ($postsByID as $post) {
                        $title = $post['title'];
                        $content = $post['content'];
                        $date = $post['date'];
                        $image = "assets/".$post['image'];
                        $author = $post['author'];
                        $id = $post['id'];

                        echo "
                        <div class='card mx-auto my-5' style='width: 25rem;'>
                            <img src='{$image}' class='card-img-top' alt='Image here of post'>
                            <div class='card-body' style='max-width: 25rem; overflow: hidden;'>
                                <h5 class='card-title text-primary'>{$title}</h5>
                                <p class='card-text text-dark' style='display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;'>{$content}</p>
                            </div>
                        </div>";
                    }
                ?>
        </section>
    </main>
</body>
</html>