<!DOCTYPE html>
<style> 
    <?php include 'CSS/main.css'; ?>
</style>
<html lang="en">
<?php include './views/includes/head.php'; ?>
<body>
    <?php include_once './views/includes/header.php';?>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Blog</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <a href="index.php?action=add" class="btn btn-primary">Add Post</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Content</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($posts as $post): ?>
                            <tr>
                                <td><?php echo $post['title']; ?></td>
                                <td><?php echo $post['content']; ?></td>
                                <td>
                                    <a href="index.php?action=edit&id=<?php echo $post['id']; ?>" class="btn btn-primary">Edit</a>
                                    <a href="index.php?action=delete&id=<?php echo $post['id']; ?>" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>