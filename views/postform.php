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
    </header>
    
    <main>
        <section class="container">
            <form method="POST">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control mb-3" name="title" placeholder="Title" required>
                </div>


                <div class="form-group">
                    <label for="content">Content</label>
                    <textarea class="form-control mb-3" name="content" rows="3" placeholder="content"></textarea required>
                </div>


                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="text" class="form-control mb-3" name="image" placeholder="Image">
                </div>


                <div class="form-group">
                    <input type="hidden" class="form-control mb-3" name="author" value="<?php echo $pseudo;?>">
                </div>

                <input type="hidden" class="form-control mb-3" name="date" value="<?php echo date("m/d/y");?>">
                <button type="submit" name="submit" class="btn btn-primary">Submit</button>

                <?php if(isset($submitError)) echo $submitError; ?>
            </form>
        </section>
    </main>
</body>
</html>