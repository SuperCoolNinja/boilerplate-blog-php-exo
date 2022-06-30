<html lang="en">
    
<style>
<?php include 'CSS/main.css';?>
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
                    <label for="Pseudo">Pseudo</label>
                    <input type="text" class="form-control mb-3" name="pseudo" placeholder="Enter your pseudo to log in.">
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
            </form>
        </section>
    </main>
</body>
</html>